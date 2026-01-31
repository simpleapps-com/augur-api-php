<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ShipToResource.
 */
final class ShipToResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['shipToId' => 1, 'address' => '123 Shipping St', 'city' => 'New York'],
            ['shipToId' => 2, 'address' => '456 Delivery Ave', 'city' => 'Los Angeles'],
        ]);

        $response = $this->api->customers->shipTo->list('CUST001');

        $this->assertCount(2, $response->data);
        $this->assertEquals('123 Shipping St', $response->data[0]['address']);
        $this->assertEquals('New York', $response->data[0]['city']);
        $this->assertRequestPath('/customer/CUST001/ship-to');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['shipToId' => 1, 'address' => '123 Shipping St'],
        ]);

        $response = $this->api->customers->shipTo->list('CUST001', ['limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/CUST001/ship-to');
    }

    public function testRefresh(): void
    {
        $this->mockResponse(['refreshed' => true, 'timestamp' => '2024-01-15T12:00:00Z']);

        $response = $this->api->customers->shipTo->refresh();

        $this->assertTrue($response->data['refreshed']);
        $this->assertRequestPath('/ship-to/refresh');
        $this->assertRequestMethod('GET');
    }
}
