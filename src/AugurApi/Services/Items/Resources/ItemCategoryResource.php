<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * itemCategory resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://items.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://items.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://items.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ItemCategoryListItem:
 * Returned by: $api->items->itemCategory->list()
 *   itemCategoryUid: int — Item category ID
 *   itemCategoryId: string — Item category code (max 255 chars)
 *   itemCategoryDesc: string — Item category name (max 255 chars)
 *   masterCategoryFlag: string — Y when this is a master category (max 1 chars)
 *   parentCategoryFlag: string — Y when the category has child categories (max 1 chars)
 *   displayOnWebFlag: string — Y when the category shows on the website (max 1 chars)
 *   displayMasterProductFlag: string — Y when the master product is displayed (max 1 chars)
 *   catalogPage: string|null — Catalog page (max 255 chars)
 *   deleteFlag: string — Prophet 21 delete flag (Y = deleted, N = active) (max 1 chars)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   createdBy: string — User who created the row (max 255 chars)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   lastMaintainedBy: string — User who last changed the row (max 255 chars)
 *   subCategoryImageFile: string|null — Image file shown for the category in its parent (max 255
 *       chars)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code: workflow state of the row
 *   itemCount: int — Number of items in the category
 *
 * ItemCategoryLookupGetData: An item category and its direct sub-categories, as
 * ItemCategoryHelper::getSummary builds it
 * Returned by: $api->items->itemCategory->getLookup()
 *   itemCategoryUid: int — Item category ID
 *   itemCategoryId: string — Item category code
 *   itemCategoryDesc: string — Item category name
 *   displayOnWebFlag: string — Y when the category shows on the website
 *   deleteFlag: string — Prophet 21 delete flag (Y = deleted, N = active)
 *   itemCount: int — Number of items in the category
 *   fullPath: string|null — Category path in the hierarchy
 *   subCategories: list<ItemCategoryLookupGetDataSubCategoriesItem> — Direct sub-categories, in
 *       hierarchy sequence order
 *     each item: ItemCategoryLookupGetDataSubCategoriesItem — One direct sub-category of an item
 *         category summary
 *
 * ItemCategoryLookupGetDataSubCategoriesItem: One direct sub-category of an item category summary
 * Field `subCategories` of ItemCategoryLookupGetData
 *   itemCategoryUid: int — Item category ID
 *   itemCategoryId: string — Item category code
 *   itemCategoryDesc: string — Item category name
 *   displayOnWebFlag: string — Y when the category shows on the website
 *   deleteFlag: string — Prophet 21 delete flag (Y = deleted, N = active)
 *   itemCount: int — Number of items in the category
 *   fullPath: string|null — Category path in the hierarchy
 *
 * @phpstan-type ItemCategoryListItem array{itemCategoryUid: int, itemCategoryId: string, itemCategoryDesc: string, masterCategoryFlag: string, parentCategoryFlag: string, displayOnWebFlag: string, displayMasterProductFlag: string, catalogPage: string|null, deleteFlag: string, dateCreated: string, createdBy: string, dateLastModified: string, lastMaintainedBy: string, subCategoryImageFile: string|null, updateCd: int, statusCd: int, processCd: int, itemCount: int}
 * @phpstan-type ItemCategoryLookupGetData array{itemCategoryUid: int, itemCategoryId: string, itemCategoryDesc: string, displayOnWebFlag: string, deleteFlag: string, itemCount: int, fullPath: string|null, subCategories: list<ItemCategoryLookupGetDataSubCategoriesItem>}
 * @phpstan-type ItemCategoryLookupGetDataSubCategoriesItem array{itemCategoryUid: int, itemCategoryId: string, itemCategoryDesc: string, displayOnWebFlag: string, deleteFlag: string, itemCount: int, fullPath: string|null}
 */
final class ItemCategoryResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /item-category
     *
     * list of categories
     * Call: $api->items->itemCategory->list()
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an item_category
     *       column.
     *
     * GET https://items.augur-api.com/item-category
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1item-category/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Maximum number of records to return (default: 10)
     *   offset?: int — Number of records to skip (default: 0)
     *   orderBy?: string — Order By (Default: item_category_uid|ASC)
     *   q?: string — Search query for filtering categories by id or description
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ItemCategoryListItem (fields listed on the class)
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
     * GET /item-category/lookup
     *
     * Look up an item_category by path
     * Call: $api->items->itemCategory->getLookup()
     *
     * Look up an item_category by its path under a root category and return its summary
     *
     * Response data: An item category and its direct sub-categories, as
     * ItemCategoryHelper::getSummary builds it
     *
     * Errors:
     *   404: Item category not found.
     *
     * GET https://items.augur-api.com/item-category/lookup
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1item-category~1lookup/get
     *
     * Query params ($params; `?` = optional):
     *   path?: string — Path to lookup (Default: /)
     *   rootItemCategoryId?: string — Root item_category.item_category_id (Default: ROOT)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ItemCategoryLookupGetData (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /item-category/{itemCategoryUid}/precache
     *
     * Queue item category pre-cache
     * Call: $api->items->itemCategory->listPrecache($itemCategoryUid)
     *
     * Queue a pre-cache rebuild of the item category; returns true once queued
     *
     * GET https://items.augur-api.com/item-category/{itemCategoryUid}/precache
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1item-category~1{itemCategoryUid}~1precache/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: bool
     *
     * @param int $itemCategoryUid item_category.item_category_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<bool>
     */
    public function listPrecache(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}/precache',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
