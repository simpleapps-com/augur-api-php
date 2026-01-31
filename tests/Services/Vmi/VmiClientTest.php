<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Vmi;

use AugurApi\Services\Vmi\Resources\DistributorsResource;
use AugurApi\Services\Vmi\Resources\InvProfileHdrResource;
use AugurApi\Services\Vmi\Resources\ProductsResource;
use AugurApi\Services\Vmi\Resources\RestockHdrResource;
use AugurApi\Services\Vmi\Resources\SectionsResource;
use AugurApi\Services\Vmi\Resources\WarehouseResource;
use AugurApi\Services\Vmi\VmiClient;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for VmiClient.
 *
 * @covers \AugurApi\Services\Vmi\VmiClient
 */
final class VmiClientTest extends AugurApiTestCase
{
    public function testVmiClientAccess(): void
    {
        $this->assertInstanceOf(VmiClient::class, $this->api->vmi);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->vmi->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->vmi->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->vmi->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testDistributorsResourceAccess(): void
    {
        $this->assertInstanceOf(DistributorsResource::class, $this->api->vmi->distributors);
    }

    public function testInvProfileHdrResourceAccess(): void
    {
        $this->assertInstanceOf(InvProfileHdrResource::class, $this->api->vmi->invProfileHdr);
    }

    public function testProductsResourceAccess(): void
    {
        $this->assertInstanceOf(ProductsResource::class, $this->api->vmi->products);
    }

    public function testRestockHdrResourceAccess(): void
    {
        $this->assertInstanceOf(RestockHdrResource::class, $this->api->vmi->restockHdr);
    }

    public function testSectionsResourceAccess(): void
    {
        $this->assertInstanceOf(SectionsResource::class, $this->api->vmi->sections);
    }

    public function testWarehouseResourceAccess(): void
    {
        $this->assertInstanceOf(WarehouseResource::class, $this->api->vmi->warehouse);
    }
}
