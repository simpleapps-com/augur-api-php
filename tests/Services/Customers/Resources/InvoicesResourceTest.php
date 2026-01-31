<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for InvoicesResource.
 */
final class InvoicesResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['invoiceNo' => 'INV001', 'amount' => 100.00, 'status' => 'paid'],
            ['invoiceNo' => 'INV002', 'amount' => 250.00, 'status' => 'pending'],
        ]);

        $response = $this->api->customers->invoices->list('CUST001');

        $this->assertCount(2, $response->data);
        $this->assertEquals('INV001', $response->data[0]['invoiceNo']);
        $this->assertEquals(100.00, $response->data[0]['amount']);
        $this->assertRequestPath('/customer/CUST001/invoices');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['invoiceNo' => 'INV001', 'amount' => 100.00],
        ]);

        $response = $this->api->customers->invoices->list('CUST001', ['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/CUST001/invoices');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'invoiceNo' => 'INV001',
            'customerId' => 'CUST001',
            'amount' => 100.00,
            'status' => 'paid',
            'dueDate' => '2024-02-01',
        ]);

        $response = $this->api->customers->invoices->get('CUST001', 'INV001');

        $this->assertEquals('INV001', $response->data['invoiceNo']);
        $this->assertEquals(100.00, $response->data['amount']);
        $this->assertRequestPath('/customer/CUST001/invoices/INV001');
        $this->assertRequestMethod('GET');
    }
}
