<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * poLine resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://orders.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://orders.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://orders.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py orders
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * PoLineListItem:
 * Returned by: $api->orders->poLine->list()
 * Returned by: $api->orders->poLine->get($poLineUid)
 *   poNo: float — Prophet 21 purchase order number
 *   qtyOrdered: float — Quantity ordered on the line
 *   qtyReceived: float — Quantity received so far
 *   receivedDate: string|null — When the line was received (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   unitPrice: float — Unit price on the line
 *   companyNo: string — Prophet 21 company number (max 8 chars)
 *   mfgPartNo: string|null — Manufacturer part number (max 20 chars)
 *   deleteFlag: string — Y when the line is deleted (max 1 chars)
 *   dateDue: string|null — Date the line is due (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   lastMaintainedBy: string — Prophet 21 user who last changed the record (max 30 chars)
 *   nextDueInPoCost: float|null — Cost of the next due-in purchase order quantity
 *   complete: string — Y when the line is complete (max 1 chars)
 *   vouchCompleted: string — Y when vouching is complete for the line (max 1 chars)
 *   cancelFlag: string|null — Y when the line is canceled (max 1 chars)
 *   inBoundCurryId: float|null — Inbound currency id
 *   accountNo: string|null — General ledger account number for the line (max 32 chars)
 *   qtyToVouch: float|null — Quantity still to vouch
 *   closedFlag: string|null — Y when the line is closed (max 1 chars)
 *   itemDescription: string|null — Item description on the line (max 40 chars)
 *   unitOfMeasure: string|null — Unit of measure for the line (max 8 chars)
 *   unitSize: float — Unit size (base units per unit of measure)
 *   unitQuantity: float — Quantity in the line's unit of measure
 *   lineNo: float — Line number within the purchase order
 *   pricingBookId: string|null — Pricing book id (max 8 chars)
 *   pricingBookItemId: string|null — Item id in the pricing book (max 40 chars)
 *   pricingBookSupplierId: float|null — Supplier id in the pricing book
 *   pricingBookDiscGrpId: string|null — Discount group id in the pricing book (max 8 chars)
 *   pricingBookEffectiveDate: string|null — Pricing book effective date (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   combinable: string|null — Y when the line can be combined (max 1 chars)
 *   calcType: string|null — Price calculation type (max 10 chars)
 *   calcValue: float|null — Price calculation value
 *   requiredDate: string|null — Date the line is required (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   nextBreak: float|null — Quantity at the next price break
 *   nextUtPrice: float|null — Unit price at the next price break
 *   baseUtPrice: float — Base unit price
 *   priceEdit: string|null — Y when the price was manually edited (max 1 chars)
 *   newItem: string|null — Y when the line is for a new item (max 1 chars)
 *   quantityChanged: string|null — Y when the quantity was changed (max 1 chars)
 *   pricingUnit: string|null — Pricing unit of measure (max 8 chars)
 *   pricingUnitSize: float|null — Size of the pricing unit
 *   extendedDesc: string|null — Extended item description (max 255 chars)
 *   unitPriceDisplay: float — Unit price as displayed
 *   invMastUid: int — Item (inv_mast) on the line
 *   excludeFromLeadTime: string — Y when the line is excluded from lead time calculations (max 1
 *       chars)
 *   sourceType: int|null — Source type code of the line
 *   expDateUpdates: int|null — Expected date updates
 *   poLineUid: int — Unique id of the purchase order line
 *   ediNewStatus: string — EDI new status (max 1 chars)
 *   lineType: string|null — Line type code (max 1 chars)
 *   contractNumber: string|null — Contract number for the line (max 40 chars)
 *   createdBy: string|null — Prophet 21 user who created the record (max 255 chars)
 *   parentPoLineNo: int|null — Parent purchase order line number
 *   supplierShipDate: string|null — Date the supplier ships the line (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   enteredAsCode: string|null — Item code as entered on the line (max 40 chars)
 *   gporRunUid: int|null — GPOR run that generated the line
 *   purchasePricingPageUid: int|null — Purchase pricing page applied to the line
 *   expediteFlag: string|null — Y when the line is flagged for expediting (max 1 chars)
 *   originalUnitPriceDisplay: float|null — Original unit price as displayed
 *   retrievedByWms: string|null — Y when the line was retrieved by the warehouse management system
 *       (max 1 chars)
 *   expediteNotes: string|null — Expedite notes for the line (max 8000 chars)
 *   expediteFollowupFlag: string — Y when the line is flagged for expedite follow-up (max 1 chars)
 *   desiredReceiptLocationId: float|null — Prophet 21 location where the line should be received
 *   acknowledgedDate: string|null — When the line was acknowledged (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   countryOfOrigin: string|null — Country of origin of the item (max 8 chars)
 *   b3Qty: float — B3 quantity
 *   qtyReady: float|null — Quantity ready
 *   qtyReadyUnitSize: float|null — Unit size of the ready quantity
 *   qtyReadyUom: string|null — Unit of measure of the ready quantity (max 8 chars)
 *   unitQtyReady: float|null — Ready quantity in units
 *   bulkBuyFlag: string|null — Y when the line is a bulk buy (max 1 chars)
 *   cadPurchaseCost: float|null — CAD purchase cost
 *   listPriceMultiplier: float|null — List price multiplier
 *   carrierStatus: string|null — Carrier status of the shipment (max 20 chars)
 *   expectedShipDate: string|null — Expected ship date (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateDueLastModified: string|null — When the due date last changed (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   acknowledged: string|null — Y when the line was acknowledged (max 1 chars)
 *   updateCd: int — Update code (704 = queued for refresh from Prophet 21, 1185 = current)
 *
 * @phpstan-type PoLineListItem array{poNo: float, qtyOrdered: float, qtyReceived: float, receivedDate: string|null, unitPrice: float, companyNo: string, mfgPartNo: string|null, deleteFlag: string, dateDue: string|null, dateCreated: string, dateLastModified: string, lastMaintainedBy: string, nextDueInPoCost: float|null, complete: string, vouchCompleted: string, cancelFlag: string|null, inBoundCurryId: float|null, accountNo: string|null, qtyToVouch: float|null, closedFlag: string|null, itemDescription: string|null, unitOfMeasure: string|null, unitSize: float, unitQuantity: float, lineNo: float, pricingBookId: string|null, pricingBookItemId: string|null, pricingBookSupplierId: float|null, pricingBookDiscGrpId: string|null, pricingBookEffectiveDate: string|null, combinable: string|null, calcType: string|null, calcValue: float|null, requiredDate: string|null, nextBreak: float|null, nextUtPrice: float|null, baseUtPrice: float, priceEdit: string|null, newItem: string|null, quantityChanged: string|null, pricingUnit: string|null, pricingUnitSize: float|null, extendedDesc: string|null, unitPriceDisplay: float, invMastUid: int, excludeFromLeadTime: string, sourceType: int|null, expDateUpdates: int|null, poLineUid: int, ediNewStatus: string, lineType: string|null, contractNumber: string|null, createdBy: string|null, parentPoLineNo: int|null, supplierShipDate: string|null, enteredAsCode: string|null, gporRunUid: int|null, purchasePricingPageUid: int|null, expediteFlag: string|null, originalUnitPriceDisplay: float|null, retrievedByWms: string|null, expediteNotes: string|null, expediteFollowupFlag: string, desiredReceiptLocationId: float|null, acknowledgedDate: string|null, countryOfOrigin: string|null, b3Qty: float, qtyReady: float|null, qtyReadyUnitSize: float|null, qtyReadyUom: string|null, unitQtyReady: float|null, bulkBuyFlag: string|null, cadPurchaseCost: float|null, listPriceMultiplier: float|null, carrierStatus: string|null, expectedShipDate: string|null, dateDueLastModified: string|null, acknowledged: string|null, updateCd: int}
 */
final class PoLineResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /po-line
     *
     * List purchase order lines
     * Call: $api->orders->poLine->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a po_line column.
     *
     * GET https://orders.augur-api.com/po-line
     * Contract: https://orders.augur-api.com/openapi.json#/paths/~1po-line/get
     *
     * Query params ($params; `?` = optional):
     *   complete?: string — Complete flag [Y|N]
     *   invMastUid?: int — Filter by inv_mast_uid
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: po_line_uid|ASC)
     *   poNo?: float — Filter by PO number
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of PoLineListItem (fields listed on the class)
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
     * GET /po-line/{poLineUid}
     *
     * Get a purchase order line
     * Call: $api->orders->poLine->get($poLineUid)
     *
     * Errors:
     *   404: No purchase order line with this ID.
     *
     * GET https://orders.augur-api.com/po-line/{poLineUid}
     * Contract: https://orders.augur-api.com/openapi.json#/paths/~1po-line~1{poLineUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: PoLineListItem (fields listed on the class)
     *
     * @param int $poLineUid po_line.po_line_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $poLineUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{poLineUid}',
            $params,
            ['poLineUid' => (string) $poLineUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
