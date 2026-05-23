<?php

declare(strict_types=1);

namespace AugurApi\Core;

use AugurApi\Core\Exceptions\InvalidArgumentException;

/**
 * Validate path-segment values before they are interpolated into request URLs.
 *
 * Rejects toxic stringified primitives ("NaN", "null", "undefined") and empty
 * strings for placeholders whose name encodes an integer type per the Augur
 * API placeholder naming convention (Id/Uid/No/Num/Number suffix, or exact
 * `id`/`lineNumber`). String-typed placeholders are checked for emptiness only.
 *
 * Verified against shared/openapi/*.json on 2026-05-22. Of 74 distinct
 * placeholders, only four have an integer-looking suffix but are typed as
 * string in OpenAPI (see STRING_OVERRIDES).
 */
final class PathValidator
{
    /**
     * Placeholder names treated as integer despite no suffix match.
     */
    private const NUMERIC_EXACT = ['id', 'linenumber'];

    /**
     * Placeholder names that look numeric but are string-typed in OpenAPI.
     */
    private const STRING_OVERRIDES = [
        'siteid',
        'pono',
        'importuid',
        'scheduledimportmasteruid',
    ];

    /**
     * @return bool true if the placeholder name indicates an integer parameter.
     */
    public static function isNumericPlaceholder(string $placeholder): bool
    {
        $normalised = strtolower(str_replace(['-', '_'], '', $placeholder));
        if (in_array($normalised, self::STRING_OVERRIDES, true)) {
            return false;
        }
        if (in_array($normalised, self::NUMERIC_EXACT, true)) {
            return true;
        }
        return (bool) preg_match('/(?:id|uid|no|num|number)$/', $normalised);
    }

    /**
     * Validate a path-segment value before substitution.
     *
     * For numeric placeholders the value MUST match /^-?\d+$/ — stringified
     * primitives ("NaN", "null", "undefined") and empty strings are rejected.
     *
     * For string placeholders only the empty string is rejected.
     *
     * @throws InvalidArgumentException when the value would produce a malformed URL.
     */
    public static function validate(string $pathTemplate, string $placeholder, string $value): void
    {
        if (self::isNumericPlaceholder($placeholder)) {
            if (preg_match('/^-?\d+$/', $value) !== 1) {
                throw new InvalidArgumentException(sprintf(
                    "Invalid path parameter '%s' for %s: expected an integer, received %s",
                    $placeholder,
                    $pathTemplate,
                    json_encode($value),
                ));
            }
            return;
        }

        if ($value === '') {
            throw new InvalidArgumentException(sprintf(
                "Invalid path parameter '%s' for %s: expected a non-empty string, received %s",
                $placeholder,
                $pathTemplate,
                json_encode($value),
            ));
        }
    }
}
