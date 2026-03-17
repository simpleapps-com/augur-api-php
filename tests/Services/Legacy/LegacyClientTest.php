<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Legacy;

use AugurApi\Services\Legacy\LegacyClient;
use AugurApi\Services\Legacy\Resources\InvMastResource;
use AugurApi\Services\Legacy\Resources\ItemCategoryResource;
use AugurApi\Services\Legacy\Resources\LegacyResource;
use AugurApi\Services\Legacy\Resources\OrdersResource;
use AugurApi\Tests\AugurApiTestCase;

final class LegacyClientTest extends AugurApiTestCase
{
    public function testLegacyClientAccess(): void
    {
        $this->assertInstanceOf(LegacyClient::class, $this->api->legacy);
    }

    public function testInvMastResourceAccess(): void
    {
        $this->assertInstanceOf(InvMastResource::class, $this->api->legacy->invMast);
    }

    public function testItemCategoryResourceAccess(): void
    {
        $this->assertInstanceOf(ItemCategoryResource::class, $this->api->legacy->itemCategory);
    }

    public function testLegacyResourceAccess(): void
    {
        $this->assertInstanceOf(LegacyResource::class, $this->api->legacy->legacy);
    }

    public function testOrdersResourceAccess(): void
    {
        $this->assertInstanceOf(OrdersResource::class, $this->api->legacy->orders);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->legacy->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->legacy->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->legacy->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testServiceClientIsCached(): void
    {
        $legacy1 = $this->api->legacy;
        $legacy2 = $this->api->legacy;
        $this->assertSame($legacy1, $legacy2);
    }
}
