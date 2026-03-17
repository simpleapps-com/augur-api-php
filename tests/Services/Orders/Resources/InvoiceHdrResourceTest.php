<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Orders\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class InvoiceHdrResourceTest extends AugurApiTestCase
{
    public function testListReprint(): void
    {
        $this->mockResponse([
            'invoiceNo' => 123,
            'status' => 'queued',
            'printJobId' => 'PJ12345',
            'message' => 'Invoice queued for reprinting',
        ]);

        $response = $this->api->orders->invoiceHdr->listReprint(123);

        $this->assertEquals(123, $response->data['invoiceNo']);
        $this->assertEquals('queued', $response->data['status']);
        $this->assertEquals('PJ12345', $response->data['printJobId']);
        $this->assertRequestPath('/invoice-hdr/123/reprint');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListReprintWithDifferentInvoice(): void
    {
        $this->mockResponse([
            'invoiceNo' => 999,
            'status' => 'queued',
        ]);

        $response = $this->api->orders->invoiceHdr->listReprint(999);

        $this->assertEquals(999, $response->data['invoiceNo']);
        $this->assertRequestPath('/invoice-hdr/999/reprint');
    }

    public function testListReprintSuccess(): void
    {
        $this->mockResponse([
            'invoiceNo' => 456,
            'status' => 'completed',
            'printedAt' => '2024-01-15T10:30:00Z',
        ]);

        $response = $this->api->orders->invoiceHdr->listReprint(456);

        $this->assertEquals('completed', $response->data['status']);
        $this->assertArrayHasKey('printedAt', $response->data);
    }

    public function testListReprintWithEmail(): void
    {
        $this->mockResponse([
            'invoiceNo' => 789,
            'status' => 'emailed',
            'emailSentTo' => 'customer@example.com',
        ]);

        $response = $this->api->orders->invoiceHdr->listReprint(789);

        $this->assertEquals('emailed', $response->data['status']);
    }
}
