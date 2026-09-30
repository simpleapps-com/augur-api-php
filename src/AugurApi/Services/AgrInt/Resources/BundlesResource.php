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
     *   bundlesUid: int
     *   bundleId: string
     *   bundleName: string
     *   description: string|null
     *   systemFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   menuGroup: int|null
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /bundles
     *
     * Response data type: object
     *   bundlesUid: int
     *   bundleId: string
     *   bundleName: string
     *   description: string|null
     *   systemFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   menuGroup: int|null
     *
     * @param array{bundleName: string, description?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /bundles/{bundlesUid}
     *
     * Response data type: object
     *   bundlesUid: int
     *   bundleId: string
     *   bundleName: string
     *   description: string|null
     *   systemFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   menuGroup: int|null
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /bundles/{bundlesUid}
     *
     * Response data type: object
     *   bundlesUid: int
     *   bundleId: string
     *   bundleName: string
     *   description: string|null
     *   systemFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   menuGroup: int|null
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /bundles/{bundlesUid}
     *
     * Response data type: object
     *   bundlesUid: int
     *   bundleId: string
     *   bundleName: string
     *   description: string|null
     *   systemFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   menuGroup: int|null
     *
     * @param array{bundleName?: string|null, description?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null} $data
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /bundles/{bundlesUid}/resources
     *
     * Response data type: array
     *   bundlesXResourcesUid: int
     *   bundlesUid: int
     *   resourcesUid: int
     *   readCd: int
     *   writeCd: int
     *   executeCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listResources(int $bundlesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{bundlesUid}/resources',
            $params,
            ['bundlesUid' => (string) $bundlesUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /bundles/{bundlesUid}/resources
     *
     * Response data type: object
     *   bundlesXResourcesUid: int
     *   bundlesUid: int
     *   resourcesUid: int
     *   readCd: int
     *   writeCd: int
     *   executeCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{resourcesUid: int, readCd?: int|null, writeCd?: int|null, executeCd?: int|null} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createResources(int $bundlesUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{bundlesUid}/resources',
            $data,
            ['bundlesUid' => (string) $bundlesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /bundles/{bundlesUid}/resources/{bundlesXResourcesUid}
     *
     * Response data type: object
     *   bundlesXResourcesUid: int
     *   bundlesUid: int
     *   resourcesUid: int
     *   readCd: int
     *   writeCd: int
     *   executeCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /bundles/{bundlesUid}/resources/{bundlesXResourcesUid}
     *
     * Response data type: object
     *   bundlesXResourcesUid: int
     *   bundlesUid: int
     *   resourcesUid: int
     *   readCd: int
     *   writeCd: int
     *   executeCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /bundles/{bundlesUid}/resources/{bundlesXResourcesUid}
     *
     * Response data type: object
     *   bundlesXResourcesUid: int
     *   bundlesUid: int
     *   resourcesUid: int
     *   readCd: int
     *   writeCd: int
     *   executeCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{statusCd?: int|null, processCd?: int|null, readCd?: int|null, writeCd?: int|null, executeCd?: int|null} $data
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
