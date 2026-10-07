<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMast resource — generated from spec.
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
 * InvMastListItem: The full item doc (InvMastHelper::generateDoc)
 * Returned by: $api->items->invMast->list()
 * Returned by: $api->items->invMast->listDoc($invMastUid)
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
 *   inventorySupplier: list<CategoriesItemsListDataItemsItemInventorySupplierItem> — The item's
 *       suppliers (not deleted)
 *     each item: CategoriesItemsListDataItemsItemInventorySupplierItem — One supplier of an item
 *         (InventorySupplierHelper::generateDoc)
 *   primarySupplierName: string|null — Most common primary supplier across the item's locations
 *   itemUom: list<CategoriesItemsListDataItemsItemItemUomItem> — Units of measure (not deleted)
 *     each item: CategoriesItemsListDataItemsItemItemUomItem — One unit of measure an item is sold
 *         in
 *   alternateCodes: list<string> — Alternate codes
 *   legacyTags: list<string> — Tags from the legacy service
 *   legacyPersonalization: list<InvMastListItemLegacyPersonalizationItem> — Personalizations from
 *       the legacy service
 *     each item: InvMastListItemLegacyPersonalizationItem — One personalization offered on an item,
 *         with its option group and options (legacy item_personalization_hdr)
 *   categoryList: list<int> — Item category IDs the item is in, ancestors included
 *   attributes: list<InvMastListItemAttributesItem> — Active attribute values, in attribute-group
 *       sequence order
 *     each item: InvMastListItemAttributesItem — One active attribute value on an item
 *         (ItemAttributeValueHelper::listDocByInvMastUid)
 *   images: list<string> — Image URLs or paths
 *   stock: InvMastStockGetData — Stock by location and per company
 *   categoryDisplayDescriptions: array<string, string> — Category display description per item
 *       category ID
 *     map of string
 *   userDefined: array<string, mixed>|array{} — Non-empty user-defined field values, keyed by field
 *       name ([] when empty)
 *   invMastText: list<InvMastListItemInvMastTextItem> — Prophet 21 item text blocks (empty unless
 *       the site has a p21_pim config)
 *     each item: InvMastListItemInvMastTextItem — One Prophet 21 item text block, present only on
 *         sites with a p21_pim config
 *   languages: list<InvMastListItemLanguagesItem> — Descriptions in other languages
 *     each item: InvMastListItemLanguagesItem — An item description in another language (items
 *         inv_mast_language)
 *   brandFolder?: BrandsFacetsListDataItemsItemBrandFolder|null — Brandfolder assets
 *       (trinitysurfaces only)
 *   docCatTrees?: list<list<int>>|null — Category trees for the item's non-root categories
 *       (trinitysurfaces only)
 *     each item: list<int>
 *   productCollection?: string|null — Product collection of the item's category under root 3
 *       (trinitysurfaces only)
 *   tsItemCategoryUid?: int|null|false — Leaf category under root 3, or false (trinitysurfaces
 *       only)
 *   ttItemCategoryUid?: int|null|false — Leaf category under root 5, or false (trinitysurfaces
 *       only)
 *   trim?: bool|null — True when the trim user-defined field is Y (trinitysurfaces only)
 *   fullSizedSamples?: CategoriesItemsListDataItemsItemFullSizedSamplesOption1|null|false —
 *       Full-sized sample item, or false (trinitysurfaces only)
 *     one of:
 *       CategoriesItemsListDataItemsItemFullSizedSamplesOption1|null — A sample item linked from an
 *           item's user-defined fields (trinitysurfaces)
 *       false
 *   swatchSample?: CategoriesItemsListDataItemsItemFullSizedSamplesOption1|null|false — Swatch
 *       sample item, or false (trinitysurfaces only)
 *     one of:
 *       CategoriesItemsListDataItemsItemFullSizedSamplesOption1|null — A sample item linked from an
 *           item's user-defined fields (trinitysurfaces)
 *       false
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
 * CategoriesItemsListDataItemsItemInventorySupplierItem: One supplier of an item
 * (InventorySupplierHelper::generateDoc)
 * Field `inventorySupplier` of InvMastListItem
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
 * CategoriesItemsListDataItemsItemItemUomItem: One unit of measure an item is sold in
 * Field `itemUom` of InvMastListItem
 * Field `childItemUom` of InvMastInvAccessoryListItem
 * Field `itemUom` of InvMastInvSubListItem
 * Field `itemUom` of InvMastSimilarListItem
 *   unitOfMeasure: string — Unit of measure code
 *   unitSize: float — Base units per one of this unit
 *
 * InvMastListItemLegacyPersonalizationItem: One personalization offered on an item, with its option
 * group and options (legacy item_personalization_hdr)
 * Field `legacyPersonalization` of InvMastListItem
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
 *   itemOptionsHdr: InvMastListItemLegacyPersonalizationItemItemOptionsHdr — The option group
 *       offered
 *   itemPersonalizationLines:
 *       list<InvMastListItemLegacyPersonalizationItemItemPersonalizationLinesItem> — The options
 *       offered
 *     each item: InvMastListItemLegacyPersonalizationItemItemPersonalizationLinesItem — One option
 *         offered for an item personalization (legacy item_personalization_line)
 *
 * InvMastListItemLegacyPersonalizationItemItemOptionsHdr: The option group offered
 * Field `itemOptionsHdr` of InvMastListItemLegacyPersonalizationItem
 *   itemOptionsHdrUid: int — Option group ID
 *   name: string|null — Option group name
 *   label: string|null — Label shown to the customer
 *   description: string|null — Option group description
 *   display: int|null — Display mode
 *   size: float|null — Size
 *   dateLastModified: string|null — Date the record was last changed
 *   alias: string|null — Alias
 *
 * InvMastListItemLegacyPersonalizationItemItemPersonalizationLinesItem: One option offered for an
 * item personalization (legacy item_personalization_line)
 * Field `itemPersonalizationLines` of InvMastListItemLegacyPersonalizationItem
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
 *       InvMastListItemLegacyPersonalizationItemItemPersonalizationLinesItemItemOptionsLine — The
 *       option offered
 *
 * InvMastListItemLegacyPersonalizationItemItemPersonalizationLinesItemItemOptionsLine: The option
 * offered
 * Field `itemOptionsLine` of InvMastListItemLegacyPersonalizationItemItemPersonalizationLinesItem
 *   itemOptionsLineUid: int — Option ID
 *   itemOptionsHdrUid: int — Option group the option belongs to
 *   name: string|null — Option name
 *   ordering: int|null — Sort position
 *   size: float|null — Size
 *   dateLastModified: string|null — Date the record was last changed
 *
 * InvMastListItemAttributesItem: One active attribute value on an item
 * (ItemAttributeValueHelper::listDocByInvMastUid)
 * Field `attributes` of InvMastListItem
 *   attributeName: string|null — Attribute description
 *   attributeValue: string|null — The item's value for the attribute
 *
 * InvMastStockGetData: Stock by location and per company
 * Returned by: $api->items->invMast->getStock($invMastUid)
 * Field `stock` of InvMastListItem
 *   stockData: list<InvMastStockGetDataStockDataItem> — Stock at each location
 *     each item: InvMastStockGetDataStockDataItem — An item's stock at one location
 *         (InvLocHelper::listStockByInvMastUid)
 *   companySummary: array<string, float> — Selling-unit quantity available per company ID, vendor
 *       stock included
 *     map of float
 *
 * InvMastStockGetDataStockDataItem: An item's stock at one location
 * (InvLocHelper::listStockByInvMastUid)
 * Field `stockData` of InvMastStockGetData
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
 * InvMastListItemInvMastTextItem: One Prophet 21 item text block, present only on sites with a
 * p21_pim config
 * Field `invMastText` of InvMastListItem
 *   sequenceNo: int — Display order
 *   displayOnWebFlag: string — Y when the text displays on the web
 *   textTypeCd: int — Prophet 21 text type code
 *   textTypeDesc: string|null — Text type description; null when the code cannot be resolved
 *   webDisplayTypeUid: int — Web display type ID
 *   webDisplayTypeId: string — Web display type code
 *   webDisplayTypeDesc: string — Web display type description
 *   textValue: string — The text
 *
 * InvMastListItemLanguagesItem: An item description in another language (items inv_mast_language)
 * Field `languages` of InvMastListItem
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
 * BrandsFacetsListDataItemsItemBrandFolder: Brandfolder assets (trinitysurfaces only)
 * Field `brandFolder` of InvMastListItem
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
 * CategoriesItemsListDataItemsItemFullSizedSamplesOption1: A sample item linked from an item's
 * user-defined fields (trinitysurfaces)
 * Field `fullSizedSamples` of InvMastListItem
 * Field `swatchSample` of InvMastListItem
 *   itemId: string — Sample item ID
 *   invMastUid: int — Sample item (inv_mast) ID
 *   classId5: string|null — Sample item class 5
 *   samplesApp: bool — True when the 4th character of classId5 is 1
 *
 * InvMastAttributesBulkCreateData: Typed response for `POST /api/inv-mast/attributes/bulk`.
 * Returned by: $api->items->invMast->createAttributesBulk($data)
 *   items: list<InvMastAttributesBulkCreateDataItemsItem> — Each found item with its active
 *       attributes, in request order
 *     each item: InvMastAttributesBulkCreateDataItemsItem — One item's active attributes, backing
 *         an entry of `POST /api/inv-mast/attributes/bulk`.
 *   notFound: list<string> — Requested item IDs with no matching inv_mast row
 *
 * InvMastAttributesBulkCreateDataItemsItem: One item's active attributes, backing an entry of `POST
 * /api/inv-mast/attributes/bulk`.
 * Field `items` of InvMastAttributesBulkCreateData
 *   itemId: string — Item ID (inv_mast.item_id)
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   attributes: list<InvMastAttributesBulkCreateDataItemsItemAttributesItem> — The item's active
 *       attribute name/value pairs
 *     each item: InvMastAttributesBulkCreateDataItemsItemAttributesItem — One attribute name/value
 *         pair on an item, same shape as the item doc's attributes[].
 *
 * InvMastAttributesBulkCreateDataItemsItemAttributesItem: One attribute name/value pair on an item,
 * same shape as the item doc's attributes[].
 * Field `attributes` of InvMastAttributesBulkCreateDataItemsItem
 *   attributeName: string — Attribute name
 *   attributeValue: string|null — Attribute value on the item
 *
 * InvMastAttributesBulkCreateBody: Look up the active attributes of many items by item ID in one
 * call
 * Request body of: $api->items->invMast->createAttributesBulk($data)
 *   itemIds: list<string> — Item IDs (inv_mast.item_id) to look up: 1 to 1000 JSON strings,
 *       anything else returns 400
 *
 * InvMastLookupGetItem: One item matched by a quick lookup
 * Returned by: $api->items->invMast->getLookup()
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   itemId: string — Item code
 *   itemDesc: string|null — Item description
 *
 * InvMastGetData:
 * Returned by: $api->items->invMast->get($invMastUid)
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
 * InvMastAlternateCodeListItem: One alternate code of an item, as AlternateCodeHelper::generateDoc
 * builds it
 * Returned by: $api->items->invMast->listAlternateCode($invMastUid)
 *   alternateCode: string — The alternate code
 *   deleteFlag: string|null — Prophet 21 delete flag (Y = deleted, N = active)
 *   dateCreated: AttributeGroupsAttributesListItemDateCreated|null — When the row was created (raw
 *       PHP DateTime object)
 *   dateLastModified: AttributeGroupsAttributesListItemDateCreated|null — When the row last changed
 *       (raw PHP DateTime object)
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   alternateCodeDesc: string|null — Alternate code description
 *   alternateCodeUid: int — Alternate code ID
 *   sourceTypeCd: int — Prophet 21 source type code of the alternate code
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *
 * AttributeGroupsAttributesListItemDateCreated: When the row was created (raw PHP DateTime object)
 * Field `dateCreated` of InvMastAlternateCodeListItem
 * Field `dateLastModified` of InvMastAlternateCodeListItem
 * Field `dateCreated` of InvMastLocationsBinsListItem
 * Field `dateLastModified` of InvMastLocationsBinsListItem
 *   date: string — Date and time (Y-m-d H:i:s.u)
 *   timezone_type: int — PHP timezone type (3 = named timezone)
 *   timezone: string — Timezone name, e.g. UTC
 *
 * InvMastAttributesListItem: One attribute value on an item: the item_attribute_value row plus the
 * attribute name and code
 * Returned by: $api->items->invMast->listAttributes($invMastUid)
 * Returned by: $api->items->invMast->listAttributesValues($invMastUid, $attributeUid)
 *   itemAttributeValueUid: int — Item attribute value ID
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   attributeUid: int — Attribute ID (attribute.attribute_uid)
 *   attributeValue: string|null — The value text on this item
 *   dateCreated: string — When the row was created (Y-m-d H:i:s)
 *   createdBy: string — User who created the row
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s)
 *   lastMaintainedBy: string — User who last changed the row
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   processCd: int — Process code: workflow state of the row
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   attributeValueUid: int — Attribute value ID (attribute_value.attribute_value_uid); 0 when the
 *       value is free text
 *   onlineCd: int — Online code: 704 when shown on the website
 *   attributeDesc: string|null — Attribute name (attribute.attribute_desc)
 *   attributeId: string — Attribute code (attribute.attribute_id)
 *
 * InvMastAttributesCreateData:
 * Returned by: $api->items->invMast->createAttributes($invMastUid, $data)
 * Returned by: $api->items->invMast->createAttributesValues($invMastUid, $attributeUid, $data)
 * Returned by:
 * $api->items->invMast->updateAttributesValues($invMastUid, $attributeUid, $attributeValueUid, $data)
 * Returned by:
 * $api->items->invMast->deleteAttributesValues($invMastUid, $attributeUid, $attributeValueUid)
 *   itemAttributeValueUid: int — Item attribute value ID
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   attributeUid: int — Attribute ID (attribute.attribute_uid)
 *   attributeValue: string|null — The value text on this item (max 255 chars)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   createdBy: string — User who created the row (max 255 chars)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   lastMaintainedBy: string — User who last changed the row (max 255 chars)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   processCd: int — Process code: workflow state of the row
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   attributeValueUid: int — Attribute value ID (attribute_value.attribute_value_uid); 0 when the
 *       value is free text
 *   onlineCd: int — Online code: 704 when shown on the website
 *
 * InvMastAttributesCreateBody: Set an attribute value on an item (the item comes from the path),
 * creating the attribute and value when new
 * Request body of: $api->items->invMast->createAttributes($invMastUid, $data)
 *   attributeName: string|null — Attribute name (e.g. Color); required, MUST be a JSON string
 *   attributeValue: string|null — Value text (e.g. Red); required, MUST be a JSON string
 *   attributeUid?: int|null — Attribute ID (attribute.attribute_uid); when set, used instead of
 *       looking the attribute up by attributeName
 *
 * InvMastAttributesValuesCreateBody: Set a value of the path attribute on the path item
 * Request body of: $api->items->invMast->createAttributesValues($invMastUid, $attributeUid, $data)
 *   attributeValue: string|null — Value text (e.g. Red); required, MUST be a JSON string
 *
 * InvMastAttributesValuesUpdateBody: Change the status of an item attribute value
 * Request body of:
 * $api->items->invMast->updateAttributesValues($invMastUid, $attributeUid, $attributeValueUid, $data)
 *   statusCd: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted); required, MUST
 *       be a JSON integer
 *
 * InvMastFaqListItem:
 * Returned by: $api->items->invMast->listFaq($invMastUid)
 * Returned by: $api->items->invMast->getFaq($invMastUid, $invMastFaqUid)
 * Returned by: $api->items->invMast->updateFaq($invMastUid, $invMastFaqUid, $data)
 * Returned by: $api->items->invMast->deleteFaq($invMastUid, $invMastFaqUid)
 *   invMastFaqUid: int — Item FAQ ID
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   question: string — The question (max 255 chars)
 *   answer: string — The published answer (max 65535 chars)
 *   generatedAnswer: string — The machine-generated answer (max 65535 chars)
 *   sourceCount: int — Number of sources used to generate the answer
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code: workflow state of the row
 *   relatedQuestionsUid: int — ID of a related FAQ entry
 *   generateCd: int — Generate answer
 *   extraPrompt: string — Extra instructions used when generating the answer (max 65535 chars)
 *   accurateFlag: string — Y/N flag: whether the answer was reviewed as accurate (max 1 chars)
 *   qualityScore: float — Quality score of the generated answer
 *
 * InvMastFaqUpdateBody: Change an item FAQ entry; every field is optional and an absent field keeps
 * its value
 * Request body of: $api->items->invMast->updateFaq($invMastUid, $invMastFaqUid, $data)
 *   answer?: string|null — The published answer
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code: workflow state of the row
 *   generateCd?: int|null — Generate code: set to request a new machine-generated answer
 *   extraPrompt?: string|null — Extra instructions used when generating the answer
 *   accurateFlag?: string|null — Y/N: whether the answer was reviewed as accurate
 *   qualityScore?: float|null — Quality score of the answer
 *
 * InvMastInvAccessoryListItem: One accessory of an item, with the accessory item's descriptions,
 * classes, units and images
 * Returned by: $api->items->invMast->listInvAccessory($invMastUid)
 *   invAccessoryUid: int — Item accessory ID
 *   parentInvMastUid: int — Item the accessory belongs to (inv_mast.inv_mast_uid)
 *   childInvMastUid: int — The accessory item (inv_mast.inv_mast_uid)
 *   childItemId: string — Accessory item code; empty when unknown
 *   childItemDesc: string — Accessory item description; empty when unknown
 *   childDisplayDesc: string — Accessory first web-displayed category description; empty when none
 *   childDefaultSellingUnit: string — Accessory default selling unit; empty when unknown
 *   classId1: string — Accessory item class 1; empty when unset
 *   classId2: string — Accessory item class 2; empty when unset
 *   classId3: string — Accessory item class 3; empty when unset
 *   classId4: string — Accessory item class 4; empty when unset
 *   classId5: string — Accessory item class 5; empty when unset
 *   childItemUom: list<CategoriesItemsListDataItemsItemItemUomItem> — Accessory units of measure
 *       (not deleted)
 *     each item: CategoriesItemsListDataItemsItemItemUomItem — One unit of measure an item is sold
 *         in
 *   childImages: list<string> — Accessory image URLs or paths
 *
 * InvMastInvSubListItem: One substitute of an item, with the substitute item's descriptions,
 * classes, units and images
 * Returned by: $api->items->invMast->listInvSub($invMastUid)
 *   invMastUid: int — Item the substitute is for (inv_mast.inv_mast_uid)
 *   subInvMastUid: int — The substitute item (inv_mast.inv_mast_uid)
 *   subInvMastItemId: string — Substitute item code; empty when unknown
 *   subInvMastItemDesc: string — Substitute item description; empty when unknown
 *   subInvMastDisplayDesc: string — Substitute first web-displayed category description; empty when
 *       none
 *   defaultSellingUnit: string — Substitute default selling unit; empty when unknown
 *   classId1: string — Substitute item class 1; empty when unset
 *   classId2: string — Substitute item class 2; empty when unset
 *   classId3: string — Substitute item class 3; empty when unset
 *   classId4: string — Substitute item class 4; empty when unset
 *   classId5: string — Substitute item class 5; empty when unset
 *   itemUom: list<CategoriesItemsListDataItemsItemItemUomItem> — Substitute units of measure (not
 *       deleted)
 *     each item: CategoriesItemsListDataItemsItemItemUomItem — One unit of measure an item is sold
 *         in
 *   images: list<string> — Substitute image URLs or paths
 *
 * InvMastLocationsBinsListItem: One bin of an item at a location, as InvBinHelper::generateDoc
 * builds it
 * Returned by: $api->items->invMast->listLocationsBins($invMastUid, $locationId)
 * Returned by: $api->items->invMast->getLocationsBins($invMastUid, $locationId, $bin)
 *   invBinUid: int — Item bin ID
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   itemId: string — Item code (inv_mast.item_id)
 *   locationId: float — Prophet 21 location ID
 *   bin: string — Bin
 *   quantity: float — Quantity in the bin
 *   dateCreated: AttributeGroupsAttributesListItemDateCreated|null — When the row was created (raw
 *       PHP DateTime object)
 *   dateLastModified: AttributeGroupsAttributesListItemDateCreated|null — When the row last changed
 *       (raw PHP DateTime object)
 *   lastMaintainedBy: string — User who last changed the row
 *
 * InvMastSimilarListItem: One item similar to an item, from its inv_mast_similarity lines with a
 * positive z-score
 * Returned by: $api->items->invMast->listSimilar($invMastUid)
 *   invMastUid: int — Similar item ID (inv_mast.inv_mast_uid)
 *   itemId: string — Item code; empty when unknown
 *   itemDesc: string — Item description; empty when unknown
 *   displayDesc: string — First web-displayed category description; empty when none
 *   defaultSellingUnit: string — Default selling unit; empty when unknown
 *   classId1: string — Item class 1; empty when unset
 *   classId2: string — Item class 2; empty when unset
 *   classId3: string — Item class 3; empty when unset
 *   classId4: string — Item class 4; empty when unset
 *   classId5: string — Item class 5; empty when unset
 *   itemUom: list<CategoriesItemsListDataItemsItemItemUomItem> — Units of measure (not deleted)
 *     each item: CategoriesItemsListDataItemsItemItemUomItem — One unit of measure an item is sold
 *         in
 *   score: float|null — Similarity score
 *   zScore: float — Standard score of the similarity among the item's similar items
 *   images: list<string> — Image URLs or paths
 *
 * @phpstan-type InvMastListItem array{invMastUid: int, itemId: string, itemDesc: string|null, displayDesc: string|null, extendedDesc: string|null, shortCode: string|null, defaultSellingUnit: string|null, defaultPurchasingUnit: string|null, deleteFlag: string, onlineCd: int, statusCd: int, baseUnit: string, vndrStock: int|null, classId1: string|null, classId2: string|null, classId3: string|null, classId4: string|null, classId5: string|null, serialized: string, trackLots: string, trackingPattern: string, defaultProductGroup: string|null, defaultSalesDiscountGroup: string|null, defaultPurchaseDiscGroup: string|null, upcOrEan: string|null, upcOrEanId: string|null, weight: float|null, length: float|null, width: float|null, height: float|null, parkerProductCd: string|null, brandName: string|null, manufacturerName: string|null, inventorySupplier: list<CategoriesItemsListDataItemsItemInventorySupplierItem>, primarySupplierName: string|null, itemUom: list<CategoriesItemsListDataItemsItemItemUomItem>, alternateCodes: list<string>, legacyTags: list<string>, legacyPersonalization: list<InvMastListItemLegacyPersonalizationItem>, categoryList: list<int>, attributes: list<InvMastListItemAttributesItem>, images: list<string>, stock: InvMastStockGetData, categoryDisplayDescriptions: array<string, string>, userDefined: array<string, mixed>|array{}, invMastText: list<InvMastListItemInvMastTextItem>, languages: list<InvMastListItemLanguagesItem>, brandFolder?: BrandsFacetsListDataItemsItemBrandFolder|null, docCatTrees?: list<list<int>>|null, productCollection?: string|null, tsItemCategoryUid?: int|null|false, ttItemCategoryUid?: int|null|false, trim?: bool|null, fullSizedSamples?: CategoriesItemsListDataItemsItemFullSizedSamplesOption1|null|false, swatchSample?: CategoriesItemsListDataItemsItemFullSizedSamplesOption1|null|false, itemVariantHdrUid?: int|null, price1?: float|null, price2?: float|null, price3?: float|null, price4?: float|null, price5?: float|null, price6?: float|null, price7?: float|null, price8?: float|null, price9?: float|null, price10?: float|null}
 * @phpstan-type CategoriesItemsListDataItemsItemInventorySupplierItem array{inventorySupplierUid: int, invMastUid: int, supplierId: float, upcCode: string, checkDigit: string, upc: string, supplierPartNo: string|null, primarySupplierFlag: string|null, listPrice: float|null}
 * @phpstan-type CategoriesItemsListDataItemsItemItemUomItem array{unitOfMeasure: string, unitSize: float}
 * @phpstan-type InvMastListItemLegacyPersonalizationItem array{itemPersonalizationHdrUid: int, invMastUid: int, itemOptionsHdrUid: int, ordering: int|null, defaultItemOptionsLineUid: int|null, required: int|null, dateLastModified: string|null, dateCreated: string|null, updateCd: int, statusCd: int, processCd: int, itemOptionsHdr: InvMastListItemLegacyPersonalizationItemItemOptionsHdr, itemPersonalizationLines: list<InvMastListItemLegacyPersonalizationItemItemPersonalizationLinesItem>}
 * @phpstan-type InvMastListItemLegacyPersonalizationItemItemOptionsHdr array{itemOptionsHdrUid: int, name: string|null, label: string|null, description: string|null, display: int|null, size: float|null, dateLastModified: string|null, alias: string|null}
 * @phpstan-type InvMastListItemLegacyPersonalizationItemItemPersonalizationLinesItem array{itemPersonalizationLineUid: int, itemPersonalizationHdrUid: int, itemOptionsLineUid: int, active: int|null, def: int|null, adjustmentInvMastUid: int|null, dateLastModified: string|null, dateCreated: string|null, updateCd: int, statusCd: int, processCd: int, itemOptionsLine: InvMastListItemLegacyPersonalizationItemItemPersonalizationLinesItemItemOptionsLine}
 * @phpstan-type InvMastListItemLegacyPersonalizationItemItemPersonalizationLinesItemItemOptionsLine array{itemOptionsLineUid: int, itemOptionsHdrUid: int, name: string|null, ordering: int|null, size: float|null, dateLastModified: string|null}
 * @phpstan-type InvMastListItemAttributesItem array{attributeName: string|null, attributeValue: string|null}
 * @phpstan-type InvMastStockGetData array{stockData: list<InvMastStockGetDataStockDataItem>, companySummary: array<string, float>}
 * @phpstan-type InvMastStockGetDataStockDataItem array{locationId: float, companyId: string, qtyOnHand: float, qtyAllocated: float, stockable: string|null, sellable: string|null, discontinued: string, unallocated: float, nextDueInPoDate: string|null, qtyBackordered: float|null, primaryBin: string|null, qtyFrozen: float, qtyQuarantined: float, qtyNonPickable: float, qtyAvailable: float, orderQuantity: float|null, productGroupId: string|null, baseUnit: string, baseUnitSize: float, defaultSellingUnit: string|null, defaultSellingUnitSize: float, divisor: float, calcQtyOnHand: float, calcQtyAllocated: float, calcQtyAvailable: float, locationName: string}
 * @phpstan-type InvMastListItemInvMastTextItem array{sequenceNo: int, displayOnWebFlag: string, textTypeCd: int, textTypeDesc: string|null, webDisplayTypeUid: int, webDisplayTypeId: string, webDisplayTypeDesc: string, textValue: string}
 * @phpstan-type InvMastListItemLanguagesItem array{invMastLanguageUid: int, invMastUid: int, languageId: string|null, languageItemDesc: string|null, itemDescDeleteFlag: string, dateCreated: string, createdBy: string, dateLastModified: string, lastMaintainedBy: string, languageExtendedDesc: string|null, updateCd: int}
 * @phpstan-type BrandsFacetsListDataItemsItemBrandFolder array{assets?: list<BrandsFacetsListDataItemsItemBrandFolderAssetsItem>|null}
 * @phpstan-type BrandsFacetsListDataItemsItemBrandFolderAssetsItem array{id: string, name: string|null, attachmentName: string|null, cdnLink: string, layout: string}
 * @phpstan-type CategoriesItemsListDataItemsItemFullSizedSamplesOption1 array{itemId: string, invMastUid: int, classId5: string|null, samplesApp: bool}
 * @phpstan-type InvMastAttributesBulkCreateData array{items: list<InvMastAttributesBulkCreateDataItemsItem>, notFound: list<string>}
 * @phpstan-type InvMastAttributesBulkCreateDataItemsItem array{itemId: string, invMastUid: int, attributes: list<InvMastAttributesBulkCreateDataItemsItemAttributesItem>}
 * @phpstan-type InvMastAttributesBulkCreateDataItemsItemAttributesItem array{attributeName: string, attributeValue: string|null}
 * @phpstan-type InvMastAttributesBulkCreateBody array{itemIds: list<string>}
 * @phpstan-type InvMastLookupGetItem array{invMastUid: int, itemId: string, itemDesc: string|null}
 * @phpstan-type InvMastGetData array{invMastUid: int, itemId: string, itemDesc: string|null, deleteFlag: string, weight: float|null, dateCreated: string, dateLastModified: string, inactive: string, classId1: string|null, classId2: string|null, classId3: string|null, classId4: string|null, classId5: string|null, upcOrEan: string|null, upcOrEanId: string|null, serialized: string, productType: string, dLength: float|null, shortCode: string|null, price1: float|null, price2: float|null, price3: float|null, price4: float|null, price5: float|null, price6: float|null, price7: float|null, price8: float|null, price9: float|null, price10: float|null, extendedDesc: string|null, defaultSellingUnit: string|null, hazMatFlag: string, keywords: string|null, disposition: string|null, baseUnit: string, restrictedFlag: string|null, parkerProductCd: string|null, parkerDivisionCd: string|null, commodityCode: string|null, unspscCode: string|null, dciCode: string|null, epaCertReqFlag: string|null, length: float|null, width: float|null, height: float|null, itemNotes: string|null, vndrStock: int|null, manufacturerName: string|null, brandName: string|null, partNumber: string|null, updateCd: int, defaultProductGroup: string|null, upcOrEanPrefix: string|null, upcOrEanItem: string|null, attributeGroupUid: int|null, defaultPriceFamilyUid: int|null, purchasePricingUnit: string|null, purchasePricingUnitSize: float|null, salesPricingUnit: string|null, salesPricingUnitSize: float|null, defaultPurchasingUnit: string|null, statusCd: int, onlineCd: int, processCd: int, eccEnabledFlag: string|null, trackLots: string, defaultSalesDiscountGroup: string|null, defaultPurchaseDiscGroup: string|null, qtySoldPast12Months: int, orderInPast12Months: int}
 * @phpstan-type InvMastAlternateCodeListItem array{alternateCode: string, deleteFlag: string|null, dateCreated: AttributeGroupsAttributesListItemDateCreated|null, dateLastModified: AttributeGroupsAttributesListItemDateCreated|null, invMastUid: int, alternateCodeDesc: string|null, alternateCodeUid: int, sourceTypeCd: int, updateCd: int}
 * @phpstan-type AttributeGroupsAttributesListItemDateCreated array{date: string, timezone_type: int, timezone: string}
 * @phpstan-type InvMastAttributesListItem array{itemAttributeValueUid: int, invMastUid: int, attributeUid: int, attributeValue: string|null, dateCreated: string, createdBy: string, dateLastModified: string, lastMaintainedBy: string, updateCd: int, processCd: int, statusCd: int, attributeValueUid: int, onlineCd: int, attributeDesc: string|null, attributeId: string}
 * @phpstan-type InvMastAttributesCreateData array{itemAttributeValueUid: int, invMastUid: int, attributeUid: int, attributeValue: string|null, dateCreated: string, createdBy: string, dateLastModified: string, lastMaintainedBy: string, updateCd: int, processCd: int, statusCd: int, attributeValueUid: int, onlineCd: int}
 * @phpstan-type InvMastAttributesCreateBody array{attributeName: string|null, attributeValue: string|null, attributeUid?: int|null}
 * @phpstan-type InvMastAttributesValuesCreateBody array{attributeValue: string|null}
 * @phpstan-type InvMastAttributesValuesUpdateBody array{statusCd: int|null}
 * @phpstan-type InvMastFaqListItem array{invMastFaqUid: int, invMastUid: int, question: string, answer: string, generatedAnswer: string, sourceCount: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, relatedQuestionsUid: int, generateCd: int, extraPrompt: string, accurateFlag: string, qualityScore: float}
 * @phpstan-type InvMastFaqUpdateBody array{answer?: string|null, statusCd?: int|null, processCd?: int|null, generateCd?: int|null, extraPrompt?: string|null, accurateFlag?: string|null, qualityScore?: float|null}
 * @phpstan-type InvMastInvAccessoryListItem array{invAccessoryUid: int, parentInvMastUid: int, childInvMastUid: int, childItemId: string, childItemDesc: string, childDisplayDesc: string, childDefaultSellingUnit: string, classId1: string, classId2: string, classId3: string, classId4: string, classId5: string, childItemUom: list<CategoriesItemsListDataItemsItemItemUomItem>, childImages: list<string>}
 * @phpstan-type InvMastInvSubListItem array{invMastUid: int, subInvMastUid: int, subInvMastItemId: string, subInvMastItemDesc: string, subInvMastDisplayDesc: string, defaultSellingUnit: string, classId1: string, classId2: string, classId3: string, classId4: string, classId5: string, itemUom: list<CategoriesItemsListDataItemsItemItemUomItem>, images: list<string>}
 * @phpstan-type InvMastLocationsBinsListItem array{invBinUid: int, invMastUid: int, itemId: string, locationId: float, bin: string, quantity: float, dateCreated: AttributeGroupsAttributesListItemDateCreated|null, dateLastModified: AttributeGroupsAttributesListItemDateCreated|null, lastMaintainedBy: string}
 * @phpstan-type InvMastSimilarListItem array{invMastUid: int, itemId: string, itemDesc: string, displayDesc: string, defaultSellingUnit: string, classId1: string, classId2: string, classId3: string, classId4: string, classId5: string, itemUom: list<CategoriesItemsListDataItemsItemItemUomItem>, score: float|null, zScore: float, images: list<string>}
 */
final class InvMastResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast
     *
     * List InvMast
     * Call: $api->items->invMast->list()
     *
     * Response data, each item: The full item doc (InvMastHelper::generateDoc)
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an inv_mast column.
     *
     * GET https://items.augur-api.com/inv-mast
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1inv-mast/get
     *
     * Query params ($params; `?` = optional):
     *   itemCategoryUid?: int — Item category ID (item_category.item_category_uid); returns only
     *       items assigned to that category
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   onlineCd?: int — Online Code (online_cd) [(704)|(705)|(700)]
     *   orderBy?: string — One inv_mast column|ASC or |DESC; any other value returns 400 (Default:
     *       inv_mast_uid|ASC)
     *   prefix?: string — ItemId Prefix
     *   q?: string — Search query for items
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastListItem (fields listed on the class)
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
     * POST /inv-mast/attributes/bulk
     *
     * Bulk item attributes
     * Call: $api->items->invMast->createAttributesBulk($data)
     *
     * List active attributes for up to 1000 items by item ID
     *
     * Request body: Look up the active attributes of many items by item ID in one call
     * Response data: Typed response for `POST /api/inv-mast/attributes/bulk`.
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or itemIds must be an array of 1 to 1000
     *       item IDs. Or itemIds must contain only strings. Or A required body field is missing or
     *       has the wrong type.
     *
     * POST https://items.augur-api.com/inv-mast/attributes/bulk
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1attributes~1bulk/post
     *
     * Request body ($data): InvMastAttributesBulkCreateBody (fields listed on the class)
     *
     * Response data type: InvMastAttributesBulkCreateData (fields listed on the class)
     *
     * @param InvMastAttributesBulkCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributesBulk(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/attributes/bulk', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/lookup
     *
     * Lookup InvMast by search query
     * Call: $api->items->invMast->getLookup()
     *
     * Response data, each item: One item matched by a quick lookup
     *
     * Errors:
     *   400: Search query parameter is required; or invalid orderBy: MUST be one field|ASC or
     *       field|DESC, the field an inv_mast column.
     *
     * GET https://items.augur-api.com/inv-mast/lookup
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1lookup/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   onlineCd?: int — Online Code (online_cd) [(704)|(705)|(700)]
     *   orderBy?: string — Order by field and direction (e.g., item_id|ASC)
     *   q: string — Search query for item lookup
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastLookupGetItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}
     *
     * get the inv_mast details
     * Call: $api->items->invMast->get($invMastUid)
     *
     * Errors:
     *   404: Item not found.
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: InvMastGetData (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/alternate-code
     *
     * List alternate codes
     * Call: $api->items->invMast->listAlternateCode($invMastUid)
     *
     * Response data, each item: One alternate code of an item, as AlternateCodeHelper::generateDoc
     * builds it
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an alternate_code
     *       column.
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}/alternate-code
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1alternate-code/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: alternate_code_uid|ASC)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastAlternateCodeListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listAlternateCode(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/alternate-code',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/attributes
     *
     * List item attributes
     * Call: $api->items->invMast->listAttributes($invMastUid)
     *
     * Response data, each item: One attribute value on an item: the item_attribute_value row plus
     * the attribute name and code
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an
     *       item_attribute_value column.
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}/attributes
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1attributes/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Record number to start from
     *   orderBy?: string — Order By (Default: item_attribute_value_uid|ASC)
     *   q?: string — Filter attribute values
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastAttributesListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listAttributes(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/attributes',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /inv-mast/{invMastUid}/attributes
     *
     * Create new attribute value for item
     * Call: $api->items->invMast->createAttributes($invMastUid, $data)
     *
     * Create a new attribute value for an item
     *
     * Request body: Set an attribute value on an item (the item comes from the path), creating the
     * attribute and value when new
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or Invalid invMastUid. Or attributeName is
     *       required and must be a string. Or attributeValue is required and must be a string.
     *
     * POST https://items.augur-api.com/inv-mast/{invMastUid}/attributes
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1attributes/post
     *
     * Request body ($data): InvMastAttributesCreateBody (fields listed on the class)
     *
     * Response data type: InvMastAttributesCreateData (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param InvMastAttributesCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributes(int $invMastUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invMastUid}/attributes',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/attributes/{attributeUid}/values
     *
     * List values for a specific item attribute
     * Call: $api->items->invMast->listAttributesValues($invMastUid, $attributeUid)
     *
     * Response data, each item: One attribute value on an item: the item_attribute_value row plus
     * the attribute name and code
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an
     *       item_attribute_value column.
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}/attributes/{attributeUid}/values
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1attributes~1{attributeUid}~1values/get
     *
     * Query params ($params; `?` = optional):
     *   attributeValueUid?: int — item_attribute_value.attribute_value_uid
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: item_attribute_value_uid|ASC)
     *   q?: string — Search Query
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastAttributesListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param int $attributeUid item_attribute.attribute_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listAttributesValues(int $invMastUid, int $attributeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/attributes/{attributeUid}/values',
            $params,
            ['invMastUid' => (string) $invMastUid, 'attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /inv-mast/{invMastUid}/attributes/{attributeUid}/values
     *
     * Create new attribute value for item using specific attribute
     * Call: $api->items->invMast->createAttributesValues($invMastUid, $attributeUid, $data)
     *
     * Create a new attribute value for an item using a specific attribute
     *
     * Request body: Set a value of the path attribute on the path item
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or attributeValue is required and must be a
     *       string. Or Invalid invMastUid. Or Invalid attributeUid.
     *
     * POST https://items.augur-api.com/inv-mast/{invMastUid}/attributes/{attributeUid}/values
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1attributes~1{attributeUid}~1values/post
     *
     * Request body ($data): InvMastAttributesValuesCreateBody (fields listed on the class)
     *
     * Response data type: InvMastAttributesCreateData (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param int $attributeUid item_attribute.attribute_uid
     * @param InvMastAttributesValuesCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributesValues(int $invMastUid, int $attributeUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invMastUid}/attributes/{attributeUid}/values',
            $data,
            ['invMastUid' => (string) $invMastUid, 'attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /inv-mast/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}
     *
     * Soft delete an attribute value
     * Call:
     * $api->items->invMast->deleteAttributesValues($invMastUid, $attributeUid, $attributeValueUid)
     *
     * Errors:
     *   404: Invalid invMastUid. Or Invalid attributeUid. Or Invalid attributeValueUid; or item
     *       attribute value not found.
     *
     * DELETE
     * https://items.augur-api.com/inv-mast/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1attributes~1{attributeUid}~1values~1{attributeValueUid}/delete
     *
     * Response data type: InvMastAttributesCreateData (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param int $attributeUid item_attribute.attribute_uid
     * @param int $attributeValueUid item_attribute_value.attribute_value_uid
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteAttributesValues(int $invMastUid, int $attributeUid, int $attributeValueUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}',
            ['invMastUid' => (string) $invMastUid, 'attributeUid' => (string) $attributeUid, 'attributeValueUid' => (string) $attributeValueUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-mast/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}
     *
     * Update attribute value status
     * Call:
     * $api->items->invMast->updateAttributesValues($invMastUid, $attributeUid, $attributeValueUid, $data)
     *
     * Update the status of an attribute value
     *
     * Request body: Change the status of an item attribute value
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or statusCd is required and must be an
     *       integer.
     *   404: Invalid invMastUid. Or Invalid attributeUid. Or Invalid attributeValueUid. Or Item
     *       attribute value not found.
     *
     * PUT
     * https://items.augur-api.com/inv-mast/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1attributes~1{attributeUid}~1values~1{attributeValueUid}/put
     *
     * Request body ($data): InvMastAttributesValuesUpdateBody (fields listed on the class)
     *
     * Response data type: InvMastAttributesCreateData (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param int $attributeUid item_attribute.attribute_uid
     * @param int $attributeValueUid item_attribute_value.attribute_value_uid
     * @param InvMastAttributesValuesUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateAttributesValues(int $invMastUid, int $attributeUid, int $attributeValueUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}',
            $data,
            ['invMastUid' => (string) $invMastUid, 'attributeUid' => (string) $attributeUid, 'attributeValueUid' => (string) $attributeValueUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/doc
     *
     * get the inv_mast document
     * Call: $api->items->invMast->listDoc($invMastUid)
     *
     * Response data: The full item doc (InvMastHelper::generateDoc)
     *
     * Errors:
     *   400: invMastUid is 0 and itemId is missing or blank.
     *   404: No item (inv_mast) with this invMastUid, or no item with this itemId when invMastUid
     *       is 0. Deleted and offline items still return 200.
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}/doc
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1doc/get
     *
     * Query params ($params; `?` = optional):
     *   includePricing?: string — Include invMast price 1-10 [Y|N] (Default: N)
     *   itemId?: string — Item ID to look up when invMastUid is 0; required in that case, ignored
     *       otherwise
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: InvMastListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDoc(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/doc',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /inv-mast/{invMastUid}/doc
     * Call: $api->items->invMast->getDoc($invMastUid)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $invMastUid, array $params = []): BaseResponse
    {
        return $this->listDoc($invMastUid, $params);
    }

    /**
     * GET /inv-mast/{invMastUid}/faq
     *
     * List Item FAQs
     * Call: $api->items->invMast->listFaq($invMastUid)
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an inv_mast_faq
     *       column.
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}/faq
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1faq/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: inv_mast_faq_uid|ASC)
     *   q?: string — Search Query
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastFaqListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listFaq(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/faq',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /inv-mast/{invMastUid}/faq/{invMastFaqUid}
     *
     * DELETE Item FAQ
     * Call: $api->items->invMast->deleteFaq($invMastUid, $invMastFaqUid)
     *
     * Errors:
     *   404: No record with this ID.
     *
     * DELETE https://items.augur-api.com/inv-mast/{invMastUid}/faq/{invMastFaqUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1faq~1{invMastFaqUid}/delete
     *
     * Response data type: InvMastFaqListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param int $invMastFaqUid Item FAQ ID (inv_mast_faq.inv_mast_faq_uid)
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteFaq(int $invMastUid, int $invMastFaqUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastUid}/faq/{invMastFaqUid}',
            ['invMastUid' => (string) $invMastUid, 'invMastFaqUid' => (string) $invMastFaqUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/faq/{invMastFaqUid}
     *
     * Get Item FAQ Details
     * Call: $api->items->invMast->getFaq($invMastUid, $invMastFaqUid)
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}/faq/{invMastFaqUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1faq~1{invMastFaqUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: InvMastFaqListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param int $invMastFaqUid Item FAQ ID (inv_mast_faq.inv_mast_faq_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getFaq(int $invMastUid, int $invMastFaqUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/faq/{invMastFaqUid}',
            $params,
            ['invMastUid' => (string) $invMastUid, 'invMastFaqUid' => (string) $invMastFaqUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-mast/{invMastUid}/faq/{invMastFaqUid}
     *
     * Update Item FAQ
     * Call: $api->items->invMast->updateFaq($invMastUid, $invMastFaqUid, $data)
     *
     * Request body: Change an item FAQ entry; every field is optional and an absent field keeps its
     * value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No record with this ID.
     *
     * PUT https://items.augur-api.com/inv-mast/{invMastUid}/faq/{invMastFaqUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1faq~1{invMastFaqUid}/put
     *
     * Request body ($data): InvMastFaqUpdateBody (fields listed on the class)
     *
     * Response data type: InvMastFaqListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param int $invMastFaqUid Item FAQ ID (inv_mast_faq.inv_mast_faq_uid)
     * @param InvMastFaqUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateFaq(int $invMastUid, int $invMastFaqUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}/faq/{invMastFaqUid}',
            $data,
            ['invMastUid' => (string) $invMastUid, 'invMastFaqUid' => (string) $invMastFaqUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/inv-accessory
     *
     * List accessory items
     * Call: $api->items->invMast->listInvAccessory($invMastUid)
     *
     * Response data, each item: One accessory of an item, with the accessory item's descriptions,
     * classes, units and images
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an inv_accessory
     *       column.
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}/inv-accessory
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1inv-accessory/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: inv_accessory_uid|ASC)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastInvAccessoryListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listInvAccessory(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/inv-accessory',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/inv-sub
     *
     * List substitute items
     * Call: $api->items->invMast->listInvSub($invMastUid)
     *
     * Response data, each item: One substitute of an item, with the substitute item's descriptions,
     * classes, units and images
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an inv_sub column.
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}/inv-sub
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1inv-sub/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — One inv_sub column|ASC or |DESC; any other value returns 400 (Default:
     *       sub_inv_mast_uid|ASC)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastInvSubListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listInvSub(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/inv-sub',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/locations/{locationId}/bins
     *
     * List bins for a specific location
     * Call: $api->items->invMast->listLocationsBins($invMastUid, $locationId)
     *
     * Response data, each item: One bin of an item at a location, as InvBinHelper::generateDoc
     * builds it
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an inv_bin column.
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}/locations/{locationId}/bins
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1locations~1{locationId}~1bins/get
     *
     * Query params ($params; `?` = optional):
     *   excludeZero?: string — Exclude bins with zero quantity [Y|N], defaults to Y
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: inv_bin_uid|ASC)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastLocationsBinsListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param int $locationId location.location_id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listLocationsBins(int $invMastUid, int $locationId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/locations/{locationId}/bins',
            $params,
            ['invMastUid' => (string) $invMastUid, 'locationId' => (string) $locationId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/locations/{locationId}/bins/{bin}
     *
     * Get a specific bin for an inventory item at a specific location
     * Call: $api->items->invMast->getLocationsBins($invMastUid, $locationId, $bin)
     *
     * Response data: One bin of an item at a location, as InvBinHelper::generateDoc builds it
     *
     * Errors:
     *   404: Item bin not found.
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}/locations/{locationId}/bins/{bin}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1locations~1{locationId}~1bins~1{bin}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: InvMastLocationsBinsListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param int $locationId location.location_id
     * @param string $bin bin identifier
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLocationsBins(int $invMastUid, int $locationId, string $bin, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/locations/{locationId}/bins/{bin}',
            $params,
            ['invMastUid' => (string) $invMastUid, 'locationId' => (string) $locationId, 'bin' => (string) $bin],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/precache
     *
     * Queue item pre-cache
     * Call: $api->items->invMast->listPrecache($invMastUid)
     *
     * Queue a pre-cache rebuild of the item; skipped when one is already running; returns true
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}/precache
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1precache/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: bool
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<bool>
     */
    public function listPrecache(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/precache',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/similar
     *
     * List similar items
     * Call: $api->items->invMast->listSimilar($invMastUid)
     *
     * Response data, each item: One item similar to an item, from its inv_mast_similarity lines
     * with a positive z-score
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}/similar
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1similar/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastSimilarListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listSimilar(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/similar',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/stock
     *
     * get the inv_mast stock
     * Call: $api->items->invMast->getStock($invMastUid)
     *
     * Response data: An item's stock by location plus the available total per company
     * (InvLocHelper::getStockDetails)
     *
     * GET https://items.augur-api.com/inv-mast/{invMastUid}/stock
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1stock/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: InvMastStockGetData (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getStock(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/stock',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
