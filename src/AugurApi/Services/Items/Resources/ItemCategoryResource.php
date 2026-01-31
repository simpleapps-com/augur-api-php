<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Item Category resource.
 *
 * @fullPath api.items.itemCategory
 * @service items
 * @domain inventory-management
 */
final class ItemCategoryResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List item categories.
     *
     * @fullPath api.items.itemCategory.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/item-category', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Lookup item categories.
     *
     * @fullPath api.items.itemCategory.lookup.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function lookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/item-category/lookup', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get item category details.
     *
     * @fullPath api.items.itemCategory.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $itemCategoryUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/item-category/{itemCategoryUid}',
            [],
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * List item category documents.
     *
     * @fullPath api.items.itemCategory.doc.list
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listDoc(int $itemCategoryUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/item-category/{itemCategoryUid}/doc',
            [],
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
