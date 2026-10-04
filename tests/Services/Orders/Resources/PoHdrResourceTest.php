<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Orders\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class PoHdrResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['poNo' => 5001, 'vendorId' => 'VEND001', 'status' => 'open', 'total' => 5000.00],
            ['poNo' => 5002, 'vendorId' => 'VEND002', 'status' => 'received', 'total' => 7500.00],
        ]);

        $response = $this->api->orders->poHdr->list();

        $this->assertCount(2, self::arrayAt($response->data));
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(5001, $data[0]['poNo']);
        $this->assertEquals('open', $data[0]['status']);
        $this->assertRequestPath('/po-hdr');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['poNo' => 5001, 'status' => 'open'],
        ], 25);

        $response = $this->api->orders->poHdr->list([
            'complete' => 'N',
            'limit' => 10,
            'offset' => 0,
        ]);

        $this->assertCount(1, self::arrayAt($response->data));
        $this->assertEquals(25, $response->total);
    }

    public function testListEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->orders->poHdr->list();

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'poNo' => 5001,
            'vendorId' => 'VEND001',
            'vendorName' => 'Test Vendor',
            'orderDate' => '2024-01-15',
            'expectedDate' => '2024-01-25',
            'status' => 'open',
            'total' => 5000.00,
        ]);

        $response = $this->api->orders->poHdr->get(5001);

        $this->assertEquals(5001, self::at($response->data, 'poNo'));
        $this->assertEquals('Test Vendor', self::at($response->data, 'vendorName'));
        $this->assertEquals(5000.00, self::at($response->data, 'total'));
        $this->assertRequestPath('/po-hdr/5001');
        $this->assertRequestMethod('GET');
    }

    public function testGetWithDifferentPo(): void
    {
        $this->mockResponse([
            'poNo' => 9999,
            'status' => 'closed',
        ]);

        $response = $this->api->orders->poHdr->get(9999);

        $this->assertEquals(9999, self::at($response->data, 'poNo'));
        $this->assertRequestPath('/po-hdr/9999');
    }

    public function testGetDoc(): void
    {
        $this->mockResponse([
            'poNo' => 5001,
            'vendorId' => 'VEND001',
            'vendorName' => 'Test Vendor',
            'lines' => [
                ['lineNo' => 1, 'itemId' => 'ITEM001', 'quantity' => 100, 'unitCost' => 25.00],
                ['lineNo' => 2, 'itemId' => 'ITEM002', 'quantity' => 50, 'unitCost' => 50.00],
            ],
            'subtotal' => 5000.00,
            'tax' => 400.00,
            'total' => 5400.00,
        ]);

        $response = $this->api->orders->poHdr->getDoc(5001);

        $this->assertEquals(5001, self::at($response->data, 'poNo'));
        $this->assertCount(2, self::arrayAt($response->data, 'lines'));
        $this->assertEquals(100, self::at($response->data, 'lines', 0, 'quantity'));
        $this->assertRequestPath('/po-hdr/5001/doc');
        $this->assertRequestMethod('GET');
    }

    public function testGetDocWithDifferentPo(): void
    {
        $this->mockResponse([
            'poNo' => 8888,
            'lines' => [],
        ]);

        $response = $this->api->orders->poHdr->getDoc(8888);

        $this->assertEquals(8888, self::at($response->data, 'poNo'));
        $this->assertRequestPath('/po-hdr/8888/doc');
    }
}
