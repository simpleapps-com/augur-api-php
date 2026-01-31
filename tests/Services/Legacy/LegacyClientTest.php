<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Legacy;

use AugurApi\Services\Legacy\LegacyClient;
use AugurApi\Services\Legacy\Resources\AlsoBoughtResource;
use AugurApi\Services\Legacy\Resources\InvMastTagsResource;
use AugurApi\Services\Legacy\Resources\InvMastWebDescResource;
use AugurApi\Services\Legacy\Resources\ItemCategoryResource;
use AugurApi\Services\Legacy\Resources\OrdersResource;
use AugurApi\Services\Legacy\Resources\StateResource;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for LegacyClient.
 */
final class LegacyClientTest extends AugurApiTestCase
{
    public function testLegacyClientAccess(): void
    {
        $this->assertInstanceOf(LegacyClient::class, $this->api->legacy);
    }

    public function testAlsoBoughtResourceAccess(): void
    {
        $this->assertInstanceOf(AlsoBoughtResource::class, $this->api->legacy->alsoBought);
    }

    public function testInvMastTagsResourceAccess(): void
    {
        $this->assertInstanceOf(InvMastTagsResource::class, $this->api->legacy->invMastTags);
    }

    public function testInvMastWebDescResourceAccess(): void
    {
        $this->assertInstanceOf(InvMastWebDescResource::class, $this->api->legacy->invMastWebDesc);
    }

    public function testItemCategoryResourceAccess(): void
    {
        $this->assertInstanceOf(ItemCategoryResource::class, $this->api->legacy->itemCategory);
    }

    public function testOrdersResourceAccess(): void
    {
        $this->assertInstanceOf(OrdersResource::class, $this->api->legacy->orders);
    }

    public function testStateResourceAccess(): void
    {
        $this->assertInstanceOf(StateResource::class, $this->api->legacy->state);
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
}
