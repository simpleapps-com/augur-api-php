<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Nexus\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for PurchaseOrderReceiptResource.
 */
final class PurchaseOrderReceiptResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['purchaseOrderReceiptUid' => 1, 'poNumber' => 'PO001', 'status' => 'received'],
            ['purchaseOrderReceiptUid' => 2, 'poNumber' => 'PO002', 'status' => 'pending'],
        ]);

        $response = $this->api->nexus->purchaseOrderReceipt->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('PO001', $response->data[0]['poNumber']);
        $this->assertRequestPath('/purchase-order-receipt');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['purchaseOrderReceiptUid' => 1, 'poNumber' => 'PO001'],
        ]);

        $response = $this->api->nexus->purchaseOrderReceipt->list(['limit' => 10, 'status' => 'received']);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/purchase-order-receipt');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'purchaseOrderReceiptUid' => 1,
            'poNumber' => 'PO001',
            'status' => 'received',
            'vendorId' => 'VENDOR001',
            'receiptDate' => '2024-01-15',
        ]);

        $response = $this->api->nexus->purchaseOrderReceipt->get(1);

        $this->assertEquals(1, $response->data['purchaseOrderReceiptUid']);
        $this->assertEquals('PO001', $response->data['poNumber']);
        $this->assertRequestPath('/purchase-order-receipt/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'purchaseOrderReceiptUid' => 3,
            'poNumber' => 'PO003',
            'status' => 'pending',
        ], 201);

        $response = $this->api->nexus->purchaseOrderReceipt->create([
            'poNumber' => 'PO003',
            'vendorId' => 'VENDOR001',
        ]);

        $this->assertEquals(3, $response->data['purchaseOrderReceiptUid']);
        $this->assertEquals('PO003', $response->data['poNumber']);
        $this->assertRequestPath('/purchase-order-receipt');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'purchaseOrderReceiptUid' => 1,
            'poNumber' => 'PO001',
            'status' => 'verified',
        ]);

        $response = $this->api->nexus->purchaseOrderReceipt->update(1, ['status' => 'verified']);

        $this->assertEquals('verified', $response->data['status']);
        $this->assertRequestPath('/purchase-order-receipt/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->nexus->purchaseOrderReceipt->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/purchase-order-receipt/1');
        $this->assertRequestMethod('DELETE');
    }
}
