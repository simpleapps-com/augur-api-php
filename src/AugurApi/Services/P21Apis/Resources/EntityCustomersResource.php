<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Entity customers resource.
 *
 * @fullPath api.p21Apis.entityCustomers
 * @service p21-apis
 * @domain entity-data-management
 */
final class EntityCustomersResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Trigger entity customers data refresh for synchronization.
     *
     * @fullPath api.p21Apis.entityCustomers.refresh.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function refresh(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/entity-customers/refresh', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
