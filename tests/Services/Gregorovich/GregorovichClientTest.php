<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Gregorovich;

use AugurApi\Services\Gregorovich\GregorovichClient;
use AugurApi\Services\Gregorovich\Resources\ChatGptResource;
use AugurApi\Services\Gregorovich\Resources\DocumentsResource;
use AugurApi\Services\Gregorovich\Resources\OllamaResource;
use AugurApi\Tests\AugurApiTestCase;

final class GregorovichClientTest extends AugurApiTestCase
{
    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();

        $response = $this->api->gregorovich->healthCheck();

        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();

        $response = $this->api->gregorovich->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();

        $response = $this->api->gregorovich->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
    }

    public function testChatGptResourceAccess(): void
    {
        $this->assertInstanceOf(ChatGptResource::class, $this->api->gregorovich->chatGpt);
    }

    public function testDocumentsResourceAccess(): void
    {
        $this->assertInstanceOf(DocumentsResource::class, $this->api->gregorovich->documents);
    }

    public function testOllamaResourceAccess(): void
    {
        $this->assertInstanceOf(OllamaResource::class, $this->api->gregorovich->ollama);
    }

    public function testServiceClientIsCached(): void
    {
        $gregorovich1 = $this->api->gregorovich;
        $gregorovich2 = $this->api->gregorovich;

        $this->assertSame($gregorovich1, $gregorovich2);
    }

    public function testServiceClientType(): void
    {
        $this->assertInstanceOf(GregorovichClient::class, $this->api->gregorovich);
    }
}
