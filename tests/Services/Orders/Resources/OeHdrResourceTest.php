<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Orders\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class OeHdrResourceTest extends AugurApiTestCase
{
    public function testGetLookup(): void
    {
        $this->mockListResponse([
            [
                'orderNo' => 1001,
                'customerId' => 'CUST001',
                'orderDate' => '2024-01-15',
                'total' => 1500.00,
                'status' => 'open',
            ],
            [
                'orderNo' => 1002,
                'customerId' => 'CUST002',
                'orderDate' => '2024-01-16',
                'total' => 2500.00,
                'status' => 'shipped',
            ],
        ]);

        $response = $this->api->orders->oeHdr->getLookup();

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1001, $data[0]['orderNo']);
        $this->assertEquals('open', $data[0]['status']);
        $this->assertRequestPath('/oe-hdr/lookup');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testGetLookupWithParams(): void
    {
        $this->mockListResponse([
            ['orderNo' => 1001, 'customerId' => 'CUST001'],
        ]);

        $response = $this->api->orders->oeHdr->getLookup([
            'customerId' => 'CUST001',
            'completed' => 'N',
        ]);

        $this->assertCount(1, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('CUST001', $data[0]['customerId']);
    }

    public function testGetLookupWithDateRange(): void
    {
        $this->mockListResponse([
            ['orderNo' => 1003, 'orderDate' => '2024-01-10'],
            ['orderNo' => 1004, 'orderDate' => '2024-01-12'],
        ]);

        $response = $this->api->orders->oeHdr->getLookup([
            'dateOrderCompleted' => '2024-01-15',
        ]);

        $this->assertCount(2, $response->data);
    }

    public function testGetLookupEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->orders->oeHdr->getLookup(['q' => 'NONEXISTENT']);

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }

    public function testGetDoc(): void
    {
        $this->mockResponse([
            'orderNo' => 12345,
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

        $response = $this->api->orders->oeHdr->getDoc(12345);

        $this->assertEquals(12345, $response->data['orderNo']);
        $this->assertEquals('Test Customer', $response->data['customerName']);
        $this->assertCount(2, $response->data['lines']);
        $this->assertRequestPath('/oe-hdr/12345/doc');
        $this->assertRequestMethod('GET');
    }

    public function testGetDocWithDifferentOrder(): void
    {
        $this->mockResponse([
            'orderNo' => 99999,
            'lines' => [],
        ]);

        $response = $this->api->orders->oeHdr->getDoc(99999);

        $this->assertEquals(99999, $response->data['orderNo']);
        $this->assertRequestPath('/oe-hdr/99999/doc');
    }
}
