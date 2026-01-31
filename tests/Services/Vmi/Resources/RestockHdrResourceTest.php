<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Vmi\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for RestockHdrResource.
 *
 * @covers \AugurApi\Services\Vmi\Resources\RestockHdrResource
 */
final class RestockHdrResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['restockHdrUid' => 1, 'warehouseUid' => 100, 'status' => 'pending'],
            ['restockHdrUid' => 2, 'warehouseUid' => 200, 'status' => 'completed'],
        ]);

        $response = $this->api->vmi->restockHdr->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['restockHdrUid']);
        $this->assertEquals('pending', $response->data[0]['status']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/restock-hdr');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['restockHdrUid' => 1, 'status' => 'pending'],
        ], 50);

        $response = $this->api->vmi->restockHdr->list(['status' => 'pending', 'limit' => 25]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'restockHdrUid' => 1,
            'warehouseUid' => 100,
            'status' => 'pending',
            'createdAt' => '2024-01-15',
            'totalItems' => 50,
        ]);

        $response = $this->api->vmi->restockHdr->get(1);

        $this->assertEquals(1, $response->data['restockHdrUid']);
        $this->assertEquals(100, $response->data['warehouseUid']);
        $this->assertEquals('pending', $response->data['status']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/restock-hdr/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'restockHdrUid' => 3,
            'warehouseUid' => 300,
            'status' => 'pending',
        ]);

        $response = $this->api->vmi->restockHdr->create([
            'warehouseUid' => 300,
        ]);

        $this->assertEquals(3, $response->data['restockHdrUid']);
        $this->assertEquals(300, $response->data['warehouseUid']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/restock-hdr');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'restockHdrUid' => 1,
            'status' => 'processing',
        ]);

        $response = $this->api->vmi->restockHdr->update(1, [
            'status' => 'processing',
        ]);

        $this->assertEquals('processing', $response->data['status']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/restock-hdr/1');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->vmi->restockHdr->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/restock-hdr/1');
    }
}
