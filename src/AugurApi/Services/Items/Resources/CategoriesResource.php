<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Categories resource.
 *
 * @fullPath api.items.categories
 * @service items
 * @domain inventory-management
 */
final class CategoriesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Lookup categories.
     *
     * @fullPath api.items.categories.lookup.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function lookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/categories/lookup', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get category details.
     *
     * @fullPath api.items.categories.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $itemCategoryUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/categories/{itemCategoryUid}',
            [],
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * List category attributes.
     *
     * @fullPath api.items.categories.attributes.list
     * @return BaseResponse<array{attributes: array<array<string, mixed>>}>
     */
    public function listAttributes(int $itemCategoryUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/categories/{itemCategoryUid}/attributes',
            [],
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? ['attributes' => []]);
    }

    /**
     * List category images.
     *
     * @fullPath api.items.categories.images.list
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listImages(int $itemCategoryUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/categories/{itemCategoryUid}/images',
            [],
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * List category items.
     *
     * API returns nested structure: { data: { itemCategoryUid, took, total, items: [...] } }
     *
     * @fullPath api.items.categories.items.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array{itemCategoryUid: int, itemCategoryId?: string, itemCategoryDesc?: string, took: int, total: int, items: array<array<string, mixed>>}>
     */
    public function listItems(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/categories/{itemCategoryUid}/items',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? ['itemCategoryUid' => $itemCategoryUid, 'took' => 0, 'total' => 0, 'items' => []]);
    }
}
