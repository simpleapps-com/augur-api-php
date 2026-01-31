<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * OpenSearch resource.
 *
 * @fullPath api.agrSite.openSearch
 * @service agr_site
 * @domain search-optimization
 */
final class OpenSearchResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get text embedding for search optimization.
     *
     * @fullPath api.agrSite.openSearch.getEmbedding
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getEmbedding(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/open-search/embedding', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
