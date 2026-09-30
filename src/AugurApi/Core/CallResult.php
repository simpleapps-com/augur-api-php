<?php

declare(strict_types=1);

namespace AugurApi\Core;

/**
 * Result of AugurApiClient::call() for a 2xx response.
 *
 * $body is the decoded JSON when the text parses, otherwise the raw text
 * ('' for an empty body). $envelope is set only when $body is the 8-key envelope.
 */
final readonly class CallResult
{
    public function __construct(
        public int $httpStatus,
        public ?Envelope $envelope,
        public mixed $body,
    ) {
    }

    public static function fromResponse(RawResponse $response): self
    {
        $body = $response->isJson ? $response->json : $response->text;

        return new self($response->status, Envelope::fromBody($body), $body);
    }
}
