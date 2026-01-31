<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Location resource.
 *
 * @fullPath api.p21Core.location
 * @service p21-core
 * @domain location-and-warehouse-management
 */
final class LocationResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List locations with filtering.
     *
     * @fullPath api.p21Core.location.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/location', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get location details by ID.
     *
     * @fullPath api.p21Core.location.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $locationId): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/location/{locationId}',
            [],
            ['locationId' => (string) $locationId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
