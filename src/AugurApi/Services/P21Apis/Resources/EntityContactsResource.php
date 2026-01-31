<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Entity contacts resource.
 *
 * @fullPath api.p21Apis.entityContacts
 * @service p21-apis
 * @domain entity-data-management
 */
final class EntityContactsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Trigger entity contacts data refresh for synchronization.
     *
     * @fullPath api.p21Apis.entityContacts.refresh.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function refresh(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/entity-contacts/refresh', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
