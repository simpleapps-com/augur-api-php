<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Vmi\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for DistributorsResource.
 *
 * @covers \AugurApi\Services\Vmi\Resources\DistributorsResource
 */
final class DistributorsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['distributorsUid' => 1, 'name' => 'Distributor A', 'active' => true],
            ['distributorsUid' => 2, 'name' => 'Distributor B', 'active' => true],
        ]);

        $response = $this->api->vmi->distributors->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['distributorsUid']);
        $this->assertEquals('Distributor A', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/distributors');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['distributorsUid' => 1, 'name' => 'Distributor A'],
        ], 25);

        $response = $this->api->vmi->distributors->list(['active' => true, 'limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(25, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'distributorsUid' => 1,
            'name' => 'Distributor A',
            'active' => true,
            'contactEmail' => 'contact@example.com',
        ]);

        $response = $this->api->vmi->distributors->get(1);

        $this->assertEquals(1, $response->data['distributorsUid']);
        $this->assertEquals('Distributor A', $response->data['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/distributors/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'distributorsUid' => 3,
            'name' => 'New Distributor',
            'active' => true,
        ]);

        $response = $this->api->vmi->distributors->create([
            'name' => 'New Distributor',
            'active' => true,
        ]);

        $this->assertEquals(3, $response->data['distributorsUid']);
        $this->assertEquals('New Distributor', $response->data['name']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/distributors');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'distributorsUid' => 1,
            'name' => 'Updated Distributor',
            'active' => false,
        ]);

        $response = $this->api->vmi->distributors->update(1, [
            'name' => 'Updated Distributor',
            'active' => false,
        ]);

        $this->assertEquals('Updated Distributor', $response->data['name']);
        $this->assertFalse($response->data['active']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/distributors/1');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->vmi->distributors->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/distributors/1');
    }

    public function testEnable(): void
    {
        $this->mockResponse([
            'distributorsUid' => 1,
            'active' => true,
        ]);

        $response = $this->api->vmi->distributors->enable(1, ['active' => true]);

        $this->assertTrue($response->data['active']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/distributors/1/enable');
    }
}
