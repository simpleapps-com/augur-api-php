<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\BrandFolder;

use AugurApi\Services\BrandFolder\BrandFolderClient;
use AugurApi\Services\BrandFolder\Resources\CategoriesResource;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for BrandFolderClient.
 */
final class BrandFolderClientTest extends AugurApiTestCase
{
    public function testBrandFolderClientAccess(): void
    {
        $this->assertInstanceOf(BrandFolderClient::class, $this->api->brandFolder);
    }

    public function testCategoriesResourceAccess(): void
    {
        $this->assertInstanceOf(CategoriesResource::class, $this->api->brandFolder->categories);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->brandFolder->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->brandFolder->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->brandFolder->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }
}
