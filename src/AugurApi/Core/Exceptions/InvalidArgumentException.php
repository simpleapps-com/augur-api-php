<?php

declare(strict_types=1);

namespace AugurApi\Core\Exceptions;

/**
 * Thrown when a path-segment value would produce a malformed URL.
 *
 * Distinct from the global \InvalidArgumentException so callers can catch this
 * specifically (e.g. to log toxic stringified primitives like "NaN", "null",
 * "undefined") without also catching unrelated PHP runtime arg errors.
 */
final class InvalidArgumentException extends AugurApiException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 400);
    }
}
