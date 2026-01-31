<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Items resource for OpenSearch.
 *
 * @fullPath api.openSearch.items
 * @service open_search
 * @domain search
 */
final class ItemsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List items.
     *
     * @fullPath api.openSearch.items.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/items', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get item document.
     *
     * @fullPath api.openSearch.items.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/items/{invMastUid}',
            [],
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Update item document.
     *
     * @fullPath api.openSearch.items.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invMastUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/items/{invMastUid}',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Refresh item document.
     *
     * @fullPath api.openSearch.items.refreshItem
     * @return BaseResponse<array<string, mixed>>
     */
    public function refreshItem(int $invMastUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/items/{invMastUid}/refresh',
            [],
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Refresh all items.
     *
     * @fullPath api.openSearch.items.refresh
     * @return BaseResponse<array<string, mixed>>
     */
    public function refresh(): BaseResponse
    {
        $response = $this->client->put($this->baseUrl, '/items/refresh', []);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
