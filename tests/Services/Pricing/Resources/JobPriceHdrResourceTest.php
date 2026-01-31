<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Pricing\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class JobPriceHdrResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['jobPriceHdrUid' => 1, 'customerId' => 'CUST001', 'jobName' => 'Project A', 'status' => 'active'],
            ['jobPriceHdrUid' => 2, 'customerId' => 'CUST002', 'jobName' => 'Project B', 'status' => 'completed'],
        ]);

        $response = $this->api->pricing->jobPriceHdr->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Project A', $response->data[0]['jobName']);
        $this->assertEquals('active', $response->data[0]['status']);
        $this->assertRequestPath('/job-price-hdr');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['jobPriceHdrUid' => 1, 'status' => 'active'],
        ], 50);

        $response = $this->api->pricing->jobPriceHdr->list([
            'status' => 'active',
            'limit' => 10,
        ]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
    }

    public function testListEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->pricing->jobPriceHdr->list();

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'jobPriceHdrUid' => 123,
            'customerId' => 'CUST001',
            'jobName' => 'Main Project',
            'startDate' => '2024-01-01',
            'endDate' => '2024-12-31',
            'status' => 'active',
            'totalValue' => 50000.00,
        ]);

        $response = $this->api->pricing->jobPriceHdr->get(123);

        $this->assertEquals(123, $response->data['jobPriceHdrUid']);
        $this->assertEquals('Main Project', $response->data['jobName']);
        $this->assertEquals(50000.00, $response->data['totalValue']);
        $this->assertRequestPath('/job-price-hdr/123');
        $this->assertRequestMethod('GET');
    }

    public function testGetWithDifferentId(): void
    {
        $this->mockResponse([
            'jobPriceHdrUid' => 456,
            'jobName' => 'Another Project',
        ]);

        $response = $this->api->pricing->jobPriceHdr->get(456);

        $this->assertEquals(456, $response->data['jobPriceHdrUid']);
        $this->assertRequestPath('/job-price-hdr/456');
    }

    public function testGetLines(): void
    {
        $this->mockListResponse([
            [
                'jobPriceLineUid' => 1,
                'itemId' => 'ITEM001',
                'description' => 'Test Item 1',
                'quantity' => 100,
                'unitPrice' => 25.00,
                'lineTotal' => 2500.00,
            ],
            [
                'jobPriceLineUid' => 2,
                'itemId' => 'ITEM002',
                'description' => 'Test Item 2',
                'quantity' => 50,
                'unitPrice' => 50.00,
                'lineTotal' => 2500.00,
            ],
        ]);

        $response = $this->api->pricing->jobPriceHdr->getLines(123);

        $this->assertCount(2, $response->data);
        $this->assertEquals('ITEM001', $response->data[0]['itemId']);
        $this->assertEquals(2500.00, $response->data[0]['lineTotal']);
        $this->assertRequestPath('/job-price-hdr/123/lines');
        $this->assertRequestMethod('GET');
    }

    public function testGetLinesWithParams(): void
    {
        $this->mockListResponse([
            ['jobPriceLineUid' => 1, 'itemId' => 'ITEM001'],
        ]);

        $response = $this->api->pricing->jobPriceHdr->getLines(123, [
            'limit' => 10,
            'orderBy' => 'itemId',
        ]);

        $this->assertCount(1, $response->data);
    }

    public function testGetLinesEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->pricing->jobPriceHdr->getLines(999);

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }

    public function testGetLine(): void
    {
        $this->mockResponse([
            'jobPriceHdrUid' => 123,
            'jobPriceLineUid' => 1,
            'itemId' => 'ITEM001',
            'description' => 'Detailed Item Description',
            'quantity' => 100,
            'unitPrice' => 25.00,
            'lineTotal' => 2500.00,
            'discountPercent' => 10,
            'netPrice' => 22.50,
        ]);

        $response = $this->api->pricing->jobPriceHdr->getLine(123, 1);

        $this->assertEquals(1, $response->data['jobPriceLineUid']);
        $this->assertEquals('ITEM001', $response->data['itemId']);
        $this->assertEquals(10, $response->data['discountPercent']);
        $this->assertEquals(22.50, $response->data['netPrice']);
        $this->assertRequestPath('/job-price-hdr/123/lines/1');
        $this->assertRequestMethod('GET');
    }

    public function testGetLineWithDifferentIds(): void
    {
        $this->mockResponse([
            'jobPriceHdrUid' => 456,
            'jobPriceLineUid' => 5,
            'itemId' => 'ITEM005',
        ]);

        $response = $this->api->pricing->jobPriceHdr->getLine(456, 5);

        $this->assertEquals(456, $response->data['jobPriceHdrUid']);
        $this->assertEquals(5, $response->data['jobPriceLineUid']);
        $this->assertRequestPath('/job-price-hdr/456/lines/5');
    }
}
