<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;
use AugurApi\Core\Schemas\EdgeCache;

/**
 * TodosSummary resource.
 *
 * @fullPath api.basecamp2.todosSummary
 * @service basecamp2
 * @domain project-management
 */
final class TodosSummaryResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List all todo summaries with pagination and filtering.
     *
     * @fullPath api.basecamp2.todosSummary.list
     * @param array<string, mixed> $params List parameters including pagination and filters
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/todos-summary', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get a specific todo summary by ID.
     *
     * @fullPath api.basecamp2.todosSummary.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id, ?EdgeCache $edgeCache = null): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/todos-summary/{id}',
            $edgeCache !== null ? ['edgeCache' => $edgeCache->value] : [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
