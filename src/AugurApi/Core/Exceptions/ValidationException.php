<?php

declare(strict_types=1);

namespace AugurApi\Core\Exceptions;

/**
 * Exception for validation errors (400).
 */
final class ValidationException extends AugurApiException
{
    /**
     * @param array<string, mixed> $errors
     */
    public function __construct(
        string $message = 'Validation failed',
        int $code = 400,
        public readonly array $errors = [],
    ) {
        parent::__construct($message, $code);
    }
}
