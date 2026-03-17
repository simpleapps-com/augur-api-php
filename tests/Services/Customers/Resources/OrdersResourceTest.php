<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for order endpoints on CustomerResource.
 */
final class OrdersResourceTest extends AugurApiTestCase
{
    public function testListOrders(): void
    {
        $this->mockListResponse([
            ['orderNo' => 12345, 'total' => 150.00, 'status' => 'shipped'],
            ['orderNo' => 12346, 'total' => 300.00, 'status' => 'processing'],
        ]);

        $response = $this->api->customers->customer->listOrders(0, 1001);

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(12345, $data[0]['orderNo']);
        $this->assertEquals(150.00, $data[0]['total']);
        $this->assertRequestPath('/customer/1001/orders');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListOrdersWithParams(): void
    {
        $this->mockListResponse([
            ['orderNo' => 12345, 'total' => 150.00],
        ]);

        $response = $this->api->customers->customer->listOrders(0, 1001, ['limit' => 10, 'orderBy' => 'orderDate']);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/1001/orders');
    }

    public function testGetOrders(): void
    {
        $this->mockResponse([
            'orderNo' => 12345,
            'customerId' => 1001,
            'total' => 150.00,
            'status' => 'shipped',
            'orderDate' => '2024-01-15',
        ]);

        $response = $this->api->customers->customer->getOrders(1001, 12345);

        $this->assertEquals(12345, $response->data['orderNo']);
        $this->assertEquals(150.00, $response->data['total']);
        $this->assertRequestPath('/customer/1001/orders/12345');
        $this->assertRequestMethod('GET');
    }
}
