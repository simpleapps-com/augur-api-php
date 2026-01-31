<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Nexus\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for TransferShippingResource.
 */
final class TransferShippingResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['transferReceiptUid' => 1, 'status' => 'shipped', 'carrier' => 'UPS'],
            ['transferReceiptUid' => 2, 'status' => 'pending', 'carrier' => 'FedEx'],
        ]);

        $response = $this->api->nexus->transferShipping->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['transferReceiptUid']);
        $this->assertEquals('shipped', $response->data[0]['status']);
        $this->assertRequestPath('/transfer-shipping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['transferReceiptUid' => 1, 'status' => 'shipped'],
        ]);

        $response = $this->api->nexus->transferShipping->list(['limit' => 10, 'carrier' => 'UPS']);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/transfer-shipping');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'transferReceiptUid' => 1,
            'status' => 'shipped',
            'carrier' => 'UPS',
            'trackingNumber' => '1Z999AA10123456784',
            'shipDate' => '2024-01-15',
        ]);

        $response = $this->api->nexus->transferShipping->get(1);

        $this->assertEquals(1, $response->data['transferReceiptUid']);
        $this->assertEquals('UPS', $response->data['carrier']);
        $this->assertEquals('1Z999AA10123456784', $response->data['trackingNumber']);
        $this->assertRequestPath('/transfer-shipping/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'transferReceiptUid' => 3,
            'status' => 'pending',
            'carrier' => 'USPS',
        ], 201);

        $response = $this->api->nexus->transferShipping->create([
            'transferId' => 'TRN001',
            'carrier' => 'USPS',
            'items' => [['itemId' => 'ITEM001', 'qty' => 10]],
        ]);

        $this->assertEquals(3, $response->data['transferReceiptUid']);
        $this->assertEquals('USPS', $response->data['carrier']);
        $this->assertRequestPath('/transfer-shipping');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'transferReceiptUid' => 1,
            'status' => 'delivered',
            'trackingNumber' => '1Z999AA10123456784',
        ]);

        $response = $this->api->nexus->transferShipping->update(1, [
            'status' => 'delivered',
            'trackingNumber' => '1Z999AA10123456784',
        ]);

        $this->assertEquals('delivered', $response->data['status']);
        $this->assertRequestPath('/transfer-shipping/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->nexus->transferShipping->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/transfer-shipping/1');
        $this->assertRequestMethod('DELETE');
    }
}
