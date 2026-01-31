<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Apis;

use AugurApi\Services\P21Apis\P21ApisClient;
use AugurApi\Services\P21Apis\Resources\EntityContactsResource;
use AugurApi\Services\P21Apis\Resources\EntityCustomersResource;
use AugurApi\Services\P21Apis\Resources\TransCategoryResource;
use AugurApi\Services\P21Apis\Resources\TransCompanyResource;
use AugurApi\Services\P21Apis\Resources\TransPurchaseOrderReceiptResource;
use AugurApi\Services\P21Apis\Resources\TransUserResource;
use AugurApi\Services\P21Apis\Resources\TransWebDisplayTypeResource;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for P21ApisClient.
 *
 * @covers \AugurApi\Services\P21Apis\P21ApisClient
 */
final class P21ApisClientTest extends AugurApiTestCase
{
    public function testP21ApisClientAccess(): void
    {
        $this->assertInstanceOf(P21ApisClient::class, $this->api->p21Apis);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->p21Apis->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->p21Apis->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->p21Apis->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testEntityContactsResourceAccess(): void
    {
        $this->assertInstanceOf(EntityContactsResource::class, $this->api->p21Apis->entityContacts);
    }

    public function testEntityCustomersResourceAccess(): void
    {
        $this->assertInstanceOf(EntityCustomersResource::class, $this->api->p21Apis->entityCustomers);
    }

    public function testTransCategoryResourceAccess(): void
    {
        $this->assertInstanceOf(TransCategoryResource::class, $this->api->p21Apis->transCategory);
    }

    public function testTransCompanyResourceAccess(): void
    {
        $this->assertInstanceOf(TransCompanyResource::class, $this->api->p21Apis->transCompany);
    }

    public function testTransPurchaseOrderReceiptResourceAccess(): void
    {
        $this->assertInstanceOf(TransPurchaseOrderReceiptResource::class, $this->api->p21Apis->transPurchaseOrderReceipt);
    }

    public function testTransUserResourceAccess(): void
    {
        $this->assertInstanceOf(TransUserResource::class, $this->api->p21Apis->transUser);
    }

    public function testTransWebDisplayTypeResourceAccess(): void
    {
        $this->assertInstanceOf(TransWebDisplayTypeResource::class, $this->api->p21Apis->transWebDisplayType);
    }
}
