<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Comments resource.
 *
 * @fullPath api.basecamp2.comments
 * @service basecamp2
 * @domain project-management
 */
final class CommentsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List all comments with filtering and pagination.
     *
     * @fullPath api.basecamp2.comments.list
     * @param array<string, mixed> $params Optional filtering and pagination parameters
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/comments', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get a specific comment by ID.
     *
     * @fullPath api.basecamp2.comments.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/comments/{id}',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
