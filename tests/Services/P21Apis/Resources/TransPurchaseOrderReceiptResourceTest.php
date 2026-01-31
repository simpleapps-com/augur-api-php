<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Apis\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for TransPurchaseOrderReceiptResource.
 *
 * @covers \AugurApi\Services\P21Apis\Resources\TransPurchaseOrderReceiptResource
 */
final class TransPurchaseOrderReceiptResourceTest extends AugurApiTestCase
{
    public function testGet(): void
    {
        $this->mockResponse([
            'poNo' => 'PO-12345',
            'vendorId' => 'VENDOR001',
            'status' => 'received',
            'totalAmount' => 1500.00,
        ]);

        $response = $this->api->p21Apis->transPurchaseOrderReceipt->get('PO-12345');

        $this->assertEquals('PO-12345', $response->data['poNo']);
        $this->assertEquals('VENDOR001', $response->data['vendorId']);
        $this->assertEquals('received', $response->data['status']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/trans-purchase-order-receipt/PO-12345');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'poNo' => 'PO-12345',
            'vendorId' => 'VENDOR001',
            'status' => 'completed',
            'totalAmount' => 1500.00,
        ]);

        $response = $this->api->p21Apis->transPurchaseOrderReceipt->update('PO-12345', [
            'status' => 'completed',
        ]);

        $this->assertEquals('completed', $response->data['status']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/trans-purchase-order-receipt/PO-12345');
    }

    public function testUpdateWithMultipleFields(): void
    {
        $this->mockResponse([
            'poNo' => 'PO-67890',
            'receivedDate' => '2024-01-15',
            'receivedBy' => 'USER001',
        ]);

        $response = $this->api->p21Apis->transPurchaseOrderReceipt->update('PO-67890', [
            'receivedDate' => '2024-01-15',
            'receivedBy' => 'USER001',
        ]);

        $this->assertEquals('2024-01-15', $response->data['receivedDate']);
        $this->assertEquals('USER001', $response->data['receivedBy']);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
