<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\OpenSearch\Resources\ItemSearchResource;
use AugurApi\Services\OpenSearch\Resources\ItemsResource;
use AugurApi\Services\OpenSearch\Resources\SuggestionsResource;

/**
 * OpenSearch service client.
 *
 * @fullPath api.openSearch
 * @service open_search
 * @domain search
 */
final class OpenSearchClient extends BaseServiceClient
{
    public readonly ItemSearchResource $itemSearch;
    public readonly ItemsResource $items;
    public readonly SuggestionsResource $suggestions;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->itemSearch = new ItemSearchResource($client, $this->baseUrl);
        $this->items = new ItemsResource($client, $this->baseUrl);
        $this->suggestions = new SuggestionsResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'openSearch';
    }
}
