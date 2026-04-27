<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Orders\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class OeHdrSalesrepResourceTest extends AugurApiTestCase
{
    public function testListOeHdr(): void
    {
        $this->mockListResponse([
            [
                'orderNo' => 1001,
                'customerId' => 'CUST001',
                'orderDate' => '2024-01-15',
                'total' => 2500.00,
            ],
            [
                'orderNo' => 1002,
                'customerId' => 'CUST002',
                'orderDate' => '2024-01-16',
                'total' => 3500.00,
            ],
        ]);

        $response = $this->api->orders->oeHdrSalesrep->listOeHdr('100');

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1001, $data[0]['orderNo']);
        $this->assertRequestPath('/oe-hdr-salesrep/100/oe-hdr');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListOeHdrWithParams(): void
    {
        $this->mockListResponse([
            ['orderNo' => 1001, 'status' => 'open'],
        ]);

        $response = $this->api->orders->oeHdrSalesrep->listOeHdr('100', [
            'status' => 'open',
            'limit' => 10,
        ]);

        $this->assertCount(1, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('open', $data[0]['status']);
    }

    public function testListOeHdrWithDateRange(): void
    {
        $this->mockListResponse([
            ['orderNo' => 1003, 'orderDate' => '2024-01-10'],
        ]);

        $response = $this->api->orders->oeHdrSalesrep->listOeHdr('100', [
            'startDate' => '2024-01-01',
            'endDate' => '2024-01-15',
        ]);

        $this->assertCount(1, $response->data);
    }

    public function testListOeHdrEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->orders->oeHdrSalesrep->listOeHdr('999');

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
        $this->assertRequestPath('/oe-hdr-salesrep/999/oe-hdr');
    }

    public function testListOeHdrDoc(): void
    {
        $this->mockResponse([
            'orderNo' => 12345,
            'salesrepId' => 100,
            'customerId' => 'CUST001',
            'customerName' => 'Test Customer',
            'total' => 2500.00,
            'commission' => 125.00,
            'lines' => [
                ['lineNo' => 1, 'itemId' => 'ITEM001', 'quantity' => 10],
            ],
        ]);

        // Generated signature: listOeHdrDoc(string $salesrepId, int $orderNo, ...)
        $response = $this->api->orders->oeHdrSalesrep->listOeHdrDoc('100', 12345);

        $this->assertEquals(12345, $response->data['orderNo']);
        $this->assertEquals(100, $response->data['salesrepId']);
        $this->assertEquals(125.00, $response->data['commission']);
        $this->assertCount(1, $response->data['lines']);
        $this->assertRequestPath('/oe-hdr-salesrep/100/oe-hdr/12345/doc');
        $this->assertRequestMethod('GET');
    }

    public function testGetOeHdrDocAlias(): void
    {
        $this->mockResponse([
            'orderNo' => 99999,
            'salesrepId' => 200,
        ]);

        // Generated signature: getOeHdrDoc(string $salesrepId, int $orderNo, ...)
        $response = $this->api->orders->oeHdrSalesrep->getOeHdrDoc('200', 99999);

        $this->assertEquals(99999, $response->data['orderNo']);
        $this->assertEquals(200, $response->data['salesrepId']);
        $this->assertRequestPath('/oe-hdr-salesrep/200/oe-hdr/99999/doc');
    }
}
