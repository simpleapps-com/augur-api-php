<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * warehouse resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
 */
final class WarehouseResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /warehouse
     *
     * Response data type: array
     * Known fields: warehouseUid, warehouseId, warehouseName, warehouseDesc, dateCreated, dateLastModified, updateCd, statusCd, ... (11 total)
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
     * POST /warehouse
     *
     * Response data type: object
     * Known fields: warehouseUid, warehouseId, warehouseName, warehouseDesc, dateCreated, dateLastModified, updateCd, statusCd, ... (11 total)
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
     * DELETE /warehouse/{warehouseUid}
     *
     * Response data type: object
     * Known fields: warehouseUid, warehouseId, warehouseName, warehouseDesc, dateCreated, dateLastModified, updateCd, statusCd, ... (11 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $warehouseUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{warehouseUid}',
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /warehouse/{warehouseUid}
     *
     * Response data type: object
     * Known fields: warehouseUid, warehouseId, warehouseName, warehouseDesc, dateCreated, dateLastModified, updateCd, statusCd, ... (11 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /warehouse/{warehouseUid}
     *
     * Response data type: object
     * Known fields: warehouseUid, warehouseId, warehouseName, warehouseDesc, dateCreated, dateLastModified, updateCd, statusCd, ... (11 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{warehouseUid}',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /warehouse/{warehouseUid}/adjust
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAdjust(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/adjust',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /warehouse/{warehouseUid}/availability
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAvailability(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}/availability',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /warehouse/{warehouseUid}/enable
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateEnable(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{warehouseUid}/enable',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /warehouse/{warehouseUid}/receive
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createReceive(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/receive',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /warehouse/{warehouseUid}/replenish
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listReplenish(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}/replenish',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /warehouse/{warehouseUid}/replenish
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createReplenish(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/replenish',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /warehouse/{warehouseUid}/transfer
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createTransfer(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/transfer',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /warehouse/{warehouseUid}/usage
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createUsage(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/usage',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /warehouse/{warehouseUid}/users
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listUsers(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}/users',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /warehouse/{warehouseUid}/users
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createUsers(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/users',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /warehouse/{warehouseUid}/users/{usersId}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteUsers(int $warehouseUid, int $usersId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{warehouseUid}/users/{usersId}',
            ['warehouseUid' => (string) $warehouseUid, 'usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /warehouse/{warehouseUid}/users/{usersId}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getUsers(int $warehouseUid, int $usersId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}/users/{usersId}',
            $params,
            ['warehouseUid' => (string) $warehouseUid, 'usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /warehouse/{warehouseUid}/users/{usersId}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateUsers(int $warehouseUid, int $usersId, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{warehouseUid}/users/{usersId}',
            $data,
            ['warehouseUid' => (string) $warehouseUid, 'usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
