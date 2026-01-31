<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Shipping;

use AugurApi\Services\Shipping\Resources\RatesResource;
use AugurApi\Services\Shipping\ShippingClient;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ShippingClient.
 */
final class ShippingClientTest extends AugurApiTestCase
{
    public function testShippingClientAccess(): void
    {
        $this->assertInstanceOf(ShippingClient::class, $this->api->shipping);
    }

    public function testRatesResourceAccess(): void
    {
        $this->assertInstanceOf(RatesResource::class, $this->api->shipping->rates);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->shipping->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->shipping->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->shipping->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }
}
