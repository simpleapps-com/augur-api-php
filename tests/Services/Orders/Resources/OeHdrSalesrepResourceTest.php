<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Orders\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class OeHdrSalesrepResourceTest extends AugurApiTestCase
{
    public function testGetOeHdr(): void
    {
        $this->mockListResponse([
            [
                'orderNo' => 'ORD001',
                'customerId' => 'CUST001',
                'orderDate' => '2024-01-15',
                'total' => 2500.00,
            ],
            [
                'orderNo' => 'ORD002',
                'customerId' => 'CUST002',
                'orderDate' => '2024-01-16',
                'total' => 3500.00,
            ],
        ]);

        $response = $this->api->orders->oeHdrSalesrep->getOeHdr('SALES001');

        $this->assertCount(2, $response->data);
        $this->assertEquals('ORD001', $response->data[0]['orderNo']);
        $this->assertRequestPath('/oe-hdr-salesrep/SALES001/oe-hdr');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testGetOeHdrWithParams(): void
    {
        $this->mockListResponse([
            ['orderNo' => 'ORD001', 'status' => 'open'],
        ]);

        $response = $this->api->orders->oeHdrSalesrep->getOeHdr('SALES001', [
            'status' => 'open',
            'limit' => 10,
        ]);

        $this->assertCount(1, $response->data);
        $this->assertEquals('open', $response->data[0]['status']);
    }

    public function testGetOeHdrWithDateRange(): void
    {
        $this->mockListResponse([
            ['orderNo' => 'ORD003', 'orderDate' => '2024-01-10'],
        ]);

        $response = $this->api->orders->oeHdrSalesrep->getOeHdr('SALES001', [
            'startDate' => '2024-01-01',
            'endDate' => '2024-01-15',
        ]);

        $this->assertCount(1, $response->data);
    }

    public function testGetOeHdrEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->orders->oeHdrSalesrep->getOeHdr('SALES999');

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
        $this->assertRequestPath('/oe-hdr-salesrep/SALES999/oe-hdr');
    }

    public function testGetOeHdrDoc(): void
    {
        $this->mockResponse([
            'orderNo' => 'ORD001',
            'salesrepId' => 'SALES001',
            'customerId' => 'CUST001',
            'customerName' => 'Test Customer',
            'total' => 2500.00,
            'commission' => 125.00,
            'lines' => [
                ['lineNo' => 1, 'itemId' => 'ITEM001', 'quantity' => 10],
            ],
        ]);

        $response = $this->api->orders->oeHdrSalesrep->getOeHdrDoc('SALES001', 'ORD001');

        $this->assertEquals('ORD001', $response->data['orderNo']);
        $this->assertEquals('SALES001', $response->data['salesrepId']);
        $this->assertEquals(125.00, $response->data['commission']);
        $this->assertCount(1, $response->data['lines']);
        $this->assertRequestPath('/oe-hdr-salesrep/SALES001/oe-hdr/ORD001/doc');
        $this->assertRequestMethod('GET');
    }

    public function testGetOeHdrDocWithDifferentIds(): void
    {
        $this->mockResponse([
            'orderNo' => 'ORD999',
            'salesrepId' => 'SALES002',
        ]);

        $response = $this->api->orders->oeHdrSalesrep->getOeHdrDoc('SALES002', 'ORD999');

        $this->assertEquals('ORD999', $response->data['orderNo']);
        $this->assertEquals('SALES002', $response->data['salesrepId']);
        $this->assertRequestPath('/oe-hdr-salesrep/SALES002/oe-hdr/ORD999/doc');
    }
}
