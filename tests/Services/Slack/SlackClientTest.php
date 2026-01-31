<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Slack;

use AugurApi\Services\Slack\Resources\WebHookResource;
use AugurApi\Services\Slack\SlackClient;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for SlackClient.
 */
final class SlackClientTest extends AugurApiTestCase
{
    public function testSlackClientAccess(): void
    {
        $this->assertInstanceOf(SlackClient::class, $this->api->slack);
    }

    public function testWebHookResourceAccess(): void
    {
        $this->assertInstanceOf(WebHookResource::class, $this->api->slack->webHook);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->slack->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->slack->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->slack->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }
}
