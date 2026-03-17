<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * entityCustomers resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-apis
 */
final class EntityCustomersResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /entity-customers/refresh
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getRefresh(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/refresh', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
