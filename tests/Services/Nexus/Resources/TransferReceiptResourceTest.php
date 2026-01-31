<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Nexus\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for TransferReceiptResource.
 */
final class TransferReceiptResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['transferReceiptUid' => 1, 'status' => 'received', 'transferId' => 'TRN001'],
            ['transferReceiptUid' => 2, 'status' => 'pending', 'transferId' => 'TRN002'],
        ]);

        $response = $this->api->nexus->transferReceipt->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['transferReceiptUid']);
        $this->assertEquals('received', $response->data[0]['status']);
        $this->assertRequestPath('/transfer-receipt');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['transferReceiptUid' => 1, 'status' => 'received'],
        ]);

        $response = $this->api->nexus->transferReceipt->list(['limit' => 10, 'status' => 'received']);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/transfer-receipt');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'transferReceiptUid' => 1,
            'status' => 'received',
            'transferId' => 'TRN001',
            'receivedBy' => 'user123',
            'receivedDate' => '2024-01-15',
        ]);

        $response = $this->api->nexus->transferReceipt->get(1);

        $this->assertEquals(1, $response->data['transferReceiptUid']);
        $this->assertEquals('TRN001', $response->data['transferId']);
        $this->assertRequestPath('/transfer-receipt/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'transferReceiptUid' => 3,
            'status' => 'pending',
            'transferId' => 'TRN003',
        ], 201);

        $response = $this->api->nexus->transferReceipt->create([
            'transferId' => 'TRN003',
            'receivedItems' => [['itemId' => 'ITEM001', 'qty' => 25]],
        ]);

        $this->assertEquals(3, $response->data['transferReceiptUid']);
        $this->assertEquals('TRN003', $response->data['transferId']);
        $this->assertRequestPath('/transfer-receipt');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'transferReceiptUid' => 1,
            'status' => 'verified',
        ]);

        $response = $this->api->nexus->transferReceipt->update(1, ['status' => 'verified']);

        $this->assertEquals('verified', $response->data['status']);
        $this->assertRequestPath('/transfer-receipt/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->nexus->transferReceipt->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/transfer-receipt/1');
        $this->assertRequestMethod('DELETE');
    }
}
