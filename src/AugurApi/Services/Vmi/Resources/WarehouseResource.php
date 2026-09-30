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
     *   warehouseUid: int
     *   warehouseId: string
     *   warehouseName: string
     *   warehouseDesc: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   customerId: float
     *   invProfileHdrUid: int
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
     * POST /warehouse
     *
     * Response data type: object
     *   warehouseUid: int
     *   warehouseId: string
     *   warehouseName: string
     *   warehouseDesc: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   customerId: float
     *   invProfileHdrUid: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /warehouse/{warehouseUid}
     *
     * Response data type: object
     *   warehouseUid: int
     *   warehouseId: string
     *   warehouseName: string
     *   warehouseDesc: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   customerId: float
     *   invProfileHdrUid: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /warehouse/{warehouseUid}
     *
     * Response data type: object
     *   warehouseUid: int
     *   warehouseId: string
     *   warehouseName: string
     *   warehouseDesc: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   customerId: float
     *   invProfileHdrUid: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /warehouse/{warehouseUid}
     *
     * Response data type: object
     *   warehouseUid: int
     *   warehouseId: string
     *   warehouseName: string
     *   warehouseDesc: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   customerId: float
     *   invProfileHdrUid: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /warehouse/{warehouseUid}/adjust
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createAdjust(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/adjust',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /warehouse/{warehouseUid}/availability
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listAvailability(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}/availability',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /warehouse/{warehouseUid}/enable
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function updateEnable(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{warehouseUid}/enable',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /warehouse/{warehouseUid}/receive
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createReceive(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/receive',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /warehouse/{warehouseUid}/replenish
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listReplenish(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}/replenish',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /warehouse/{warehouseUid}/replenish
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createReplenish(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/replenish',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /warehouse/{warehouseUid}/transfer
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createTransfer(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/transfer',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /warehouse/{warehouseUid}/usage
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createUsage(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/usage',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /warehouse/{warehouseUid}/users
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listUsers(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}/users',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /warehouse/{warehouseUid}/users
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function createUsers(int $warehouseUid, array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/users',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /warehouse/{warehouseUid}/users/{usersId}
     *
     * @return BaseResponse<mixed>
     */
    public function deleteUsers(int $warehouseUid, int $usersId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{warehouseUid}/users/{usersId}',
            ['warehouseUid' => (string) $warehouseUid, 'usersId' => (string) $usersId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /warehouse/{warehouseUid}/users/{usersId}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getUsers(int $warehouseUid, int $usersId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}/users/{usersId}',
            $params,
            ['warehouseUid' => (string) $warehouseUid, 'usersId' => (string) $usersId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /warehouse/{warehouseUid}/users/{usersId}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function updateUsers(int $warehouseUid, int $usersId, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{warehouseUid}/users/{usersId}',
            $data,
            ['warehouseUid' => (string) $warehouseUid, 'usersId' => (string) $usersId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
