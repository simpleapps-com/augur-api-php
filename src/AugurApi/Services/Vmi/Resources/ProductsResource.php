<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Products resource.
 *
 * @fullPath api.vmi.products
 * @service vmi
 * @domain inventory
 */
final class ProductsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List products.
     *
     * @fullPath api.vmi.products.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/products', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Find products and items.
     *
     * @fullPath api.vmi.products.find
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function find(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/products/find', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get product details.
     *
     * @fullPath api.vmi.products.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $productsUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/products/{productsUid}',
            [],
            ['productsUid' => (string) $productsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create product.
     *
     * @fullPath api.vmi.products.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(int $distributorsUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/distributors/{distributorsUid}/products',
            $data,
            ['distributorsUid' => (string) $distributorsUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update product.
     *
     * @fullPath api.vmi.products.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $productsUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/products/{productsUid}',
            $data,
            ['productsUid' => (string) $productsUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete product.
     *
     * @fullPath api.vmi.products.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $productsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/products/{productsUid}',
            ['productsUid' => (string) $productsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }

    /**
     * Enable product.
     *
     * @fullPath api.vmi.products.enable
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function enable(int $productsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/products/{productsUid}/enable',
            $data,
            ['productsUid' => (string) $productsUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
