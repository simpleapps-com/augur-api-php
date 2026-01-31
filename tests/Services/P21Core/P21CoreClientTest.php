<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Core;

use AugurApi\Services\P21Core\P21CoreClient;
use AugurApi\Services\P21Core\Resources\AddressResource;
use AugurApi\Services\P21Core\Resources\CashDrawerResource;
use AugurApi\Services\P21Core\Resources\CodeP21Resource;
use AugurApi\Services\P21Core\Resources\CompanyResource;
use AugurApi\Services\P21Core\Resources\LocationResource;
use AugurApi\Services\P21Core\Resources\PaymentTypesResource;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for P21CoreClient.
 *
 * @covers \AugurApi\Services\P21Core\P21CoreClient
 */
final class P21CoreClientTest extends AugurApiTestCase
{
    public function testP21CoreClientAccess(): void
    {
        $this->assertInstanceOf(P21CoreClient::class, $this->api->p21Core);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->p21Core->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->p21Core->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->p21Core->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testAddressResourceAccess(): void
    {
        $this->assertInstanceOf(AddressResource::class, $this->api->p21Core->address);
    }

    public function testCashDrawerResourceAccess(): void
    {
        $this->assertInstanceOf(CashDrawerResource::class, $this->api->p21Core->cashDrawer);
    }

    public function testCodeP21ResourceAccess(): void
    {
        $this->assertInstanceOf(CodeP21Resource::class, $this->api->p21Core->codeP21);
    }

    public function testCompanyResourceAccess(): void
    {
        $this->assertInstanceOf(CompanyResource::class, $this->api->p21Core->company);
    }

    public function testLocationResourceAccess(): void
    {
        $this->assertInstanceOf(LocationResource::class, $this->api->p21Core->location);
    }

    public function testPaymentTypesResourceAccess(): void
    {
        $this->assertInstanceOf(PaymentTypesResource::class, $this->api->p21Core->paymentTypes);
    }
}
