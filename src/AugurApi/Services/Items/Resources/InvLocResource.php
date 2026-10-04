<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invLoc resource — generated from spec.
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
 * InvLocListItem:
 * Returned by: $api->items->invLoc->list()
 *   companyId: string — Prophet 21 company ID (max 8 chars)
 *   locationId: float — Prophet 21 location ID
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   qtyOnHand: float|null — Quantity on hand
 *   qtyInProcess: float|null — Quantity in process
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   nextDueInPoDate: string|null — Due date of the next open purchase order (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   sellable: string|null — Y when the item can be sold from this location (max 1 chars)
 *   movingAverageCost: float|null — Moving average cost
 *   standardCost: float|null — Standard cost
 *   protectedStockQty: float|null — Quantity held back from sale
 *   invMin: float|null — Minimum stock level
 *   invMax: float|null — Maximum stock level
 *   safetyStock: float|null — Safety stock quantity
 *   stockable: string|null — Y when the item is stocked at this location (max 1 chars)
 *   averageMonthlyUsage: float|null — Average monthly usage
 *   noCharge: string|null — Y when the item is no-charge at this location (max 1 chars)
 *   price1: float|null — Location price 1
 *   price2: float|null — Location price 2
 *   price3: float|null — Location price 3
 *   price4: float|null — Location price 4
 *   price5: float|null — Location price 5
 *   price6: float|null — Location price 6
 *   price7: float|null — Location price 7
 *   price8: float|null — Location price 8
 *   price9: float|null — Location price 9
 *   price10: float|null — Location price 10
 *   orderQuantity: float|null — Standard reorder quantity
 *   qtyAllocated: float|null — Quantity allocated to orders
 *   qtyBackordered: float|null — Quantity on backorder
 *   qtyInTransit: float|null — Quantity in transit
 *   trackBins: string|null — Y when stock is tracked by bin (max 1 chars)
 *   primaryBin: string|null — Primary bin (max 10 chars)
 *   qtyReservedDueIn: float|null — Quantity reserved from incoming stock
 *   dateLastCounted: string|null — When stock was last counted (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   deadstockFlag: string — Y when the item is dead stock at this location (max 1 chars)
 *   primarySupplierId: float|null — Primary supplier ID
 *   lastSaleDate: string|null — Date of the last sale (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   lastPurchaseDate: string|null — Date of the last purchase (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   invLastChangedDate: string|null — When the inventory last changed (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   minReplenishmentQty: float|null — Minimum replenishment quantity
 *   discontinued: string — Y when the item is discontinued at this location (max 1 chars)
 *   priceFamilyUid: int|null — Price family ID
 *   deleteFlag: string|null — Prophet 21 delete flag (Y = deleted, N = active) (max 1 chars)
 *   defaultSellingUnit: string|null — Default selling unit of measure (max 8 chars)
 *   futureStandardCost: float|null — Standard cost that takes effect on effective_date
 *   effectiveDate: string|null — Date future_standard_cost takes effect (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   restrictedFlag: string|null — Y when sale of the item is restricted at this location (max 1
 *       chars)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   productGroupId: string|null — Product group ID (max 8 chars)
 *   purchaseDiscountGroup: string|null — Purchase discount group (max 8 chars)
 *   salesDiscountGroup: string|null — Sales discount group (max 8 chars)
 *   purchaseClass: string|null — Purchase class (max 8 chars)
 *
 * @phpstan-type InvLocListItem array{companyId: string, locationId: float, invMastUid: int, qtyOnHand: float|null, qtyInProcess: float|null, dateCreated: string, dateLastModified: string, nextDueInPoDate: string|null, sellable: string|null, movingAverageCost: float|null, standardCost: float|null, protectedStockQty: float|null, invMin: float|null, invMax: float|null, safetyStock: float|null, stockable: string|null, averageMonthlyUsage: float|null, noCharge: string|null, price1: float|null, price2: float|null, price3: float|null, price4: float|null, price5: float|null, price6: float|null, price7: float|null, price8: float|null, price9: float|null, price10: float|null, orderQuantity: float|null, qtyAllocated: float|null, qtyBackordered: float|null, qtyInTransit: float|null, trackBins: string|null, primaryBin: string|null, qtyReservedDueIn: float|null, dateLastCounted: string|null, deadstockFlag: string, primarySupplierId: float|null, lastSaleDate: string|null, lastPurchaseDate: string|null, invLastChangedDate: string|null, minReplenishmentQty: float|null, discontinued: string, priceFamilyUid: int|null, deleteFlag: string|null, defaultSellingUnit: string|null, futureStandardCost: float|null, effectiveDate: string|null, restrictedFlag: string|null, updateCd: int, productGroupId: string|null, purchaseDiscountGroup: string|null, salesDiscountGroup: string|null, purchaseClass: string|null}
 */
final class InvLocResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-loc
     *
     * List InvLoc
     * Call: $api->items->invLoc->list()
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an inv_loc column.
     *
     * GET https://items.augur-api.com/inv-loc
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1inv-loc/get
     *
     * Query params ($params; `?` = optional):
     *   createdSince?: string — Return only rows created on or after this date (YYYY-MM-DD
     *       HH:MM:SS)
     *   invMastUid?: int — Item ID (inv_mast.inv_mast_uid); returns only that item's location rows
     *   limit?: int — Limit number of results (Default: 10)
     *   locationId?: string — Location ID (inv_loc.location_id); returns only rows for that
     *       location
     *   modifiedSince?: string — Return only rows modified on or after this date (YYYY-MM-DD
     *       HH:MM:SS)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — One inv_loc column|ASC or |DESC; any other value returns 400 (Default:
     *       inv_mast_uid|ASC)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvLocListItem (fields listed on the class)
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
}
