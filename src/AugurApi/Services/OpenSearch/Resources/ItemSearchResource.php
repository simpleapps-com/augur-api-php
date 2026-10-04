<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * itemSearch resource — generated from spec.
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
 * ItemSearchListData: Item search results with hit totals and the query string's redirect (GET
 * /api/item-search)
 * Returned by: $api->openSearch->itemSearch->list()
 *   items: list<ItemSearchListDataItemsItem> — Matching items for the requested page
 *     each item: ItemSearchListDataItemsItem — One item hit from GET /api/item-search
 *   totalResults: int — Total hits for the query
 *   maxScore: int|float|null — Highest relevance score among the hits (0 when the search returned
 *       no metadata)
 *   took: int — OpenSearch query time in milliseconds
 *   queryStringUid: int — query_string row recorded for this search text (0 when not recorded)
 *   queryStringRedirectLink: string|bool — Redirect link configured for this search text, or false
 *       when none
 *
 * ItemSearchListDataItemsItem: One item hit from GET /api/item-search
 * Field `items` of ItemSearchListData
 *   invMastUid: int — Item (inv_mast) ID
 *   itemId: string|null — Item ID
 *   itemDesc: string|null — Item description
 *   score: float|null — OpenSearch relevance score
 *   sourceFields: array<string, mixed>|array{}|null — Index source fields requested through
 *       sourceFieldsList, keyed by field name ([] when empty)
 *   scoreInt: int — Relevance score truncated to an integer
 *   brandFolder?: ItemSearchListDataItemsItemBrandFolder — Brandfolder assets; the key is present
 *       only when useBrandFolderDoc=Y
 *
 * ItemSearchListDataItemsItemBrandFolder: Brandfolder assets; the key is present only when
 * useBrandFolderDoc=Y
 * Field `brandFolder` of ItemSearchListDataItemsItem
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
 * ItemSearchAttributesListData: Attributes available to filter a search, from the categories its
 * results fall in (GET /api/item-search/attributes)
 * Returned by: $api->openSearch->itemSearch->listAttributes()
 *   attributes: list<ItemSearchAttributesListDataAttributesItem> — Filterable attributes, each with
 *       its values
 *     each item: ItemSearchAttributesListDataAttributesItem — One filterable attribute of the
 *         categories the current search results fall in, with its values
 *
 * ItemSearchAttributesListDataAttributesItem: One filterable attribute of the categories the
 * current search results fall in, with its values
 * Field `attributes` of ItemSearchAttributesListData
 *   attributeUid: int — attribute row UID; pass it in the search filters param
 *   attributeId: string — P21 attribute ID
 *   attributeDesc: string|null — Display name of the attribute
 *   sequenceNo: int|null — Display order among the attributes; null when the attribute group sets
 *       none
 *   values: list<ItemSearchAttributesListDataAttributesItemValuesItem> — Values available in the
 *       result categories
 *     each item: ItemSearchAttributesListDataAttributesItemValuesItem — One value of an attribute
 *         available to filter the current search results
 *   valueCount: int — Number of values
 *
 * ItemSearchAttributesListDataAttributesItemValuesItem: One value of an attribute available to
 * filter the current search results
 * Field `values` of ItemSearchAttributesListDataAttributesItem
 *   attributeValueUid: int — attribute_value row UID; pass it in the search filters param
 *   attributeValue: string — Display text of the value
 *   sequenceNo: int — Display order within the attribute
 *
 * @phpstan-type ItemSearchListData array{items: list<ItemSearchListDataItemsItem>, totalResults: int, maxScore: int|float|null, took: int, queryStringUid: int, queryStringRedirectLink: string|bool}
 * @phpstan-type ItemSearchListDataItemsItem array{invMastUid: int, itemId: string|null, itemDesc: string|null, score: float|null, sourceFields: array<string, mixed>|array{}|null, scoreInt: int, brandFolder?: ItemSearchListDataItemsItemBrandFolder}
 * @phpstan-type ItemSearchListDataItemsItemBrandFolder array{assets?: list<ItemSearchListDataItemsItemBrandFolderAssetsItem>|null}
 * @phpstan-type ItemSearchListDataItemsItemBrandFolderAssetsItem array{id: string, name: string|null, attachmentName: string|null, cdnLink: string, layout: string}
 * @phpstan-type ItemSearchAttributesListData array{attributes: list<ItemSearchAttributesListDataAttributesItem>}
 * @phpstan-type ItemSearchAttributesListDataAttributesItem array{attributeUid: int, attributeId: string, attributeDesc: string|null, sequenceNo: int|null, values: list<ItemSearchAttributesListDataAttributesItemValuesItem>, valueCount: int}
 * @phpstan-type ItemSearchAttributesListDataAttributesItemValuesItem array{attributeValueUid: int, attributeValue: string, sequenceNo: int}
 */
final class ItemSearchResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /item-search
     *
     * Search items
     * Call: $api->openSearch->itemSearch->list()
     *
     * Search the items index by text or similarity, with attribute, category and stock filters,
     * sorting and paging; returns the matching items and hit totals
     *
     * Response data: Item search results with hit totals and the query string's redirect (GET
     * /api/item-search)
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://open-search.augur-api.com/item-search
     * Contract: https://open-search.augur-api.com/openapi.json#/paths/~1item-search/get
     *
     * Query params ($params; `?` = optional):
     *   classId5ExcludeList?: string — list of inv_mast.class_id5 values to exclude (CSV)
     *   classId5List?: string — list of inv_mast.class_id5 values (CSV)
     *   discontinuedAny?: string — Filter by discontinued status [Y|N]
     *   fields?: string — list of fields to query (CSV)
     *   filters?: string — A JSON representation of the filters [{attributeUid:attributeValueUid}]
     *   from?: int — return results starting FROM this index
     *   itemCategoryUidList?: string — CSV is itemCategoryUids to limit search results
     *   jobNumbers?: string — A CSV of job numbers to filter
     *   operator?: string — search operator [AND|OR] (Default: OR)
     *   parentCategoryUid?: int — item_category_uid as parent with all children included
     *   q: string — search query
     *   searchType: string — Type of search: [similarity|query] (Default: query)
     *   size?: int — size of search results
     *   sort?: string — Comma-separated items index field|direction, snake_case (e.g., price1|asc,
     *       item_desc_keyword|asc, item_id|asc). Field MUST be a keyword or numeric field; text
     *       fields such as item_desc return 400. Empty or relevance sorts by relevance
     *   sourceFieldsList?: string — list of source_fields to return (CSV)
     *   stockStatus?: string — Filter by stock status [in_stock|out_of_stock]
     *   tags?: string — A CSV of tags to filter
     *   useBrandFolderDoc?: string — Y adds each item's Brand Folder document as brandFolder [Y|N]
     *       (Default: N)
     *   variantFilter?: string — Filter variants [primary_only] (Default: blank)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ItemSearchListData (fields listed on the class)
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
     * GET /item-search/attributes
     *
     * Get Attributes from Item Search
     * Call: $api->openSearch->itemSearch->listAttributes()
     *
     * Response data: Attributes available to filter a search, from the categories its results fall
     * in (GET /api/item-search/attributes)
     *
     * GET https://open-search.augur-api.com/item-search/attributes
     * Contract: https://open-search.augur-api.com/openapi.json#/paths/~1item-search~1attributes/get
     *
     * Query params ($params; `?` = optional):
     *   classId5List?: string — list of inv_mast.class_id5 values (CSV)
     *   fields?: string — list of fields to query (CSV)
     *   filters?: string — A JSON representation of the filters [{attributeUid:attributeValueUid}]
     *   from?: int — return results starting FROM this index
     *   operator?: string — search operator [AND|OR] (Default: OR)
     *   q: string — search query
     *   searchType: string — Type of search: [similarity|query] (Default: query)
     *   size?: int — size of search results
     *   sort?: string — Comma-separated items index field|direction, snake_case (e.g., price1|asc,
     *       item_id|asc). Empty or relevance sorts by relevance
     *   sourceFieldsList?: string — list of source_fields to return (CSV)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ItemSearchAttributesListData (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAttributes(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/attributes', $params);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
