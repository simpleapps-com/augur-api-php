<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Warehouse resource.
 *
 * @fullPath api.vmi.warehouse
 * @service vmi
 * @domain inventory
 */
final class WarehouseResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List warehouses.
     *
     * @fullPath api.vmi.warehouse.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/warehouse', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get warehouse details.
     *
     * @fullPath api.vmi.warehouse.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $warehouseUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/warehouse/{warehouseUid}',
            [],
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create warehouse.
     *
     * @fullPath api.vmi.warehouse.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/warehouse', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update warehouse.
     *
     * @fullPath api.vmi.warehouse.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $warehouseUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/warehouse/{warehouseUid}',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete warehouse.
     *
     * @fullPath api.vmi.warehouse.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $warehouseUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/warehouse/{warehouseUid}',
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }

    /**
     * Get inventory availability.
     *
     * @fullPath api.vmi.warehouse.getAvailability
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getAvailability(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/warehouse/{warehouseUid}/availability',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Receive inventory.
     *
     * @fullPath api.vmi.warehouse.receive
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function receive(int $warehouseUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/warehouse/{warehouseUid}/receive',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Adjust inventory.
     *
     * @fullPath api.vmi.warehouse.adjust
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function adjust(int $warehouseUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/warehouse/{warehouseUid}/adjust',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Transfer inventory.
     *
     * @fullPath api.vmi.warehouse.transfer
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function transfer(int $warehouseUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/warehouse/{warehouseUid}/transfer',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Use inventory.
     *
     * @fullPath api.vmi.warehouse.usage
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function usage(int $warehouseUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/warehouse/{warehouseUid}/usage',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Enable warehouse.
     *
     * @fullPath api.vmi.warehouse.enable
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function enable(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/warehouse/{warehouseUid}/enable',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Get replenishment data.
     *
     * @fullPath api.vmi.warehouse.getReplenish
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getReplenish(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/warehouse/{warehouseUid}/replenish',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Create replenishment.
     *
     * @fullPath api.vmi.warehouse.createReplenish
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createReplenish(int $warehouseUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/warehouse/{warehouseUid}/replenish',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * List warehouse users.
     *
     * @fullPath api.vmi.warehouse.listUsers
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listUsers(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/warehouse/{warehouseUid}/users',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get warehouse user.
     *
     * @fullPath api.vmi.warehouse.getUser
     * @return BaseResponse<array<string, mixed>>
     */
    public function getUser(int $warehouseUid, int $usersId): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/warehouse/{warehouseUid}/users/{usersId}',
            [],
            ['warehouseUid' => (string) $warehouseUid, 'usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create warehouse user.
     *
     * @fullPath api.vmi.warehouse.createUser
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createUser(int $warehouseUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/warehouse/{warehouseUid}/users',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update warehouse user.
     *
     * @fullPath api.vmi.warehouse.updateUser
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateUser(int $warehouseUid, int $usersId, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/warehouse/{warehouseUid}/users/{usersId}',
            $data,
            ['warehouseUid' => (string) $warehouseUid, 'usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete warehouse user.
     *
     * @fullPath api.vmi.warehouse.deleteUser
     * @return BaseResponse<bool>
     */
    public function deleteUser(int $warehouseUid, int $usersId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/warehouse/{warehouseUid}/users/{usersId}',
            ['warehouseUid' => (string) $warehouseUid, 'usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
