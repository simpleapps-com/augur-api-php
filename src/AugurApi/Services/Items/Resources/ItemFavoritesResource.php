<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * itemFavorites resource — generated from spec.
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
 * ItemFavoritesItemsListItem:
 * Returned by: $api->items->itemFavorites->listItems($usersId)
 * Returned by: $api->items->itemFavorites->createItems($usersId, $data)
 * Returned by: $api->items->itemFavorites->getItems($usersId, $invMastUid)
 * Returned by: $api->items->itemFavorites->updateItems($usersId, $invMastUid, $data)
 *   itemFavoritesUid: int — Item favorite ID
 *   usersId: int — Joomla user ID (joomla.users.id)
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   sequenceNo: int — Display order of the favorite
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   statusCd: int — Status code (704 = favorite, 705 = removed)
 *   processCd: int — Process code: workflow state of the row
 *
 * @phpstan-type ItemFavoritesItemsListItem array{itemFavoritesUid: int, usersId: int, invMastUid: int, sequenceNo: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 */
final class ItemFavoritesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /item-favorites/{usersId}/items
     *
     * List the item favorites for a user
     * Call: $api->items->itemFavorites->listItems($usersId)
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an item_favorites
     *       column.
     *
     * GET https://items.augur-api.com/item-favorites/{usersId}/items
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1item-favorites~1{usersId}~1items/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Number of results to skip
     *   orderBy?: string — Order By (Default: item_favorites_uid|ASC)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ItemFavoritesItemsListItem (fields listed on the class)
     *
     * @param int $usersId joomla.users.id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listItems(int $usersId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersId}/items',
            $params,
            ['usersId' => (string) $usersId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /item-favorites/{usersId}/items
     *
     * Create item favorites
     * Call: $api->items->itemFavorites->createItems($usersId, $data)
     *
     * Request body, each item: inv_mast_uid of the item to favorite
     *
     * Success status: 201 (not 200)
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://items.augur-api.com/item-favorites/{usersId}/items
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1item-favorites~1{usersId}~1items/post
     *
     * Request body ($data): list<int>
     *   each item: int — inv_mast_uid of the item to favorite
     *
     * Response data type: list of ItemFavoritesItemsListItem (fields listed on the class)
     *
     * @param int $usersId joomla.users.id
     * @param list<int> $data
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function createItems(int $usersId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{usersId}/items',
            $data,
            ['usersId' => (string) $usersId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /item-favorites/{usersId}/items/{invMastUid}
     *
     * Soft Delete an item from a user's favorites
     * Call: $api->items->itemFavorites->deleteItems($usersId, $invMastUid)
     *
     * Errors:
     *   404: No record with this ID; or item favorite not found.
     *
     * DELETE https://items.augur-api.com/item-favorites/{usersId}/items/{invMastUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1item-favorites~1{usersId}~1items~1{invMastUid}/delete
     *
     * Response data type: bool
     *
     * @param int $usersId joomla.users.id
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @return BaseResponse<bool>
     */
    public function deleteItems(int $usersId, int $invMastUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{usersId}/items/{invMastUid}',
            ['usersId' => (string) $usersId, 'invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /item-favorites/{usersId}/items/{invMastUid}
     *
     * Get a single item favorite
     * Call: $api->items->itemFavorites->getItems($usersId, $invMastUid)
     *
     * Errors:
     *   404: Item favorite not found.
     *
     * GET https://items.augur-api.com/item-favorites/{usersId}/items/{invMastUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1item-favorites~1{usersId}~1items~1{invMastUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ItemFavoritesItemsListItem (fields listed on the class)
     *
     * @param int $usersId joomla.users.id
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getItems(int $usersId, int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersId}/items/{invMastUid}',
            $params,
            ['usersId' => (string) $usersId, 'invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /item-favorites/{usersId}/items/{invMastUid}
     *
     * Toggle an item favorite active/inactive
     * Call: $api->items->itemFavorites->updateItems($usersId, $invMastUid, $data)
     *
     * No request body: the API ignores any body sent.
     *
     * Errors:
     *   404: No record with this ID.
     *
     * PUT https://items.augur-api.com/item-favorites/{usersId}/items/{invMastUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1item-favorites~1{usersId}~1items~1{invMastUid}/put
     *
     * Response data type: ItemFavoritesItemsListItem (fields listed on the class)
     *
     * @param int $usersId joomla.users.id
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateItems(int $usersId, int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{usersId}/items/{invMastUid}',
            $data,
            ['usersId' => (string) $usersId, 'invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
