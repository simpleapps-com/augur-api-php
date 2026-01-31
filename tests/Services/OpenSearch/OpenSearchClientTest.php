<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\OpenSearch;

use AugurApi\Services\OpenSearch\OpenSearchClient;
use AugurApi\Services\OpenSearch\Resources\ItemSearchResource;
use AugurApi\Services\OpenSearch\Resources\ItemsResource;
use AugurApi\Services\OpenSearch\Resources\SuggestionsResource;
use AugurApi\Tests\AugurApiTestCase;

final class OpenSearchClientTest extends AugurApiTestCase
{
    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();

        $response = $this->api->openSearch->healthCheck();

        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();

        $response = $this->api->openSearch->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();

        $response = $this->api->openSearch->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
    }

    public function testItemSearchResourceAccess(): void
    {
        $this->assertInstanceOf(ItemSearchResource::class, $this->api->openSearch->itemSearch);
    }

    public function testItemsResourceAccess(): void
    {
        $this->assertInstanceOf(ItemsResource::class, $this->api->openSearch->items);
    }

    public function testSuggestionsResourceAccess(): void
    {
        $this->assertInstanceOf(SuggestionsResource::class, $this->api->openSearch->suggestions);
    }

    public function testServiceClientIsCached(): void
    {
        $openSearch1 = $this->api->openSearch;
        $openSearch2 = $this->api->openSearch;

        $this->assertSame($openSearch1, $openSearch2);
    }

    public function testServiceClientType(): void
    {
        $this->assertInstanceOf(OpenSearchClient::class, $this->api->openSearch);
    }
}
