<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for CustomerResource.
 */
final class CustomerResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['customerId' => 'CUST001', 'customerName' => 'Customer A'],
            ['customerId' => 'CUST002', 'customerName' => 'Customer B'],
        ]);

        $response = $this->api->customers->customer->list();

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Customer A', $data[0]['customerName']);
        $this->assertEquals(2, $response->total);
        $this->assertRequestPath('/customer');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([['customerId' => 'CUST001']]);

        $response = $this->api->customers->customer->list(['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer');
    }

    public function testGetLookup(): void
    {
        $this->mockListResponse([
            ['customerId' => 'CUST001', 'customerName' => 'Customer A'],
        ]);

        $response = $this->api->customers->customer->getLookup(['q' => 'Customer']);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/lookup');
        $this->assertRequestMethod('GET');
    }

    public function testListAddress(): void
    {
        $this->mockListResponse([
            ['addressId' => 1, 'street' => '123 Main St'],
            ['addressId' => 2, 'street' => '456 Oak Ave'],
        ]);

        $response = $this->api->customers->customer->listAddress(1001);

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('123 Main St', $data[0]['street']);
        $this->assertRequestPath('/customer/1001/address');
        $this->assertRequestMethod('GET');
    }

    public function testListContacts(): void
    {
        $this->mockListResponse([
            ['contactId' => 1, 'name' => 'John Doe'],
            ['contactId' => 2, 'name' => 'Jane Doe'],
        ]);

        $response = $this->api->customers->customer->listContacts(1001);

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('John Doe', $data[0]['name']);
        $this->assertRequestPath('/customer/1001/contacts');
        $this->assertRequestMethod('GET');
    }

    public function testCreateContacts(): void
    {
        $this->mockResponse([
            'contactId' => 3,
            'name' => 'New Contact',
            'email' => 'new@example.com',
        ], 201);

        $response = $this->api->customers->customer->createContacts(1001, [
            'name' => 'New Contact',
            'email' => 'new@example.com',
        ]);

        $this->assertEquals('New Contact', $response->data['name']);
        $this->assertRequestPath('/customer/1001/contacts');
        $this->assertRequestMethod('POST');
    }

    public function testListDoc(): void
    {
        $this->mockResponse([
            'customerId' => 1001,
            'customerName' => 'Customer A',
            'email' => 'test@example.com',
        ]);

        $response = $this->api->customers->customer->listDoc(1001);

        $this->assertEquals(1001, $response->data['customerId']);
        $this->assertRequestPath('/customer/1001/doc');
        $this->assertRequestMethod('GET');
    }

    public function testGetDocAlias(): void
    {
        $this->mockResponse([
            'customerId' => 1001,
            'customerName' => 'Customer A',
        ]);

        $response = $this->api->customers->customer->getDoc(1001);

        $this->assertEquals(1001, $response->data['customerId']);
        $this->assertRequestPath('/customer/1001/doc');
    }

    public function testListInvoices(): void
    {
        $this->mockListResponse([
            ['invoiceNo' => 'INV001', 'amount' => 100.00],
        ]);

        $response = $this->api->customers->customer->listInvoices(1001);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/1001/invoices');
        $this->assertRequestMethod('GET');
    }

    public function testGetInvoices(): void
    {
        $this->mockResponse([
            'invoiceNo' => 1001,
            'amount' => 100.00,
        ]);

        $response = $this->api->customers->customer->getInvoices(1001, 1001);

        $this->assertEquals(1001, $response->data['invoiceNo']);
        $this->assertRequestPath('/customer/1001/invoices/1001');
        $this->assertRequestMethod('GET');
    }

    public function testListOrders(): void
    {
        $this->mockListResponse([
            ['orderNo' => 12345, 'total' => 150.00],
        ]);

        $response = $this->api->customers->customer->listOrders(1001);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/1001/orders');
        $this->assertRequestMethod('GET');
    }

    public function testGetOrders(): void
    {
        $this->mockResponse([
            'orderNo' => 12345,
            'total' => 150.00,
        ]);

        $response = $this->api->customers->customer->getOrders(1001, 12345);

        $this->assertEquals(12345, $response->data['orderNo']);
        $this->assertRequestPath('/customer/1001/orders/12345');
        $this->assertRequestMethod('GET');
    }

    public function testListPurchasedItems(): void
    {
        $this->mockListResponse([
            ['itemId' => 'ABC123', 'quantity' => 10],
        ]);

        $response = $this->api->customers->customer->listPurchasedItems(1001);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/1001/purchased-items');
        $this->assertRequestMethod('GET');
    }

    public function testListQuotes(): void
    {
        $this->mockListResponse([
            ['orderNo' => 5001, 'total' => 500.00],
        ]);

        $response = $this->api->customers->customer->listQuotes(1001);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/1001/quotes');
        $this->assertRequestMethod('GET');
    }

    public function testGetQuotes(): void
    {
        $this->mockResponse([
            'orderNo' => 5001,
            'total' => 500.00,
        ]);

        $response = $this->api->customers->customer->getQuotes(1001, 5001);

        $this->assertEquals(5001, $response->data['orderNo']);
        $this->assertRequestPath('/customer/1001/quotes/5001');
        $this->assertRequestMethod('GET');
    }

    public function testListShipTo(): void
    {
        $this->mockListResponse([
            ['shipToId' => 1, 'address' => '123 Ship St'],
        ]);

        $response = $this->api->customers->customer->listShipTo(1001);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/1001/ship-to');
        $this->assertRequestMethod('GET');
    }

    public function testCreateShipTo(): void
    {
        $this->mockResponse([
            'shipToId' => 3,
            'address' => '789 New Ship St',
        ], 201);

        $response = $this->api->customers->customer->createShipTo(1001, [
            'address' => '789 New Ship St',
        ]);

        $this->assertEquals('789 New Ship St', $response->data['address']);
        $this->assertRequestPath('/customer/1001/ship-to');
        $this->assertRequestMethod('POST');
    }
}
