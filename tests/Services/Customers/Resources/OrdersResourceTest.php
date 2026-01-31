<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for OrdersResource.
 */
final class OrdersResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['orderNo' => 'ORD001', 'total' => 150.00, 'status' => 'shipped'],
            ['orderNo' => 'ORD002', 'total' => 300.00, 'status' => 'processing'],
        ]);

        $response = $this->api->customers->orders->list('CUST001');

        $this->assertCount(2, $response->data);
        $this->assertEquals('ORD001', $response->data[0]['orderNo']);
        $this->assertEquals(150.00, $response->data[0]['total']);
        $this->assertRequestPath('/customer/CUST001/orders');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['orderNo' => 'ORD001', 'total' => 150.00],
        ]);

        $response = $this->api->customers->orders->list('CUST001', ['limit' => 10, 'orderBy' => 'orderDate']);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/CUST001/orders');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'orderNo' => 'ORD001',
            'customerId' => 'CUST001',
            'total' => 150.00,
            'status' => 'shipped',
            'orderDate' => '2024-01-15',
        ]);

        $response = $this->api->customers->orders->get('CUST001', 'ORD001');

        $this->assertEquals('ORD001', $response->data['orderNo']);
        $this->assertEquals(150.00, $response->data['total']);
        $this->assertRequestPath('/customer/CUST001/orders/ORD001');
        $this->assertRequestMethod('GET');
    }
}
