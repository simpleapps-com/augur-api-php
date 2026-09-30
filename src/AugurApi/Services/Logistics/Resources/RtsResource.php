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
     * @return BaseResponse<mixed>
     */
    public function listBrands(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/brands', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /rts/brands/{brandId}/machines
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listBrandsMachines(int $brandId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/brands/{brandId}/machines',
            $params,
            ['brandId' => (string) $brandId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /rts/machines/{machineId}/tracks
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listMachinesTracks(int $machineId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/machines/{machineId}/tracks',
            $params,
            ['machineId' => (string) $machineId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /rts/search/machines
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listSearchMachines(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/search/machines', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /rts/track/{trackId}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getTrack(int $trackId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/track/{trackId}',
            $params,
            ['trackId' => (string) $trackId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /rts/tracks
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listTracks(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/tracks', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
