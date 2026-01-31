<?php

declare(strict_types=1);

namespace AugurApi\Core\Exceptions;

/**
 * Exception for rate limit errors (429).
 */
final class RateLimitException extends AugurApiException
{
    public function __construct(
        string $message = 'Rate limit exceeded',
        int $code = 429,
    ) {
        parent::__construct($message, $code);
    }
}
