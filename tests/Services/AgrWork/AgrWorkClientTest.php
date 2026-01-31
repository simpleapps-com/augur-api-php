<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrWork;

use AugurApi\Services\AgrWork\AgrWorkClient;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for AgrWorkClient.
 */
final class AgrWorkClientTest extends AugurApiTestCase
{
    public function testAgrWorkClientAccess(): void
    {
        $this->assertInstanceOf(AgrWorkClient::class, $this->api->agrWork);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->agrWork->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->agrWork->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->agrWork->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }
}
