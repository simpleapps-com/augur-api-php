<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Commerce;

use AugurApi\Services\Commerce\CommerceClient;
use AugurApi\Services\Commerce\Resources\CartHdrResource;
use AugurApi\Services\Commerce\Resources\CartLineResource;
use AugurApi\Services\Commerce\Resources\CheckoutResource;
use AugurApi\Tests\AugurApiTestCase;

final class CommerceClientTest extends AugurApiTestCase
{
    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();

        $response = $this->api->commerce->healthCheck();

        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();

        $response = $this->api->commerce->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();

        $response = $this->api->commerce->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
    }

    public function testCartHdrResourceAccess(): void
    {
        $this->assertInstanceOf(CartHdrResource::class, $this->api->commerce->cartHdr);
    }

    public function testCartLineResourceAccess(): void
    {
        $this->assertInstanceOf(CartLineResource::class, $this->api->commerce->cartLine);
    }

    public function testCheckoutResourceAccess(): void
    {
        $this->assertInstanceOf(CheckoutResource::class, $this->api->commerce->checkout);
    }

    public function testServiceClientIsCached(): void
    {
        $commerce1 = $this->api->commerce;
        $commerce2 = $this->api->commerce;

        $this->assertSame($commerce1, $commerce2);
    }

    public function testServiceClientType(): void
    {
        $this->assertInstanceOf(CommerceClient::class, $this->api->commerce);
    }
}
