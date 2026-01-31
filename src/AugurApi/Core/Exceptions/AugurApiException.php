<?php

declare(strict_types=1);

namespace AugurApi\Core\Exceptions;

use Exception;

/**
 * Base exception for Augur API errors.
 */
class AugurApiException extends Exception
{
    public function __construct(
        string $message = 'API request failed',
        int $code = 0,
        ?Exception $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
