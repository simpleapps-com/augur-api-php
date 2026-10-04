<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * rts resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://logistics.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://logistics.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://logistics.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
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
     * List RTS Brands
     * Call: $api->logistics->rts->listBrands()
     *
     * List RTS machine brands (proxies RTS Partner Track Finder API)
     *
     * GET https://logistics.augur-api.com/rts/brands
     * Contract: https://logistics.augur-api.com/openapi.json#/paths/~1rts~1brands/get
     *
     * Query params ($params; `?` = optional):
     *   search?: string — Optional case-insensitive name filter
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
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
     * List RTS Machines for Brand
     * Call: $api->logistics->rts->listBrandsMachines($brandId)
     *
     * List RTS machines for a specific brand (proxies RTS Partner Track Finder API)
     *
     * GET https://logistics.augur-api.com/rts/brands/{brandId}/machines
     * Contract:
     * https://logistics.augur-api.com/openapi.json#/paths/~1rts~1brands~1{brandId}~1machines/get
     *
     * Query params ($params; `?` = optional):
     *   search?: string — Optional case-insensitive name filter
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param int $brandId RTS brand ID
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
     * List RTS Tracks for Machine
     * Call: $api->logistics->rts->listMachinesTracks($machineId)
     *
     * List RTS tracks compatible with a specific machine (proxies RTS Partner Track Finder API)
     *
     * GET https://logistics.augur-api.com/rts/machines/{machineId}/tracks
     * Contract:
     * https://logistics.augur-api.com/openapi.json#/paths/~1rts~1machines~1{machineId}~1tracks/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param int $machineId RTS machine ID
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
     * Search RTS Machines
     * Call: $api->logistics->rts->listSearchMachines()
     *
     * Search RTS machines across all brands (proxies RTS Partner Track Finder API; max 50 results)
     *
     * Errors:
     *   400: Query parameter "q" is required.
     *
     * GET https://logistics.augur-api.com/rts/search/machines
     * Contract: https://logistics.augur-api.com/openapi.json#/paths/~1rts~1search~1machines/get
     *
     * Query params ($params; `?` = optional):
     *   q: string — Search term (matches machine name and brand name)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
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
     * Get RTS Track
     * Call: $api->logistics->rts->getTrack($trackId)
     *
     * Get a single RTS track by ID (proxies RTS Partner Track Finder API; returns 404 if track not
     * found)
     *
     * Errors:
     *   404: Track not found.
     *
     * GET https://logistics.augur-api.com/rts/track/{trackId}
     * Contract: https://logistics.augur-api.com/openapi.json#/paths/~1rts~1track~1{trackId}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param int $trackId RTS track ID
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
     * Browse RTS Tracks
     * Call: $api->logistics->rts->listTracks()
     *
     * Browse RTS tracks with optional class and search filters (proxies RTS Partner Track Finder
     * API; max 100 results)
     *
     * GET https://logistics.augur-api.com/rts/tracks
     * Contract: https://logistics.augur-api.com/openapi.json#/paths/~1rts~1tracks/get
     *
     * Query params ($params; `?` = optional):
     *   search?: string — Optional search filter (track name, size, or tread pattern)
     *   trackClass?: string — Optional track class filter
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
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
