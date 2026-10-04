<?php

declare(strict_types=1);

namespace AugurApi\Services\BrandFolder\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * categories resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://brand-folder.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path,
 *       path params and query params, each with type and required flag. Grep it for a path; for a
 *       GET that line is all you need. Bodies are not in it.
 *   https://brand-folder.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://brand-folder.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py brand-folder
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * CategoriesListItem:
 * Returned by: $api->brandFolder->categories->list()
 * Returned by: $api->brandFolder->categories->get($itemCategoryUid)
 *   itemCategoryUid: int — Item category (item_category_uid) this row mirrors
 *   itemCategoryId: string — Item category ID (max 255 chars)
 *   itemCategoryDesc: string — Item category description (max 255 chars)
 *   dateCreated: string — When the row was created (YYYY-MM-DD HH:mm:ss) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — When the row last changed (YYYY-MM-DD HH:mm:ss) (mysql-datetime,
 *       e.g. 2025-07-30 15:50:49)
 *   updateCd: int — Update code
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code
 *   rootCategoryId: string — Item category ID of the root category this category sits under (max
 *       255 chars)
 *   labelsId: string|null — Brandfolder label ID linked to the category (max 255 chars)
 *   imagesAssetsId: string|null — Brandfolder asset ID of the category image (max 255 chars)
 *   roomScenesAssetsId: string|null — Brandfolder asset ID of the category room scene (max 255
 *       chars)
 *   brochuresAssetsId: string|null — Brandfolder asset ID of the consumer brochure (max 255 chars)
 *   contractorsAssetsId: string|null — Brandfolder asset ID of the contractor brochure (max 255
 *       chars)
 *   dateLastProcessed: string — When the category was last processed (YYYY-MM-DD HH:mm:ss)
 *       (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastCheckImages: string — When the category images were last checked (YYYY-MM-DD HH:mm:ss)
 *       (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastCheckRoomScene: string — When the category room scene was last checked (YYYY-MM-DD
 *       HH:mm:ss) (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   itemCategoryDescPc: string|null — Item category description in PascalCase, used to match
 *       Brandfolder names (max 255 chars)
 *   dateLastUpload: string — When an attachment was last uploaded for the category (YYYY-MM-DD
 *       HH:mm:ss) (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   leedAssetsId: string|null — Brandfolder asset ID of the LEED document (max 255 chars)
 *   colorsList: string|null — Comma-separated, sorted lowercase colors of the active items in the
 *       category (max 500 chars)
 *   colorsCount: int — Number of distinct colors in colorsList
 *   focusCd: int — Focus code (704 = the focused category, 705 = not focused)
 *
 * CategoriesFocusCreateBody: Set the focus category; send itemCategoryUid or itemCategoryId (the
 * uid wins when both are sent)
 * Request body of: $api->brandFolder->categories->createFocus($data)
 *   itemCategoryUid?: int|null — Item category primary key (item_category_uid)
 *   itemCategoryId?: string|null — Item category identifier (item_category_id), resolved to its uid
 *
 * @phpstan-type CategoriesListItem array{itemCategoryUid: int, itemCategoryId: string, itemCategoryDesc: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, rootCategoryId: string, labelsId: string|null, imagesAssetsId: string|null, roomScenesAssetsId: string|null, brochuresAssetsId: string|null, contractorsAssetsId: string|null, dateLastProcessed: string, dateLastCheckImages: string, dateLastCheckRoomScene: string, itemCategoryDescPc: string|null, dateLastUpload: string, leedAssetsId: string|null, colorsList: string|null, colorsCount: int, focusCd: int}
 * @phpstan-type CategoriesFocusCreateBody array{itemCategoryUid?: int|null, itemCategoryId?: string|null}
 */
final class CategoriesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /categories
     *
     * List categories
     * Call: $api->brandFolder->categories->list()
     *
     * Errors:
     *   400: Invalid orderBy: not one field|ASC or field|DESC on a categories column.
     *
     * GET https://brand-folder.augur-api.com/categories
     * Contract: https://brand-folder.augur-api.com/openapi.json#/paths/~1categories/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Sort as one column|ASC or column|DESC on a categories column (Default:
     *       item_category_uid|ASC)
     *   q?: string — Search item_category_id or item_category_desc (LIKE)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CategoriesListItem (fields listed on the class)
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
     * POST /categories/focus
     *
     * Set Category Focus
     * Call: $api->brandFolder->categories->createFocus($data)
     *
     * Request body: Set the focus category; send itemCategoryUid or itemCategoryId (the uid wins
     * when both are sent)
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or A required body field is missing or has
     *       the wrong type.
     *
     * POST https://brand-folder.augur-api.com/categories/focus
     * Contract: https://brand-folder.augur-api.com/openapi.json#/paths/~1categories~1focus/post
     *
     * Request body ($data): CategoriesFocusCreateBody (fields listed on the class)
     *
     * Response data type: bool
     *
     * @param CategoriesFocusCreateBody $data
     * @return BaseResponse<bool>
     */
    public function createFocus(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/focus', $data);

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /categories/{itemCategoryUid}
     *
     * Get a category
     * Call: $api->brandFolder->categories->get($itemCategoryUid)
     *
     * Get a category by UID
     *
     * Errors:
     *   404: No category with this ID.
     *
     * GET https://brand-folder.augur-api.com/categories/{itemCategoryUid}
     * Contract:
     * https://brand-folder.augur-api.com/openapi.json#/paths/~1categories~1{itemCategoryUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CategoriesListItem (fields listed on the class)
     *
     * @param int $itemCategoryUid Item category (item_category_uid) to return
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
