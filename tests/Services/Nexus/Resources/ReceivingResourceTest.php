<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Nexus\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ReceivingResource.
 */
final class ReceivingResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['receivingUid' => 1, 'status' => 'received', 'locationId' => 'LOC001'],
            ['receivingUid' => 2, 'status' => 'pending', 'locationId' => 'LOC002'],
        ]);

        $response = $this->api->nexus->receiving->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['receivingUid']);
        $this->assertEquals('received', $response->data[0]['status']);
        $this->assertRequestPath('/receiving');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['receivingUid' => 1, 'status' => 'received'],
        ]);

        $response = $this->api->nexus->receiving->list(['limit' => 10, 'locationId' => 'LOC001']);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/receiving');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'receivingUid' => 1,
            'status' => 'received',
            'locationId' => 'LOC001',
            'receivedBy' => 'user123',
            'receivedDate' => '2024-01-15',
        ]);

        $response = $this->api->nexus->receiving->get(1);

        $this->assertEquals(1, $response->data['receivingUid']);
        $this->assertEquals('LOC001', $response->data['locationId']);
        $this->assertRequestPath('/receiving/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'receivingUid' => 3,
            'status' => 'pending',
            'locationId' => 'LOC003',
        ], 201);

        $response = $this->api->nexus->receiving->create([
            'locationId' => 'LOC003',
            'items' => [['itemId' => 'ITEM001', 'qty' => 100]],
        ]);

        $this->assertEquals(3, $response->data['receivingUid']);
        $this->assertEquals('LOC003', $response->data['locationId']);
        $this->assertRequestPath('/receiving');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'receivingUid' => 1,
            'status' => 'verified',
        ]);

        $response = $this->api->nexus->receiving->update(1, ['status' => 'verified']);

        $this->assertEquals('verified', $response->data['status']);
        $this->assertRequestPath('/receiving/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->nexus->receiving->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/receiving/1');
        $this->assertRequestMethod('DELETE');
    }
}
