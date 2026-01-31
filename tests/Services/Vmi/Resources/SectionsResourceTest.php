<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Vmi\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for SectionsResource.
 *
 * @covers \AugurApi\Services\Vmi\Resources\SectionsResource
 */
final class SectionsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['sectionsUid' => 1, 'name' => 'Section A', 'warehouseUid' => 100],
            ['sectionsUid' => 2, 'name' => 'Section B', 'warehouseUid' => 100],
        ]);

        $response = $this->api->vmi->sections->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['sectionsUid']);
        $this->assertEquals('Section A', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/sections');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['sectionsUid' => 1, 'name' => 'Section A'],
        ], 25);

        $response = $this->api->vmi->sections->list(['warehouseUid' => 100, 'limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(25, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'sectionsUid' => 1,
            'name' => 'Section A',
            'warehouseUid' => 100,
            'location' => 'Aisle 1',
        ]);

        $response = $this->api->vmi->sections->get(1);

        $this->assertEquals(1, $response->data['sectionsUid']);
        $this->assertEquals('Section A', $response->data['name']);
        $this->assertEquals('Aisle 1', $response->data['location']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/sections/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'sectionsUid' => 3,
            'name' => 'New Section',
            'warehouseUid' => 100,
        ]);

        $response = $this->api->vmi->sections->create([
            'name' => 'New Section',
            'warehouseUid' => 100,
        ]);

        $this->assertEquals(3, $response->data['sectionsUid']);
        $this->assertEquals('New Section', $response->data['name']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/sections');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'sectionsUid' => 1,
            'name' => 'Updated Section',
        ]);

        $response = $this->api->vmi->sections->update(1, [
            'name' => 'Updated Section',
        ]);

        $this->assertEquals('Updated Section', $response->data['name']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/sections/1');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->vmi->sections->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/sections/1');
    }

    public function testEnable(): void
    {
        $this->mockResponse([
            'sectionsUid' => 1,
            'active' => true,
        ]);

        $response = $this->api->vmi->sections->enable(1);

        $this->assertTrue($response->data['active']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/sections/1/enable');
    }

    public function testEnableWithData(): void
    {
        $this->mockResponse([
            'sectionsUid' => 1,
            'active' => false,
        ]);

        $response = $this->api->vmi->sections->enable(1, ['active' => false]);

        $this->assertFalse($response->data['active']);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
