<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for invoice endpoints on CustomerResource.
 */
final class InvoicesResourceTest extends AugurApiTestCase
{
    public function testListInvoices(): void
    {
        $this->mockListResponse([
            ['invoiceNo' => 1001, 'amount' => 100.00, 'status' => 'paid'],
            ['invoiceNo' => 1002, 'amount' => 250.00, 'status' => 'pending'],
        ]);

        $response = $this->api->customers->customer->listInvoices(1001);

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1001, $data[0]['invoiceNo']);
        $this->assertEquals(100.00, $data[0]['amount']);
        $this->assertRequestPath('/customer/1001/invoices');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListInvoicesWithParams(): void
    {
        $this->mockListResponse([
            ['invoiceNo' => 1001, 'amount' => 100.00],
        ]);

        $response = $this->api->customers->customer->listInvoices(1001, ['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/1001/invoices');
    }

    public function testGetInvoices(): void
    {
        $this->mockResponse([
            'invoiceNo' => 1001,
            'customerId' => 1001,
            'amount' => 100.00,
            'status' => 'paid',
            'dueDate' => '2024-02-01',
        ]);

        $response = $this->api->customers->customer->getInvoices(1001, 1001);

        $this->assertEquals(1001, $response->data['invoiceNo']);
        $this->assertEquals(100.00, $response->data['amount']);
        $this->assertRequestPath('/customer/1001/invoices/1001');
        $this->assertRequestMethod('GET');
    }
}
