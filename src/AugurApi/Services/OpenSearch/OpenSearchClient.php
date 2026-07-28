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
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py open-search
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
        $this->itemSearch = new ItemSearchResource($client, $this->baseUrl . '/item-search');
        $this->itemSearchFacets = new ItemSearchFacetsResource($client, $this->baseUrl . '/item-search-facets');
        $this->items = new ItemsResource($client, $this->baseUrl . '/items');
        $this->queryStringRedirect = new QueryStringRedirectResource($client, $this->baseUrl . '/query-string-redirect');
        $this->suggestions = new SuggestionsResource($client, $this->baseUrl . '/suggestions');
    }

    protected function getServiceName(): string
    {
        return 'openSearch';
    }
}
