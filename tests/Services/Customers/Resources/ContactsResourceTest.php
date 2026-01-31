<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ContactsResource.
 */
final class ContactsResourceTest extends AugurApiTestCase
{
    public function testGetCustomers(): void
    {
        $this->mockListResponse([
            ['customerId' => 'CUST001', 'customerName' => 'Customer A'],
            ['customerId' => 'CUST002', 'customerName' => 'Customer B'],
        ]);

        $response = $this->api->customers->contacts->getCustomers(123);

        $this->assertCount(2, $response->data);
        $this->assertEquals('CUST001', $response->data[0]['customerId']);
        $this->assertRequestPath('/contacts/123/customers');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGetDoc(): void
    {
        $this->mockResponse([
            'contactId' => 123,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
        ]);

        $response = $this->api->customers->contacts->getDoc(123);

        $this->assertEquals(123, $response->data['contactId']);
        $this->assertEquals('John', $response->data['firstName']);
        $this->assertRequestPath('/contacts/123/doc');
        $this->assertRequestMethod('GET');
    }

    public function testGetWebAllowance(): void
    {
        $this->mockResponse([
            'contactId' => 123,
            'allowance' => 1000.00,
            'used' => 250.00,
        ]);

        $response = $this->api->customers->contacts->getWebAllowance(123);

        $this->assertEquals(123, $response->data['contactId']);
        $this->assertEquals(1000.00, $response->data['allowance']);
        $this->assertRequestPath('/contacts/123/web-allowance');
        $this->assertRequestMethod('GET');
    }

    public function testRefresh(): void
    {
        $this->mockResponse(['refreshed' => true, 'timestamp' => '2024-01-15T12:00:00Z']);

        $response = $this->api->customers->contacts->refresh();

        $this->assertTrue($response->data['refreshed']);
        $this->assertRequestPath('/contacts/refresh');
        $this->assertRequestMethod('GET');
    }
}
