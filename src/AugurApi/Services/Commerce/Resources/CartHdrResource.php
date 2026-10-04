<?php

declare(strict_types=1);

namespace AugurApi\Services\Commerce\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * cartHdr resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://commerce.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://commerce.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://commerce.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py commerce
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * CartHdrListListItem: One of a user's carts
 * Returned by: $api->commerce->cartHdr->listList()
 *   cartHdrUid: int — Cart ID
 *   customerId: int — Prophet 21 customer the cart belongs to
 *   contactId: int — Prophet 21 contact the cart belongs to
 *   userId: int — Storefront user the cart belongs to
 *
 * CartHdrLookupGetDataOption1: The cart a lookup found or created
 * Returned by: $api->commerce->cartHdr->getLookup()
 *   cartHdrUid: int — Cart ID
 *   customerId: int — Prophet 21 customer the cart belongs to
 *   userId: int — Storefront user the cart belongs to
 *   contactId: int — Prophet 21 contact the cart belongs to
 *   cartToken: string|null — Token that identifies the cart to the storefront
 *   userCartNo: int — The user's cart number; 0 is the user's default cart
 *
 * CartHdrAlsoBoughtListItem: The full item doc (InvMastHelper::generateDoc)
 * Returned by: $api->commerce->cartHdr->listAlsoBought($cartHdrUid)
 *   invMastUid: int — Item (inv_mast) ID
 *   itemId: string — Item ID
 *   itemDesc: string|null — Item description
 *   displayDesc: string|null — First web-displayed category description for the item
 *   extendedDesc: string|null — Extended description
 *   shortCode: string|null — Short code
 *   defaultSellingUnit: string|null — Default selling unit
 *   defaultPurchasingUnit: string|null — Default purchasing unit
 *   deleteFlag: string — Y when the item is deleted
 *   onlineCd: int — Online code (704 = online)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   baseUnit: string — Base unit
 *   vndrStock: int|null — Vendor stock quantity
 *   classId1: string|null — Item class 1
 *   classId2: string|null — Item class 2
 *   classId3: string|null — Item class 3
 *   classId4: string|null — Item class 4
 *   classId5: string|null — Item class 5
 *   serialized: string — Y when the item is serialized
 *   trackLots: string — Y when the item is lot-tracked
 *   trackingPattern: string — Tracking pattern derived from serialized and trackLots
 *   defaultProductGroup: string|null — Default product group
 *   defaultSalesDiscountGroup: string|null — Default sales discount group
 *   defaultPurchaseDiscGroup: string|null — Default purchase discount group
 *   upcOrEan: string|null — UPC or EAN code type
 *   upcOrEanId: string|null — UPC or EAN code
 *   weight: float|null — Weight
 *   length: float|null — Length
 *   width: float|null — Width
 *   height: float|null — Height
 *   parkerProductCd: string|null — Parker product code
 *   brandName: string|null — Brand name
 *   manufacturerName: string|null — Manufacturer name
 *   inventorySupplier: list<CartHdrAlsoBoughtListItemInventorySupplierItem> — The item's suppliers
 *       (not deleted)
 *     each item: CartHdrAlsoBoughtListItemInventorySupplierItem — One supplier of an item
 *         (InventorySupplierHelper::generateDoc)
 *   primarySupplierName: string|null — Most common primary supplier across the item's locations
 *   itemUom: list<CartHdrAlsoBoughtListItemItemUomItem> — Units of measure (not deleted)
 *     each item: CartHdrAlsoBoughtListItemItemUomItem — One unit of measure an item is sold in
 *   alternateCodes: list<string> — Alternate codes
 *   legacyTags: list<string> — Tags from the legacy service
 *   legacyPersonalization: list<CartHdrAlsoBoughtListItemLegacyPersonalizationItem> —
 *       Personalizations from the legacy service
 *     each item: CartHdrAlsoBoughtListItemLegacyPersonalizationItem — One personalization offered
 *         on an item, with its option group and options (legacy item_personalization_hdr)
 *   categoryList: list<int> — Item category IDs the item is in, ancestors included
 *   attributes: list<CartHdrAlsoBoughtListItemAttributesItem> — Active attribute values, in
 *       attribute-group sequence order
 *     each item: CartHdrAlsoBoughtListItemAttributesItem — One active attribute value on an item
 *         (ItemAttributeValueHelper::listDocByInvMastUid)
 *   images: list<string> — Image URLs or paths
 *   stock: CartHdrAlsoBoughtListItemStock — Stock by location and per company
 *   categoryDisplayDescriptions: array<string, string> — Category display description per item
 *       category ID
 *     map of string
 *   userDefined: array<string, mixed>|array{} — Non-empty user-defined field values, keyed by field
 *       name ([] when empty)
 *   invMastText: list<CartHdrAlsoBoughtListItemInvMastTextItem> — Prophet 21 item text blocks
 *       (empty unless the site has a p21_pim config)
 *     each item: CartHdrAlsoBoughtListItemInvMastTextItem — One Prophet 21 item text block, present
 *         only on sites with a p21_pim config
 *   languages: list<CartHdrAlsoBoughtListItemLanguagesItem> — Descriptions in other languages
 *     each item: CartHdrAlsoBoughtListItemLanguagesItem — An item description in another language
 *         (items inv_mast_language)
 *   brandFolder?: CartHdrAlsoBoughtListItemBrandFolder — Brandfolder assets (trinitysurfaces only)
 *   docCatTrees?: list<list<int>>|null — Category trees for the item's non-root categories
 *       (trinitysurfaces only)
 *     each item: list<int>
 *   productCollection?: string|null — Product collection of the item's category under root 3
 *       (trinitysurfaces only)
 *   tsItemCategoryUid?: int|bool|null — Leaf category under root 3, or false (trinitysurfaces only)
 *   ttItemCategoryUid?: int|bool|null — Leaf category under root 5, or false (trinitysurfaces only)
 *   trim?: bool|null — True when the trim user-defined field is Y (trinitysurfaces only)
 *   fullSizedSamples?: CartHdrAlsoBoughtListItemFullSizedSamplesOption1|bool|null — Full-sized
 *       sample item, or false (trinitysurfaces only)
 *   swatchSample?: CartHdrAlsoBoughtListItemFullSizedSamplesOption1|bool|null — Swatch sample item,
 *       or false (trinitysurfaces only)
 *   itemVariantHdrUid?: int|null — Variant group the item belongs to
 *   price1?: float|null — List price 1 (only with includePricing=Y)
 *   price2?: float|null — List price 2 (only with includePricing=Y)
 *   price3?: float|null — List price 3 (only with includePricing=Y)
 *   price4?: float|null — List price 4 (only with includePricing=Y)
 *   price5?: float|null — List price 5 (only with includePricing=Y)
 *   price6?: float|null — List price 6 (only with includePricing=Y)
 *   price7?: float|null — List price 7 (only with includePricing=Y)
 *   price8?: float|null — List price 8 (only with includePricing=Y)
 *   price9?: float|null — List price 9 (only with includePricing=Y)
 *   price10?: float|null — List price 10 (only with includePricing=Y)
 *
 * CartHdrAlsoBoughtListItemInventorySupplierItem: One supplier of an item
 * (InventorySupplierHelper::generateDoc)
 * Field `inventorySupplier` of CartHdrAlsoBoughtListItem
 *   inventorySupplierUid: int — Item supplier ID
 *   invMastUid: int — Item (inv_mast) supplied
 *   supplierId: float — Supplier ID
 *   upcCode: string — Supplier UPC code; empty when none
 *   checkDigit: string — UPC check digit; empty when none
 *   upc: string — upcCode followed by checkDigit
 *   supplierPartNo: string|null — Supplier part number
 *   primarySupplierFlag: string|null — Y when this is the item's primary supplier
 *   listPrice: float|null — Supplier list price
 *
 * CartHdrAlsoBoughtListItemItemUomItem: One unit of measure an item is sold in
 * Field `itemUom` of CartHdrAlsoBoughtListItem
 *   unitOfMeasure: string — Unit of measure code
 *   unitSize: float — Base units per one of this unit
 *
 * CartHdrAlsoBoughtListItemLegacyPersonalizationItem: One personalization offered on an item, with
 * its option group and options (legacy item_personalization_hdr)
 * Field `legacyPersonalization` of CartHdrAlsoBoughtListItem
 *   itemPersonalizationHdrUid: int — Personalization ID
 *   invMastUid: int — Item (inv_mast) the personalization belongs to
 *   itemOptionsHdrUid: int — Option group offered
 *   ordering: int|null — Sort position
 *   defaultItemOptionsLineUid: int|null — Option chosen by default
 *   required: int|null — 1 when the customer must choose an option
 *   dateLastModified: string|null — Date the record was last changed
 *   dateCreated: string|null — Date the record was created
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   itemOptionsHdr: CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemOptionsHdr — The option
 *       group offered
 *   itemPersonalizationLines:
 *       list<CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItem> — The
 *       options offered
 *     each item: CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItem —
 *         One option offered for an item personalization (legacy item_personalization_line)
 *
 * CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemOptionsHdr: The option group offered
 * Field `itemOptionsHdr` of CartHdrAlsoBoughtListItemLegacyPersonalizationItem
 *   itemOptionsHdrUid: int — Option group ID
 *   name: string|null — Option group name
 *   label: string|null — Label shown to the customer
 *   description: string|null — Option group description
 *   display: int|null — Display mode
 *   size: float|null — Size
 *   dateLastModified: string|null — Date the record was last changed
 *   alias: string|null — Alias
 *
 * CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItem: One option
 * offered for an item personalization (legacy item_personalization_line)
 * Field `itemPersonalizationLines` of CartHdrAlsoBoughtListItemLegacyPersonalizationItem
 *   itemPersonalizationLineUid: int — Personalization line ID
 *   itemPersonalizationHdrUid: int — Personalization the line belongs to
 *   itemOptionsLineUid: int — Option offered
 *   active: int|null — 1 when the option is offered
 *   def: int|null — 1 when the option is the default
 *   adjustmentInvMastUid: int|null — Item (inv_mast) added to the order when the option is chosen
 *   dateLastModified: string|null — Date the record was last changed
 *   dateCreated: string|null — Date the record was created
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   itemOptionsLine:
 *       CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItemItemOptionsLine
 *       — The option offered
 *
 * CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItemItemOptionsLine:
 * The option offered
 * Field `itemOptionsLine` of
 * CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItem
 *   itemOptionsLineUid: int — Option ID
 *   itemOptionsHdrUid: int — Option group the option belongs to
 *   name: string|null — Option name
 *   ordering: int|null — Sort position
 *   size: float|null — Size
 *   dateLastModified: string|null — Date the record was last changed
 *
 * CartHdrAlsoBoughtListItemAttributesItem: One active attribute value on an item
 * (ItemAttributeValueHelper::listDocByInvMastUid)
 * Field `attributes` of CartHdrAlsoBoughtListItem
 *   attributeName: string|null — Attribute description
 *   attributeValue: string|null — The item's value for the attribute
 *
 * CartHdrAlsoBoughtListItemStock: Stock by location and per company
 * Field `stock` of CartHdrAlsoBoughtListItem
 *   stockData: list<CartHdrAlsoBoughtListItemStockStockDataItem> — Stock at each location
 *     each item: CartHdrAlsoBoughtListItemStockStockDataItem — An item's stock at one location
 *         (InvLocHelper::listStockByInvMastUid)
 *   companySummary: array<string, float> — Selling-unit quantity available per company ID, vendor
 *       stock included
 *     map of float
 *
 * CartHdrAlsoBoughtListItemStockStockDataItem: An item's stock at one location
 * (InvLocHelper::listStockByInvMastUid)
 * Field `stockData` of CartHdrAlsoBoughtListItemStock
 *   locationId: float — Location ID
 *   companyId: string — Company the location belongs to
 *   qtyOnHand: float — Quantity on hand, in base units
 *   qtyAllocated: float — Quantity allocated, in base units
 *   stockable: string|null — Y when the item is stocked at the location
 *   sellable: string|null — Y when the item is sold from the location
 *   discontinued: string — Y when the item is discontinued at the location
 *   unallocated: float — qtyOnHand minus qtyAllocated
 *   nextDueInPoDate: string|null — Date (Y-m-d) the next purchase order is due in
 *   qtyBackordered: float|null — Quantity backordered
 *   primaryBin: string|null — Primary bin
 *   qtyFrozen: float — Quantity frozen
 *   qtyQuarantined: float — Quantity quarantined
 *   qtyNonPickable: float — Quantity not pickable
 *   qtyAvailable: float — qtyOnHand less allocated, frozen, quarantined and non-pickable
 *   orderQuantity: float|null — Order quantity
 *   productGroupId: string|null — Product group at the location
 *   baseUnit: string — Item base unit
 *   baseUnitSize: float — Base unit size (1 when unset)
 *   defaultSellingUnit: string|null — Item default selling unit
 *   defaultSellingUnitSize: float — Default selling unit size
 *   divisor: float — defaultSellingUnitSize divided by baseUnitSize
 *   calcQtyOnHand: float — qtyOnHand in selling units
 *   calcQtyAllocated: float — qtyAllocated in selling units
 *   calcQtyAvailable: float — qtyAvailable in selling units
 *   locationName: string — Location name, or "Location {locationId}" when it cannot be resolved
 *
 * CartHdrAlsoBoughtListItemInvMastTextItem: One Prophet 21 item text block, present only on sites
 * with a p21_pim config
 * Field `invMastText` of CartHdrAlsoBoughtListItem
 *   sequenceNo: int — Display order
 *   displayOnWebFlag: string — Y when the text displays on the web
 *   textTypeCd: int — Prophet 21 text type code
 *   textTypeDesc: string|null — Text type description; null when the code cannot be resolved
 *   webDisplayTypeUid: int — Web display type ID
 *   webDisplayTypeId: string — Web display type code
 *   webDisplayTypeDesc: string — Web display type description
 *   textValue: string — The text
 *
 * CartHdrAlsoBoughtListItemLanguagesItem: An item description in another language (items
 * inv_mast_language)
 * Field `languages` of CartHdrAlsoBoughtListItem
 *   invMastLanguageUid: int — Item language ID
 *   invMastUid: int — Item (inv_mast) the description belongs to
 *   languageId: string|null — Language ID
 *   languageItemDesc: string|null — Item description in the language
 *   itemDescDeleteFlag: string — Y when the description is deleted
 *   dateCreated: string — Date the record was created
 *   createdBy: string — User who created the record
 *   dateLastModified: string — Date the record was last changed
 *   lastMaintainedBy: string — User who last changed the record
 *   languageExtendedDesc: string|null — Extended description in the language
 *   updateCd: int — Update code (1185 = Import Complete)
 *
 * CartHdrAlsoBoughtListItemBrandFolder: Brandfolder assets (trinitysurfaces only)
 * Field `brandFolder` of CartHdrAlsoBoughtListItem
 *   assets?: list<CartHdrAlsoBoughtListItemBrandFolderAssetsItem>|null — Active assets linked to
 *       the item; the key is absent when the lookup failed
 *     each item: CartHdrAlsoBoughtListItemBrandFolderAssetsItem — One Brandfolder asset linked to
 *         an item
 *
 * CartHdrAlsoBoughtListItemBrandFolderAssetsItem: One Brandfolder asset linked to an item
 * Field `assets` of CartHdrAlsoBoughtListItemBrandFolder
 *   id: string — Brandfolder asset ID
 *   name: string|null — Asset name
 *   attachmentName: string|null — First attachment's file name
 *   cdnLink: string — CDN URL of the asset
 *   layout: string — Attachment layout (square when unknown)
 *
 * CartHdrAlsoBoughtListItemFullSizedSamplesOption1:
 * Field `fullSizedSamples` of CartHdrAlsoBoughtListItem
 * Field `swatchSample` of CartHdrAlsoBoughtListItem
 *   itemId: string — Sample item ID
 *   invMastUid: int — Sample item (inv_mast) ID
 *   classId5: string|null — Sample item class 5
 *   samplesApp: bool — True when the 4th character of classId5 is 1
 *
 * @phpstan-type CartHdrListListItem array{cartHdrUid: int, customerId: int, contactId: int, userId: int}
 * @phpstan-type CartHdrLookupGetDataOption1 array{cartHdrUid: int, customerId: int, userId: int, contactId: int, cartToken: string|null, userCartNo: int}
 * @phpstan-type CartHdrAlsoBoughtListItem array{invMastUid: int, itemId: string, itemDesc: string|null, displayDesc: string|null, extendedDesc: string|null, shortCode: string|null, defaultSellingUnit: string|null, defaultPurchasingUnit: string|null, deleteFlag: string, onlineCd: int, statusCd: int, baseUnit: string, vndrStock: int|null, classId1: string|null, classId2: string|null, classId3: string|null, classId4: string|null, classId5: string|null, serialized: string, trackLots: string, trackingPattern: string, defaultProductGroup: string|null, defaultSalesDiscountGroup: string|null, defaultPurchaseDiscGroup: string|null, upcOrEan: string|null, upcOrEanId: string|null, weight: float|null, length: float|null, width: float|null, height: float|null, parkerProductCd: string|null, brandName: string|null, manufacturerName: string|null, inventorySupplier: list<CartHdrAlsoBoughtListItemInventorySupplierItem>, primarySupplierName: string|null, itemUom: list<CartHdrAlsoBoughtListItemItemUomItem>, alternateCodes: list<string>, legacyTags: list<string>, legacyPersonalization: list<CartHdrAlsoBoughtListItemLegacyPersonalizationItem>, categoryList: list<int>, attributes: list<CartHdrAlsoBoughtListItemAttributesItem>, images: list<string>, stock: CartHdrAlsoBoughtListItemStock, categoryDisplayDescriptions: array<string, string>, userDefined: array<string, mixed>|array{}, invMastText: list<CartHdrAlsoBoughtListItemInvMastTextItem>, languages: list<CartHdrAlsoBoughtListItemLanguagesItem>, brandFolder?: CartHdrAlsoBoughtListItemBrandFolder, docCatTrees?: list<list<int>>|null, productCollection?: string|null, tsItemCategoryUid?: int|bool|null, ttItemCategoryUid?: int|bool|null, trim?: bool|null, fullSizedSamples?: CartHdrAlsoBoughtListItemFullSizedSamplesOption1|bool|null, swatchSample?: CartHdrAlsoBoughtListItemFullSizedSamplesOption1|bool|null, itemVariantHdrUid?: int|null, price1?: float|null, price2?: float|null, price3?: float|null, price4?: float|null, price5?: float|null, price6?: float|null, price7?: float|null, price8?: float|null, price9?: float|null, price10?: float|null}
 * @phpstan-type CartHdrAlsoBoughtListItemInventorySupplierItem array{inventorySupplierUid: int, invMastUid: int, supplierId: float, upcCode: string, checkDigit: string, upc: string, supplierPartNo: string|null, primarySupplierFlag: string|null, listPrice: float|null}
 * @phpstan-type CartHdrAlsoBoughtListItemItemUomItem array{unitOfMeasure: string, unitSize: float}
 * @phpstan-type CartHdrAlsoBoughtListItemLegacyPersonalizationItem array{itemPersonalizationHdrUid: int, invMastUid: int, itemOptionsHdrUid: int, ordering: int|null, defaultItemOptionsLineUid: int|null, required: int|null, dateLastModified: string|null, dateCreated: string|null, updateCd: int, statusCd: int, processCd: int, itemOptionsHdr: CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemOptionsHdr, itemPersonalizationLines: list<CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItem>}
 * @phpstan-type CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemOptionsHdr array{itemOptionsHdrUid: int, name: string|null, label: string|null, description: string|null, display: int|null, size: float|null, dateLastModified: string|null, alias: string|null}
 * @phpstan-type CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItem array{itemPersonalizationLineUid: int, itemPersonalizationHdrUid: int, itemOptionsLineUid: int, active: int|null, def: int|null, adjustmentInvMastUid: int|null, dateLastModified: string|null, dateCreated: string|null, updateCd: int, statusCd: int, processCd: int, itemOptionsLine: CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItemItemOptionsLine}
 * @phpstan-type CartHdrAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItemItemOptionsLine array{itemOptionsLineUid: int, itemOptionsHdrUid: int, name: string|null, ordering: int|null, size: float|null, dateLastModified: string|null}
 * @phpstan-type CartHdrAlsoBoughtListItemAttributesItem array{attributeName: string|null, attributeValue: string|null}
 * @phpstan-type CartHdrAlsoBoughtListItemStock array{stockData: list<CartHdrAlsoBoughtListItemStockStockDataItem>, companySummary: array<string, float>}
 * @phpstan-type CartHdrAlsoBoughtListItemStockStockDataItem array{locationId: float, companyId: string, qtyOnHand: float, qtyAllocated: float, stockable: string|null, sellable: string|null, discontinued: string, unallocated: float, nextDueInPoDate: string|null, qtyBackordered: float|null, primaryBin: string|null, qtyFrozen: float, qtyQuarantined: float, qtyNonPickable: float, qtyAvailable: float, orderQuantity: float|null, productGroupId: string|null, baseUnit: string, baseUnitSize: float, defaultSellingUnit: string|null, defaultSellingUnitSize: float, divisor: float, calcQtyOnHand: float, calcQtyAllocated: float, calcQtyAvailable: float, locationName: string}
 * @phpstan-type CartHdrAlsoBoughtListItemInvMastTextItem array{sequenceNo: int, displayOnWebFlag: string, textTypeCd: int, textTypeDesc: string|null, webDisplayTypeUid: int, webDisplayTypeId: string, webDisplayTypeDesc: string, textValue: string}
 * @phpstan-type CartHdrAlsoBoughtListItemLanguagesItem array{invMastLanguageUid: int, invMastUid: int, languageId: string|null, languageItemDesc: string|null, itemDescDeleteFlag: string, dateCreated: string, createdBy: string, dateLastModified: string, lastMaintainedBy: string, languageExtendedDesc: string|null, updateCd: int}
 * @phpstan-type CartHdrAlsoBoughtListItemBrandFolder array{assets?: list<CartHdrAlsoBoughtListItemBrandFolderAssetsItem>|null}
 * @phpstan-type CartHdrAlsoBoughtListItemBrandFolderAssetsItem array{id: string, name: string|null, attachmentName: string|null, cdnLink: string, layout: string}
 * @phpstan-type CartHdrAlsoBoughtListItemFullSizedSamplesOption1 array{itemId: string, invMastUid: int, classId5: string|null, samplesApp: bool}
 */
final class CartHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /cart-hdr/list
     *
     * List Cart Hdr by user_id
     * Call: $api->commerce->cartHdr->listList()
     *
     * Response data, each item: One of a user's carts
     *
     * GET https://commerce.augur-api.com/cart-hdr/list
     * Contract: https://commerce.augur-api.com/openapi.json#/paths/~1cart-hdr~1list/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   userId: int — Storefront user whose carts to list
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CartHdrListListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listList(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/list', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /cart-hdr/lookup
     *
     * Lookup Cart Hdr
     * Call: $api->commerce->cartHdr->getLookup()
     *
     * GET https://commerce.augur-api.com/cart-hdr/lookup
     * Contract: https://commerce.augur-api.com/openapi.json#/paths/~1cart-hdr~1lookup/get
     *
     * Query params ($params; `?` = optional):
     *   cartToken?: string — Token that identifies an anonymous cart; ignored when userId is above
     *       0
     *   contactId: int — Prophet 21 contact the cart belongs to
     *   customerId: int — Prophet 21 customer the cart belongs to
     *   userCartNo?: int — The user's cart number; 0 or absent picks cart 1 for a logged-in user
     *   userId: int — Storefront user the cart belongs to; 0 for an anonymous cart keyed on
     *       cartToken
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CartHdrLookupGetDataOption1|false
     *   one of:
     *     CartHdrLookupGetDataOption1 — The cart a lookup found or created
     *     false — false when the operation failed
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<CartHdrLookupGetDataOption1|false>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        /** @var BaseResponse<CartHdrLookupGetDataOption1|false> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /cart-hdr/{cartHdrUid}/also-bought
     *
     * List Also Bought data for Cart Hdr
     * Call: $api->commerce->cartHdr->listAlsoBought($cartHdrUid)
     *
     * Response data, each item: The full item doc (InvMastHelper::generateDoc)
     *
     * GET https://commerce.augur-api.com/cart-hdr/{cartHdrUid}/also-bought
     * Contract:
     * https://commerce.augur-api.com/openapi.json#/paths/~1cart-hdr~1{cartHdrUid}~1also-bought/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — limit (default 10)
     *   offset?: int — offset (default 0)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CartHdrAlsoBoughtListItem (fields listed on the class)
     *
     * @param int $cartHdrUid Cart ID (cart_hdr_uid) whose items drive the recommendations
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listAlsoBought(int $cartHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{cartHdrUid}/also-bought',
            $params,
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
