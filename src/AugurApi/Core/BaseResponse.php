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
        $message = $response['message'] ?? null;

        return new self(
            data: $dataMapper($response['data'] ?? null),
            status: Field::int($response['status'] ?? null) ?? 200,
            message: is_string($message) ? $message : null,
            total: Field::int($response['total'] ?? null),
            limit: Field::int($response['limit'] ?? null),
            offset: Field::int($response['offset'] ?? null),
        );
    }
}
