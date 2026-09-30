<?php

declare(strict_types=1);

namespace AugurApi\Core\Exceptions;

/**
 * Exception for missing resources or unrouted paths (404).
 */
final class NotFoundException extends AugurApiException
{
    public function __construct(
        string $message = 'Resource not found',
        int $code = 404,
        string $service = '',
        string $endpoint = '',
    ) {
        parent::__construct($message, $code, null, $service, $endpoint);
    }
}
