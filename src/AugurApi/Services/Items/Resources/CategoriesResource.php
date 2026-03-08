<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;
use AugurApi\Core\Exceptions\ValidationException;
use AugurApi\Core\Schemas\EdgeCache;

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
     * When $itemCategoryUid is 0, the `path` param is required to resolve the category by URL path.
     *
     * @fullPath api.items.categories.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $itemCategoryUid, array $params = []): BaseResponse
    {
        if ($itemCategoryUid === 0) {
            $path = $params['path'] ?? '';
            if ($path === '' || trim($path) === '') {
                throw new ValidationException(
                    'categories->get() requires `path` in params when itemCategoryUid is 0. '
                    . 'Use itemCategoryUid: 0 with a path to resolve a category by its URL path.',
                    400,
                    ['itemCategoryUid' => 'path is required when itemCategoryUid is 0'],
                );
            }
        }

        $response = $this->client->get(
            $this->baseUrl,
            '/categories/{itemCategoryUid}',
            $params,
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
    public function listAttributes(int $itemCategoryUid, ?EdgeCache $edgeCache = null): BaseResponse
    {
        if ($itemCategoryUid === 0) {
            throw new ValidationException(
                'categories->listAttributes() does not support itemCategoryUid: 0. '
                . 'Resolve the category UID first using categories->get(0, [\'path\' => ...]) then use the resolved UID.',
                400,
                ['itemCategoryUid' => 'itemCategoryUid: 0 is not supported for this endpoint'],
            );
        }

        $response = $this->client->get(
            $this->baseUrl,
            '/categories/{itemCategoryUid}/attributes',
            $edgeCache !== null ? ['edgeCache' => $edgeCache->value] : [],
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
    public function listImages(int $itemCategoryUid, ?EdgeCache $edgeCache = null): BaseResponse
    {
        if ($itemCategoryUid === 0) {
            throw new ValidationException(
                'categories->listImages() does not support itemCategoryUid: 0. '
                . 'Resolve the category UID first using categories->get(0, [\'path\' => ...]) then use the resolved UID.',
                400,
                ['itemCategoryUid' => 'itemCategoryUid: 0 is not supported for this endpoint'],
            );
        }

        $response = $this->client->get(
            $this->baseUrl,
            '/categories/{itemCategoryUid}/images',
            $edgeCache !== null ? ['edgeCache' => $edgeCache->value] : [],
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
        if ($itemCategoryUid === 0) {
            throw new ValidationException(
                'categories->listItems() does not support itemCategoryUid: 0. '
                . 'Resolve the category UID first using categories->get(0, [\'path\' => ...]) then use the resolved UID.',
                400,
                ['itemCategoryUid' => 'itemCategoryUid: 0 is not supported for this endpoint'],
            );
        }

        $response = $this->client->get(
            $this->baseUrl,
            '/categories/{itemCategoryUid}/items',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? ['itemCategoryUid' => $itemCategoryUid, 'took' => 0, 'total' => 0, 'items' => []]);
    }
}
