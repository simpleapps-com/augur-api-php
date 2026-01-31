<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Speedship resource.
 *
 * @fullPath api.logistics.speedship
 * @service logistics
 * @domain shipping
 */
final class SpeedshipResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get Speedship freight.
     *
     * @fullPath api.logistics.speedship.getFreight
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getFreight(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/speedship/freight', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
