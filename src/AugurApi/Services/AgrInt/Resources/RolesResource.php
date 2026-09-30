<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * roles resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-int
 */
final class RolesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /roles
     *
     * Response data type: array
     *   rolesUid: int
     *   roleId: string
     *   roleName: string
     *   description: string|null
     *   systemFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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
     * POST /roles
     *
     * Response data type: object
     *   rolesUid: int
     *   roleId: string
     *   roleName: string
     *   description: string|null
     *   systemFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{roleName: string, description?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null} $data
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
     * DELETE /roles/{rolesUid}
     *
     * Response data type: object
     *   rolesUid: int
     *   roleId: string
     *   roleName: string
     *   description: string|null
     *   systemFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $rolesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{rolesUid}',
            ['rolesUid' => (string) $rolesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /roles/{rolesUid}
     *
     * Response data type: object
     *   rolesUid: int
     *   roleId: string
     *   roleName: string
     *   description: string|null
     *   systemFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $rolesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{rolesUid}',
            $params,
            ['rolesUid' => (string) $rolesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /roles/{rolesUid}
     *
     * Response data type: object
     *   rolesUid: int
     *   roleId: string
     *   roleName: string
     *   description: string|null
     *   systemFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{roleName?: string|null, description?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $rolesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{rolesUid}',
            $data,
            ['rolesUid' => (string) $rolesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /roles/{rolesUid}/bundles
     *
     * Response data type: array
     *   rolesXBundlesUid: int
     *   rolesUid: int
     *   bundlesUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listBundles(int $rolesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{rolesUid}/bundles',
            $params,
            ['rolesUid' => (string) $rolesUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /roles/{rolesUid}/bundles
     *
     * Response data type: object
     *   rolesXBundlesUid: int
     *   rolesUid: int
     *   bundlesUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{bundlesUid: int} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createBundles(int $rolesUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{rolesUid}/bundles',
            $data,
            ['rolesUid' => (string) $rolesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /roles/{rolesUid}/bundles/{rolesXBundlesUid}
     *
     * Response data type: object
     *   rolesXBundlesUid: int
     *   rolesUid: int
     *   bundlesUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteBundles(int $rolesUid, int $rolesXBundlesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{rolesUid}/bundles/{rolesXBundlesUid}',
            ['rolesUid' => (string) $rolesUid, 'rolesXBundlesUid' => (string) $rolesXBundlesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /roles/{rolesUid}/bundles/{rolesXBundlesUid}
     *
     * Response data type: object
     *   rolesXBundlesUid: int
     *   rolesUid: int
     *   bundlesUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getBundles(int $rolesUid, int $rolesXBundlesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{rolesUid}/bundles/{rolesXBundlesUid}',
            $params,
            ['rolesUid' => (string) $rolesUid, 'rolesXBundlesUid' => (string) $rolesXBundlesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /roles/{rolesUid}/bundles/{rolesXBundlesUid}
     *
     * Response data type: object
     *   rolesXBundlesUid: int
     *   rolesUid: int
     *   bundlesUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{statusCd?: int|null, processCd?: int|null} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateBundles(int $rolesUid, int $rolesXBundlesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{rolesUid}/bundles/{rolesXBundlesUid}',
            $data,
            ['rolesUid' => (string) $rolesUid, 'rolesXBundlesUid' => (string) $rolesXBundlesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
