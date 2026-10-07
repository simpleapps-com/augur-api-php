<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMast resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://legacy.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://legacy.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://legacy.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py legacy
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * InvMastAlsoBoughtListItem: The full item doc (InvMastHelper::generateDoc)
 * Returned by: $api->legacy->invMast->listAlsoBought($invMastUid)
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
 *   inventorySupplier: list<InvMastAlsoBoughtListItemInventorySupplierItem> — The item's suppliers
 *       (not deleted)
 *     each item: InvMastAlsoBoughtListItemInventorySupplierItem — One supplier of an item
 *         (InventorySupplierHelper::generateDoc)
 *   primarySupplierName: string|null — Most common primary supplier across the item's locations
 *   itemUom: list<InvMastAlsoBoughtListItemItemUomItem> — Units of measure (not deleted)
 *     each item: InvMastAlsoBoughtListItemItemUomItem — One unit of measure an item is sold in
 *   alternateCodes: list<string> — Alternate codes
 *   legacyTags: list<string> — Tags from the legacy service
 *   legacyPersonalization: list<InvMastAlsoBoughtListItemLegacyPersonalizationItem> —
 *       Personalizations from the legacy service
 *     each item: InvMastAlsoBoughtListItemLegacyPersonalizationItem — One personalization offered
 *         on an item, with its option group and options (legacy item_personalization_hdr)
 *   categoryList: list<int> — Item category IDs the item is in, ancestors included
 *   attributes: list<InvMastAlsoBoughtListItemAttributesItem> — Active attribute values, in
 *       attribute-group sequence order
 *     each item: InvMastAlsoBoughtListItemAttributesItem — One active attribute value on an item
 *         (ItemAttributeValueHelper::listDocByInvMastUid)
 *   images: list<string> — Image URLs or paths
 *   stock: InvMastAlsoBoughtListItemStock — Stock by location and per company
 *   categoryDisplayDescriptions: array<string, string> — Category display description per item
 *       category ID
 *     map of string
 *   userDefined: array<string, mixed>|array{} — Non-empty user-defined field values, keyed by field
 *       name ([] when empty)
 *   invMastText: list<InvMastAlsoBoughtListItemInvMastTextItem> — Prophet 21 item text blocks
 *       (empty unless the site has a p21_pim config)
 *     each item: InvMastAlsoBoughtListItemInvMastTextItem — One Prophet 21 item text block, present
 *         only on sites with a p21_pim config
 *   languages: list<InvMastAlsoBoughtListItemLanguagesItem> — Descriptions in other languages
 *     each item: InvMastAlsoBoughtListItemLanguagesItem — An item description in another language
 *         (items inv_mast_language)
 *   brandFolder?: InvMastAlsoBoughtListItemBrandFolder|null — Brandfolder assets (trinitysurfaces
 *       only)
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
 *   fullSizedSamples?: InvMastAlsoBoughtListItemFullSizedSamples|null|false — Full-sized sample
 *       item, or false (trinitysurfaces only)
 *     one of:
 *       InvMastAlsoBoughtListItemFullSizedSamples|null — A sample item linked from an item's
 *           user-defined fields (trinitysurfaces)
 *       false
 *   swatchSample?: InvMastAlsoBoughtListItemFullSizedSamples|null|false — Swatch sample item, or
 *       false (trinitysurfaces only)
 *     one of:
 *       InvMastAlsoBoughtListItemFullSizedSamples|null — A sample item linked from an item's
 *           user-defined fields (trinitysurfaces)
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
 * InvMastAlsoBoughtListItemInventorySupplierItem: One supplier of an item
 * (InventorySupplierHelper::generateDoc)
 * Field `inventorySupplier` of InvMastAlsoBoughtListItem
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
 * InvMastAlsoBoughtListItemItemUomItem: One unit of measure an item is sold in
 * Field `itemUom` of InvMastAlsoBoughtListItem
 *   unitOfMeasure: string — Unit of measure code
 *   unitSize: float — Base units per one of this unit
 *
 * InvMastAlsoBoughtListItemLegacyPersonalizationItem: One personalization offered on an item, with
 * its option group and options (legacy item_personalization_hdr)
 * Field `legacyPersonalization` of InvMastAlsoBoughtListItem
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
 *   itemOptionsHdr: InvMastAlsoBoughtListItemLegacyPersonalizationItemItemOptionsHdr — The option
 *       group offered
 *   itemPersonalizationLines:
 *       list<InvMastAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItem> — The
 *       options offered
 *     each item: InvMastAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItem —
 *         One option offered for an item personalization (legacy item_personalization_line)
 *
 * InvMastAlsoBoughtListItemLegacyPersonalizationItemItemOptionsHdr: The option group offered
 * Field `itemOptionsHdr` of InvMastAlsoBoughtListItemLegacyPersonalizationItem
 *   itemOptionsHdrUid: int — Option group ID
 *   name: string|null — Option group name
 *   label: string|null — Label shown to the customer
 *   description: string|null — Option group description
 *   display: int|null — Display mode
 *   size: float|null — Size
 *   dateLastModified: string|null — Date the record was last changed
 *   alias: string|null — Alias
 *
 * InvMastAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItem: One option
 * offered for an item personalization (legacy item_personalization_line)
 * Field `itemPersonalizationLines` of InvMastAlsoBoughtListItemLegacyPersonalizationItem
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
 *       InvMastAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItemItemOptionsLine
 *       — The option offered
 *
 * InvMastAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItemItemOptionsLine:
 * The option offered
 * Field `itemOptionsLine` of
 * InvMastAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItem
 *   itemOptionsLineUid: int — Option ID
 *   itemOptionsHdrUid: int — Option group the option belongs to
 *   name: string|null — Option name
 *   ordering: int|null — Sort position
 *   size: float|null — Size
 *   dateLastModified: string|null — Date the record was last changed
 *
 * InvMastAlsoBoughtListItemAttributesItem: One active attribute value on an item
 * (ItemAttributeValueHelper::listDocByInvMastUid)
 * Field `attributes` of InvMastAlsoBoughtListItem
 *   attributeName: string|null — Attribute description
 *   attributeValue: string|null — The item's value for the attribute
 *
 * InvMastAlsoBoughtListItemStock: Stock by location and per company
 * Field `stock` of InvMastAlsoBoughtListItem
 *   stockData: list<InvMastAlsoBoughtListItemStockStockDataItem> — Stock at each location
 *     each item: InvMastAlsoBoughtListItemStockStockDataItem — An item's stock at one location
 *         (InvLocHelper::listStockByInvMastUid)
 *   companySummary: array<string, float> — Selling-unit quantity available per company ID, vendor
 *       stock included
 *     map of float
 *
 * InvMastAlsoBoughtListItemStockStockDataItem: An item's stock at one location
 * (InvLocHelper::listStockByInvMastUid)
 * Field `stockData` of InvMastAlsoBoughtListItemStock
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
 * InvMastAlsoBoughtListItemInvMastTextItem: One Prophet 21 item text block, present only on sites
 * with a p21_pim config
 * Field `invMastText` of InvMastAlsoBoughtListItem
 *   sequenceNo: int — Display order
 *   displayOnWebFlag: string — Y when the text displays on the web
 *   textTypeCd: int — Prophet 21 text type code
 *   textTypeDesc: string|null — Text type description; null when the code cannot be resolved
 *   webDisplayTypeUid: int — Web display type ID
 *   webDisplayTypeId: string — Web display type code
 *   webDisplayTypeDesc: string — Web display type description
 *   textValue: string — The text
 *
 * InvMastAlsoBoughtListItemLanguagesItem: An item description in another language (items
 * inv_mast_language)
 * Field `languages` of InvMastAlsoBoughtListItem
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
 * InvMastAlsoBoughtListItemBrandFolder: Brandfolder assets (trinitysurfaces only)
 * Field `brandFolder` of InvMastAlsoBoughtListItem
 *   assets?: list<InvMastAlsoBoughtListItemBrandFolderAssetsItem>|null — Active assets linked to
 *       the item; the key is absent when the lookup failed
 *     each item: InvMastAlsoBoughtListItemBrandFolderAssetsItem — One Brandfolder asset linked to
 *         an item
 *
 * InvMastAlsoBoughtListItemBrandFolderAssetsItem: One Brandfolder asset linked to an item
 * Field `assets` of InvMastAlsoBoughtListItemBrandFolder
 *   id: string — Brandfolder asset ID
 *   name: string|null — Asset name
 *   attachmentName: string|null — First attachment's file name
 *   cdnLink: string — CDN URL of the asset
 *   layout: string — Attachment layout (square when unknown)
 *
 * InvMastAlsoBoughtListItemFullSizedSamples: A sample item linked from an item's user-defined
 * fields (trinitysurfaces)
 * Field `fullSizedSamples` of InvMastAlsoBoughtListItem
 * Field `swatchSample` of InvMastAlsoBoughtListItem
 *   itemId: string — Sample item ID
 *   invMastUid: int — Sample item (inv_mast) ID
 *   classId5: string|null — Sample item class 5
 *   samplesApp: bool — True when the 4th character of classId5 is 1
 *
 * InvMastTagsListItem:
 * Returned by: $api->legacy->invMast->listTags($invMastUid)
 * Returned by: $api->legacy->invMast->createTags($invMastUid, $data)
 * Returned by: $api->legacy->invMast->getTags($invMastUid, $invMastTagsUid)
 * Returned by: $api->legacy->invMast->updateTags($invMastUid, $invMastTagsUid, $data)
 * Returned by: $api->legacy->invMast->deleteTags($invMastUid, $invMastTagsUid)
 *   invMastTagsUid: int — Unique identifier of the item tag
 *   invMastUid: int — Item (inv_mast) the tag belongs to
 *   tag: string|null — Tag text (max 255 chars)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *
 * InvMastTagsCreateBody: Add a tag to the item in the path
 * Request body of: $api->legacy->invMast->createTags($invMastUid, $data)
 *   tag?: string|null — Tag text
 *
 * InvMastTagsUpdateBody: Partial update of an item tag; an absent field keeps its current value
 * Request body of: $api->legacy->invMast->updateTags($invMastUid, $invMastTagsUid, $data)
 *   tag?: string|null — Tag text
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code
 *   updateCd?: int|null — Update code
 *
 * InvMastWebDescListItem:
 * Returned by: $api->legacy->invMast->listWebDesc($invMastUid)
 * Returned by: $api->legacy->invMast->createWebDesc($invMastUid, $data)
 * Returned by: $api->legacy->invMast->getWebDesc($invMastUid, $invMastWebDescUid)
 * Returned by: $api->legacy->invMast->updateWebDesc($invMastUid, $invMastWebDescUid, $data)
 * Returned by: $api->legacy->invMast->deleteWebDesc($invMastUid, $invMastWebDescUid)
 *   invMastWebDescUid: int — Unique identifier of the item web description
 *   invMastUid: int — Item (inv_mast) the web description belongs to
 *   webDesc1: string|null — Web description 1 (max 16777215 chars)
 *   webDesc2: string|null — Web description 2 (max 16777215 chars)
 *   webDesc3: string|null — Web description 3 (max 16777215 chars)
 *   webDesc4: string|null — Web description 4 (max 16777215 chars)
 *   webDescFull: string|null — Full web description (max 16777215 chars)
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   active: int|null — 1 when active
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastChecked: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *
 * InvMastWebDescCreateBody: Create the web descriptions for the item in the path, or return the
 * existing row
 * Request body of: $api->legacy->invMast->createWebDesc($invMastUid, $data)
 *   webDesc1?: string|null — Web description 1
 *   webDesc2?: string|null — Web description 2
 *   webDesc3?: string|null — Web description 3
 *   webDesc4?: string|null — Web description 4
 *   webDescFull?: string|null — Full web description
 *   active?: int|null — 1 when active; defaults to 1
 *
 * InvMastWebDescUpdateBody: Partial update of an item's web descriptions; an absent field keeps its
 * current value
 * Request body of: $api->legacy->invMast->updateWebDesc($invMastUid, $invMastWebDescUid, $data)
 *   webDesc1?: string|null — Web description 1
 *   webDesc2?: string|null — Web description 2
 *   webDesc3?: string|null — Web description 3
 *   webDesc4?: string|null — Web description 4
 *   webDescFull?: string|null — Full web description
 *   active?: int|null — 1 when active
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   updateCd?: int|null — Update code
 *
 * @phpstan-type InvMastAlsoBoughtListItem array{invMastUid: int, itemId: string, itemDesc: string|null, displayDesc: string|null, extendedDesc: string|null, shortCode: string|null, defaultSellingUnit: string|null, defaultPurchasingUnit: string|null, deleteFlag: string, onlineCd: int, statusCd: int, baseUnit: string, vndrStock: int|null, classId1: string|null, classId2: string|null, classId3: string|null, classId4: string|null, classId5: string|null, serialized: string, trackLots: string, trackingPattern: string, defaultProductGroup: string|null, defaultSalesDiscountGroup: string|null, defaultPurchaseDiscGroup: string|null, upcOrEan: string|null, upcOrEanId: string|null, weight: float|null, length: float|null, width: float|null, height: float|null, parkerProductCd: string|null, brandName: string|null, manufacturerName: string|null, inventorySupplier: list<InvMastAlsoBoughtListItemInventorySupplierItem>, primarySupplierName: string|null, itemUom: list<InvMastAlsoBoughtListItemItemUomItem>, alternateCodes: list<string>, legacyTags: list<string>, legacyPersonalization: list<InvMastAlsoBoughtListItemLegacyPersonalizationItem>, categoryList: list<int>, attributes: list<InvMastAlsoBoughtListItemAttributesItem>, images: list<string>, stock: InvMastAlsoBoughtListItemStock, categoryDisplayDescriptions: array<string, string>, userDefined: array<string, mixed>|array{}, invMastText: list<InvMastAlsoBoughtListItemInvMastTextItem>, languages: list<InvMastAlsoBoughtListItemLanguagesItem>, brandFolder?: InvMastAlsoBoughtListItemBrandFolder|null, docCatTrees?: list<list<int>>|null, productCollection?: string|null, tsItemCategoryUid?: int|null|false, ttItemCategoryUid?: int|null|false, trim?: bool|null, fullSizedSamples?: InvMastAlsoBoughtListItemFullSizedSamples|null|false, swatchSample?: InvMastAlsoBoughtListItemFullSizedSamples|null|false, itemVariantHdrUid?: int|null, price1?: float|null, price2?: float|null, price3?: float|null, price4?: float|null, price5?: float|null, price6?: float|null, price7?: float|null, price8?: float|null, price9?: float|null, price10?: float|null}
 * @phpstan-type InvMastAlsoBoughtListItemInventorySupplierItem array{inventorySupplierUid: int, invMastUid: int, supplierId: float, upcCode: string, checkDigit: string, upc: string, supplierPartNo: string|null, primarySupplierFlag: string|null, listPrice: float|null}
 * @phpstan-type InvMastAlsoBoughtListItemItemUomItem array{unitOfMeasure: string, unitSize: float}
 * @phpstan-type InvMastAlsoBoughtListItemLegacyPersonalizationItem array{itemPersonalizationHdrUid: int, invMastUid: int, itemOptionsHdrUid: int, ordering: int|null, defaultItemOptionsLineUid: int|null, required: int|null, dateLastModified: string|null, dateCreated: string|null, updateCd: int, statusCd: int, processCd: int, itemOptionsHdr: InvMastAlsoBoughtListItemLegacyPersonalizationItemItemOptionsHdr, itemPersonalizationLines: list<InvMastAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItem>}
 * @phpstan-type InvMastAlsoBoughtListItemLegacyPersonalizationItemItemOptionsHdr array{itemOptionsHdrUid: int, name: string|null, label: string|null, description: string|null, display: int|null, size: float|null, dateLastModified: string|null, alias: string|null}
 * @phpstan-type InvMastAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItem array{itemPersonalizationLineUid: int, itemPersonalizationHdrUid: int, itemOptionsLineUid: int, active: int|null, def: int|null, adjustmentInvMastUid: int|null, dateLastModified: string|null, dateCreated: string|null, updateCd: int, statusCd: int, processCd: int, itemOptionsLine: InvMastAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItemItemOptionsLine}
 * @phpstan-type InvMastAlsoBoughtListItemLegacyPersonalizationItemItemPersonalizationLinesItemItemOptionsLine array{itemOptionsLineUid: int, itemOptionsHdrUid: int, name: string|null, ordering: int|null, size: float|null, dateLastModified: string|null}
 * @phpstan-type InvMastAlsoBoughtListItemAttributesItem array{attributeName: string|null, attributeValue: string|null}
 * @phpstan-type InvMastAlsoBoughtListItemStock array{stockData: list<InvMastAlsoBoughtListItemStockStockDataItem>, companySummary: array<string, float>}
 * @phpstan-type InvMastAlsoBoughtListItemStockStockDataItem array{locationId: float, companyId: string, qtyOnHand: float, qtyAllocated: float, stockable: string|null, sellable: string|null, discontinued: string, unallocated: float, nextDueInPoDate: string|null, qtyBackordered: float|null, primaryBin: string|null, qtyFrozen: float, qtyQuarantined: float, qtyNonPickable: float, qtyAvailable: float, orderQuantity: float|null, productGroupId: string|null, baseUnit: string, baseUnitSize: float, defaultSellingUnit: string|null, defaultSellingUnitSize: float, divisor: float, calcQtyOnHand: float, calcQtyAllocated: float, calcQtyAvailable: float, locationName: string}
 * @phpstan-type InvMastAlsoBoughtListItemInvMastTextItem array{sequenceNo: int, displayOnWebFlag: string, textTypeCd: int, textTypeDesc: string|null, webDisplayTypeUid: int, webDisplayTypeId: string, webDisplayTypeDesc: string, textValue: string}
 * @phpstan-type InvMastAlsoBoughtListItemLanguagesItem array{invMastLanguageUid: int, invMastUid: int, languageId: string|null, languageItemDesc: string|null, itemDescDeleteFlag: string, dateCreated: string, createdBy: string, dateLastModified: string, lastMaintainedBy: string, languageExtendedDesc: string|null, updateCd: int}
 * @phpstan-type InvMastAlsoBoughtListItemBrandFolder array{assets?: list<InvMastAlsoBoughtListItemBrandFolderAssetsItem>|null}
 * @phpstan-type InvMastAlsoBoughtListItemBrandFolderAssetsItem array{id: string, name: string|null, attachmentName: string|null, cdnLink: string, layout: string}
 * @phpstan-type InvMastAlsoBoughtListItemFullSizedSamples array{itemId: string, invMastUid: int, classId5: string|null, samplesApp: bool}
 * @phpstan-type InvMastTagsListItem array{invMastTagsUid: int, invMastUid: int, tag: string|null, updateCd: int, statusCd: int, processCd: int, dateCreated: string, dateLastModified: string}
 * @phpstan-type InvMastTagsCreateBody array{tag?: string|null}
 * @phpstan-type InvMastTagsUpdateBody array{tag?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type InvMastWebDescListItem array{invMastWebDescUid: int, invMastUid: int, webDesc1: string|null, webDesc2: string|null, webDesc3: string|null, webDesc4: string|null, webDescFull: string|null, dateCreated: string, active: int|null, dateLastModified: string, dateLastChecked: string, updateCd: int, statusCd: int}
 * @phpstan-type InvMastWebDescCreateBody array{webDesc1?: string|null, webDesc2?: string|null, webDesc3?: string|null, webDesc4?: string|null, webDescFull?: string|null, active?: int|null}
 * @phpstan-type InvMastWebDescUpdateBody array{webDesc1?: string|null, webDesc2?: string|null, webDesc3?: string|null, webDesc4?: string|null, webDescFull?: string|null, active?: int|null, statusCd?: int|null, updateCd?: int|null}
 */
final class InvMastResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast/{invMastUid}/also-bought
     *
     * List item Also Bought
     * Call: $api->legacy->invMast->listAlsoBought($invMastUid)
     *
     * Response data, each item: The full item doc (InvMastHelper::generateDoc)
     *
     * GET https://legacy.augur-api.com/inv-mast/{invMastUid}/also-bought
     * Contract:
     * https://legacy.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1also-bought/get
     *
     * Query params ($params; `?` = optional):
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastAlsoBoughtListItem (fields listed on the class)
     *
     * @param int $invMastUid Unique identifier of the item (inv_mast) whose also-bought items are listed
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listAlsoBought(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/also-bought',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/tags
     *
     * List Inv Mast Tags
     * Call: $api->legacy->invMast->listTags($invMastUid)
     *
     * Errors:
     *   400: invMastUid is below 1, or orderBy is not column|ASC or column|DESC on an inv_mast_tags
     *       column.
     *   404: No item (inv_mast) with this invMastUid.
     *
     * GET https://legacy.augur-api.com/inv-mast/{invMastUid}/tags
     * Contract: https://legacy.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1tags/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Maximum rows to return (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: inv_mast_tags_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastTagsListItem (fields listed on the class)
     *
     * @param int $invMastUid Unique identifier of the item (inv_mast) the tag belongs to
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listTags(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/tags',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /inv-mast/{invMastUid}/tags
     *
     * Create Inv Mast Tag
     * Call: $api->legacy->invMast->createTags($invMastUid, $data)
     *
     * Request body: Add a tag to the item in the path
     *
     * Errors:
     *   400: invMastUid is below 1, or the body is missing or not a JSON object.
     *   404: No item (inv_mast) with this invMastUid.
     *
     * POST https://legacy.augur-api.com/inv-mast/{invMastUid}/tags
     * Contract:
     * https://legacy.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1tags/post
     *
     * Request body ($data): InvMastTagsCreateBody (fields listed on the class)
     *
     * Response data type: InvMastTagsListItem (fields listed on the class)
     *
     * @param int $invMastUid Unique identifier of the item (inv_mast) the tag belongs to
     * @param InvMastTagsCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createTags(int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invMastUid}/tags',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /inv-mast/{invMastUid}/tags/{invMastTagsUid}
     *
     * Delete Inv Mast Tag
     * Call: $api->legacy->invMast->deleteTags($invMastUid, $invMastTagsUid)
     *
     * Errors:
     *   400: invMastUid is below 1.
     *   404: No item (inv_mast) with this invMastUid, or no tag with this ID on that item.
     *
     * DELETE https://legacy.augur-api.com/inv-mast/{invMastUid}/tags/{invMastTagsUid}
     * Contract:
     * https://legacy.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1tags~1{invMastTagsUid}/delete
     *
     * Response data type: InvMastTagsListItem (fields listed on the class)
     *
     * @param int $invMastUid Unique identifier of the item (inv_mast) the tag belongs to
     * @param int $invMastTagsUid Unique identifier of the item tag
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteTags(int $invMastUid, int $invMastTagsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastUid}/tags/{invMastTagsUid}',
            ['invMastUid' => (string) $invMastUid, 'invMastTagsUid' => (string) $invMastTagsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/tags/{invMastTagsUid}
     *
     * Get Inv Mast Tag Details
     * Call: $api->legacy->invMast->getTags($invMastUid, $invMastTagsUid)
     *
     * Errors:
     *   400: invMastUid is below 1.
     *   404: No item (inv_mast) with this invMastUid, or no tag with this ID on that item.
     *
     * GET https://legacy.augur-api.com/inv-mast/{invMastUid}/tags/{invMastTagsUid}
     * Contract:
     * https://legacy.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1tags~1{invMastTagsUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: InvMastTagsListItem (fields listed on the class)
     *
     * @param int $invMastUid Unique identifier of the item (inv_mast) the tag belongs to
     * @param int $invMastTagsUid Unique identifier of the item tag
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getTags(int $invMastUid, int $invMastTagsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/tags/{invMastTagsUid}',
            $params,
            ['invMastUid' => (string) $invMastUid, 'invMastTagsUid' => (string) $invMastTagsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-mast/{invMastUid}/tags/{invMastTagsUid}
     *
     * Update Inv Mast Tag
     * Call: $api->legacy->invMast->updateTags($invMastUid, $invMastTagsUid, $data)
     *
     * Request body: Partial update of an item tag; an absent field keeps its current value
     *
     * Errors:
     *   400: invMastUid is below 1, or the body is missing or not a JSON object.
     *   404: No item (inv_mast) with this invMastUid, or no tag with this ID on that item.
     *
     * PUT https://legacy.augur-api.com/inv-mast/{invMastUid}/tags/{invMastTagsUid}
     * Contract:
     * https://legacy.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1tags~1{invMastTagsUid}/put
     *
     * Request body ($data): InvMastTagsUpdateBody (fields listed on the class)
     *
     * Response data type: InvMastTagsListItem (fields listed on the class)
     *
     * @param int $invMastUid Unique identifier of the item (inv_mast) the tag belongs to
     * @param int $invMastTagsUid Unique identifier of the item tag
     * @param InvMastTagsUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateTags(int $invMastUid, int $invMastTagsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}/tags/{invMastTagsUid}',
            $data,
            ['invMastUid' => (string) $invMastUid, 'invMastTagsUid' => (string) $invMastTagsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/web-desc
     *
     * List item Web Descriptions
     * Call: $api->legacy->invMast->listWebDesc($invMastUid)
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an inv_mast_web_desc column.
     *
     * GET https://legacy.augur-api.com/inv-mast/{invMastUid}/web-desc
     * Contract:
     * https://legacy.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1web-desc/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: inv_mast_web_desc_uid|ASC)
     *   q?: string — Text matched (LIKE) against any of the web description fields
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastWebDescListItem (fields listed on the class)
     *
     * @param int $invMastUid Unique identifier of the item (inv_mast) the web description belongs to
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listWebDesc(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/web-desc',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /inv-mast/{invMastUid}/web-desc
     *
     * Create Web Description for Item
     * Call: $api->legacy->invMast->createWebDesc($invMastUid, $data)
     *
     * Request body: Create the web descriptions for the item in the path, or return the existing
     * row
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://legacy.augur-api.com/inv-mast/{invMastUid}/web-desc
     * Contract:
     * https://legacy.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1web-desc/post
     *
     * Request body ($data): InvMastWebDescCreateBody (fields listed on the class)
     *
     * Response data type: InvMastWebDescListItem (fields listed on the class)
     *
     * @param int $invMastUid Unique identifier of the item (inv_mast) the web description belongs to
     * @param InvMastWebDescCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createWebDesc(int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invMastUid}/web-desc',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /inv-mast/{invMastUid}/web-desc/{invMastWebDescUid}
     *
     * Delete Item Web Description
     * Call: $api->legacy->invMast->deleteWebDesc($invMastUid, $invMastWebDescUid)
     *
     * Errors:
     *   404: No item web description with this ID.
     *
     * DELETE https://legacy.augur-api.com/inv-mast/{invMastUid}/web-desc/{invMastWebDescUid}
     * Contract:
     * https://legacy.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1web-desc~1{invMastWebDescUid}/delete
     *
     * Response data type: InvMastWebDescListItem (fields listed on the class)
     *
     * @param int $invMastUid Unique identifier of the item (inv_mast) the web description belongs to
     * @param int $invMastWebDescUid Unique identifier of the item web description
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteWebDesc(int $invMastUid, int $invMastWebDescUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastUid}/web-desc/{invMastWebDescUid}',
            ['invMastUid' => (string) $invMastUid, 'invMastWebDescUid' => (string) $invMastWebDescUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/web-desc/{invMastWebDescUid}
     *
     * Get Item Web Description
     * Call: $api->legacy->invMast->getWebDesc($invMastUid, $invMastWebDescUid)
     *
     * Errors:
     *   404: No item web description with this ID.
     *
     * GET https://legacy.augur-api.com/inv-mast/{invMastUid}/web-desc/{invMastWebDescUid}
     * Contract:
     * https://legacy.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1web-desc~1{invMastWebDescUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: InvMastWebDescListItem (fields listed on the class)
     *
     * @param int $invMastUid Unique identifier of the item (inv_mast) the web description belongs to
     * @param int $invMastWebDescUid Unique identifier of the item web description
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getWebDesc(int $invMastUid, int $invMastWebDescUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/web-desc/{invMastWebDescUid}',
            $params,
            ['invMastUid' => (string) $invMastUid, 'invMastWebDescUid' => (string) $invMastWebDescUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-mast/{invMastUid}/web-desc/{invMastWebDescUid}
     *
     * Update Item Web Description
     * Call: $api->legacy->invMast->updateWebDesc($invMastUid, $invMastWebDescUid, $data)
     *
     * Request body: Partial update of an item's web descriptions; an absent field keeps its current
     * value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No item web description with this ID.
     *
     * PUT https://legacy.augur-api.com/inv-mast/{invMastUid}/web-desc/{invMastWebDescUid}
     * Contract:
     * https://legacy.augur-api.com/openapi.json#/paths/~1inv-mast~1{invMastUid}~1web-desc~1{invMastWebDescUid}/put
     *
     * Request body ($data): InvMastWebDescUpdateBody (fields listed on the class)
     *
     * Response data type: InvMastWebDescListItem (fields listed on the class)
     *
     * @param int $invMastUid Unique identifier of the item (inv_mast) the web description belongs to
     * @param int $invMastWebDescUid Unique identifier of the item web description
     * @param InvMastWebDescUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateWebDesc(int $invMastUid, int $invMastWebDescUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}/web-desc/{invMastWebDescUid}',
            $data,
            ['invMastUid' => (string) $invMastUid, 'invMastWebDescUid' => (string) $invMastWebDescUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
