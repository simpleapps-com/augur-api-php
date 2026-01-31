<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Nexus\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for BinTransferResource.
 */
final class BinTransferResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['binTransferHdrUid' => 1, 'status' => 'pending', 'fromBin' => 'A1'],
            ['binTransferHdrUid' => 2, 'status' => 'completed', 'fromBin' => 'B2'],
        ]);

        $response = $this->api->nexus->binTransfer->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['binTransferHdrUid']);
        $this->assertEquals('pending', $response->data[0]['status']);
        $this->assertRequestPath('/bin-transfer');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['binTransferHdrUid' => 1, 'status' => 'pending'],
        ]);

        $response = $this->api->nexus->binTransfer->list(['limit' => 10, 'status' => 'pending']);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/bin-transfer');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'binTransferHdrUid' => 1,
            'status' => 'pending',
            'fromBin' => 'A1',
            'toBin' => 'A2',
            'quantity' => 100,
        ]);

        $response = $this->api->nexus->binTransfer->get(1);

        $this->assertEquals(1, $response->data['binTransferHdrUid']);
        $this->assertEquals('A1', $response->data['fromBin']);
        $this->assertEquals(100, $response->data['quantity']);
        $this->assertRequestPath('/bin-transfer/1');
        $this->assertRequestMethod('GET');
    }

    public function testGetStatus(): void
    {
        $this->mockResponse([
            'binTransferHdrUid' => 1,
            'status' => 'in_progress',
            'lines' => [
                ['lineNo' => 1, 'itemId' => 'ITEM001', 'qty' => 50],
                ['lineNo' => 2, 'itemId' => 'ITEM002', 'qty' => 50],
            ],
        ]);

        $response = $this->api->nexus->binTransfer->getStatus(1);

        $this->assertEquals('in_progress', $response->data['status']);
        $this->assertCount(2, $response->data['lines']);
        $this->assertRequestPath('/bin-transfer/1/status');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'binTransferHdrUid' => 3,
            'status' => 'pending',
            'fromBin' => 'C1',
            'toBin' => 'C2',
        ], 201);

        $response = $this->api->nexus->binTransfer->create([
            'fromBin' => 'C1',
            'toBin' => 'C2',
            'quantity' => 50,
        ]);

        $this->assertEquals(3, $response->data['binTransferHdrUid']);
        $this->assertEquals('pending', $response->data['status']);
        $this->assertRequestPath('/bin-transfer');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'binTransferHdrUid' => 1,
            'status' => 'approved',
            'quantity' => 75,
        ]);

        $response = $this->api->nexus->binTransfer->update(1, [
            'status' => 'approved',
            'quantity' => 75,
        ]);

        $this->assertEquals('approved', $response->data['status']);
        $this->assertRequestPath('/bin-transfer/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->nexus->binTransfer->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/bin-transfer/1');
        $this->assertRequestMethod('DELETE');
    }
}
