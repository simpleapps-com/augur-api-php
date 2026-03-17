<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * openSearch resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 */
final class OpenSearchResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /open-search/embedding
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listEmbedding(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/embedding', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
