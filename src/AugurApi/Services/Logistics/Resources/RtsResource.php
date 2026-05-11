<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * rts resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py logistics
 */
final class RtsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /rts/brands
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listBrands(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/brands', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /rts/brands/<brandId:\d+>/machines
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listBrandsBrandIdMachines(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/brands/<brandId:\d+>/machines', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /rts/machines/<machineId:\d+>/tracks
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listMachinesMachineIdTracks(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/machines/<machineId:\d+>/tracks', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /rts/search/machines
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listSearchMachines(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/search/machines', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /rts/track/<trackId:\d+>
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listTrackTrackId(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/track/<trackId:\d+>', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /rts/tracks
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listTracks(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/tracks', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
