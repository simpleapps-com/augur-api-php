<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Sism;

use AugurApi\Services\P21Sism\P21SismClient;
use AugurApi\Services\P21Sism\Resources\ImpOeLineResource;
use AugurApi\Services\P21Sism\Resources\ImportResource;
use AugurApi\Services\P21Sism\Resources\ScheduledImportMasterResource;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for P21SismClient.
 *
 * @covers \AugurApi\Services\P21Sism\P21SismClient
 */
final class P21SismClientTest extends AugurApiTestCase
{
    public function testP21SismClientAccess(): void
    {
        $this->assertInstanceOf(P21SismClient::class, $this->api->p21Sism);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->p21Sism->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->p21Sism->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->p21Sism->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testImpOeLineResourceAccess(): void
    {
        $this->assertInstanceOf(ImpOeLineResource::class, $this->api->p21Sism->impOeLine);
    }

    public function testImportResourceAccess(): void
    {
        $this->assertInstanceOf(ImportResource::class, $this->api->p21Sism->import);
    }

    public function testScheduledImportMasterResourceAccess(): void
    {
        $this->assertInstanceOf(ScheduledImportMasterResource::class, $this->api->p21Sism->scheduledImportMaster);
    }
}
