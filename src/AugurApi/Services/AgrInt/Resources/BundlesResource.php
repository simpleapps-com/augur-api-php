<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * bundles resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-int
 */
final class BundlesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /bundles
     *
     * Response data type: array
     * Known fields: bundlesUid, bundleId, bundleName, description, systemFlag, dateCreated, dateLastModified, updateCd, ... (10 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /bundles
     *
     * Response data type: object
     * Known fields: bundlesUid, bundleId, bundleName, description, systemFlag, dateCreated, dateLastModified, updateCd, ... (10 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /bundles/{bundlesUid}
     *
     * Response data type: object
     * Known fields: bundlesUid, bundleId, bundleName, description, systemFlag, dateCreated, dateLastModified, updateCd, ... (10 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $bundlesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{bundlesUid}',
            ['bundlesUid' => (string) $bundlesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /bundles/{bundlesUid}
     *
     * Response data type: object
     * Known fields: bundlesUid, bundleId, bundleName, description, systemFlag, dateCreated, dateLastModified, updateCd, ... (10 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $bundlesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{bundlesUid}',
            $params,
            ['bundlesUid' => (string) $bundlesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /bundles/{bundlesUid}
     *
     * Response data type: object
     * Known fields: bundlesUid, bundleId, bundleName, description, systemFlag, dateCreated, dateLastModified, updateCd, ... (10 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $bundlesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{bundlesUid}',
            $data,
            ['bundlesUid' => (string) $bundlesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /bundles/{bundlesUid}/resources
     *
     * Response data type: array
     * Known fields: bundlesXResourcesUid, bundlesUid, resourcesUid, readCd, writeCd, executeCd, dateCreated, dateLastModified, ... (11 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listResources(int $bundlesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{bundlesUid}/resources',
            $params,
            ['bundlesUid' => (string) $bundlesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /bundles/{bundlesUid}/resources
     *
     * Response data type: object
     * Known fields: bundlesXResourcesUid, bundlesUid, resourcesUid, readCd, writeCd, executeCd, dateCreated, dateLastModified, ... (11 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createResources(int $bundlesUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{bundlesUid}/resources',
            $data,
            ['bundlesUid' => (string) $bundlesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /bundles/{bundlesUid}/resources/{bundlesXResourcesUid}
     *
     * Response data type: object
     * Known fields: bundlesXResourcesUid, bundlesUid, resourcesUid, readCd, writeCd, executeCd, dateCreated, dateLastModified, ... (11 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteResources(int $bundlesUid, int $bundlesXResourcesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{bundlesUid}/resources/{bundlesXResourcesUid}',
            ['bundlesUid' => (string) $bundlesUid, 'bundlesXResourcesUid' => (string) $bundlesXResourcesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /bundles/{bundlesUid}/resources/{bundlesXResourcesUid}
     *
     * Response data type: object
     * Known fields: bundlesXResourcesUid, bundlesUid, resourcesUid, readCd, writeCd, executeCd, dateCreated, dateLastModified, ... (11 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getResources(int $bundlesUid, int $bundlesXResourcesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{bundlesUid}/resources/{bundlesXResourcesUid}',
            $params,
            ['bundlesUid' => (string) $bundlesUid, 'bundlesXResourcesUid' => (string) $bundlesXResourcesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /bundles/{bundlesUid}/resources/{bundlesXResourcesUid}
     *
     * Response data type: object
     * Known fields: bundlesXResourcesUid, bundlesUid, resourcesUid, readCd, writeCd, executeCd, dateCreated, dateLastModified, ... (11 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateResources(int $bundlesUid, int $bundlesXResourcesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{bundlesUid}/resources/{bundlesXResourcesUid}',
            $data,
            ['bundlesUid' => (string) $bundlesUid, 'bundlesXResourcesUid' => (string) $bundlesXResourcesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
