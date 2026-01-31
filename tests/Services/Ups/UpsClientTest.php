<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Ups;

use AugurApi\Services\Ups\Resources\RatesShopResource;
use AugurApi\Services\Ups\UpsClient;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for UpsClient.
 */
final class UpsClientTest extends AugurApiTestCase
{
    public function testUpsClientAccess(): void
    {
        $this->assertInstanceOf(UpsClient::class, $this->api->ups);
    }

    public function testRatesShopResourceAccess(): void
    {
        $this->assertInstanceOf(RatesShopResource::class, $this->api->ups->ratesShop);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->ups->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->ups->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->ups->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }
}
