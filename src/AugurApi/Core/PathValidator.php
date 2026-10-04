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
 * `id`/`lineNumber`). String-typed placeholders must be non-empty and use only
 * characters a URL path carries literally, since values are sent unencoded.
 *
 * STRING_OVERRIDES lists the placeholders with an integer-looking suffix that
 * the specs type as string. Re-derive it from shared/specs/*.json
 * (`path_params[].type`) after every sync that adds a path param; a missing
 * entry rejects valid string ids client-side. `grantid` and `salesrepid`
 * belong to endpoints since removed and are kept so older paths stay accepted.
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
        'grantid',
        'salesrepid',
        'companyid',
        'orderno',
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
     * A value made only of the characters a URL path segment carries literally
     * (RFC 3986 pchar minus "%"). Path values are sent unencoded because the API
     * never decodes them ("D%2FS" is looked up literally); anything else would
     * split or end the path, or be percent-encoded on the way and never match.
     */
    private const PATH_SAFE = '/\A[A-Za-z0-9\-._~!$&\'()*+,;=:@]+\z/';

    /**
     * Validate a path-segment value before substitution.
     *
     * For numeric placeholders the value MUST match /^-?\d+$/ — stringified
     * primitives ("NaN", "null", "undefined") and empty strings are rejected.
     *
     * For string placeholders the value MUST be non-empty and use only
     * path-safe characters (PATH_SAFE). Any other value can only be sent as a
     * query parameter (e.g. bins list with query ['bin' => 'D/S']).
     *
     * Messages name the placeholder, never the value; the exception's
     * endpoint carries the template.
     *
     * @ensures (returns) ⇒ $value is safe to insert into the URL path unencoded
     * @ensures ∀ thrown e. $value ∉ e.message  (values may be card data or PII)
     * @trusted Last line of defence before the value reaches the wire; the API
     *          does not decode path segments, so a miss here misroutes the
     *          request or silently matches nothing.
     *
     * @param string $service Kebab service name carried on the exception
     * @throws InvalidArgumentException when the value would produce a malformed or misrouted URL.
     */
    public static function validate(
        string $pathTemplate,
        string $placeholder,
        string $value,
        string $service = '',
    ): void {
        $problem = self::problem($placeholder, $value);
        if ($problem !== null) {
            throw new InvalidArgumentException(
                "Invalid path parameter '{$placeholder}': {$problem}",
                $service,
                $pathTemplate,
            );
        }
    }

    /**
     * What is wrong with $value as a path segment, or null when it is safe.
     */
    private static function problem(string $placeholder, string $value): ?string
    {
        if (self::isNumericPlaceholder($placeholder)) {
            return preg_match('/\A-?\d+\z/', $value) === 1 ? null : 'expected an integer';
        }
        if ($value === '') {
            return 'expected a non-empty string';
        }
        return preg_match(self::PATH_SAFE, $value) === 1 ? null : "contains characters a URL path can't carry";
    }
}
