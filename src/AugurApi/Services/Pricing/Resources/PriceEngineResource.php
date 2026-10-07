<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * priceEngine resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://pricing.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://pricing.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://pricing.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py pricing
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * PriceEngineListData: Price for one item and customer from the four-stage pricing waterfall (job,
 * source code, library, default company)
 * Returned by: $api->pricing->priceEngine->list()
 * Field `priceEngine` of PriceEngineCreateDataItemsItem
 *   unitPrice: float — Selling price per unit of measure; 0 when no stage produced a price
 *   pricedFrom:
 *       'jobPricing'|'sourceCd'|'libraryPrice'|'libraryMultiplier'|'defaultCompanyPrice'|false —
 *       Waterfall stage that produced the price, or false when none did
 *   priceType: 'J'|'S'|'L'|'C'|false — Short code of the winning stage (J, S, L, C), or false when
 *       none did
 *   jobPrice: float|false — Job or contract price when job pricing matched, otherwise false
 *   listPrice: float — Primary supplier list price, always calculated for reference
 *   customer: PriceEngineListDataCustomer — Customer pricing setup used by the engine
 *   item: PriceEngineListDataItem — Item, quantity, and unit of measure that were priced
 *   options: array<string, mixed>|array{} — Input options the engine ran with, keyed by option name
 *       (customerId, itemId, quantity, unitOfMeasure, shipToId, cartItems) ([] when empty)
 *   messages: list<string> — Diagnostic messages collected while pricing
 *   jobNo: string|null — Job number when job pricing matched
 *   jobPriceHdrUid: int|null — Job price header UID when job pricing matched
 *   contractNo: string|null — Contract number when job pricing matched
 *   libraryPriceData:
 *       PriceEngineListDataLibraryPriceDataOption1|PriceEngineListDataLibraryPriceDataOption2|null
 *       — Library pricing detail whenever the library stage ran, including when it found no price
 *     one of:
 *       PriceEngineListDataLibraryPriceDataOption1 — Library price from the price page that matched
 *           the item (library, book, page chain)
 *       PriceEngineListDataLibraryPriceDataOption2 — Library price from a multiplier library (type
 *           211), which prices without consulting books or pages
 *   defaultCompanyPrice: PriceEngineListDataDefaultCompanyPrice|null — Default company pricing
 *       detail when that stage ran
 *   webPrice: float|false — Web discount price for the customer, or false when no web pricing rule
 *       applies
 *
 * PriceEngineListDataCustomer: Customer pricing setup used by the engine
 * Field `customer` of PriceEngineListData
 *   customerId: float — P21 customer ID
 *   valid: bool — True when the customer was found
 *   sourcePriceCd: int|false — Customer's source price code, or false when none is set
 *   sourcePriceDesc: string|null — Description of the source price code
 *   pricingMethodCd: int|null — Customer's pricing method code (211 Multiplier, 234 Libraries)
 *   pricingMethodDesc: string|null — Description of the pricing method code
 *   hasJobPricing: bool — True when the customer has any active job pricing
 *   jobPricingEnabled: bool — True when job pricing is enabled for the customer
 *   corpAddressId: float|null — Corporate address ID used for corporate job pricing
 *   corpAddressJobCount: int — Number of jobs linked to the corporate address
 *   customerShipToJobCount: int — Number of jobs linked to the customer or ship-to
 *
 * PriceEngineListDataItem: Item, quantity, and unit of measure that were priced
 * Field `item` of PriceEngineListData
 *   itemId: string — P21 item ID
 *   valid: bool — True when the item was found
 *   invMastUid: int|null — Inventory master UID when the item was found
 *   quantity: float — Requested quantity
 *   unitOfMeasure: string|null — Unit of measure the price is expressed in
 *
 * PriceEngineListDataLibraryPriceDataOption1: Library price from the price page that matched the
 * item (library, book, page chain)
 * Field `libraryPriceData` of PriceEngineListData
 *   unitPrice: float|false — Unit price in the requested unit of measure, or false when no page
 *       produced a price
 *   sourcePrice: float|null|false — Source price the page calculation started from
 *   quantity: float — Quantity used to select the break tier
 *   pricePageUid: int — Price page UID that matched
 *   pricePageDescription: string — Description of the matched price page
 *   pricePageCdType: int — Page type code that decided the match (212 item to 2339 price family)
 *   pricePageCdDesc: string — Description of the page type code
 *   effectiveDate: string — Date the matched page takes effect
 *   expirationDate: string — Date the matched page expires
 *   itemId: string — P21 item ID
 *   invMastUid: int — Inventory master UID
 *   pricingMethodCd: int — Page pricing method code
 *   pricingMethodCdDesc: string — Description of the pricing method code
 *   sourcePriceCd: int — Source price code the source price came from
 *   sourcePriceCdDesc: string — Description of the source price code
 *   calculationMethodCd: int — Calculation method code (211 multiplier, 229 markup, 1292 fixed
 *       price)
 *   calculationMethodCdDesc: string — Description of the calculation method code
 *   totalingMethodCd: int — Totaling method code
 *   totalingMethodCdDesc: string — Description of the totaling method code
 *   calculatorType: string — Page calculator type: P price, B break, C cost
 *   purchasePricingUnit: string|null — Item's purchase pricing unit
 *   purchasePricingUnitSize: float|null — Size of the purchase pricing unit
 *   salesPricingUnit: string|null — Item's sales pricing unit
 *   salesPricingUnitSize: float|null — Size of the sales pricing unit
 *   unitOfMeasure: string|null — Unit of measure the price is expressed in
 *   unitOfMeasureSize: float|null — Size of the unit of measure in base units
 *   defaultSellingUnit: string|null — Item's default selling unit
 *   defaultSellingUnitSize: float|null — Size of the default selling unit
 *   defaultPurchasingUnit: string|null — Item's default purchasing unit
 *   defaultPurchasingUnitSize: float|null — Size of the default purchasing unit
 *   baseUnit: string|null — Item's base unit
 *   baseUnitSize: float|null — Size of the base unit
 *   multiplier: float — Calculation value applied for the quantity (multiplier or markup percent)
 *   breaks: list<PriceEngineListDataLibraryPriceDataOption1BreaksItem> — Quantity break tiers of
 *       the matched page, lowest quantity first
 *     each item: PriceEngineListDataLibraryPriceDataOption1BreaksItem — One quantity break tier of
 *         a price page
 *   baseSize: float|null — Base size the source price is divided by, set when the calculation runs
 *   basePrice: float|null — Price per base unit, set when the calculation runs
 *   potentialCostValue: float|null — Candidate cost value on the cost path, committed as source
 *       price only after a page match
 *   costPageUid: float|null — Cost page UID used on the cost path
 *   costPageDescription: string|null — Description of the cost page
 *   costPageMatched: bool|null — True when a cost page matched on the cost path
 *   costSource: string|null — Where the cost came from when a fallback was used
 *   lastReceivedPoCostSupplierId: float|null — Supplier ID whose last received PO cost was used
 *       (source code 204)
 *   invLocProductGroupId: string|null — Item's product group at the pricing location
 *   pricePageProductGroupId: string|null — Product group on the matched page
 *   pricePageSupplierId: float|null — Supplier ID on the matched page
 *   pricePageDiscountGroupId: string|null — Discount group on the matched page
 *   pricePageMfgClassId: string|null — Manufacturer class on the matched page
 *   pricePagePriceFamilyUid: float|null — Price family UID on the matched page
 *   invLocSalesDiscountGroup: string|null — Item's sales discount group at the pricing location
 *   invLocPriceFamilyUid: float|null — Item's price family UID at the pricing location
 *
 * PriceEngineListDataLibraryPriceDataOption1BreaksItem: One quantity break tier of a price page
 * Field `breaks` of PriceEngineListDataLibraryPriceDataOption1
 *   calculationValue: float|null — Page calculation value (multiplier or markup) for this tier
 *   break: float|null — Quantity at which the next tier starts, or null for the last tier
 *   startQuantity: float — First quantity this tier applies to
 *   endQuantity: float|null — Last quantity this tier applies to, or null when open-ended
 *   unitPrice: float|false — Unit price at this tier, or false when it could not be calculated
 *
 * PriceEngineListDataLibraryPriceDataOption2: Library price from a multiplier library (type 211),
 * which prices without consulting books or pages
 * Field `libraryPriceData` of PriceEngineListData
 *   unitPrice: float|false — Unit price, or false when the library produced no price
 *   pricedFrom: string|null — Pricing source label, libraryMultiplier when a price was found
 *   sourcePrice: float|null — Source price the multiplier was applied to
 *   sourcePriceCd: int|null — Source price code the source price came from
 *   multiplier: float|null — Library multiplier applied to the source price
 *   priceLibraryUid: int|null — Price library UID that produced the price
 *   unitOfMeasureSize: float|null — Unit of measure size applied to the base price
 *
 * PriceEngineListDataDefaultCompanyPrice: Default company pricing detail when that stage ran
 * Field `defaultCompanyPrice` of PriceEngineListData
 *   unitPrice: float|false — Unit price in the requested unit of measure, or false when none was
 *       found
 *   purchasePricingUnitSize: float|null — Item's purchase pricing unit size from inv_mast
 *   sourceTypeCd: int — Company price source code (PRICE_1 to PRICE_10 or supplier list price), 0
 *       when none
 *   sourceTypeDesc: string|null — Description of the company price source code
 *   unitOfMeasure: string — Unit of measure the price is expressed in
 *   unitOfMeasureSize: float — Size of the unit of measure in base units
 *   basePrice: float — Source price before base size and unit of measure conversion
 *   baseSize: float — Base size the source price is divided by
 *
 * PriceEngineCreateData: Prices for every cart line, each priced with the whole cart as context for
 * group quantity breaks
 * Returned by: $api->pricing->priceEngine->create($data)
 *   customerId: int — P21 customer ID the cart was priced for
 *   shipToId: int — Ship-to ID used for pricing
 *   itemCount: int — Number of cart lines priced
 *   items: list<PriceEngineCreateDataItemsItem> — Price for each cart line
 *     each item: PriceEngineCreateDataItemsItem — Price engine result for one cart line
 *
 * PriceEngineCreateDataItemsItem: Price engine result for one cart line
 * Field `items` of PriceEngineCreateData
 *   itemId: string — P21 item ID
 *   quantity: float — Quantity priced
 *   unitOfMeasure: string — Unit of measure the price is expressed in; empty when neither the
 *       request nor the item supplied one
 *   priceEngine: PriceEngineListData — Full price engine result for this line
 *
 * PriceEngineCreateBody: Cart to price; every line is priced with the whole cart as context for
 * group quantity breaks
 * Request body of: $api->pricing->priceEngine->create($data)
 *   customerId: int — P21 customer ID to price for; MUST be positive
 *   items: list<PriceEngineCreateBodyItemsItem> — Cart lines to price; MUST NOT be empty
 *     each item: PriceEngineCreateBodyItemsItem — One cart line to price
 *   shipToId?: int|null — Ship-to ID for location-based pricing; defaults to customerId
 *
 * PriceEngineCreateBodyItemsItem: One cart line to price
 * Field `items` of PriceEngineCreateBody
 *   itemId: string — P21 item ID; lines with an empty itemId are skipped
 *   quantity?: float — Quantity to price, defaults to 1
 *   unitOfMeasure?: string|null — Unit of measure to price in; the item's default when omitted
 *
 * @phpstan-type PriceEngineListData array{unitPrice: float, pricedFrom: 'jobPricing'|'sourceCd'|'libraryPrice'|'libraryMultiplier'|'defaultCompanyPrice'|false, priceType: 'J'|'S'|'L'|'C'|false, jobPrice: float|false, listPrice: float, customer: PriceEngineListDataCustomer, item: PriceEngineListDataItem, options: array<string, mixed>|array{}, messages: list<string>, jobNo: string|null, jobPriceHdrUid: int|null, contractNo: string|null, libraryPriceData: PriceEngineListDataLibraryPriceDataOption1|PriceEngineListDataLibraryPriceDataOption2|null, defaultCompanyPrice: PriceEngineListDataDefaultCompanyPrice|null, webPrice: float|false}
 * @phpstan-type PriceEngineListDataCustomer array{customerId: float, valid: bool, sourcePriceCd: int|false, sourcePriceDesc: string|null, pricingMethodCd: int|null, pricingMethodDesc: string|null, hasJobPricing: bool, jobPricingEnabled: bool, corpAddressId: float|null, corpAddressJobCount: int, customerShipToJobCount: int}
 * @phpstan-type PriceEngineListDataItem array{itemId: string, valid: bool, invMastUid: int|null, quantity: float, unitOfMeasure: string|null}
 * @phpstan-type PriceEngineListDataLibraryPriceDataOption1 array{unitPrice: float|false, sourcePrice: float|null|false, quantity: float, pricePageUid: int, pricePageDescription: string, pricePageCdType: int, pricePageCdDesc: string, effectiveDate: string, expirationDate: string, itemId: string, invMastUid: int, pricingMethodCd: int, pricingMethodCdDesc: string, sourcePriceCd: int, sourcePriceCdDesc: string, calculationMethodCd: int, calculationMethodCdDesc: string, totalingMethodCd: int, totalingMethodCdDesc: string, calculatorType: string, purchasePricingUnit: string|null, purchasePricingUnitSize: float|null, salesPricingUnit: string|null, salesPricingUnitSize: float|null, unitOfMeasure: string|null, unitOfMeasureSize: float|null, defaultSellingUnit: string|null, defaultSellingUnitSize: float|null, defaultPurchasingUnit: string|null, defaultPurchasingUnitSize: float|null, baseUnit: string|null, baseUnitSize: float|null, multiplier: float, breaks: list<PriceEngineListDataLibraryPriceDataOption1BreaksItem>, baseSize: float|null, basePrice: float|null, potentialCostValue: float|null, costPageUid: float|null, costPageDescription: string|null, costPageMatched: bool|null, costSource: string|null, lastReceivedPoCostSupplierId: float|null, invLocProductGroupId: string|null, pricePageProductGroupId: string|null, pricePageSupplierId: float|null, pricePageDiscountGroupId: string|null, pricePageMfgClassId: string|null, pricePagePriceFamilyUid: float|null, invLocSalesDiscountGroup: string|null, invLocPriceFamilyUid: float|null}
 * @phpstan-type PriceEngineListDataLibraryPriceDataOption1BreaksItem array{calculationValue: float|null, break: float|null, startQuantity: float, endQuantity: float|null, unitPrice: float|false}
 * @phpstan-type PriceEngineListDataLibraryPriceDataOption2 array{unitPrice: float|false, pricedFrom: string|null, sourcePrice: float|null, sourcePriceCd: int|null, multiplier: float|null, priceLibraryUid: int|null, unitOfMeasureSize: float|null}
 * @phpstan-type PriceEngineListDataDefaultCompanyPrice array{unitPrice: float|false, purchasePricingUnitSize: float|null, sourceTypeCd: int, sourceTypeDesc: string|null, unitOfMeasure: string, unitOfMeasureSize: float, basePrice: float, baseSize: float}
 * @phpstan-type PriceEngineCreateData array{customerId: int, shipToId: int, itemCount: int, items: list<PriceEngineCreateDataItemsItem>}
 * @phpstan-type PriceEngineCreateDataItemsItem array{itemId: string, quantity: float, unitOfMeasure: string, priceEngine: PriceEngineListData}
 * @phpstan-type PriceEngineCreateBody array{customerId: int, items: list<PriceEngineCreateBodyItemsItem>, shipToId?: int|null}
 * @phpstan-type PriceEngineCreateBodyItemsItem array{itemId: string, quantity?: float, unitOfMeasure?: string|null}
 */
final class PriceEngineResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /price-engine
     *
     * Get Item Price
     * Call: $api->pricing->priceEngine->list()
     *
     * Response data: Price for one item and customer from the four-stage pricing waterfall (job,
     * source code, library, default company)
     *
     * Errors:
     *   400: A positive "customerId" is required.
     *
     * GET https://pricing.augur-api.com/price-engine
     * Contract: https://pricing.augur-api.com/openapi.json#/paths/~1price-engine/get
     *
     * Query params ($params; `?` = optional):
     *   cartItems?: string — Cart items for group break pricing (format:
     *       itemId:qty[:UOM],itemId:qty[:UOM])
     *   customerId: int — Prophet 21 customer to price for; MUST be above 0
     *   itemId: string — Prophet 21 item ID to price
     *   quantity?: int — Quantity to price, for quantity breaks (Default: 1)
     *   shipToId?: int — Prophet 21 ship-to that selects the pricing location (Default: the
     *       customer default ship-to)
     *   unitOfMeasure?: string — Unit of measure to price in (Default: the item sales unit)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: PriceEngineListData (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /price-engine
     *
     * Cart Price Engine
     * Call: $api->pricing->priceEngine->create($data)
     *
     * Price multiple items with cart context for group break pricing
     *
     * Request body: Cart to price; every line is priced with the whole cart as context for group
     * quantity breaks
     * Response data: Prices for every cart line, each priced with the whole cart as context for
     * group quantity breaks
     *
     * Errors:
     *   400: Request body is required with customerId and items array. Or A required body field is
     *       missing or has the wrong type.
     *
     * POST https://pricing.augur-api.com/price-engine
     * Contract: https://pricing.augur-api.com/openapi.json#/paths/~1price-engine/post
     *
     * Request body ($data): PriceEngineCreateBody (fields listed on the class)
     *
     * Response data type: PriceEngineCreateData (fields listed on the class)
     *
     * @param PriceEngineCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
