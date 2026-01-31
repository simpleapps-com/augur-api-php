<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * ShipVia resource.
 *
 * @fullPath api.logistics.shipvia
 * @service logistics
 * @domain shipping
 */
final class ShipviaResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get ShipVia shipping rates from multiple carriers.
     *
     * @fullPath api.logistics.shipvia.getRates
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getRates(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/shipvia/rates', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get ShipVia LTL (Less-Than-Truckload) freight rates from multiple carriers.
     *
     * @fullPath api.logistics.shipvia.getLtlRates
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLtlRates(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/shipvia/rates/ltl', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
