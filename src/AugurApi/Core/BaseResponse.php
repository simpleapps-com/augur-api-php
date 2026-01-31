<?php

declare(strict_types=1);

namespace AugurApi\Core;

/**
 * Base response wrapper for all API responses.
 *
 * @template T
 */
final readonly class BaseResponse
{
    /**
     * @param T $data
     */
    public function __construct(
        public mixed $data,
        public int $status = 200,
        public ?string $message = null,
        public ?int $total = null,
        public ?int $limit = null,
        public ?int $offset = null,
    ) {
    }

    /**
     * @template U
     * @param array<string, mixed> $response
     * @param callable(mixed): U $dataMapper
     * @return self<U>
     */
    public static function fromArray(array $response, callable $dataMapper): self
    {
        return new self(
            data: $dataMapper($response['data'] ?? null),
            status: (int) ($response['status'] ?? 200),
            message: $response['message'] ?? null,
            total: isset($response['total']) ? (int) $response['total'] : null,
            limit: isset($response['limit']) ? (int) $response['limit'] : null,
            offset: isset($response['offset']) ? (int) $response['offset'] : null,
        );
    }
}
