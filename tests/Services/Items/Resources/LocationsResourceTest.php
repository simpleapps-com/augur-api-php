<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for LocationsResource.
 *
 * @covers \AugurApi\Services\Items\Resources\LocationsResource
 */
final class LocationsResourceTest extends AugurApiTestCase
{
    public function testListBins(): void
    {
        $this->mockListResponse([
            ['bin' => 'A-01-01', 'description' => 'Aisle A, Shelf 1, Position 1'],
            ['bin' => 'A-01-02', 'description' => 'Aisle A, Shelf 1, Position 2'],
        ]);

        $response = $this->api->items->locations->listBins(1);

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('A-01-01', $data[0]['bin']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/locations/1/bins');
    }

    public function testListBinsWithParams(): void
    {
        $this->mockListResponse([
            ['bin' => 'A-01-01', 'description' => 'Aisle A, Shelf 1, Position 1'],
        ], 100);

        $response = $this->api->items->locations->listBins(1, ['limit' => 25, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(100, $response->total);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGetBins(): void
    {
        $this->mockResponse([
            'bin' => 'A-01-01',
            'locationId' => 1,
            'description' => 'Aisle A, Shelf 1, Position 1',
            'capacity' => 100,
            'currentQty' => 50,
        ]);

        // Generated signature: getBins(string $bin, int $locationId, ...)
        $response = $this->api->items->locations->getBins('A-01-01', 1);

        $this->assertEquals('A-01-01', $response->data['bin']);
        $this->assertEquals(1, $response->data['locationId']);
        $this->assertEquals(100, $response->data['capacity']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/locations/1/bins/A-01-01');
    }
}
