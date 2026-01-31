<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Orders\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class InvoiceHdrResourceTest extends AugurApiTestCase
{
    public function testReprint(): void
    {
        $this->mockResponse([
            'invoiceNo' => 'INV001',
            'status' => 'queued',
            'printJobId' => 'PJ12345',
            'message' => 'Invoice queued for reprinting',
        ]);

        $response = $this->api->orders->invoiceHdr->reprint('INV001');

        $this->assertEquals('INV001', $response->data['invoiceNo']);
        $this->assertEquals('queued', $response->data['status']);
        $this->assertEquals('PJ12345', $response->data['printJobId']);
        $this->assertRequestPath('/invoice-hdr/INV001/reprint');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testReprintWithDifferentInvoice(): void
    {
        $this->mockResponse([
            'invoiceNo' => 'INV999',
            'status' => 'queued',
        ]);

        $response = $this->api->orders->invoiceHdr->reprint('INV999');

        $this->assertEquals('INV999', $response->data['invoiceNo']);
        $this->assertRequestPath('/invoice-hdr/INV999/reprint');
    }

    public function testReprintSuccess(): void
    {
        $this->mockResponse([
            'invoiceNo' => 'INV123',
            'status' => 'completed',
            'printedAt' => '2024-01-15T10:30:00Z',
        ]);

        $response = $this->api->orders->invoiceHdr->reprint('INV123');

        $this->assertEquals('completed', $response->data['status']);
        $this->assertArrayHasKey('printedAt', $response->data);
    }

    public function testReprintWithEmail(): void
    {
        $this->mockResponse([
            'invoiceNo' => 'INV456',
            'status' => 'emailed',
            'emailSentTo' => 'customer@example.com',
        ]);

        $response = $this->api->orders->invoiceHdr->reprint('INV456');

        $this->assertEquals('emailed', $response->data['status']);
    }
}
