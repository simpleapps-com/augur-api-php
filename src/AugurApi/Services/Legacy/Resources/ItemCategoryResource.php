<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * itemCategory resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://legacy.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://legacy.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://legacy.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py legacy
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ItemCategoryGetData:
 * Returned by: $api->legacy->itemCategory->get($itemCategoryUid)
 *   itemCategoryUid: int — Unique identifier of the item category
 *   itemCategoryId: string — Item category ID (max 255 chars)
 *   itemCategoryDesc: string — Item category description (max 255 chars)
 *   article: string|null — Category article text 1 (max 16777215 chars)
 *   boxFolderId: string|null — Box folder ID for the category (max 255 chars)
 *   masterCategoryFlag: string — Y when this is a master category (max 1 chars)
 *   parentCategoryFlag: string — Y when this is a parent category (max 1 chars)
 *   displayOnWebFlag: string — Y when the category displays on the web (max 1 chars)
 *   deleteFlag: string — Y when the category is deleted (max 1 chars)
 *   customerApproval: string|null — Customer approval flag (max 1 chars)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastChecked: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   article2: string|null — Category article text 2 (max 16777215 chars)
 *   article3: string|null — Category article text 3 (max 16777215 chars)
 *   article4: string|null — Category article text 4 (max 16777215 chars)
 *   article5: string|null — Category article text 5 (max 16777215 chars)
 *   sampleItemId: string|null — Sample item ID shown for the category (max 255 chars)
 *   metaDesc: string|null — Meta description for the category page (max 255 chars)
 *   title: string|null — Category page title (max 255 chars)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   subCategoryImageFile: string|null — Sub-category image file (max 255 chars)
 *   lastMaintainedBy: string — User who last changed the record (max 255 chars)
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   createdBy: string — User who created the record (max 255 chars)
 *   catalogPage: string|null — Catalog page (max 255 chars)
 *   displayMasterProductFlag: string — Y when the master product displays (max 1 chars)
 *
 * @phpstan-type ItemCategoryGetData array{itemCategoryUid: int, itemCategoryId: string, itemCategoryDesc: string, article: string|null, boxFolderId: string|null, masterCategoryFlag: string, parentCategoryFlag: string, displayOnWebFlag: string, deleteFlag: string, customerApproval: string|null, dateLastModified: string, dateLastChecked: string, article2: string|null, article3: string|null, article4: string|null, article5: string|null, sampleItemId: string|null, metaDesc: string|null, title: string|null, updateCd: int, subCategoryImageFile: string|null, lastMaintainedBy: string, dateCreated: string, createdBy: string, catalogPage: string|null, displayMasterProductFlag: string}
 */
final class ItemCategoryResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /item-category/{itemCategoryUid}
     *
     * Get Item Category Details
     * Call: $api->legacy->itemCategory->get($itemCategoryUid)
     *
     * Errors:
     *   404: No item category with this ID.
     *
     * GET https://legacy.augur-api.com/item-category/{itemCategoryUid}
     * Contract:
     * https://legacy.augur-api.com/openapi.json#/paths/~1item-category~1{itemCategoryUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ItemCategoryGetData (fields listed on the class)
     *
     * @param int $itemCategoryUid Unique identifier of the item category
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
