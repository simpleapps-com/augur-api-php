<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Pricing;

use AugurApi\Services\Pricing\PricingClient;
use AugurApi\Services\Pricing\Resources\JobPriceHdrResource;
use AugurApi\Services\Pricing\Resources\PriceEngineResource;
use AugurApi\Services\Pricing\Resources\TaxEngineResource;
use AugurApi\Tests\AugurApiTestCase;

final class PricingClientTest extends AugurApiTestCase
{
    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();

        $response = $this->api->pricing->healthCheck();

        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();

        $response = $this->api->pricing->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();

        $response = $this->api->pricing->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
    }

    public function testJobPriceHdrResourceAccess(): void
    {
        $this->assertInstanceOf(JobPriceHdrResource::class, $this->api->pricing->jobPriceHdr);
    }

    public function testPriceEngineResourceAccess(): void
    {
        $this->assertInstanceOf(PriceEngineResource::class, $this->api->pricing->priceEngine);
    }

    public function testTaxEngineResourceAccess(): void
    {
        $this->assertInstanceOf(TaxEngineResource::class, $this->api->pricing->taxEngine);
    }

    public function testServiceClientIsCached(): void
    {
        $pricing1 = $this->api->pricing;
        $pricing2 = $this->api->pricing;

        $this->assertSame($pricing1, $pricing2);
    }

    public function testServiceClientType(): void
    {
        $this->assertInstanceOf(PricingClient::class, $this->api->pricing);
    }
}
