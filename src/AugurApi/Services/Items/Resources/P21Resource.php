<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * p21 resource — generated from spec.
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
 * InvMastGetData:
 * Returned by: $api->items->p21->listInvMast()
 *   invMastUid: int — Item ID
 *   itemId: string — Item code (max 40 chars)
 *   itemDesc: string|null — Item description (max 40 chars)
 *   deleteFlag: string — Prophet 21 delete flag (Y = deleted, N = active) (max 1 chars)
 *   weight: float|null — Item weight
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   inactive: string — Y when the item is inactive in Prophet 21 (max 1 chars)
 *   classId1: string|null — Item class 1 (max 8 chars)
 *   classId2: string|null — Item class 2 (max 8 chars)
 *   classId3: string|null — Item class 3 (max 8 chars)
 *   classId4: string|null — Item class 4 (max 8 chars)
 *   classId5: string|null — Item class 5 (max 8 chars)
 *   upcOrEan: string|null — UPC or EAN code type (max 3 chars)
 *   upcOrEanId: string|null — UPC or EAN code (max 15 chars)
 *   serialized: string — Y when the item is serialized (max 1 chars)
 *   productType: string — Prophet 21 product type (max 1 chars)
 *   dLength: float|null — Item length (Prophet 21 d_length)
 *   shortCode: string|null — Short code (max 30 chars)
 *   price1: float|null — List price 1
 *   price2: float|null — List price 2
 *   price3: float|null — List price 3
 *   price4: float|null — List price 4
 *   price5: float|null — List price 5
 *   price6: float|null — List price 6
 *   price7: float|null — List price 7
 *   price8: float|null — List price 8
 *   price9: float|null — List price 9
 *   price10: float|null — List price 10
 *   extendedDesc: string|null — Extended description (max 255 chars)
 *   defaultSellingUnit: string|null — Default selling unit of measure (max 8 chars)
 *   hazMatFlag: string — Y when the item is a hazardous material (max 1 chars)
 *   keywords: string|null — Search keywords (max 2147483647 chars)
 *   disposition: string|null — Prophet 21 disposition code (max 1 chars)
 *   baseUnit: string — Base unit of measure (max 8 chars)
 *   restrictedFlag: string|null — Y when sale of the item is restricted (max 1 chars)
 *   parkerProductCd: string|null — Parker product code (max 255 chars)
 *   parkerDivisionCd: string|null — Parker division code (max 255 chars)
 *   commodityCode: string|null — Commodity code (max 255 chars)
 *   unspscCode: string|null — UNSPSC classification code (max 255 chars)
 *   dciCode: string|null — DCI code (max 255 chars)
 *   epaCertReqFlag: string|null — Y when EPA certification is required to buy (max 1 chars)
 *   length: float|null — Item length
 *   width: float|null — Item width
 *   height: float|null — Item height
 *   itemNotes: string|null — Item notes (max 255 chars)
 *   vndrStock: int|null — Vendor stock number
 *   manufacturerName: string|null — Manufacturer name (max 255 chars)
 *   brandName: string|null — Brand name (max 255 chars)
 *   partNumber: string|null — Manufacturer part number (max 255 chars)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   defaultProductGroup: string|null — Default product group (max 8 chars)
 *   upcOrEanPrefix: string|null — UPC or EAN prefix (max 9 chars)
 *   upcOrEanItem: string|null — UPC or EAN item part (max 5 chars)
 *   attributeGroupUid: int|null — Attribute group ID (attribute_group.attribute_group_uid)
 *   defaultPriceFamilyUid: int|null — Default price family ID
 *   purchasePricingUnit: string|null — Purchase pricing unit of measure (max 8 chars)
 *   purchasePricingUnitSize: float|null — Purchase pricing unit size
 *   salesPricingUnit: string|null — Sales pricing unit of measure (max 8 chars)
 *   salesPricingUnitSize: float|null — Sales pricing unit size
 *   defaultPurchasingUnit: string|null — Default purchasing unit of measure (max 8 chars)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   onlineCd: int — Online code: 704 when shown on the website
 *   processCd: int — Process code: workflow state of the row
 *   eccEnabledFlag: string|null — Y when ECC is enabled for the item (max 1 chars)
 *   trackLots: string — Y when the item is lot-tracked (max 1 chars)
 *   defaultSalesDiscountGroup: string|null — Default sales discount group (max 8 chars)
 *   defaultPurchaseDiscGroup: string|null — Default purchase discount group (max 8 chars)
 *   qtySoldPast12Months: int — Quantity sold in the past 12 months
 *   orderInPast12Months: int — Number of orders in the past 12 months
 *
 * @phpstan-type InvMastGetData array{invMastUid: int, itemId: string, itemDesc: string|null, deleteFlag: string, weight: float|null, dateCreated: string, dateLastModified: string, inactive: string, classId1: string|null, classId2: string|null, classId3: string|null, classId4: string|null, classId5: string|null, upcOrEan: string|null, upcOrEanId: string|null, serialized: string, productType: string, dLength: float|null, shortCode: string|null, price1: float|null, price2: float|null, price3: float|null, price4: float|null, price5: float|null, price6: float|null, price7: float|null, price8: float|null, price9: float|null, price10: float|null, extendedDesc: string|null, defaultSellingUnit: string|null, hazMatFlag: string, keywords: string|null, disposition: string|null, baseUnit: string, restrictedFlag: string|null, parkerProductCd: string|null, parkerDivisionCd: string|null, commodityCode: string|null, unspscCode: string|null, dciCode: string|null, epaCertReqFlag: string|null, length: float|null, width: float|null, height: float|null, itemNotes: string|null, vndrStock: int|null, manufacturerName: string|null, brandName: string|null, partNumber: string|null, updateCd: int, defaultProductGroup: string|null, upcOrEanPrefix: string|null, upcOrEanItem: string|null, attributeGroupUid: int|null, defaultPriceFamilyUid: int|null, purchasePricingUnit: string|null, purchasePricingUnitSize: float|null, salesPricingUnit: string|null, salesPricingUnitSize: float|null, defaultPurchasingUnit: string|null, statusCd: int, onlineCd: int, processCd: int, eccEnabledFlag: string|null, trackLots: string, defaultSalesDiscountGroup: string|null, defaultPurchaseDiscGroup: string|null, qtySoldPast12Months: int, orderInPast12Months: int}
 */
final class P21Resource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /p21/inv-mast
     *
     * List raw inv_mast P21 data
     * Call: $api->items->p21->listInvMast()
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an inv_mast column.
     *
     * GET https://items.augur-api.com/p21/inv-mast
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1p21~1inv-mast/get
     *
     * Query params ($params; `?` = optional):
     *   createdSince?: string — Created since date (YYYY-MM-DD HH:MM:SS)
     *   limit?: int — Limit number of results (Default: 10)
     *   modifiedSince?: string — Modified since date (YYYY-MM-DD HH:MM:SS)
     *   offset?: int — Offset for pagination
     *   onlineCd?: int — Online code filter (704/705/700)
     *   orderBy?: string — Order by field and direction (e.g., item_id|ASC)
     *   statusCd?: int — Status code filter (704/705/700)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastGetData (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listInvMast(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/inv-mast', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
