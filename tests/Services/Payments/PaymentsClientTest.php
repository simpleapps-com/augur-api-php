<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Payments;

use AugurApi\Services\Payments\PaymentsClient;
use AugurApi\Services\Payments\Resources\ElementResource;
use AugurApi\Services\Payments\Resources\MonerisResource;
use AugurApi\Services\Payments\Resources\PaytraceResource;
use AugurApi\Services\Payments\Resources\UnifiedResource;
use AugurApi\Tests\AugurApiTestCase;

final class PaymentsClientTest extends AugurApiTestCase
{
    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();

        $response = $this->api->payments->healthCheck();

        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();

        $response = $this->api->payments->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();

        $response = $this->api->payments->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
    }

    public function testElementResourceAccess(): void
    {
        $this->assertInstanceOf(ElementResource::class, $this->api->payments->element);
    }

    public function testMonerisResourceAccess(): void
    {
        $this->assertInstanceOf(MonerisResource::class, $this->api->payments->moneris);
    }

    public function testPaytraceResourceAccess(): void
    {
        $this->assertInstanceOf(PaytraceResource::class, $this->api->payments->paytrace);
    }

    public function testUnifiedResourceAccess(): void
    {
        $this->assertInstanceOf(UnifiedResource::class, $this->api->payments->unified);
    }

    public function testServiceClientIsCached(): void
    {
        $payments1 = $this->api->payments;
        $payments2 = $this->api->payments;

        $this->assertSame($payments1, $payments2);
    }

    public function testServiceClientType(): void
    {
        $this->assertInstanceOf(PaymentsClient::class, $this->api->payments);
    }
}
