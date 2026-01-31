<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Services\Customers\Schemas\Customer;
use AugurApi\Services\Customers\Schemas\CustomerListParams;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for CustomerResource.
 */
final class CustomerResourceTest extends AugurApiTestCase
{
    public function testListCustomers(): void
    {
        $this->mockListResponse([
            ['customerId' => 'CUST001', 'customerName' => 'Customer A'],
            ['customerId' => 'CUST002', 'customerName' => 'Customer B'],
        ]);

        $response = $this->api->customers->customer->list();

        $this->assertCount(2, $response->data);
        $this->assertInstanceOf(Customer::class, $response->data[0]);
        $this->assertEquals('Customer A', $response->data[0]->customerName);
        $this->assertEquals(2, $response->total);
        $this->assertRequestPath('/customer');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListCustomersWithParams(): void
    {
        $this->mockListResponse([['customerId' => 'CUST001']]);

        $params = new CustomerListParams(limit: 10, offset: 0);
        $response = $this->api->customers->customer->list($params);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer');
    }

    public function testListCustomersWithArray(): void
    {
        $this->mockListResponse([['customerId' => 'CUST001']]);

        $response = $this->api->customers->customer->list(['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testLookupCustomer(): void
    {
        $this->mockListResponse([
            ['customerId' => 'CUST001', 'customerName' => 'Customer A'],
        ]);

        $response = $this->api->customers->customer->lookup(['q' => 'Customer']);

        $this->assertCount(1, $response->data);
        $this->assertInstanceOf(Customer::class, $response->data[0]);
        $this->assertRequestPath('/customer/lookup');
        $this->assertRequestMethod('GET');
    }

    public function testGetDoc(): void
    {
        $this->mockResponse([
            'customerId' => 'CUST001',
            'customerName' => 'Customer A',
            'email' => 'test@example.com',
        ]);

        $response = $this->api->customers->customer->getDoc('CUST001');

        $this->assertEquals('CUST001', $response->data['customerId']);
        $this->assertRequestPath('/customer/CUST001/doc');
        $this->assertRequestMethod('GET');
    }

    public function testGetAddresses(): void
    {
        $this->mockListResponse([
            ['addressId' => 1, 'street' => '123 Main St'],
            ['addressId' => 2, 'street' => '456 Oak Ave'],
        ]);

        $response = $this->api->customers->customer->getAddresses('CUST001');

        $this->assertCount(2, $response->data);
        $this->assertEquals('123 Main St', $response->data[0]['street']);
        $this->assertRequestPath('/customer/CUST001/address');
        $this->assertRequestMethod('GET');
    }

    public function testGetContacts(): void
    {
        $this->mockListResponse([
            ['contactId' => 1, 'name' => 'John Doe'],
            ['contactId' => 2, 'name' => 'Jane Doe'],
        ]);

        $response = $this->api->customers->customer->getContacts('CUST001');

        $this->assertCount(2, $response->data);
        $this->assertEquals('John Doe', $response->data[0]['name']);
        $this->assertRequestPath('/customer/CUST001/contacts');
        $this->assertRequestMethod('GET');
    }

    public function testCreateContact(): void
    {
        $this->mockResponse([
            'contactId' => 3,
            'name' => 'New Contact',
            'email' => 'new@example.com',
        ], 201);

        $response = $this->api->customers->customer->createContact('CUST001', [
            'name' => 'New Contact',
            'email' => 'new@example.com',
        ]);

        $this->assertEquals('New Contact', $response->data['name']);
        $this->assertRequestPath('/customer/CUST001/contacts');
        $this->assertRequestMethod('POST');
    }

    public function testGetShipTo(): void
    {
        $this->mockListResponse([
            ['shipToId' => 1, 'address' => '123 Ship St'],
            ['shipToId' => 2, 'address' => '456 Ship Ave'],
        ]);

        $response = $this->api->customers->customer->getShipTo('CUST001');

        $this->assertCount(2, $response->data);
        $this->assertEquals('123 Ship St', $response->data[0]['address']);
        $this->assertRequestPath('/customer/CUST001/ship-to');
        $this->assertRequestMethod('GET');
    }

    public function testCreateShipTo(): void
    {
        $this->mockResponse([
            'shipToId' => 3,
            'address' => '789 New Ship St',
        ], 201);

        $response = $this->api->customers->customer->createShipTo('CUST001', [
            'address' => '789 New Ship St',
        ]);

        $this->assertEquals('789 New Ship St', $response->data['address']);
        $this->assertRequestPath('/customer/CUST001/ship-to');
        $this->assertRequestMethod('POST');
    }

    public function testListCustomersWithNoParams(): void
    {
        $this->mockListResponse([['customerId' => 'CUST001']]);

        $response = $this->api->customers->customer->list();

        $this->assertCount(1, $response->data);
    }

    public function testListCustomersWithNullData(): void
    {
        $this->mockClient->addResponse(
            new \Nyholm\Psr7\Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => null,
                'status' => 200,
            ])),
        );

        $response = $this->api->customers->customer->list();

        $this->assertIsArray($response->data);
        $this->assertCount(0, $response->data);
    }

    public function testLookupCustomerWithNullData(): void
    {
        $this->mockClient->addResponse(
            new \Nyholm\Psr7\Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => null,
                'status' => 200,
            ])),
        );

        $response = $this->api->customers->customer->lookup(['q' => 'test']);

        $this->assertIsArray($response->data);
        $this->assertCount(0, $response->data);
    }
}
