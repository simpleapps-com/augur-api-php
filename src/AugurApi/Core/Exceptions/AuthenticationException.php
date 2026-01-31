<?php

declare(strict_types=1);

namespace AugurApi\Core\Exceptions;

/**
 * Exception for authentication failures (401, 403).
 */
final class AuthenticationException extends AugurApiException
{
    public function __construct(
        string $message = 'Authentication failed',
        int $code = 401,
    ) {
        parent::__construct($message, $code);
    }
}
