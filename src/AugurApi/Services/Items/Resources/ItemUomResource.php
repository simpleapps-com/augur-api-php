<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * itemUom resource — generated from spec.
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
 * ItemUomListItem:
 * Returned by: $api->items->itemUom->list()
 * Returned by: $api->items->itemUom->get($itemUomUid)
 *   unitOfMeasure: string — Unit of measure code (max 8 chars)
 *   deleteFlag: string — Prophet 21 delete flag (Y = deleted, N = active) (max 1 chars)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   lastMaintainedBy: string — User who last changed the row (max 30 chars)
 *   unitSize: float — Number of base units in this unit
 *   sellingUnit: string|null — Y when the unit can be sold (max 1 chars)
 *   purchasingUnit: string|null — Y when the unit can be purchased (max 1 chars)
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   createdBy: string|null — User who created the row (max 255 chars)
 *   itemUomUid: int — Item unit-of-measure ID
 *   b2bUnitFlag: string — Y when the unit is offered on B2B (max 1 chars)
 *   tallyFactor: float|null — Tally factor
 *   wwmsFlag: string|null — Y when the unit is used by the warehouse management system (max 1
 *       chars)
 *   prodOrderFactor: int|null — Production order factor
 *   minimumOrderQty: float|null — Minimum order quantity in this unit
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *
 * @phpstan-type ItemUomListItem array{unitOfMeasure: string, deleteFlag: string, dateCreated: string, dateLastModified: string, lastMaintainedBy: string, unitSize: float, sellingUnit: string|null, purchasingUnit: string|null, invMastUid: int, createdBy: string|null, itemUomUid: int, b2bUnitFlag: string, tallyFactor: float|null, wwmsFlag: string|null, prodOrderFactor: int|null, minimumOrderQty: float|null, updateCd: int}
 */
final class ItemUomResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /item-uom
     *
     * List Item UOMs
     * Call: $api->items->itemUom->list()
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an item_uom column.
     *
     * GET https://items.augur-api.com/item-uom
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1item-uom/get
     *
     * Query params ($params; `?` = optional):
     *   createdSince?: string — Filter records created since date (YYYY-MM-DD HH:MM:SS)
     *   deleteFlag?: string — Filter by delete flag (N=active, Y=deleted)
     *   invMastUid?: int — Item ID (inv_mast_uid)
     *   limit?: int — Limit number of results (Default: 10)
     *   modifiedSince?: string — Filter records modified since date (YYYY-MM-DD HH:MM:SS)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: item_uom_uid|ASC)
     *   unitOfMeasure?: string — Unit of Measure filter
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ItemUomListItem (fields listed on the class)
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
     * GET /item-uom/{itemUomUid}
     *
     * Get Item UOM Details
     * Call: $api->items->itemUom->get($itemUomUid)
     *
     * GET https://items.augur-api.com/item-uom/{itemUomUid}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1item-uom~1{itemUomUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ItemUomListItem (fields listed on the class)
     *
     * @param int $itemUomUid Item unit-of-measure ID (item_uom.item_uom_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $itemUomUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemUomUid}',
            $params,
            ['itemUomUid' => (string) $itemUomUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
