<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers;

use AugurApi\Services\Customers\CustomersClient;
use AugurApi\Services\Customers\Resources\ContactsResource;
use AugurApi\Services\Customers\Resources\ContactsUdResource;
use AugurApi\Services\Customers\Resources\CustomerResource;
use AugurApi\Services\Customers\Resources\InvoicesResource;
use AugurApi\Services\Customers\Resources\OeContactsCustomerResource;
use AugurApi\Services\Customers\Resources\OrdersResource;
use AugurApi\Services\Customers\Resources\PurchasedItemsResource;
use AugurApi\Services\Customers\Resources\QuotesResource;
use AugurApi\Services\Customers\Resources\ShipToResource;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for CustomersClient.
 */
final class CustomersClientTest extends AugurApiTestCase
{
    public function testCustomersClientAccess(): void
    {
        $this->assertInstanceOf(CustomersClient::class, $this->api->customers);
    }

    public function testContactsResourceAccess(): void
    {
        $this->assertInstanceOf(ContactsResource::class, $this->api->customers->contacts);
    }

    public function testContactsUdResourceAccess(): void
    {
        $this->assertInstanceOf(ContactsUdResource::class, $this->api->customers->contactsUd);
    }

    public function testCustomerResourceAccess(): void
    {
        $this->assertInstanceOf(CustomerResource::class, $this->api->customers->customer);
    }

    public function testInvoicesResourceAccess(): void
    {
        $this->assertInstanceOf(InvoicesResource::class, $this->api->customers->invoices);
    }

    public function testOeContactsCustomerResourceAccess(): void
    {
        $this->assertInstanceOf(OeContactsCustomerResource::class, $this->api->customers->oeContactsCustomer);
    }

    public function testOrdersResourceAccess(): void
    {
        $this->assertInstanceOf(OrdersResource::class, $this->api->customers->orders);
    }

    public function testPurchasedItemsResourceAccess(): void
    {
        $this->assertInstanceOf(PurchasedItemsResource::class, $this->api->customers->purchasedItems);
    }

    public function testQuotesResourceAccess(): void
    {
        $this->assertInstanceOf(QuotesResource::class, $this->api->customers->quotes);
    }

    public function testShipToResourceAccess(): void
    {
        $this->assertInstanceOf(ShipToResource::class, $this->api->customers->shipTo);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->customers->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->customers->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->customers->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }
}
