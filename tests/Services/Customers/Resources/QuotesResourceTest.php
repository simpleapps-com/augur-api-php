<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for QuotesResource.
 */
final class QuotesResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['quoteNo' => 'QUO001', 'total' => 500.00, 'status' => 'pending'],
            ['quoteNo' => 'QUO002', 'total' => 750.00, 'status' => 'approved'],
        ]);

        $response = $this->api->customers->quotes->list('CUST001');

        $this->assertCount(2, $response->data);
        $this->assertEquals('QUO001', $response->data[0]['quoteNo']);
        $this->assertEquals(500.00, $response->data[0]['total']);
        $this->assertRequestPath('/customer/CUST001/quotes');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['quoteNo' => 'QUO001', 'total' => 500.00],
        ]);

        $response = $this->api->customers->quotes->list('CUST001', ['limit' => 10, 'status' => 'pending']);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/CUST001/quotes');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'quoteNo' => 'QUO001',
            'customerId' => 'CUST001',
            'total' => 500.00,
            'status' => 'pending',
            'expirationDate' => '2024-03-01',
        ]);

        $response = $this->api->customers->quotes->get('CUST001', 'QUO001');

        $this->assertEquals('QUO001', $response->data['quoteNo']);
        $this->assertEquals(500.00, $response->data['total']);
        $this->assertRequestPath('/customer/CUST001/quotes/QUO001');
        $this->assertRequestMethod('GET');
    }
}
