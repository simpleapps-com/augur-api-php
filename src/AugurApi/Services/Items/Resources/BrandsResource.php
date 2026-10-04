<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * brands resource — generated from spec.
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
 * BrandsListItem:
 * Returned by: $api->items->brands->list()
 * Returned by: $api->items->brands->create($data)
 * Returned by: $api->items->brands->get($brandsUid)
 * Returned by: $api->items->brands->update($brandsUid, $data)
 * Returned by: $api->items->brands->delete($brandsUid)
 *   brandsUid: int — Brand ID
 *   brandsName: string — Brand name (max 255 chars)
 *   brandsId: string — Brand code (max 255 chars)
 *   brandsDesc: string|null — Brand description (max 40 chars)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code: workflow state of the row
 *   contentId: int|null — CMS content ID linked to the brand, when set
 *
 * BrandsCreateBody: Create a brand, or return the existing one with the same name
 * Request body of: $api->items->brands->create($data)
 *   brandsName: string|null — Brand name; brandsId is derived from it. Required
 *   brandsDesc?: string|null — Brand description
 *   contentId?: int|null — CMS content ID linked to the brand
 *
 * BrandsUpdateBody: Change a brand; every field is optional and an absent field keeps its value
 * Request body of: $api->items->brands->update($brandsUid, $data)
 *   brandsName?: string|null — Brand name; also regenerates brandsId
 *   brandsDesc?: string|null — Brand description
 *   contentId?: int|null — CMS content ID linked to the brand
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code: workflow state of the row
 *
 * BrandsAttributesListData: The filterable attributes of a category, brand or contract
 * Returned by: $api->items->brands->listAttributes($brandsUid)
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
 * Returned by: $api->items->brands->listFacets($brandsUid)
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
 * BrandsItemsListData: A page of a brand's items from the items index
 * Returned by: $api->items->brands->listItems($brandsUid)
 *   total: int — Total matching items in the index; 0 when the brand does not exist
 *   items: list<BrandsItemsListDataItemsItem> — The items on this page
 *     each item: BrandsItemsListDataItemsItem — One item of a brand, from the items index
 *
 * BrandsItemsListDataItemsItem: One item of a brand, from the items index
 * Field `items` of BrandsItemsListData
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   itemId: string — Item code; empty when the index has none
 *   itemDesc: string — Item description; empty when the index has none
 *
 * BrandsItemsCreateData:
 * Returned by: $api->items->brands->createItems($brandsUid, $data)
 * Returned by: $api->items->brands->getItems($brandsUid, $brandsXItemsUid)
 * Returned by: $api->items->brands->updateItems($brandsUid, $brandsXItemsUid, $data)
 * Returned by: $api->items->brands->deleteItems($brandsUid, $brandsXItemsUid)
 *   brandsXItemsUid: int — Brand-to-item assignment ID
 *   brandsUid: int — Brand ID (brands.brands_uid)
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code: workflow state of the row
 *
 * BrandsItemsCreateBody: Assign an item to a brand (the brand comes from the path)
 * Request body of: $api->items->brands->createItems($brandsUid, $data)
 *   invMastUid: int|null — Item to assign (inv_mast.inv_mast_uid). Without it nothing is created
 *       and data is an empty object
 *   statusCd?: int|null — Status code; defaults to 704 (Active)
 *   processCd?: int|null — Process code; defaults to 704
 *   updateCd?: int|null — Update code; defaults to import complete
 *
 * BrandsItemsUpdateBody: Change a brand-to-item assignment; every field is optional and an absent
 * field keeps its value
 * Request body of: $api->items->brands->updateItems($brandsUid, $brandsXItemsUid, $data)
 *   invMastUid?: int|null — Item ID (inv_mast.inv_mast_uid)
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code: workflow state of the row
 *
 * @phpstan-type BrandsListItem array{brandsUid: int, brandsName: string, brandsId: string, brandsDesc: string|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, contentId: int|null}
 * @phpstan-type BrandsCreateBody array{brandsName: string|null, brandsDesc?: string|null, contentId?: int|null}
 * @phpstan-type BrandsUpdateBody array{brandsName?: string|null, brandsDesc?: string|null, contentId?: int|null, statusCd?: int|null, processCd?: int|null}
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
 * @phpstan-type BrandsItemsListData array{total: int, items: list<BrandsItemsListDataItemsItem>}
 * @phpstan-type BrandsItemsListDataItemsItem array{invMastUid: int, itemId: string, itemDesc: string}
 * @phpstan-type BrandsItemsCreateData array{brandsXItemsUid: int, brandsUid: int, invMastUid: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type BrandsItemsCreateBody array{invMastUid: int|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type BrandsItemsUpdateBody array{invMastUid?: int|null, statusCd?: int|null, processCd?: int|null}
 */
final class BrandsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /brands
     *
     * List Brands
     * Call: $api->items->brands->list()
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field a brands column.
     *
     * GET https://items.augur-api.com/brands
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1brands/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: brands_uid|ASC)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of BrandsListItem (fields listed on the class)
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
     * POST /brands
     *
     * Create Brands
     * Call: $api->items->brands->create($data)
     *
     * Request body: Create a brand, or return the existing one with the same name
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://items.augur-api.com/brands
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1brands/post
     *
     * Request body ($data): BrandsCreateBody (fields listed on the class)
     *
     * Response data type: BrandsListItem (fields listed on the class)
     *
     * @param BrandsCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /brands/{brandsUid}
     *
     * DELETE Brands
     * Call: $api->items->brands->delete($brandsUid)
     *
     * Errors:
     *   404: No record with this ID.
     *
     * DELETE https://items.augur-api.com/brands/{brandsUid}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1brands~1{brandsUid}/delete
     *
     * Response data type: BrandsListItem (fields listed on the class)
     *
     * @param int $brandsUid Brand ID (brands.brands_uid)
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $brandsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{brandsUid}',
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /brands/{brandsUid}
     *
     * Get Brands Details
     * Call: $api->items->brands->get($brandsUid)
     *
     * GET https://items.augur-api.com/brands/{brandsUid}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1brands~1{brandsUid}/get
     *
     * Query params ($params; `?` = optional):
     *   brandsId?: string — Brands ID for lookup when UID is 0
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: BrandsListItem (fields listed on the class)
     *
     * @param int $brandsUid Brand ID (brands.brands_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $brandsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{brandsUid}',
            $params,
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /brands/{brandsUid}
     *
     * Update Brands
     * Call: $api->items->brands->update($brandsUid, $data)
     *
     * Request body: Change a brand; every field is optional and an absent field keeps its value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No record with this ID.
     *
     * PUT https://items.augur-api.com/brands/{brandsUid}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1brands~1{brandsUid}/put
     *
     * Request body ($data): BrandsUpdateBody (fields listed on the class)
     *
     * Response data type: BrandsListItem (fields listed on the class)
     *
     * @param int $brandsUid Brand ID (brands.brands_uid)
     * @param BrandsUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $brandsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{brandsUid}',
            $data,
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /brands/{brandsUid}/attributes
     *
     * List attributes for brand items
     * Call: $api->items->brands->listAttributes($brandsUid)
     *
     * Response data: The filterable attributes of a category, brand or contract
     *
     * GET https://items.augur-api.com/brands/{brandsUid}/attributes
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1brands~1{brandsUid}~1attributes/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: BrandsAttributesListData (fields listed on the class)
     *
     * @param int $brandsUid Brand ID (brands.brands_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAttributes(int $brandsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{brandsUid}/attributes',
            $params,
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /brands/{brandsUid}/facets
     *
     * result-set self-filtering facets and hydrated items for a brand
     * Call: $api->items->brands->listFacets($brandsUid)
     *
     * Response data: Faceted item search: the page of hydrated items, hit metadata, and attribute
     * facets (GET /api/item-search-facets)
     *
     * Errors:
     *   400: sort is not a sortable field.
     *   404: No brand with this ID.
     *
     * GET https://items.augur-api.com/brands/{brandsUid}/facets
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1brands~1{brandsUid}~1facets/get
     *
     * Query params ($params; `?` = optional):
     *   classId5ExcludeList?: string — CSV of class_id5 values to exclude
     *   classId5List?: string — CSV of class_id5 values to include
     *   discontinuedAny?: string — Discontinued filter [Y|N|blank]
     *   filters?: string — JSON representation of attribute filters
     *   from?: int — Result offset within the facets result window
     *   q?: string — Search query (optional keyword narrowing within the brand)
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
     * @param int $brandsUid Brand ID (brands.brands_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listFacets(int $brandsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{brandsUid}/facets',
            $params,
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /brands/{brandsUid}/items
     *
     * List items for a brand
     * Call: $api->items->brands->listItems($brandsUid)
     *
     * Response data: A page of a brand's items from the items index
     *
     * Errors:
     *   400: Invalid sortBy '...': MUST be one field|ASC or field|DESC, the field a keyword or
     *       numeric field of the items index.
     *
     * GET https://items.augur-api.com/brands/{brandsUid}/items
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1brands~1{brandsUid}~1items/get
     *
     * Query params ($params; `?` = optional):
     *   classId5ExcludeList?: string — List of excluded class 5 values (default:blank)
     *   classId5List?: string — List of allowed class 5 values (default:blank)
     *   displayOnWebFlag?: string — Display on web flag [Y|N|Blank] (Default: Blank)
     *   fields?: string — fields to filter with (Default: itemId, itemDesc, ExtendedDesc)
     *   filters?: string — A JSON representation of the filters [{attributeUid:attributeValueUid}]
     *   includeStock?: string — Include Stock [Y|N] (Default: N)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   q?: string — search query (optional)
     *   sortBy?: string — Items index field|direction, snake_case. Field MUST be a keyword or
     *       numeric field (e.g. item_id, item_desc_keyword, short_code, inv_mast_uid, price1); text
     *       fields such as item_desc return 400. Default (empty or relevance): relevance order when
     *       q is set, item_id|ASC otherwise. sortOrder, if sent, supplies a missing direction
     *   sortOrder?: string — Sort direction (ASC or DESC); applies only when sortBy carries no
     *       direction
     *   tags?: string — A CSV of tags
     *   variantFilter?: string — Filter variants [primary_only] (Default: blank)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: BrandsItemsListData (fields listed on the class)
     *
     * @param int $brandsUid Brand ID (brands.brands_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listItems(int $brandsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{brandsUid}/items',
            $params,
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /brands/{brandsUid}/items
     *
     * Assign an item to a brand
     * Call: $api->items->brands->createItems($brandsUid, $data)
     *
     * Assign an item to a brand (create or restore)
     *
     * Request body: Assign an item to a brand (the brand comes from the path)
     *
     * POST https://items.augur-api.com/brands/{brandsUid}/items
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1brands~1{brandsUid}~1items/post
     *
     * Request body ($data): BrandsItemsCreateBody (fields listed on the class)
     *
     * Response data type: BrandsItemsCreateData (fields listed on the class)
     *
     * @param int $brandsUid Brand ID (brands.brands_uid)
     * @param BrandsItemsCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createItems(int $brandsUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{brandsUid}/items',
            $data,
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /brands/{brandsUid}/items/{brandsXItemsUid}
     *
     * Soft-delete a brand-to-item assignment
     * Call: $api->items->brands->deleteItems($brandsUid, $brandsXItemsUid)
     *
     * Errors:
     *   404: No record with this ID.
     *
     * DELETE https://items.augur-api.com/brands/{brandsUid}/items/{brandsXItemsUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1brands~1{brandsUid}~1items~1{brandsXItemsUid}/delete
     *
     * Response data type: BrandsItemsCreateData (fields listed on the class)
     *
     * @param int $brandsUid Brand ID (brands.brands_uid)
     * @param int $brandsXItemsUid Brand-to-item assignment ID (brands_x_items.brands_x_items_uid)
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteItems(int $brandsUid, int $brandsXItemsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{brandsUid}/items/{brandsXItemsUid}',
            ['brandsUid' => (string) $brandsUid, 'brandsXItemsUid' => (string) $brandsXItemsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /brands/{brandsUid}/items/{brandsXItemsUid}
     *
     * Get a brand-to-item assignment
     * Call: $api->items->brands->getItems($brandsUid, $brandsXItemsUid)
     *
     * Get a brand-to-item assignment by UID
     *
     * GET https://items.augur-api.com/brands/{brandsUid}/items/{brandsXItemsUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1brands~1{brandsUid}~1items~1{brandsXItemsUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: BrandsItemsCreateData (fields listed on the class)
     *
     * @param int $brandsUid Brand ID (brands.brands_uid)
     * @param int $brandsXItemsUid Brand-to-item assignment ID (brands_x_items.brands_x_items_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getItems(int $brandsUid, int $brandsXItemsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{brandsUid}/items/{brandsXItemsUid}',
            $params,
            ['brandsUid' => (string) $brandsUid, 'brandsXItemsUid' => (string) $brandsXItemsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /brands/{brandsUid}/items/{brandsXItemsUid}
     *
     * Update a brand-to-item assignment
     * Call: $api->items->brands->updateItems($brandsUid, $brandsXItemsUid, $data)
     *
     * Request body: Change a brand-to-item assignment; every field is optional and an absent field
     * keeps its value
     *
     * Errors:
     *   404: No record with this ID.
     *
     * PUT https://items.augur-api.com/brands/{brandsUid}/items/{brandsXItemsUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1brands~1{brandsUid}~1items~1{brandsXItemsUid}/put
     *
     * Request body ($data): BrandsItemsUpdateBody (fields listed on the class)
     *
     * Response data type: BrandsItemsCreateData (fields listed on the class)
     *
     * @param int $brandsUid Brand ID (brands.brands_uid)
     * @param int $brandsXItemsUid Brand-to-item assignment ID (brands_x_items.brands_x_items_uid)
     * @param BrandsItemsUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateItems(int $brandsUid, int $brandsXItemsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{brandsUid}/items/{brandsXItemsUid}',
            $data,
            ['brandsUid' => (string) $brandsUid, 'brandsXItemsUid' => (string) $brandsXItemsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
