<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * contracts resource — generated from spec.
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
 * BrandsAttributesListData: The filterable attributes of a category, brand or contract
 * Returned by: $api->items->contracts->listAttributes($jobNo)
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
 * Returned by: $api->items->contracts->listFacets($jobNo)
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
 *   score: float|null — OpenSearch relevance score, or null when the search was sorted
 *   brandFolder?: BrandsFacetsListDataItemsItemBrandFolder|null — Brandfolder assets; the key is
 *       present only when useBrandFolderDoc=Y
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
 * ContractsItemsListData: A page of the items priced on a contract (job), from the items index
 * Returned by: $api->items->contracts->listItems($jobNo)
 *   took: int — OpenSearch query time in milliseconds
 *   total: int — Total matching items in the index
 *   items: list<ContractsItemsListDataItemsItem> — The items on this page
 *     each item: ContractsItemsListDataItemsItem — One item priced on a contract (job)
 *   count: int — Number of entries in items
 *
 * ContractsItemsListDataItemsItem: One item priced on a contract (job)
 * Field `items` of ContractsItemsListData
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   itemId: string — Item code; empty when the index has none
 *   itemDesc: string — Item description; empty when the index has none
 *   extendedDesc: string — Extended description; empty when the index has none
 *
 * @phpstan-type BrandsAttributesListData array{attributes: list<BrandsAttributesListDataAttributesItem>}
 * @phpstan-type BrandsAttributesListDataAttributesItem array{attributeUid: int, attributeId: string, attributeDesc: string|null, sequenceNo: int|null, values: list<BrandsAttributesListDataAttributesItemValuesItem>, valueCount?: int|null}
 * @phpstan-type BrandsAttributesListDataAttributesItemValuesItem array{attributeValueUid: int, attributeValue: string, sequenceNo: int|null}
 * @phpstan-type BrandsFacetsListData array{meta: BrandsFacetsListDataMeta, items: list<BrandsFacetsListDataItemsItem>, facets: list<BrandsFacetsListDataFacetsItem>}
 * @phpstan-type BrandsFacetsListDataMeta array{took: int, total: int, pageableTotal: int, maxScore: float|null}
 * @phpstan-type BrandsFacetsListDataItemsItem array{score: float|null, brandFolder?: BrandsFacetsListDataItemsItemBrandFolder|null}
 * @phpstan-type BrandsFacetsListDataItemsItemBrandFolder array{assets?: list<BrandsFacetsListDataItemsItemBrandFolderAssetsItem>|null}
 * @phpstan-type BrandsFacetsListDataItemsItemBrandFolderAssetsItem array{id: string, name: string|null, attachmentName: string|null, cdnLink: string, layout: string}
 * @phpstan-type BrandsFacetsListDataFacetsItem array{attributeUid: int, attributeId: string, label: string, sequence: int, headCoveragePct: float, values: list<BrandsFacetsListDataFacetsItemValuesItem>}
 * @phpstan-type BrandsFacetsListDataFacetsItemValuesItem array{valueUid: int, label: string, sequence: int, count: int}
 * @phpstan-type ContractsItemsListData array{took: int, total: int, items: list<ContractsItemsListDataItemsItem>, count: int}
 * @phpstan-type ContractsItemsListDataItemsItem array{invMastUid: int, itemId: string, itemDesc: string, extendedDesc: string}
 */
final class ContractsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /contracts/{jobNo}/attributes
     *
     * list the attributes for contract items
     * Call: $api->items->contracts->listAttributes($jobNo)
     *
     * Response data: The filterable attributes of a category, brand or contract
     *
     * GET https://items.augur-api.com/contracts/{jobNo}/attributes
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1contracts~1{jobNo}~1attributes/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: BrandsAttributesListData (fields listed on the class)
     *
     * @param int $jobNo Job number
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAttributes(int $jobNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{jobNo}/attributes',
            $params,
            ['jobNo' => (string) $jobNo],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /contracts/{jobNo}/facets
     *
     * result-set self-filtering facets and hydrated items for a contract
     * Call: $api->items->contracts->listFacets($jobNo)
     *
     * Response data: Faceted item search: the page of hydrated items, hit metadata, and attribute
     * facets (GET /api/item-search-facets)
     *
     * Errors:
     *   400: Invalid sort '...': MUST be field|asc or field|desc, comma-separated, each field a
     *       keyword or numeric field of the items index.
     *
     * GET https://items.augur-api.com/contracts/{jobNo}/facets
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1contracts~1{jobNo}~1facets/get
     *
     * Query params ($params; `?` = optional):
     *   classId5ExcludeList?: string — CSV of class_id5 values to exclude
     *   classId5List?: string — CSV of class_id5 values to include
     *   discontinuedAny?: string — Discontinued filter [Y|N|blank]
     *   filters?: string — JSON representation of attribute filters
     *   from?: int — Result offset within the facets result window
     *   q?: string — Search query (optional keyword narrowing within the contract)
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
     * @param int $jobNo Job number
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listFacets(int $jobNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{jobNo}/facets',
            $params,
            ['jobNo' => (string) $jobNo],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /contracts/{jobNo}/items
     *
     * List contracts items for a job
     * Call: $api->items->contracts->listItems($jobNo)
     *
     * Response data: A page of the items priced on a contract (job), from the items index
     *
     * Errors:
     *   400: Invalid sortBy '...': MUST be one field|ASC or field|DESC, the field a keyword or
     *       numeric field of the items index.
     *
     * GET https://items.augur-api.com/contracts/{jobNo}/items
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1contracts~1{jobNo}~1items/get
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
     * Response data type: ContractsItemsListData (fields listed on the class)
     *
     * @param int $jobNo Job number
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listItems(int $jobNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{jobNo}/items',
            $params,
            ['jobNo' => (string) $jobNo],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
