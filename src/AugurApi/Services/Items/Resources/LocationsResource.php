<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Locations resource.
 *
 * @fullPath api.items.locations
 * @service items
 * @domain inventory-management
 */
final class LocationsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List location bins.
     *
     * @fullPath api.items.locations.bins.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listBins(string $locationId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/locations/{locationId}/bins',
            $params,
            ['locationId' => $locationId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get location bin.
     *
     * @fullPath api.items.locations.bins.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function getBin(string $locationId, string $bin): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/locations/{locationId}/bins/{bin}',
            [],
            ['locationId' => $locationId, 'bin' => $bin],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
