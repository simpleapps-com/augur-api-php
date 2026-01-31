<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Logistics;

use AugurApi\Services\Logistics\LogisticsClient;
use AugurApi\Services\Logistics\Resources\ShipviaResource;
use AugurApi\Services\Logistics\Resources\SpeedshipResource;
use AugurApi\Tests\AugurApiTestCase;

final class LogisticsClientTest extends AugurApiTestCase
{
    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();

        $response = $this->api->logistics->healthCheck();

        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();

        $response = $this->api->logistics->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();

        $response = $this->api->logistics->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
    }

    public function testShipviaResourceAccess(): void
    {
        $this->assertInstanceOf(ShipviaResource::class, $this->api->logistics->shipvia);
    }

    public function testSpeedshipResourceAccess(): void
    {
        $this->assertInstanceOf(SpeedshipResource::class, $this->api->logistics->speedship);
    }

    public function testServiceClientIsCached(): void
    {
        $logistics1 = $this->api->logistics;
        $logistics2 = $this->api->logistics;

        $this->assertSame($logistics1, $logistics2);
    }

    public function testServiceClientType(): void
    {
        $this->assertInstanceOf(LogisticsClient::class, $this->api->logistics);
    }
}
