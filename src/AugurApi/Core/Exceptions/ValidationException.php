<?php

declare(strict_types=1);

namespace AugurApi\Core\Exceptions;

/**
 * Exception for validation errors (400).
 */
final class ValidationException extends AugurApiException
{
    /**
     * @param array<array-key, mixed> $errors Field map or list, as the API sent it
     */
    public function __construct(
        string $message = 'Validation failed',
        int $code = 400,
        public readonly array $errors = [],
    ) {
        parent::__construct($message, $code);
    }
}
