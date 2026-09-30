<?php

declare(strict_types=1);

namespace AugurApi\Core\Exceptions;

use Exception;
use Throwable;

/**
 * Base exception for Augur API errors.
 *
 * $service is the kebab service name and $endpoint the path template
 * (e.g. "/inv-mast/{invMastUid}"); both are '' when unknown. Neither the
 * message nor these fields ever carry param values.
 */
class AugurApiException extends Exception
{
    public function __construct(
        string $message = 'API request failed',
        int $code = 0,
        ?Throwable $previous = null,
        public readonly string $service = '',
        public readonly string $endpoint = '',
    ) {
        parent::__construct($message, $code, $previous);
    }
}
