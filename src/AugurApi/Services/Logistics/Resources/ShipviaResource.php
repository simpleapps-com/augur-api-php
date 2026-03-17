<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * shipvia resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py logistics
 */
final class ShipviaResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /shipvia/rates
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listRates(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/rates', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /shipvia/rates/ltl
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listRatesLtl(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/rates/ltl', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
