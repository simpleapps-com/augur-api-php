<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Apis\Resources;

use AugurApi\Services\P21Apis\Resources\TransPurchaseOrderReceiptResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for TransPurchaseOrderReceiptResource.
 */
#[CoversClass(TransPurchaseOrderReceiptResource::class)]
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

        $this->assertEquals('PO-12345', self::at($response->data, 'poNo'));
        $this->assertEquals('VENDOR001', self::at($response->data, 'vendorId'));
        $this->assertEquals('received', self::at($response->data, 'status'));
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/trans-purchase-order-receipt/PO-12345');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
