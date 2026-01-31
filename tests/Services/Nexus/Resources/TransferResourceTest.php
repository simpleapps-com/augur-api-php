<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Nexus\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for TransferResource.
 */
final class TransferResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['transferUid' => 1, 'status' => 'in_transit', 'fromLocation' => 'WH001'],
            ['transferUid' => 2, 'status' => 'completed', 'fromLocation' => 'WH002'],
        ]);

        $response = $this->api->nexus->transfer->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['transferUid']);
        $this->assertEquals('in_transit', $response->data[0]['status']);
        $this->assertRequestPath('/transfer');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['transferUid' => 1, 'status' => 'in_transit'],
        ]);

        $response = $this->api->nexus->transfer->list(['limit' => 10, 'status' => 'in_transit']);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/transfer');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'transferUid' => 1,
            'status' => 'in_transit',
            'fromLocation' => 'WH001',
            'toLocation' => 'WH002',
            'createdDate' => '2024-01-15',
        ]);

        $response = $this->api->nexus->transfer->get(1);

        $this->assertEquals(1, $response->data['transferUid']);
        $this->assertEquals('WH001', $response->data['fromLocation']);
        $this->assertEquals('WH002', $response->data['toLocation']);
        $this->assertRequestPath('/transfer/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'transferUid' => 3,
            'status' => 'pending',
            'fromLocation' => 'WH001',
            'toLocation' => 'WH003',
        ], 201);

        $response = $this->api->nexus->transfer->create([
            'fromLocation' => 'WH001',
            'toLocation' => 'WH003',
            'items' => [['itemId' => 'ITEM001', 'qty' => 50]],
        ]);

        $this->assertEquals(3, $response->data['transferUid']);
        $this->assertEquals('WH003', $response->data['toLocation']);
        $this->assertRequestPath('/transfer');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'transferUid' => 1,
            'status' => 'shipped',
        ]);

        $response = $this->api->nexus->transfer->update(1, ['status' => 'shipped']);

        $this->assertEquals('shipped', $response->data['status']);
        $this->assertRequestPath('/transfer/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->nexus->transfer->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/transfer/1');
        $this->assertRequestMethod('DELETE');
    }
}
