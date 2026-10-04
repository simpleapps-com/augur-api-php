<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * categories resource — generated from spec.
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
 * CategoriesLookupGetData: A category with its hierarchy, counts and active children
 * Returned by: $api->items->categories->getLookup()
 * Returned by: $api->items->categories->get($itemCategoryUid)
 *   itemCategoryUid: int — Category ID (item_category.item_category_uid)
 *   itemCategoryId: string — Category code
 *   itemCategoryDesc: string — Category description
 *   categoryImage: string|bool — Category image path, or false when none
 *   categoryText: string|bool — Category text, or false when none
 *   parentItemCategoryUid: int — Parent category ID
 *   nodeCount: int — Depth of the category in the hierarchy
 *   fullPath: string|null — Full hierarchy path
 *   cleanPath: string|null — URL-safe hierarchy path
 *   displayOnWebFlag: string — Y when the category displays on the web
 *   subItemCategoryUids: list<int> — This category and every descendant category ID
 *   maxItems: int — Active item links across the category and its descendants
 *   itemsByCategory: int — Online items in the category (OpenSearch count, after filters)
 *   children: list<CategoriesLookupGetDataChildrenOption1Item>|array<string,
 *       CategoriesLookupGetDataChildrenOption1Item> — Active child categories after childrenFilter,
 *       childrenLimit and childrenOffset
 *     one of:
 *       list<CategoriesLookupGetDataChildrenOption1Item>
 *         each item: CategoriesLookupGetDataChildrenOption1Item — One active child category of a
 *             category, with its online item count
 *       array<string, CategoriesLookupGetDataChildrenOption1Item>
 *         map of CategoriesLookupGetDataChildrenOption1Item — One active child category of a
 *             category, with its online item count
 *   childrenTotal: int — Children before childrenFilter and paging
 *   childrenCount: int — Children returned
 *   userDefined?: array<string, string> — User-defined fields (only with includeUd=Y)
 *     map of string
 *
 * CategoriesLookupGetDataChildrenOption1Item: One active child category of a category, with its
 * online item count
 * Field `children` of CategoriesLookupGetData
 *   itemCategoryUid: int — Category ID (item_category.item_category_uid)
 *   itemCategoryId: string — Category code
 *   itemCategoryDesc: string — Category description
 *   statusCd: int — Status code (704 = Active; only active children are listed)
 *   fullPath: string|null — Full hierarchy path
 *   cleanPath: string|null — URL-safe hierarchy path
 *   categoryImage: string|bool — Category image path, or false when none
 *   sequenceNo: int — Display order under the parent
 *   productCollection: string|null — Product collection
 *   itemCount: int — Online items in the category
 *   userDefined?: array<string, string> — User-defined fields (only with includeUd=Y)
 *     map of string
 *   roomScene?: CategoriesLookupGetDataChildrenOption1ItemRoomSceneOption1|bool|null — Primary
 *       room-scene asset, false when none, null when the lookup failed (trinitysurfaces only)
 *   colorList?: list<string>|null — Brandfolder color names (trinitysurfaces only)
 *   colorCount?: int|null — Brandfolder color count (trinitysurfaces only)
 *   bf?: bool|null — True when the Brandfolder lookup succeeded (trinitysurfaces only)
 *
 * CategoriesLookupGetDataChildrenOption1ItemRoomSceneOption1:
 * Field `roomScene` of CategoriesLookupGetDataChildrenOption1Item
 *   id: string — Brandfolder asset ID
 *   name: string|null — Asset name
 *   cdnLink: string — CDN URL of the asset
 *   sequenceNo: int — Display order within the category (always 1)
 *
 * BrandsAttributesListData: The filterable attributes of a category, brand or contract
 * Returned by: $api->items->categories->listAttributes($itemCategoryUid)
 *   attributes: list<BrandsAttributesListDataAttributesItem> — Active filterable attributes with
 *       their values
 *     each item: BrandsAttributesListDataAttributesItem — One filterable attribute of a category,
 *         brand or contract, with its values
 *
 * BrandsAttributesListDataAttributesItem: One filterable attribute of a category, brand or
 * contract, with its values
 * Field `attributes` of BrandsAttributesListData
 *   attributeUid: int — Attribute ID (attribute.attribute_uid)
 *   attributeId: string — Attribute code
 *   attributeDesc: string|null — Attribute name
 *   sequenceNo: int|null — Display order of the attribute within its attribute group
 *   values: list<BrandsAttributesListDataAttributesItemValuesItem> — The attribute values in use
 *     each item: BrandsAttributesListDataAttributesItemValuesItem — One value of a filterable
 *         attribute in a category, brand or contract attribute list
 *   valueCount?: int|null — Number of values before values from other categories were merged in
 *       (category attribute lists only)
 *
 * BrandsAttributesListDataAttributesItemValuesItem: One value of a filterable attribute in a
 * category, brand or contract attribute list
 * Field `values` of BrandsAttributesListDataAttributesItem
 *   attributeValueUid: int — Attribute value ID (attribute_value.attribute_value_uid)
 *   attributeValue: string — The value text
 *   sequenceNo: int|null — Display order: the lowest sequence across the attribute groups, else the
 *       value own sequence
 *
 * BrandsFacetsListData: Faceted item search: the page of hydrated items, hit metadata, and
 * attribute facets (GET /api/item-search-facets)
 * Returned by: $api->items->categories->listFacets($itemCategoryUid)
 *   meta: BrandsFacetsListDataMeta — Query time and hit totals
 *   items: list<BrandsFacetsListDataItemsItem> — Matching items for the requested page
 *     each item: BrandsFacetsListDataItemsItem — One item hit: the items service inv_mast doc (GET
 *         /api/items/{invMastUid}) plus its search score
 *   facets: list<BrandsFacetsListDataFacetsItem> — Attribute facets, in attribute sequence order
 *     each item: BrandsFacetsListDataFacetsItem — One attribute facet over the search result set,
 *         with its values
 *
 * BrandsFacetsListDataMeta: Query time and hit totals
 * Field `meta` of BrandsFacetsListData
 *   took: int — OpenSearch query time in milliseconds
 *   total: int — Total hits for the query, unfiltered by paging
 *   pageableTotal: int — Hits reachable through from/size (total capped at the result window)
 *   maxScore: float|null — Highest relevance score, or null when the search was sorted
 *
 * BrandsFacetsListDataItemsItem: One item hit: the items service inv_mast doc (GET
 * /api/items/{invMastUid}) plus its search score
 * Field `items` of BrandsFacetsListData
 *   score: int|float|null — OpenSearch relevance score, or null when the search was sorted
 *   brandFolder?: BrandsFacetsListDataItemsItemBrandFolder — Brandfolder assets; the key is present
 *       only when useBrandFolderDoc=Y
 *
 * BrandsFacetsListDataItemsItemBrandFolder: Brandfolder assets; the key is present only when
 * useBrandFolderDoc=Y
 * Field `brandFolder` of BrandsFacetsListDataItemsItem
 * Field `brandFolder` of CategoriesItemsListDataItemsItem
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
 * BrandsFacetsListDataFacetsItem: One attribute facet over the search result set, with its values
 * Field `facets` of BrandsFacetsListData
 *   attributeUid: int — attribute_uid of the facet
 *   attributeId: string — Attribute ID
 *   label: string — Attribute description shown as the facet heading
 *   sequence: int — Facet display order: lowest attribute-group sequence (9999 when none)
 *   headCoveragePct: float — Percent of the sampled top hits carrying this attribute, one decimal
 *   values: list<BrandsFacetsListDataFacetsItemValuesItem> — Values with counts, highest count
 *       first
 *     each item: BrandsFacetsListDataFacetsItemValuesItem — One attribute value offered as a facet
 *         filter, with its hit count
 *
 * BrandsFacetsListDataFacetsItemValuesItem: One attribute value offered as a facet filter, with its
 * hit count
 * Field `values` of BrandsFacetsListDataFacetsItem
 *   valueUid: int — attribute_value_uid to pass back in filters
 *   label: string — Attribute value text (empty when the value row is missing)
 *   sequence: int — Value display sequence (0 when the value row is missing)
 *   count: int — Items in the result set carrying this value
 *
 * CategoriesImagesListData: A category's images: folder images on every site, plus product
 * collection and Brandfolder assets on trinitysurfaces
 * Returned by: $api->items->categories->listImages($itemCategoryUid)
 *   itemCategoryUid: int|null — Category ID (item_category.item_category_uid)
 *   itemCategoryId: string|null — Category code; the image file name
 *   folderImages: list<string> — Category image paths found on the site (jpg, png)
 *   productCollection?: string|null — Product collection of the category (trinitysurfaces only)
 *   brandFolderAssets?: list<CategoriesImagesListDataBrandFolderAssetsItem>|null — Brandfolder
 *       room-scene assets; empty when the lookup failed (trinitysurfaces only)
 *     each item: CategoriesImagesListDataBrandFolderAssetsItem — One Brandfolder room-scene asset
 *         linked to a category
 *   brandFolderArchives?: list<CategoriesImagesListDataBrandFolderArchivesItem>|null — Brandfolder
 *       downloadable archives; empty when the lookup failed (trinitysurfaces only)
 *     each item: CategoriesImagesListDataBrandFolderArchivesItem — One downloadable Brandfolder
 *         archive configured on a category
 *
 * CategoriesImagesListDataBrandFolderAssetsItem: One Brandfolder room-scene asset linked to a
 * category
 * Field `brandFolderAssets` of CategoriesImagesListData
 *   id: string — Brandfolder asset ID
 *   name: string|null — Asset name
 *   cdnLink: string — CDN URL of the asset
 *   sequenceNo: int — Display order within the category
 *   statusCd: int — Asset status code (704 = Active; only active assets are listed)
 *   hasWebTag: bool — True when the asset carries the Web tag (always true for a listed asset)
 *   hasRoomSceneTag: bool — True when the asset carries a Room Scene tag (always true for a listed
 *       asset)
 *
 * CategoriesImagesListDataBrandFolderArchivesItem: One downloadable Brandfolder archive configured
 * on a category
 * Field `brandFolderArchives` of CategoriesImagesListData
 *   id: string — Brandfolder asset ID
 *   name: string|null — Asset name
 *   type: string — Archive kind: images, room_scenes, brochures, contractors, or leed
 *   attachmentName: string|null — First attachment's file name
 *   cdnLink: string — CDN URL of the archive
 *
 * CategoriesItemsListData: A page of a category's items from the items index, each built into a
 * category item doc
 * Returned by: $api->items->categories->listItems($itemCategoryUid)
 *   itemCategoryUid: int — Item category ID
 *   itemCategoryId: string — Item category code
 *   itemCategoryDesc: string — Item category name
 *   took: int — OpenSearch query time in milliseconds
 *   total: int — Total matching items in the index
 *   items: list<CategoriesItemsListDataItemsItem> — The items on this page
 *     each item: CategoriesItemsListDataItemsItem — One item of a category item list, as
 *         CategoriesHelper::buildCategoryItemDoc builds it
 *   count: int — Number of entries in items
 *
 * CategoriesItemsListDataItemsItem: One item of a category item list, as
 * CategoriesHelper::buildCategoryItemDoc builds it
 * Field `items` of CategoriesItemsListData
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   itemId: string — Item code
 *   itemDesc: string|null — Item description
 *   extendedDesc: string|null — Extended description
 *   brandName: string|null — Brand name (trinitysurfaces: user-defined private_label_desc_2, else
 *       itemDesc)
 *   manufacturerName: string|null — Manufacturer name (trinitysurfaces: user-defined
 *       private_label_desc_1, else itemDesc)
 *   shortCode: string|null — Short code
 *   classId1: string|null — Item class 1
 *   classId2: string|null — Item class 2
 *   classId3: string|null — Item class 3
 *   classId4: string|null — Item class 4
 *   classId5: string|null — Item class 5
 *   images: list<string> — Image URLs or paths
 *   defaultSellingUnit: string|null — Default selling unit
 *   itemUom: list<CategoriesItemsListDataItemsItemItemUomItem> — Units of measure (not deleted)
 *     each item: CategoriesItemsListDataItemsItemItemUomItem — One unit of measure an item is sold
 *         in
 *   vndrStock: int — Vendor stock quantity; 0 when unset
 *   inventorySupplier: list<CategoriesItemsListDataItemsItemInventorySupplierItem> — The item's
 *       suppliers (not deleted)
 *     each item: CategoriesItemsListDataItemsItemInventorySupplierItem — One supplier of an item
 *         (InventorySupplierHelper::generateDoc)
 *   displayDesc: string — The item's display description in this category
 *   stock?: InvMastStockGetData — Stock by location and per company (only with includeStock=Y)
 *   samplesApp?: bool|null — True when the 4th character of classId5 is 1 (trinitysurfaces only)
 *   trim?: bool|null — True when the trim user-defined field is Y (trinitysurfaces only)
 *   fullSizedSamples?: CategoriesItemsListDataItemsItemFullSizedSamplesOption1|bool|null —
 *       Full-sized sample item, or false (trinitysurfaces only)
 *   swatchSample?: CategoriesItemsListDataItemsItemFullSizedSamplesOption1|bool|null — Swatch
 *       sample item, or false (trinitysurfaces only)
 *   brandFolder?: BrandsFacetsListDataItemsItemBrandFolder — Brandfolder assets (trinitysurfaces
 *       only)
 *
 * CategoriesItemsListDataItemsItemItemUomItem: One unit of measure an item is sold in
 * Field `itemUom` of CategoriesItemsListDataItemsItem
 *   unitOfMeasure: string — Unit of measure code
 *   unitSize: float — Base units per one of this unit
 *
 * CategoriesItemsListDataItemsItemInventorySupplierItem: One supplier of an item
 * (InventorySupplierHelper::generateDoc)
 * Field `inventorySupplier` of CategoriesItemsListDataItemsItem
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
 * InvMastStockGetData: Stock by location and per company (only with includeStock=Y)
 * Field `stock` of CategoriesItemsListDataItemsItem
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
 * CategoriesItemsListDataItemsItemFullSizedSamplesOption1:
 * Field `fullSizedSamples` of CategoriesItemsListDataItemsItem
 * Field `swatchSample` of CategoriesItemsListDataItemsItem
 *   itemId: string — Sample item ID
 *   invMastUid: int — Sample item (inv_mast) ID
 *   classId5: string|null — Sample item class 5
 *   samplesApp: bool — True when the 4th character of classId5 is 1
 *
 * @phpstan-type CategoriesLookupGetData array{itemCategoryUid: int, itemCategoryId: string, itemCategoryDesc: string, categoryImage: string|bool, categoryText: string|bool, parentItemCategoryUid: int, nodeCount: int, fullPath: string|null, cleanPath: string|null, displayOnWebFlag: string, subItemCategoryUids: list<int>, maxItems: int, itemsByCategory: int, children: list<CategoriesLookupGetDataChildrenOption1Item>|array<string, CategoriesLookupGetDataChildrenOption1Item>, childrenTotal: int, childrenCount: int, userDefined?: array<string, string>}
 * @phpstan-type CategoriesLookupGetDataChildrenOption1Item array{itemCategoryUid: int, itemCategoryId: string, itemCategoryDesc: string, statusCd: int, fullPath: string|null, cleanPath: string|null, categoryImage: string|bool, sequenceNo: int, productCollection: string|null, itemCount: int, userDefined?: array<string, string>, roomScene?: CategoriesLookupGetDataChildrenOption1ItemRoomSceneOption1|bool|null, colorList?: list<string>|null, colorCount?: int|null, bf?: bool|null}
 * @phpstan-type CategoriesLookupGetDataChildrenOption1ItemRoomSceneOption1 array{id: string, name: string|null, cdnLink: string, sequenceNo: int}
 * @phpstan-type BrandsAttributesListData array{attributes: list<BrandsAttributesListDataAttributesItem>}
 * @phpstan-type BrandsAttributesListDataAttributesItem array{attributeUid: int, attributeId: string, attributeDesc: string|null, sequenceNo: int|null, values: list<BrandsAttributesListDataAttributesItemValuesItem>, valueCount?: int|null}
 * @phpstan-type BrandsAttributesListDataAttributesItemValuesItem array{attributeValueUid: int, attributeValue: string, sequenceNo: int|null}
 * @phpstan-type BrandsFacetsListData array{meta: BrandsFacetsListDataMeta, items: list<BrandsFacetsListDataItemsItem>, facets: list<BrandsFacetsListDataFacetsItem>}
 * @phpstan-type BrandsFacetsListDataMeta array{took: int, total: int, pageableTotal: int, maxScore: float|null}
 * @phpstan-type BrandsFacetsListDataItemsItem array{score: int|float|null, brandFolder?: BrandsFacetsListDataItemsItemBrandFolder}
 * @phpstan-type BrandsFacetsListDataItemsItemBrandFolder array{assets?: list<BrandsFacetsListDataItemsItemBrandFolderAssetsItem>|null}
 * @phpstan-type BrandsFacetsListDataItemsItemBrandFolderAssetsItem array{id: string, name: string|null, attachmentName: string|null, cdnLink: string, layout: string}
 * @phpstan-type BrandsFacetsListDataFacetsItem array{attributeUid: int, attributeId: string, label: string, sequence: int, headCoveragePct: float, values: list<BrandsFacetsListDataFacetsItemValuesItem>}
 * @phpstan-type BrandsFacetsListDataFacetsItemValuesItem array{valueUid: int, label: string, sequence: int, count: int}
 * @phpstan-type CategoriesImagesListData array{itemCategoryUid: int|null, itemCategoryId: string|null, folderImages: list<string>, productCollection?: string|null, brandFolderAssets?: list<CategoriesImagesListDataBrandFolderAssetsItem>|null, brandFolderArchives?: list<CategoriesImagesListDataBrandFolderArchivesItem>|null}
 * @phpstan-type CategoriesImagesListDataBrandFolderAssetsItem array{id: string, name: string|null, cdnLink: string, sequenceNo: int, statusCd: int, hasWebTag: bool, hasRoomSceneTag: bool}
 * @phpstan-type CategoriesImagesListDataBrandFolderArchivesItem array{id: string, name: string|null, type: string, attachmentName: string|null, cdnLink: string}
 * @phpstan-type CategoriesItemsListData array{itemCategoryUid: int, itemCategoryId: string, itemCategoryDesc: string, took: int, total: int, items: list<CategoriesItemsListDataItemsItem>, count: int}
 * @phpstan-type CategoriesItemsListDataItemsItem array{invMastUid: int, itemId: string, itemDesc: string|null, extendedDesc: string|null, brandName: string|null, manufacturerName: string|null, shortCode: string|null, classId1: string|null, classId2: string|null, classId3: string|null, classId4: string|null, classId5: string|null, images: list<string>, defaultSellingUnit: string|null, itemUom: list<CategoriesItemsListDataItemsItemItemUomItem>, vndrStock: int, inventorySupplier: list<CategoriesItemsListDataItemsItemInventorySupplierItem>, displayDesc: string, stock?: InvMastStockGetData, samplesApp?: bool|null, trim?: bool|null, fullSizedSamples?: CategoriesItemsListDataItemsItemFullSizedSamplesOption1|bool|null, swatchSample?: CategoriesItemsListDataItemsItemFullSizedSamplesOption1|bool|null, brandFolder?: BrandsFacetsListDataItemsItemBrandFolder}
 * @phpstan-type CategoriesItemsListDataItemsItemItemUomItem array{unitOfMeasure: string, unitSize: float}
 * @phpstan-type CategoriesItemsListDataItemsItemInventorySupplierItem array{inventorySupplierUid: int, invMastUid: int, supplierId: float, upcCode: string, checkDigit: string, upc: string, supplierPartNo: string|null, primarySupplierFlag: string|null, listPrice: float|null}
 * @phpstan-type InvMastStockGetData array{stockData: list<InvMastStockGetDataStockDataItem>, companySummary: array<string, float>}
 * @phpstan-type InvMastStockGetDataStockDataItem array{locationId: float, companyId: string, qtyOnHand: float, qtyAllocated: float, stockable: string|null, sellable: string|null, discontinued: string, unallocated: float, nextDueInPoDate: string|null, qtyBackordered: float|null, primaryBin: string|null, qtyFrozen: float, qtyQuarantined: float, qtyNonPickable: float, qtyAvailable: float, orderQuantity: float|null, productGroupId: string|null, baseUnit: string, baseUnitSize: float, defaultSellingUnit: string|null, defaultSellingUnitSize: float, divisor: float, calcQtyOnHand: float, calcQtyAllocated: float, calcQtyAvailable: float, locationName: string}
 * @phpstan-type CategoriesItemsListDataItemsItemFullSizedSamplesOption1 array{itemId: string, invMastUid: int, classId5: string|null, samplesApp: bool}
 */
final class CategoriesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /categories/lookup
     *
     * get the categories details
     * Call: $api->items->categories->getLookup()
     *
     * lookup the categories details
     *
     * Response data: A category with its hierarchy, counts and active children
     *
     * GET https://items.augur-api.com/categories/lookup
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1categories~1lookup/get
     *
     * Query params ($params; `?` = optional):
     *   path?: string — Path to lookup (Default: /)
     *   rootItemCategoryId?: string — Root item_category.item_category_id (Default: ROOT)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CategoriesLookupGetData (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /categories/{itemCategoryUid}
     *
     * Get the category details
     * Call: $api->items->categories->get($itemCategoryUid)
     *
     * Response data: A category with its hierarchy, counts and active children
     *
     * Errors:
     *   400: An itemCategoryUid of 0 requires a path or rootItemCategoryId query parameter; or
     *       invalid orderBy: MUST be one field|ASC or field|DESC, the field a child category key.
     *   404: Item Category not found.
     *
     * GET https://items.augur-api.com/categories/{itemCategoryUid}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1categories~1{itemCategoryUid}/get
     *
     * Query params ($params; `?` = optional):
     *   childrenFilter?: string — Filter for children (Default: null)
     *   childrenLimit?: int — Limit number of results (Default: 0)
     *   childrenOffset?: int — Starting offset results (Default: 0)
     *   classId5List?: string — List of allowed class 5 values (default:blank)
     *   filters?: string — A JSON representation of the filters [{attributeUid:attributeValueUid}]
     *   includeUd?: string — Include UD table data [Y|N] (Default: N)
     *   orderBy?: string — Select order of the categories Default: item_category_desc|ASC
     *   path?: string — Path to lookup (Default: /)
     *   productCollection?: string — Product Collection the category must be in. default: blank
     *   rootItemCategoryId?: string — Root item_category.item_category_id (Default: ROOT)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CategoriesLookupGetData (fields listed on the class)
     *
     * @param int $itemCategoryUid item_category.item_category_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /categories/{itemCategoryUid}/attributes
     *
     * list the attributes in a category
     * Call: $api->items->categories->listAttributes($itemCategoryUid)
     *
     * Response data: The filterable attributes of a category, brand or contract
     *
     * GET https://items.augur-api.com/categories/{itemCategoryUid}/attributes
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1categories~1{itemCategoryUid}~1attributes/get
     *
     * Query params ($params; `?` = optional):
     *   includeSubCategories?: string — Include attributes from sub categories [Y|N] (Default: N)
     *   productCollection?: string — Product Collection the category must be in. default: blank
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: BrandsAttributesListData (fields listed on the class)
     *
     * @param int $itemCategoryUid item_category.item_category_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAttributes(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}/attributes',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /categories/{itemCategoryUid}/facets
     *
     * result-set self-filtering facets and hydrated items for a category
     * Call: $api->items->categories->listFacets($itemCategoryUid)
     *
     * Response data: Faceted item search: the page of hydrated items, hit metadata, and attribute
     * facets (GET /api/item-search-facets)
     *
     * Errors:
     *   400: Invalid sort '...': MUST be field|asc or field|desc, comma-separated, each field a
     *       keyword or numeric field of the items index.
     *
     * GET https://items.augur-api.com/categories/{itemCategoryUid}/facets
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1categories~1{itemCategoryUid}~1facets/get
     *
     * Query params ($params; `?` = optional):
     *   classId5ExcludeList?: string — CSV of class_id5 values to exclude
     *   classId5List?: string — CSV of class_id5 values to include
     *   discontinuedAny?: string — Discontinued filter [Y|N|blank]
     *   filters?: string — JSON representation of attribute filters
     *   from?: int — Result offset within the facets result window
     *   q?: string — Search query (optional keyword narrowing within the category)
     *   size?: int — Page size for hydrated items
     *   sort?: string — Comma-separated items index field|direction, snake_case (e.g.,
     *       item_desc_keyword|asc, price1|desc). Field MUST be a keyword or numeric field; text
     *       fields such as item_desc return 400. Empty or relevance sorts by relevance
     *   stockStatus?: string — Filter by stock status [in_stock|out_of_stock]
     *   tags?: string — CSV of tags
     *   useBrandFolderDoc?: string — Attach BrandFolder doc to items [Y|N]
     *   variantFilter?: string — Filter variants primary_only
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: BrandsFacetsListData (fields listed on the class)
     *
     * @param int $itemCategoryUid item_category.item_category_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listFacets(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}/facets',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /categories/{itemCategoryUid}/images
     *
     * list the images for a category
     * Call: $api->items->categories->listImages($itemCategoryUid)
     *
     * Response data: A category's images: folder images on every site, plus product collection and
     * Brandfolder assets on trinitysurfaces
     *
     * GET https://items.augur-api.com/categories/{itemCategoryUid}/images
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1categories~1{itemCategoryUid}~1images/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CategoriesImagesListData (fields listed on the class)
     *
     * @param int $itemCategoryUid item_category.item_category_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listImages(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}/images',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /categories/{itemCategoryUid}/items
     *
     * list the items in a category
     * Call: $api->items->categories->listItems($itemCategoryUid)
     *
     * Response data: A page of a category's items from the items index, each built into a category
     * item doc
     *
     * Errors:
     *   400: Invalid sortBy '...': MUST be one field|ASC or field|DESC, the field a keyword or
     *       numeric field of the items index.
     *
     * GET https://items.augur-api.com/categories/{itemCategoryUid}/items
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1categories~1{itemCategoryUid}~1items/get
     *
     * Query params ($params; `?` = optional):
     *   classId5ExcludeList?: string — List of excluded class 5 values (default:blank)
     *   classId5List?: string — List of allowed class 5 values (default:blank)
     *   displayOnWebFlag?: string — Display on web flag [Y|N|Blank] (Default: Blank)
     *   fields?: string — fields to filter with (Default: itemId, itemDesc, ExtendedDesc)
     *   filters?: string — A JSON representation of the filters [{attributeUid:attributeValueUid}]
     *   includeStock?: string — Include Stock [Y|N] (Default: N)
     *   jobNumbers?: string — Job numbers (contracts) to filter items by - comma-separated
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   q?: string — search query
     *   sortBy?: string — Items index field|direction, snake_case. Field MUST be a keyword or
     *       numeric field (e.g. item_id, item_desc_keyword, short_code, inv_mast_uid, price1); text
     *       fields such as item_desc return 400. Default (empty or relevance): relevance order when
     *       q is set, item_id|ASC otherwise. sortOrder, if sent, supplies a missing direction
     *   sortOrder?: string — Sort direction (ASC or DESC); applies only when sortBy carries no
     *       direction
     *   stockStatus?: string — Filter by stock status [in_stock|out_of_stock] (Default: blank)
     *   tags?: string — A CSV of tags
     *   variantFilter?: string — Filter variants [primary_only] (Default: blank)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CategoriesItemsListData (fields listed on the class)
     *
     * @param int $itemCategoryUid item_category.item_category_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listItems(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}/items',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
