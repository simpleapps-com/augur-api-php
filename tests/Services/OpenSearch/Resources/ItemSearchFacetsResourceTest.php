<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\OpenSearch\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for OpenSearch ItemSearchFacetsResource.
 */
final class ItemSearchFacetsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['name' => 'brand', 'count' => 12],
            ['name' => 'category', 'count' => 5],
        ]);

        $response = $this->api->openSearch->itemSearchFacets->list();

        $this->assertCount(2, $response->data);
        $this->assertRequestPath('/item-search-facets');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['name' => 'brand', 'count' => 12],
        ]);

        $response = $this->api->openSearch->itemSearchFacets->list(['q' => 'widget']);

        $this->assertCount(1, $response->data);
        $this->assertStringContainsString('q=widget', $this->getLastRequest()->getUri()->getQuery());
    }
}
