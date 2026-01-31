<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Orders\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class OeHdrResourceTest extends AugurApiTestCase
{
    public function testLookup(): void
    {
        $this->mockListResponse([
            [
                'orderNo' => 'ORD001',
                'customerId' => 'CUST001',
                'orderDate' => '2024-01-15',
                'total' => 1500.00,
                'status' => 'open',
            ],
            [
                'orderNo' => 'ORD002',
                'customerId' => 'CUST002',
                'orderDate' => '2024-01-16',
                'total' => 2500.00,
                'status' => 'shipped',
            ],
        ]);

        $response = $this->api->orders->oeHdr->lookup();

        $this->assertCount(2, $response->data);
        $this->assertEquals('ORD001', $response->data[0]['orderNo']);
        $this->assertEquals('open', $response->data[0]['status']);
        $this->assertRequestPath('/oe-hdr/lookup');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testLookupWithParams(): void
    {
        $this->mockListResponse([
            ['orderNo' => 'ORD001', 'customerId' => 'CUST001'],
        ]);

        $response = $this->api->orders->oeHdr->lookup([
            'customerId' => 'CUST001',
            'status' => 'open',
        ]);

        $this->assertCount(1, $response->data);
        $this->assertEquals('CUST001', $response->data[0]['customerId']);
    }

    public function testLookupWithDateRange(): void
    {
        $this->mockListResponse([
            ['orderNo' => 'ORD003', 'orderDate' => '2024-01-10'],
            ['orderNo' => 'ORD004', 'orderDate' => '2024-01-12'],
        ]);

        $response = $this->api->orders->oeHdr->lookup([
            'startDate' => '2024-01-01',
            'endDate' => '2024-01-15',
        ]);

        $this->assertCount(2, $response->data);
    }

    public function testLookupEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->orders->oeHdr->lookup(['customerId' => 'NONEXISTENT']);

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }

    public function testGetDoc(): void
    {
        $this->mockResponse([
            'orderNo' => 'ORD001',
            'customerId' => 'CUST001',
            'customerName' => 'Test Customer',
            'orderDate' => '2024-01-15',
            'shipDate' => '2024-01-17',
            'total' => 1500.00,
            'lines' => [
                ['lineNo' => 1, 'itemId' => 'ITEM001', 'quantity' => 5, 'unitPrice' => 100.00],
                ['lineNo' => 2, 'itemId' => 'ITEM002', 'quantity' => 10, 'unitPrice' => 100.00],
            ],
        ]);

        $response = $this->api->orders->oeHdr->getDoc('ORD001');

        $this->assertEquals('ORD001', $response->data['orderNo']);
        $this->assertEquals('Test Customer', $response->data['customerName']);
        $this->assertCount(2, $response->data['lines']);
        $this->assertRequestPath('/oe-hdr/ORD001/doc');
        $this->assertRequestMethod('GET');
    }

    public function testGetDocWithDifferentOrder(): void
    {
        $this->mockResponse([
            'orderNo' => 'ORD999',
            'lines' => [],
        ]);

        $response = $this->api->orders->oeHdr->getDoc('ORD999');

        $this->assertEquals('ORD999', $response->data['orderNo']);
        $this->assertRequestPath('/oe-hdr/ORD999/doc');
    }
}
