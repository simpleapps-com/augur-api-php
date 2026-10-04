<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * itemSearchFacets resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://open-search.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path,
 *       path params and query params, each with type and required flag. Grep it for a path; for a
 *       GET that line is all you need. Bodies are not in it.
 *   https://open-search.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://open-search.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py open-search
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ItemSearchFacetsListData: Faceted item search: the page of hydrated items, hit metadata, and
 * attribute facets (GET /api/item-search-facets)
 * Returned by: $api->openSearch->itemSearchFacets->list()
 *   meta: ItemSearchFacetsListDataMeta — Query time and hit totals
 *   items: list<ItemSearchFacetsListDataItemsItem> — Matching items for the requested page
 *     each item: ItemSearchFacetsListDataItemsItem — One item hit: the items service inv_mast doc
 *         (GET /api/items/{invMastUid}) plus its search score
 *   facets: list<ItemSearchFacetsListDataFacetsItem> — Attribute facets, in attribute sequence
 *       order
 *     each item: ItemSearchFacetsListDataFacetsItem — One attribute facet over the search result
 *         set, with its values
 *
 * ItemSearchFacetsListDataMeta: Query time and hit totals
 * Field `meta` of ItemSearchFacetsListData
 *   took: int — OpenSearch query time in milliseconds
 *   total: int — Total hits for the query, unfiltered by paging
 *   pageableTotal: int — Hits reachable through from/size (total capped at the result window)
 *   maxScore: float|null — Highest relevance score, or null when the search was sorted
 *
 * ItemSearchFacetsListDataItemsItem: One item hit: the items service inv_mast doc (GET
 * /api/items/{invMastUid}) plus its search score
 * Field `items` of ItemSearchFacetsListData
 *   score: int|float|null — OpenSearch relevance score, or null when the search was sorted
 *   brandFolder?: ItemSearchListDataItemsItemBrandFolder — Brandfolder assets; the key is present
 *       only when useBrandFolderDoc=Y
 *
 * ItemSearchListDataItemsItemBrandFolder: Brandfolder assets; the key is present only when
 * useBrandFolderDoc=Y
 * Field `brandFolder` of ItemSearchFacetsListDataItemsItem
 *   assets?: list<ItemSearchListDataItemsItemBrandFolderAssetsItem>|null — Active assets linked to
 *       the item; the key is absent when the lookup failed
 *     each item: ItemSearchListDataItemsItemBrandFolderAssetsItem — One Brandfolder asset linked to
 *         an item
 *
 * ItemSearchListDataItemsItemBrandFolderAssetsItem: One Brandfolder asset linked to an item
 * Field `assets` of ItemSearchListDataItemsItemBrandFolder
 *   id: string — Brandfolder asset ID
 *   name: string|null — Asset name
 *   attachmentName: string|null — First attachment's file name
 *   cdnLink: string — CDN URL of the asset
 *   layout: string — Attachment layout (square when unknown)
 *
 * ItemSearchFacetsListDataFacetsItem: One attribute facet over the search result set, with its
 * values
 * Field `facets` of ItemSearchFacetsListData
 *   attributeUid: int — attribute_uid of the facet
 *   attributeId: string — Attribute ID
 *   label: string — Attribute description shown as the facet heading
 *   sequence: int — Facet display order: lowest attribute-group sequence (9999 when none)
 *   headCoveragePct: float — Percent of the sampled top hits carrying this attribute, one decimal
 *   values: list<ItemSearchFacetsListDataFacetsItemValuesItem> — Values with counts, highest count
 *       first
 *     each item: ItemSearchFacetsListDataFacetsItemValuesItem — One attribute value offered as a
 *         facet filter, with its hit count
 *
 * ItemSearchFacetsListDataFacetsItemValuesItem: One attribute value offered as a facet filter, with
 * its hit count
 * Field `values` of ItemSearchFacetsListDataFacetsItem
 *   valueUid: int — attribute_value_uid to pass back in filters
 *   label: string — Attribute value text (empty when the value row is missing)
 *   sequence: int — Value display sequence (0 when the value row is missing)
 *   count: int — Items in the result set carrying this value
 *
 * @phpstan-type ItemSearchFacetsListData array{meta: ItemSearchFacetsListDataMeta, items: list<ItemSearchFacetsListDataItemsItem>, facets: list<ItemSearchFacetsListDataFacetsItem>}
 * @phpstan-type ItemSearchFacetsListDataMeta array{took: int, total: int, pageableTotal: int, maxScore: float|null}
 * @phpstan-type ItemSearchFacetsListDataItemsItem array{score: int|float|null, brandFolder?: ItemSearchListDataItemsItemBrandFolder}
 * @phpstan-type ItemSearchListDataItemsItemBrandFolder array{assets?: list<ItemSearchListDataItemsItemBrandFolderAssetsItem>|null}
 * @phpstan-type ItemSearchListDataItemsItemBrandFolderAssetsItem array{id: string, name: string|null, attachmentName: string|null, cdnLink: string, layout: string}
 * @phpstan-type ItemSearchFacetsListDataFacetsItem array{attributeUid: int, attributeId: string, label: string, sequence: int, headCoveragePct: float, values: list<ItemSearchFacetsListDataFacetsItemValuesItem>}
 * @phpstan-type ItemSearchFacetsListDataFacetsItemValuesItem array{valueUid: int, label: string, sequence: int, count: int}
 */
final class ItemSearchFacetsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /item-search-facets
     *
     * Search items with self-filtering, result-set-derived facets
     * Call: $api->openSearch->itemSearchFacets->list()
     *
     * Response data: Faceted item search: the page of hydrated items, hit metadata, and attribute
     * facets (GET /api/item-search-facets)
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://open-search.augur-api.com/item-search-facets
     * Contract: https://open-search.augur-api.com/openapi.json#/paths/~1item-search-facets/get
     *
     * Query params ($params; `?` = optional):
     *   classId5ExcludeList?: string — list of inv_mast.class_id5 values to exclude (CSV)
     *   classId5List?: string — list of inv_mast.class_id5 values (CSV)
     *   discontinuedAny?: string — Filter by discontinued status [Y|N]
     *   fields?: string — list of fields to query (CSV)
     *   filters?: string — A JSON representation of the filters [[attributeUid,attributeValueUid]]
     *   from?: int — return results starting FROM this index (bounded by the facet window, see
     *       size)
     *   itemCategoryUidList?: string — CSV of itemCategoryUids to limit search results
     *   jobNumbers?: string — A CSV of job numbers to filter
     *   operator?: string — search operator [AND|OR] (Default: AND)
     *   parentCategoryUid?: int — item_category_uid as parent with all children included
     *   q: string — search query
     *   searchType?: string — Type of search: [similarity|query] (Default: query)
     *   size?: int — page size, bounded by the facet window (RESULT_WINDOW = 200)
     *   sort?: string — Comma-separated items index field|direction, snake_case (e.g., price1|asc,
     *       item_desc_keyword|asc, item_id|asc); does not affect facet selection. Field MUST be a
     *       keyword or numeric field; text fields such as item_desc return 400. Empty or relevance
     *       sorts by relevance
     *   sourceFieldsList?: string — unused: every item is already hydrated to the full inv_mast doc
     *   stockStatus?: string — Filter by stock status [in_stock|out_of_stock]
     *   tags?: string — A CSV of tags to filter
     *   useBrandFolderDoc?: string — Include brand folder doc: [Y|N] (Default: N)
     *   variantFilter?: string — Filter variants [primary_only] (Default: blank)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ItemSearchFacetsListData (fields listed on the class)
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
}
