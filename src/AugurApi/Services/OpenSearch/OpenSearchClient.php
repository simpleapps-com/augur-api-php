<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\OpenSearch\Resources\ItemSearchFacetsResource;
use AugurApi\Services\OpenSearch\Resources\ItemSearchResource;
use AugurApi\Services\OpenSearch\Resources\ItemsResource;
use AugurApi\Services\OpenSearch\Resources\QueryStringRedirectResource;
use AugurApi\Services\OpenSearch\Resources\SuggestionsResource;

/**
 * OpenSearch service client — generated from spec.
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
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /item-search → $api->openSearch->itemSearch->list() → ItemSearchListData
 *   GET /item-search-facets → $api->openSearch->itemSearchFacets->list() → ItemSearchFacetsListData
 *   GET /item-search/attributes → $api->openSearch->itemSearch->listAttributes() →
 *       ItemSearchAttributesListData
 *   GET /items → $api->openSearch->items->list() → list of ItemsListItem
 *   PUT /items/refresh → $api->openSearch->items->updateRefresh($data) → bool
 *   GET /items/{invMastUid} → $api->openSearch->items->get($invMastUid) → ItemsListItem
 *   PUT /items/{invMastUid} → $api->openSearch->items->update($invMastUid, $data) → ItemsListItem
 *   GET /items/{invMastUid}/refresh → $api->openSearch->items->getRefresh($invMastUid) →
 *       ItemsListItem
 *   GET /query-string-redirect → $api->openSearch->queryStringRedirect->list() →
 *       list of QueryStringRedirectListItem
 *   POST /query-string-redirect → $api->openSearch->queryStringRedirect->create($data) →
 *       QueryStringRedirectListItem
 *   GET /query-string-redirect/{queryStringRedirectUid} →
 *       $api->openSearch->queryStringRedirect->get($queryStringRedirectUid) →
 *       QueryStringRedirectListItem
 *   PUT /query-string-redirect/{queryStringRedirectUid} →
 *       $api->openSearch->queryStringRedirect->update($queryStringRedirectUid, $data) →
 *       QueryStringRedirectListItem
 *   DELETE /query-string-redirect/{queryStringRedirectUid} →
 *       $api->openSearch->queryStringRedirect->delete($queryStringRedirectUid) →
 *       QueryStringRedirectListItem
 *   GET /suggestions → $api->openSearch->suggestions->list() → list of SuggestionsListItem
 *   GET /suggestions/suggest → $api->openSearch->suggestions->listSuggest() →
 *       list of SuggestionsSuggestListItem
 *   GET /suggestions/{suggestionsUid} → $api->openSearch->suggestions->get($suggestionsUid) →
 *       SuggestionsListItem
 */
final class OpenSearchClient extends BaseServiceClient
{
    public readonly ItemSearchResource $itemSearch;
    public readonly ItemSearchFacetsResource $itemSearchFacets;
    public readonly ItemsResource $items;
    public readonly QueryStringRedirectResource $queryStringRedirect;
    public readonly SuggestionsResource $suggestions;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->itemSearch = new ItemSearchResource($this->client, $this->baseUrl . '/item-search');
        $this->itemSearchFacets = new ItemSearchFacetsResource($this->client, $this->baseUrl . '/item-search-facets');
        $this->items = new ItemsResource($this->client, $this->baseUrl . '/items');
        $this->queryStringRedirect = new QueryStringRedirectResource($this->client, $this->baseUrl . '/query-string-redirect');
        $this->suggestions = new SuggestionsResource($this->client, $this->baseUrl . '/suggestions');
    }

    protected function getServiceName(): string
    {
        return 'openSearch';
    }
}
