<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Item search resource.
 *
 * @fullPath api.openSearch.itemSearch
 * @service open_search
 * @domain search
 */
final class ItemSearchResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Perform item search.
     *
     * @fullPath api.openSearch.itemSearch.search
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function search(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/item-search', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get attributes from item search.
     *
     * @fullPath api.openSearch.itemSearch.getAttributes
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getAttributes(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/item-search/attributes', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
