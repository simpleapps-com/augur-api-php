<?php

declare(strict_types=1);

namespace AugurApi\Core;

/**
 * Narrow untyped JSON values to scalar fields. Unusable values become null.
 */
final class Field
{
    /**
     * Int for numeric values (int, float, numeric string), else null.
     */
    public static function int(mixed $value): ?int
    {
        return is_numeric($value) ? (int) $value : null;
    }
}
