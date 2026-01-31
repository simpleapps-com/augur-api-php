<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInfo;

use AugurApi\Services\AgrInfo\Resources\AkashaResource;
use AugurApi\Services\AgrInfo\Resources\ContextResource;
use AugurApi\Services\AgrInfo\Resources\JoomlaResource;
use AugurApi\Services\AgrInfo\Resources\MicroservicesResource;
use AugurApi\Services\AgrInfo\Resources\OllamaResource;
use AugurApi\Services\AgrInfo\Resources\RubricsResource;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for AgrInfoClient service client.
 */
final class AgrInfoClientTest extends AugurApiTestCase
{
    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->agrInfo->healthCheck();

        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->agrInfo->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->agrInfo->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
    }

    public function testAkashaResourceAccess(): void
    {
        $this->assertInstanceOf(AkashaResource::class, $this->api->agrInfo->akasha);
    }

    public function testContextResourceAccess(): void
    {
        $this->assertInstanceOf(ContextResource::class, $this->api->agrInfo->context);
    }

    public function testJoomlaResourceAccess(): void
    {
        $this->assertInstanceOf(JoomlaResource::class, $this->api->agrInfo->joomla);
    }

    public function testMicroservicesResourceAccess(): void
    {
        $this->assertInstanceOf(MicroservicesResource::class, $this->api->agrInfo->microservices);
    }

    public function testOllamaResourceAccess(): void
    {
        $this->assertInstanceOf(OllamaResource::class, $this->api->agrInfo->ollama);
    }

    public function testRubricsResourceAccess(): void
    {
        $this->assertInstanceOf(RubricsResource::class, $this->api->agrInfo->rubrics);
    }
}
