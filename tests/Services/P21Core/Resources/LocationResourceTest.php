<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Core\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for LocationResource.
 *
 * @covers \AugurApi\Services\P21Core\Resources\LocationResource
 */
final class LocationResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['locationId' => 100, 'locationName' => 'Main Warehouse', 'active' => true],
            ['locationId' => 200, 'locationName' => 'Secondary Warehouse', 'active' => true],
        ]);

        $response = $this->api->p21Core->location->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(100, $response->data[0]['locationId']);
        $this->assertEquals('Main Warehouse', $response->data[0]['locationName']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/location');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['locationId' => 100, 'locationName' => 'Main Warehouse'],
        ], 50);

        $response = $this->api->p21Core->location->list(['active' => true, 'limit' => 25]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'locationId' => 100,
            'locationName' => 'Main Warehouse',
            'active' => true,
            'address' => '789 Industrial Blvd',
            'phone' => '555-0200',
        ]);

        $response = $this->api->p21Core->location->get(100);

        $this->assertEquals(100, $response->data['locationId']);
        $this->assertEquals('Main Warehouse', $response->data['locationName']);
        $this->assertTrue($response->data['active']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/location/100');
    }
}
