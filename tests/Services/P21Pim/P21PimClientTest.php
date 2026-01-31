<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Pim;

use AugurApi\Services\P21Pim\P21PimClient;
use AugurApi\Services\P21Pim\Resources\InvMastExtResource;
use AugurApi\Services\P21Pim\Resources\ItemsResource;
use AugurApi\Services\P21Pim\Resources\PodcastsResource;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for P21PimClient.
 *
 * @covers \AugurApi\Services\P21Pim\P21PimClient
 */
final class P21PimClientTest extends AugurApiTestCase
{
    public function testP21PimClientAccess(): void
    {
        $this->assertInstanceOf(P21PimClient::class, $this->api->p21Pim);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->p21Pim->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->p21Pim->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->p21Pim->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testInvMastExtResourceAccess(): void
    {
        $this->assertInstanceOf(InvMastExtResource::class, $this->api->p21Pim->invMastExt);
    }

    public function testItemsResourceAccess(): void
    {
        $this->assertInstanceOf(ItemsResource::class, $this->api->p21Pim->items);
    }

    public function testPodcastsResourceAccess(): void
    {
        $this->assertInstanceOf(PodcastsResource::class, $this->api->p21Pim->podcasts);
    }
}
