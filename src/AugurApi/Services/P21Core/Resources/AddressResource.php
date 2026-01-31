<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Address resource.
 *
 * @fullPath api.p21Core.address
 * @service p21-core
 * @domain address-and-shipping-management
 */
final class AddressResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List all addresses with filtering capabilities.
     *
     * @fullPath api.p21Core.address.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/address', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get address details by ID.
     *
     * @fullPath api.p21Core.address.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/address/{id}',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get corporate address list.
     *
     * @fullPath api.p21Core.address.corpAddress.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getCorpAddress(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/address/{id}/corp-address',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get default address.
     *
     * @fullPath api.p21Core.address.default.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDefault(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/address/{id}/default',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Enable or disable address as shipping method.
     *
     * @fullPath api.p21Core.address.enable.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function enable(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/address/{id}/enable',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Trigger data refresh for address synchronization.
     *
     * @fullPath api.p21Core.address.refresh.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function refresh(): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/address/refresh');

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
