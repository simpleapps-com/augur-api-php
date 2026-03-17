<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for quote endpoints on CustomerResource.
 */
final class QuotesResourceTest extends AugurApiTestCase
{
    public function testListQuotes(): void
    {
        $this->mockListResponse([
            ['orderNo' => 5001, 'total' => 500.00, 'status' => 'pending'],
            ['orderNo' => 5002, 'total' => 750.00, 'status' => 'approved'],
        ]);

        $response = $this->api->customers->customer->listQuotes(1001);

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(5001, $data[0]['orderNo']);
        $this->assertEquals(500.00, $data[0]['total']);
        $this->assertRequestPath('/customer/1001/quotes');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListQuotesWithParams(): void
    {
        $this->mockListResponse([
            ['orderNo' => 5001, 'total' => 500.00],
        ]);

        $response = $this->api->customers->customer->listQuotes(1001, ['limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/1001/quotes');
    }

    public function testGetQuotes(): void
    {
        $this->mockResponse([
            'orderNo' => 5001,
            'customerId' => 1001,
            'total' => 500.00,
            'status' => 'pending',
            'expirationDate' => '2024-03-01',
        ]);

        $response = $this->api->customers->customer->getQuotes(1001, 5001);

        $this->assertEquals(5001, $response->data['orderNo']);
        $this->assertEquals(500.00, $response->data['total']);
        $this->assertRequestPath('/customer/1001/quotes/5001');
        $this->assertRequestMethod('GET');
    }
}
