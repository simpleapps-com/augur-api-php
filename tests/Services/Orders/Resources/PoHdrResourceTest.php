<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Orders\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class PoHdrResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['poNo' => 'PO001', 'vendorId' => 'VEND001', 'status' => 'open', 'total' => 5000.00],
            ['poNo' => 'PO002', 'vendorId' => 'VEND002', 'status' => 'received', 'total' => 7500.00],
        ]);

        $response = $this->api->orders->poHdr->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('PO001', $response->data[0]['poNo']);
        $this->assertEquals('open', $response->data[0]['status']);
        $this->assertRequestPath('/po-hdr');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['poNo' => 'PO001', 'status' => 'open'],
        ], 25);

        $response = $this->api->orders->poHdr->list([
            'status' => 'open',
            'limit' => 10,
            'offset' => 0,
        ]);

        $this->assertCount(1, $response->data);
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
            'poNo' => 'PO001',
            'vendorId' => 'VEND001',
            'vendorName' => 'Test Vendor',
            'orderDate' => '2024-01-15',
            'expectedDate' => '2024-01-25',
            'status' => 'open',
            'total' => 5000.00,
        ]);

        $response = $this->api->orders->poHdr->get('PO001');

        $this->assertEquals('PO001', $response->data['poNo']);
        $this->assertEquals('Test Vendor', $response->data['vendorName']);
        $this->assertEquals(5000.00, $response->data['total']);
        $this->assertRequestPath('/po-hdr/PO001');
        $this->assertRequestMethod('GET');
    }

    public function testGetWithDifferentPo(): void
    {
        $this->mockResponse([
            'poNo' => 'PO999',
            'status' => 'closed',
        ]);

        $response = $this->api->orders->poHdr->get('PO999');

        $this->assertEquals('PO999', $response->data['poNo']);
        $this->assertRequestPath('/po-hdr/PO999');
    }

    public function testGetDoc(): void
    {
        $this->mockResponse([
            'poNo' => 'PO001',
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

        $response = $this->api->orders->poHdr->getDoc('PO001');

        $this->assertEquals('PO001', $response->data['poNo']);
        $this->assertCount(2, $response->data['lines']);
        $this->assertEquals(100, $response->data['lines'][0]['quantity']);
        $this->assertRequestPath('/po-hdr/PO001/doc');
        $this->assertRequestMethod('GET');
    }

    public function testGetDocWithDifferentPo(): void
    {
        $this->mockResponse([
            'poNo' => 'PO888',
            'lines' => [],
        ]);

        $response = $this->api->orders->poHdr->getDoc('PO888');

        $this->assertEquals('PO888', $response->data['poNo']);
        $this->assertRequestPath('/po-hdr/PO888/doc');
    }

    public function testScan(): void
    {
        $this->mockListResponse([
            ['poNo' => 'PO001', 'vendorId' => 'VEND001', 'matchScore' => 95],
            ['poNo' => 'PO005', 'vendorId' => 'VEND001', 'matchScore' => 80],
        ]);

        $response = $this->api->orders->poHdr->scan([
            'vendorId' => 'VEND001',
            'itemId' => 'ITEM001',
            'quantity' => 100,
        ]);

        $this->assertCount(2, $response->data);
        $this->assertEquals('PO001', $response->data[0]['poNo']);
        $this->assertEquals(95, $response->data[0]['matchScore']);
        $this->assertRequestPath('/po-hdr/scan');
        $this->assertRequestMethod('POST');
    }

    public function testScanWithDateRange(): void
    {
        $this->mockListResponse([
            ['poNo' => 'PO003', 'orderDate' => '2024-01-10'],
        ]);

        $response = $this->api->orders->poHdr->scan([
            'startDate' => '2024-01-01',
            'endDate' => '2024-01-15',
            'itemId' => 'ITEM001',
        ]);

        $this->assertCount(1, $response->data);
    }

    public function testScanEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->orders->poHdr->scan([
            'vendorId' => 'NONEXISTENT',
        ]);

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }
}
