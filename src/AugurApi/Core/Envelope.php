<?php

declare(strict_types=1);

namespace AugurApi\Core;

/**
 * The 8-key Augur response envelope. Values are passed through as decoded,
 * with no type checks or coercion (see wiki Endpoint-Registry, call()).
 */
final readonly class Envelope
{
    private const array KEYS = [
        'count',
        'data',
        'message',
        'options',
        'params',
        'status',
        'total',
        'totalResults',
    ];

    public function __construct(
        public mixed $count,
        public mixed $data,
        public mixed $message,
        public mixed $options,
        public mixed $params,
        public mixed $status,
        public mixed $total,
        public mixed $totalResults,
    ) {
    }

    /**
     * The envelope when $body is a JSON object (not a list) with all 8 keys, else null.
     */
    public static function fromBody(mixed $body): ?self
    {
        if (!is_array($body) || array_is_list($body)) {
            return null;
        }
        foreach (self::KEYS as $key) {
            if (!array_key_exists($key, $body)) {
                return null;
            }
        }

        return new self(
            $body['count'],
            $body['data'],
            $body['message'],
            $body['options'],
            $body['params'],
            $body['status'],
            $body['total'],
            $body['totalResults'],
        );
    }
}
