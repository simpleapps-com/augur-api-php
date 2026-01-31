<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\SmartyStreets;

use AugurApi\Services\SmartyStreets\Resources\UsResource;
use AugurApi\Services\SmartyStreets\SmartyStreetsClient;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for SmartyStreetsClient.
 */
final class SmartyStreetsClientTest extends AugurApiTestCase
{
    public function testSmartyStreetsClientAccess(): void
    {
        $this->assertInstanceOf(SmartyStreetsClient::class, $this->api->smartyStreets);
    }

    public function testUsResourceAccess(): void
    {
        $this->assertInstanceOf(UsResource::class, $this->api->smartyStreets->us);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->smartyStreets->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->smartyStreets->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->smartyStreets->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }
}
