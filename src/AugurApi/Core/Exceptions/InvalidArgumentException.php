<?php

declare(strict_types=1);

namespace AugurApi\Core\Exceptions;

/**
 * Thrown before any I/O when arguments would produce a malformed request: a
 * bad path-segment value, or a call() argument that does not fit the endpoint.
 *
 * Distinct from the global \InvalidArgumentException so callers can catch this
 * specifically (e.g. to log toxic stringified primitives like "NaN", "null",
 * "undefined") without also catching unrelated PHP runtime arg errors.
 * Messages name keys, never values.
 */
final class InvalidArgumentException extends AugurApiException
{
    public function __construct(string $message, string $service = '', string $endpoint = '')
    {
        parent::__construct($message, 400, null, $service, $endpoint);
    }
}
