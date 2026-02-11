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
            ['orderNo' => 'ORD001', 'total' => 500.00, 'status' => 'pending'],
            ['orderNo' => 'ORD002', 'total' => 750.00, 'status' => 'approved'],
        ]);

        $response = $this->api->customers->quotes->list('CUST001');

        $this->assertCount(2, $response->data);
        $this->assertEquals('ORD001', $response->data[0]['orderNo']);
        $this->assertEquals(500.00, $response->data[0]['total']);
        $this->assertRequestPath('/customer/CUST001/quotes');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['orderNo' => 'ORD001', 'total' => 500.00],
        ]);

        $response = $this->api->customers->quotes->list('CUST001', ['limit' => 10, 'status' => 'pending']);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/CUST001/quotes');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'orderNo' => 'ORD001',
            'customerId' => 'CUST001',
            'total' => 500.00,
            'status' => 'pending',
            'expirationDate' => '2024-03-01',
        ]);

        $response = $this->api->customers->quotes->get('CUST001', 'ORD001');

        $this->assertEquals('ORD001', $response->data['orderNo']);
        $this->assertEquals(500.00, $response->data['total']);
        $this->assertRequestPath('/customer/CUST001/quotes/ORD001');
        $this->assertRequestMethod('GET');
    }
}
