<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * itemWishlist resource — generated from spec.
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
 * ItemWishlistGetItem: One wishlist of a user, as the wishlist list returns it
 * Returned by: $api->items->itemWishlist->get($usersId)
 *   itemWishlistHdrUid: int — Wishlist ID
 *   name: string — Wishlist name
 *   accessLevel: string — Wishlist access level
 *   sequenceNo: int — Display order of the wishlist
 *   description: string — Wishlist description
 *
 * ItemWishlistCreateData:
 * Returned by: $api->items->itemWishlist->create($usersId, $data)
 * Returned by: $api->items->itemWishlist->updateHdr($usersId, $itemWishlistHdrUid, $data)
 * Returned by: $api->items->itemWishlist->deleteHdr($usersId, $itemWishlistHdrUid)
 *   itemWishlistHdrUid: int — Wishlist ID
 *   usersId: int — Joomla user ID (joomla.users.id) that owns the wishlist
 *   name: string — Wishlist name (max 255 chars)
 *   sequenceNo: int — Display order of the wishlist
 *   accessLevel: string — Wishlist access level (max 255 chars)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   statusCd: int — Status code (704 = Active, 705 = Inactive/removed, 700 = Deleted)
 *   processCd: int — Process code: workflow state of the row
 *   description: string — Wishlist description (max 255 chars)
 *   itemWishlistHdrId: string — Wishlist code, derived from name (max 255 chars)
 *
 * ItemWishlistCreateBody: Create a wishlist for the path user
 * Request body of: $api->items->itemWishlist->create($usersId, $data)
 *   name?: string|null — Wishlist name; defaults to Default
 *   description?: string|null — Wishlist description; defaults to Default
 *
 * ItemWishlistHdrGetItem: One line of a wishlist, as the wishlist line list returns it
 * Returned by: $api->items->itemWishlist->getHdr($usersId, $itemWishlistHdrUid)
 *   itemWishlistLineUid: int — Wishlist line ID
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   sequenceNo: int — Display order of the line
 *   comment: string|null — Line comment
 *   quantity: int — Quantity
 *   itemWishlistHdrUid: int — Wishlist ID (item_wishlist_hdr.item_wishlist_hdr_uid)
 *   itemWishlistHdrName: string — Wishlist name
 *   classId5?: string|null — Item class 5 (trinitysurfaces only)
 *   samplesApp?: bool|null — True when the 4th character of classId5 is 1 (trinitysurfaces only)
 *   trinityDesc?: string|null — User-defined private_label_desc_1 (trinitysurfaces only)
 *   trinityItemId?: string|null — User-defined private_label_id_1 (trinitysurfaces only)
 *   agentItemId?: string|null — User-defined private_label_desc_2 (trinitysurfaces only)
 *   agentDesc?: string|null — User-defined private_label_id_2 (trinitysurfaces only)
 *   trim?: bool|null — True when the trim user-defined field is Y (trinitysurfaces only)
 *   fullSizedSamples?: CategoriesItemsListDataItemsItemFullSizedSamplesOption1|bool|null —
 *       Full-sized sample item, or false (trinitysurfaces only)
 *   swatchSample?: CategoriesItemsListDataItemsItemFullSizedSamplesOption1|bool|null — Swatch
 *       sample item, or false (trinitysurfaces only)
 *   brandFolder?: BrandsFacetsListDataItemsItemBrandFolder — Brandfolder assets (trinitysurfaces
 *       only)
 *
 * CategoriesItemsListDataItemsItemFullSizedSamplesOption1:
 * Field `fullSizedSamples` of ItemWishlistHdrGetItem
 * Field `swatchSample` of ItemWishlistHdrGetItem
 *   itemId: string — Sample item ID
 *   invMastUid: int — Sample item (inv_mast) ID
 *   classId5: string|null — Sample item class 5
 *   samplesApp: bool — True when the 4th character of classId5 is 1
 *
 * BrandsFacetsListDataItemsItemBrandFolder: Brandfolder assets (trinitysurfaces only)
 * Field `brandFolder` of ItemWishlistHdrGetItem
 *   assets?: list<BrandsFacetsListDataItemsItemBrandFolderAssetsItem>|null — Active assets linked
 *       to the item; the key is absent when the lookup failed
 *     each item: BrandsFacetsListDataItemsItemBrandFolderAssetsItem — One Brandfolder asset linked
 *         to an item
 *
 * BrandsFacetsListDataItemsItemBrandFolderAssetsItem: One Brandfolder asset linked to an item
 * Field `assets` of BrandsFacetsListDataItemsItemBrandFolder
 *   id: string — Brandfolder asset ID
 *   name: string|null — Asset name
 *   attachmentName: string|null — First attachment's file name
 *   cdnLink: string — CDN URL of the asset
 *   layout: string — Attachment layout (square when unknown)
 *
 * ItemWishlistHdrCreateItem:
 * Returned by: $api->items->itemWishlist->createHdr($usersId, $itemWishlistHdrUid, $data)
 * Returned by:
 * $api->items->itemWishlist->getHdrLine($usersId, $itemWishlistHdrUid, $itemWishlistLineUid)
 * Returned by:
 * $api->items->itemWishlist->updateHdrLine($usersId, $itemWishlistHdrUid, $itemWishlistLineUid, $data)
 * Returned by:
 * $api->items->itemWishlist->deleteHdrLine($usersId, $itemWishlistHdrUid, $itemWishlistLineUid)
 *   itemWishlistLineUid: int — Wishlist line ID
 *   itemWishlistHdrUid: int — Wishlist ID (item_wishlist_hdr.item_wishlist_hdr_uid)
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   sequenceNo: int — Display order of the line
 *   comment: string|null — Line comment (max 255 chars)
 *   quantity: int — Quantity
 *   priorityFlag: string|null — Priority flag (max 1 chars)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   statusCd: int — Status code (704 = Active, 705 = Inactive/removed, 700 = Deleted)
 *   processCd: int — Process code: workflow state of the row
 *
 * ItemWishlistHdrCreateBodyItem: One item to add to a wishlist; the body is a list of these, or a
 * single one
 * Request body of: $api->items->itemWishlist->createHdr($usersId, $itemWishlistHdrUid, $data)
 *   invMastUid?: int|null — Item to add (inv_mast.inv_mast_uid; inv_mast_uid is also accepted); an
 *       entry without it is skipped
 *   quantity?: int|null — Quantity on the line; defaults to 1. Re-posting an item overwrites its
 *       quantity
 *
 * ItemWishlistHdrUpdateBody: Change a wishlist; every field is optional and an absent field keeps
 * its value
 * Request body of: $api->items->itemWishlist->updateHdr($usersId, $itemWishlistHdrUid, $data)
 *   name?: string|null — Wishlist name; also regenerates its id
 *   description?: string|null — Wishlist description
 *   accessLevel?: string|null — Wishlist access level
 *   sequenceNo?: int|null — Display order of the wishlist
 *
 * ItemWishlistHdrLineUpdateBody: Change an item in a wishlist; every field is optional and an
 * absent field keeps its value
 * Request body of:
 * $api->items->itemWishlist->updateHdrLine($usersId, $itemWishlistHdrUid, $itemWishlistLineUid, $data)
 *   quantity?: int|null — Quantity
 *   statusCd?: int|null — Status code; ignored unless a valid status (704 = active, 705 = inactive)
 *
 * @phpstan-type ItemWishlistGetItem array{itemWishlistHdrUid: int, name: string, accessLevel: string, sequenceNo: int, description: string}
 * @phpstan-type ItemWishlistCreateData array{itemWishlistHdrUid: int, usersId: int, name: string, sequenceNo: int, accessLevel: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, description: string, itemWishlistHdrId: string}
 * @phpstan-type ItemWishlistCreateBody array{name?: string|null, description?: string|null}
 * @phpstan-type ItemWishlistHdrGetItem array{itemWishlistLineUid: int, invMastUid: int, sequenceNo: int, comment: string|null, quantity: int, itemWishlistHdrUid: int, itemWishlistHdrName: string, classId5?: string|null, samplesApp?: bool|null, trinityDesc?: string|null, trinityItemId?: string|null, agentItemId?: string|null, agentDesc?: string|null, trim?: bool|null, fullSizedSamples?: CategoriesItemsListDataItemsItemFullSizedSamplesOption1|bool|null, swatchSample?: CategoriesItemsListDataItemsItemFullSizedSamplesOption1|bool|null, brandFolder?: BrandsFacetsListDataItemsItemBrandFolder}
 * @phpstan-type CategoriesItemsListDataItemsItemFullSizedSamplesOption1 array{itemId: string, invMastUid: int, classId5: string|null, samplesApp: bool}
 * @phpstan-type BrandsFacetsListDataItemsItemBrandFolder array{assets?: list<BrandsFacetsListDataItemsItemBrandFolderAssetsItem>|null}
 * @phpstan-type BrandsFacetsListDataItemsItemBrandFolderAssetsItem array{id: string, name: string|null, attachmentName: string|null, cdnLink: string, layout: string}
 * @phpstan-type ItemWishlistHdrCreateItem array{itemWishlistLineUid: int, itemWishlistHdrUid: int, invMastUid: int, sequenceNo: int, comment: string|null, quantity: int, priorityFlag: string|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type ItemWishlistHdrCreateBodyItem array{invMastUid?: int|null, quantity?: int|null}
 * @phpstan-type ItemWishlistHdrUpdateBody array{name?: string|null, description?: string|null, accessLevel?: string|null, sequenceNo?: int|null}
 * @phpstan-type ItemWishlistHdrLineUpdateBody array{quantity?: int|null, statusCd?: int|null}
 */
final class ItemWishlistResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /item-wishlist/{usersId}
     *
     * List the item wishlists for a user
     * Call: $api->items->itemWishlist->get($usersId)
     *
     * Response data, each item: One wishlist of a user, as the wishlist list returns it
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an item_wishlist_hdr
     *       column.
     *
     * GET https://items.augur-api.com/item-wishlist/{usersId}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1item-wishlist~1{usersId}/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Number of results to return (default: 10)
     *   offset?: int — Number of results to skip
     *   orderBy?: string — Order By (default: sequence_no|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ItemWishlistGetItem (fields listed on the class)
     *
     * @param int $usersId joomla.users.id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function get(int $usersId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersId}',
            $params,
            ['usersId' => (string) $usersId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /item-wishlist/{usersId}
     *
     * Create a new item wishlist
     * Call: $api->items->itemWishlist->create($usersId, $data)
     *
     * Request body: Create a wishlist for the path user
     *
     * Success status: 201 (not 200)
     *
     * Errors:
     *   400: Invalid JSON.
     *
     * POST https://items.augur-api.com/item-wishlist/{usersId}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1item-wishlist~1{usersId}/post
     *
     * Request body ($data): ItemWishlistCreateBody (fields listed on the class)
     *
     * Response data type: ItemWishlistCreateData (fields listed on the class)
     *
     * @param int $usersId joomla.users.id
     * @param ItemWishlistCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(int $usersId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{usersId}',
            $data,
            ['usersId' => (string) $usersId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     *
     * Delete an item wishlist
     * Call: $api->items->itemWishlist->deleteHdr($usersId, $itemWishlistHdrUid)
     *
     * Errors:
     *   404: No record with this ID; or wishlist not found.
     *
     * DELETE https://items.augur-api.com/item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1item-wishlist~1{usersId}~1hdr~1{itemWishlistHdrUid}/delete
     *
     * Response data type: ItemWishlistCreateData (fields listed on the class)
     *
     * @param int $usersId joomla.users.id
     * @param int $itemWishlistHdrUid item_wishlist_hdr.item_wishlist_hdr_uid
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteHdr(int $usersId, int $itemWishlistHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}',
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     *
     * List items in a wishlist
     * Call: $api->items->itemWishlist->getHdr($usersId, $itemWishlistHdrUid)
     *
     * Response data, each item: One line of a wishlist, as the wishlist line list returns it
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an item_wishlist_line
     *       column.
     *
     * GET https://items.augur-api.com/item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1item-wishlist~1{usersId}~1hdr~1{itemWishlistHdrUid}/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Number of results to return (default: 10)
     *   offset?: int — Number of results to skip
     *   orderBy?: string — Order By (Default: sequence_no|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ItemWishlistHdrGetItem (fields listed on the class)
     *
     * @param int $usersId joomla.users.id
     * @param int $itemWishlistHdrUid item_wishlist_hdr.item_wishlist_hdr_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function getHdr(int $usersId, int $itemWishlistHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}',
            $params,
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     *
     * Create one more more item in a wishlist
     * Call: $api->items->itemWishlist->createHdr($usersId, $itemWishlistHdrUid, $data)
     *
     * Request body, each item: One item to add to a wishlist; the body is a list of these, or a
     * single one
     *
     * Success status: 201 (not 200)
     *
     * Errors:
     *   400: Invalid JSON.
     *
     * POST https://items.augur-api.com/item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1item-wishlist~1{usersId}~1hdr~1{itemWishlistHdrUid}/post
     *
     * Request body ($data): list of ItemWishlistHdrCreateBodyItem (fields listed on the class)
     *
     * Response data type: list of ItemWishlistHdrCreateItem (fields listed on the class)
     *
     * @param int $usersId joomla.users.id
     * @param int $itemWishlistHdrUid item_wishlist_hdr.item_wishlist_hdr_uid
     * @param list<ItemWishlistHdrCreateBodyItem> $data
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function createHdr(int $usersId, int $itemWishlistHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}',
            $data,
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     *
     * Update a new item wishlist
     * Call: $api->items->itemWishlist->updateHdr($usersId, $itemWishlistHdrUid, $data)
     *
     * Request body: Change a wishlist; every field is optional and an absent field keeps its value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No record with this ID.
     *
     * PUT https://items.augur-api.com/item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1item-wishlist~1{usersId}~1hdr~1{itemWishlistHdrUid}/put
     *
     * Request body ($data): ItemWishlistHdrUpdateBody (fields listed on the class)
     *
     * Response data type: ItemWishlistCreateData (fields listed on the class)
     *
     * @param int $usersId joomla.users.id
     * @param int $itemWishlistHdrUid item_wishlist_hdr.item_wishlist_hdr_uid
     * @param ItemWishlistHdrUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateHdr(int $usersId, int $itemWishlistHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}',
            $data,
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}
     *
     * Delete an item from a wishlist
     * Call:
     * $api->items->itemWishlist->deleteHdrLine($usersId, $itemWishlistHdrUid, $itemWishlistLineUid)
     *
     * Errors:
     *   404: No record with this ID; or wishlist line not found.
     *
     * DELETE
     * https://items.augur-api.com/item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1item-wishlist~1{usersId}~1hdr~1{itemWishlistHdrUid}~1line~1{itemWishlistLineUid}/delete
     *
     * Response data type: ItemWishlistHdrCreateItem (fields listed on the class)
     *
     * @param int $usersId joomla.users.id
     * @param int $itemWishlistHdrUid item_wishlist_hdr.item_wishlist_hdr_uid
     * @param int $itemWishlistLineUid item_wishlist_line.item_wishlist_line_uid
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteHdrLine(int $usersId, int $itemWishlistHdrUid, int $itemWishlistLineUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}',
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid, 'itemWishlistLineUid' => (string) $itemWishlistLineUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}
     *
     * Get an item from a wishlist
     * Call:
     * $api->items->itemWishlist->getHdrLine($usersId, $itemWishlistHdrUid, $itemWishlistLineUid)
     *
     * Get one item of a wishlist; an empty object when the line does not belong to the wishlist
     *
     * GET
     * https://items.augur-api.com/item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1item-wishlist~1{usersId}~1hdr~1{itemWishlistHdrUid}~1line~1{itemWishlistLineUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ItemWishlistHdrCreateItem (fields listed on the class)
     *
     * @param int $usersId joomla.users.id
     * @param int $itemWishlistHdrUid item_wishlist_hdr.item_wishlist_hdr_uid
     * @param int $itemWishlistLineUid item_wishlist_line.item_wishlist_line_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getHdrLine(int $usersId, int $itemWishlistHdrUid, int $itemWishlistLineUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}',
            $params,
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid, 'itemWishlistLineUid' => (string) $itemWishlistLineUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}
     *
     * Update an item in a wishlist
     * Call:
     * $api->items->itemWishlist->updateHdrLine($usersId, $itemWishlistHdrUid, $itemWishlistLineUid, $data)
     *
     * Change the quantity or status of one item in a wishlist; an empty object when the line does
     * not belong to the wishlist
     *
     * Request body: Change an item in a wishlist; every field is optional and an absent field keeps
     * its value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: Wishlist or line uid below 1, or no line with this ID on this wishlist.
     *
     * PUT
     * https://items.augur-api.com/item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1item-wishlist~1{usersId}~1hdr~1{itemWishlistHdrUid}~1line~1{itemWishlistLineUid}/put
     *
     * Request body ($data): ItemWishlistHdrLineUpdateBody (fields listed on the class)
     *
     * Response data type: ItemWishlistHdrCreateItem (fields listed on the class)
     *
     * @param int $usersId joomla.users.id
     * @param int $itemWishlistHdrUid item_wishlist_hdr.item_wishlist_hdr_uid
     * @param int $itemWishlistLineUid item_wishlist_line.item_wishlist_line_uid
     * @param ItemWishlistHdrLineUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateHdrLine(int $usersId, int $itemWishlistHdrUid, int $itemWishlistLineUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}',
            $data,
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid, 'itemWishlistLineUid' => (string) $itemWishlistLineUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
