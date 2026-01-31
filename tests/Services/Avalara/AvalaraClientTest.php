<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Avalara;

use AugurApi\Services\Avalara\AvalaraClient;
use AugurApi\Services\Avalara\Resources\RatesResource;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for AvalaraClient.
 */
final class AvalaraClientTest extends AugurApiTestCase
{
    public function testAvalaraClientAccess(): void
    {
        $this->assertInstanceOf(AvalaraClient::class, $this->api->avalara);
    }

    public function testRatesResourceAccess(): void
    {
        $this->assertInstanceOf(RatesResource::class, $this->api->avalara->rates);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->avalara->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->avalara->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->avalara->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }
}
