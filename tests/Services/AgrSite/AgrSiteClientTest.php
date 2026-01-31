<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrSite;

use AugurApi\Services\AgrSite\Resources\ContextResource;
use AugurApi\Services\AgrSite\Resources\FyxerTranscriptResource;
use AugurApi\Services\AgrSite\Resources\GeoCodesPostalCodesResource;
use AugurApi\Services\AgrSite\Resources\MetaFilesResource;
use AugurApi\Services\AgrSite\Resources\NotificationsResource;
use AugurApi\Services\AgrSite\Resources\OpenSearchResource;
use AugurApi\Services\AgrSite\Resources\SettingsResource;
use AugurApi\Services\AgrSite\Resources\TrainingResource;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for AgrSiteClient service client.
 */
final class AgrSiteClientTest extends AugurApiTestCase
{
    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->agrSite->healthCheck();

        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->agrSite->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->agrSite->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
    }

    public function testContextResourceAccess(): void
    {
        $this->assertInstanceOf(ContextResource::class, $this->api->agrSite->context);
    }

    public function testFyxerTranscriptResourceAccess(): void
    {
        $this->assertInstanceOf(FyxerTranscriptResource::class, $this->api->agrSite->fyxerTranscript);
    }

    public function testGeoCodesPostalCodesResourceAccess(): void
    {
        $this->assertInstanceOf(GeoCodesPostalCodesResource::class, $this->api->agrSite->geoCodesPostalCodes);
    }

    public function testMetaFilesResourceAccess(): void
    {
        $this->assertInstanceOf(MetaFilesResource::class, $this->api->agrSite->metaFiles);
    }

    public function testNotificationsResourceAccess(): void
    {
        $this->assertInstanceOf(NotificationsResource::class, $this->api->agrSite->notifications);
    }

    public function testOpenSearchResourceAccess(): void
    {
        $this->assertInstanceOf(OpenSearchResource::class, $this->api->agrSite->openSearch);
    }

    public function testSettingsResourceAccess(): void
    {
        $this->assertInstanceOf(SettingsResource::class, $this->api->agrSite->settings);
    }

    public function testTrainingResourceAccess(): void
    {
        $this->assertInstanceOf(TrainingResource::class, $this->api->agrSite->training);
    }
}
