<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Orders;

use AugurApi\Services\Orders\OrdersClient;
use AugurApi\Services\Orders\Resources\InvoiceHdrResource;
use AugurApi\Services\Orders\Resources\OeHdrResource;
use AugurApi\Services\Orders\Resources\OeHdrSalesrepResource;
use AugurApi\Services\Orders\Resources\PickTicketsResource;
use AugurApi\Services\Orders\Resources\PoHdrResource;
use AugurApi\Tests\AugurApiTestCase;

final class OrdersClientTest extends AugurApiTestCase
{
    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();

        $response = $this->api->orders->healthCheck();

        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();

        $response = $this->api->orders->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();

        $response = $this->api->orders->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
    }

    public function testInvoiceHdrResourceAccess(): void
    {
        $this->assertInstanceOf(InvoiceHdrResource::class, $this->api->orders->invoiceHdr);
    }

    public function testOeHdrResourceAccess(): void
    {
        $this->assertInstanceOf(OeHdrResource::class, $this->api->orders->oeHdr);
    }

    public function testOeHdrSalesrepResourceAccess(): void
    {
        $this->assertInstanceOf(OeHdrSalesrepResource::class, $this->api->orders->oeHdrSalesrep);
    }

    public function testPickTicketsResourceAccess(): void
    {
        $this->assertInstanceOf(PickTicketsResource::class, $this->api->orders->pickTickets);
    }

    public function testPoHdrResourceAccess(): void
    {
        $this->assertInstanceOf(PoHdrResource::class, $this->api->orders->poHdr);
    }

    public function testServiceClientIsCached(): void
    {
        $orders1 = $this->api->orders;
        $orders2 = $this->api->orders;

        $this->assertSame($orders1, $orders2);
    }

    public function testServiceClientType(): void
    {
        $this->assertInstanceOf(OrdersClient::class, $this->api->orders);
    }
}
