<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;
use AugurApi\Services\Items\Schemas\Brand;
use AugurApi\Services\Items\Schemas\BrandsListParams;

/**
 * Brands resource.
 *
 * @fullPath api.items.brands
 * @service items
 * @domain inventory-management
 */
final class BrandsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List all brands.
     *
     * @fullPath api.items.brands.list
     * @param BrandsListParams|array<string, mixed>|null $params
     * @return BaseResponse<array<Brand>>
     */
    public function list(BrandsListParams|array|null $params = null): BaseResponse
    {
        $queryParams = match (true) {
            $params instanceof BrandsListParams => $params->toArray(),
            is_array($params) => $params,
            default => [],
        };

        $response = $this->client->get($this->baseUrl, '/brands', $queryParams);

        return BaseResponse::fromArray($response, static function ($data): array {
            if (!is_array($data)) {
                return [];
            }
            return array_map(static fn ($item) => Brand::fromArray($item), $data);
        });
    }

    /**
     * Get a brand by UID.
     *
     * @fullPath api.items.brands.get
     * @return BaseResponse<Brand>
     */
    public function get(int $brandsUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/brands/{brandsUid}',
            [],
            ['brandsUid' => (string) $brandsUid],
        );

        return BaseResponse::fromArray(
            $response,
            static fn ($data) => Brand::fromArray($data),
        );
    }

    /**
     * Create a new brand.
     *
     * @fullPath api.items.brands.create
     * @param array<string, mixed> $data
     * @return BaseResponse<Brand>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/brands', $data);

        return BaseResponse::fromArray(
            $response,
            static fn ($data) => Brand::fromArray($data),
        );
    }

    /**
     * Update a brand.
     *
     * @fullPath api.items.brands.update
     * @param array<string, mixed> $data
     * @return BaseResponse<Brand>
     */
    public function update(int $brandsUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/brands/{brandsUid}',
            $data,
            ['brandsUid' => (string) $brandsUid],
        );

        return BaseResponse::fromArray(
            $response,
            static fn ($data) => Brand::fromArray($data),
        );
    }

    /**
     * Delete a brand.
     *
     * @fullPath api.items.brands.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $brandsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/brands/{brandsUid}',
            ['brandsUid' => (string) $brandsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }

    /**
     * Get attributes for a brand.
     *
     * @fullPath api.items.brands.getAttributes
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getAttributes(int $brandsUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/brands/{brandsUid}/attributes',
            [],
            ['brandsUid' => (string) $brandsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get items for a brand.
     *
     * @fullPath api.items.brands.getItems
     * @param array<string, mixed>|null $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getItems(int $brandsUid, ?array $params = null): BaseResponse
    {
        $queryParams = $params ?? [];

        $response = $this->client->get(
            $this->baseUrl,
            '/brands/{brandsUid}/items',
            $queryParams,
            ['brandsUid' => (string) $brandsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
