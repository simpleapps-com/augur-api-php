<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Nexus;

use AugurApi\Services\Nexus\NexusClient;
use AugurApi\Services\Nexus\Resources\BinTransferResource;
use AugurApi\Services\Nexus\Resources\PurchaseOrderReceiptResource;
use AugurApi\Services\Nexus\Resources\ReceivingResource;
use AugurApi\Services\Nexus\Resources\TransferReceiptResource;
use AugurApi\Services\Nexus\Resources\TransferResource;
use AugurApi\Services\Nexus\Resources\TransferShippingResource;
use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for NexusClient.
 */
final class NexusClientTest extends AugurApiTestCase
{
    public function testNexusClientAccess(): void
    {
        $this->assertInstanceOf(NexusClient::class, $this->api->nexus);
    }

    public function testBinTransferResourceAccess(): void
    {
        $this->assertInstanceOf(BinTransferResource::class, $this->api->nexus->binTransfer);
    }

    public function testPurchaseOrderReceiptResourceAccess(): void
    {
        $this->assertInstanceOf(PurchaseOrderReceiptResource::class, $this->api->nexus->purchaseOrderReceipt);
    }

    public function testReceivingResourceAccess(): void
    {
        $this->assertInstanceOf(ReceivingResource::class, $this->api->nexus->receiving);
    }

    public function testTransferResourceAccess(): void
    {
        $this->assertInstanceOf(TransferResource::class, $this->api->nexus->transfer);
    }

    public function testTransferReceiptResourceAccess(): void
    {
        $this->assertInstanceOf(TransferReceiptResource::class, $this->api->nexus->transferReceipt);
    }

    public function testTransferShippingResourceAccess(): void
    {
        $this->assertInstanceOf(TransferShippingResource::class, $this->api->nexus->transferShipping);
    }

    public function testHealthCheck(): void
    {
        $this->mockHealthCheckResponse();
        $response = $this->api->nexus->healthCheck();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('abc123', $response->data['siteHash']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPing(): void
    {
        $this->mockPingResponse();
        $response = $this->api->nexus->ping();

        $this->assertEquals('pong', $response->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoami(): void
    {
        $this->mockWhoamiResponse();
        $response = $this->api->nexus->whoami();

        $this->assertEquals('TEST123', $response->data['siteId']);
        $this->assertEquals('Test Site', $response->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }
}
