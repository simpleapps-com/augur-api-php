<?php

declare(strict_types=1);

namespace AugurApi\Services\Nexus;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Nexus\Resources\BinTransferResource;
use AugurApi\Services\Nexus\Resources\PurchaseOrderReceiptResource;
use AugurApi\Services\Nexus\Resources\ReceivingResource;
use AugurApi\Services\Nexus\Resources\TransferReceiptResource;
use AugurApi\Services\Nexus\Resources\TransferResource;
use AugurApi\Services\Nexus\Resources\TransferShippingResource;

/**
 * Nexus service client.
 *
 * @fullPath api.nexus
 * @service nexus
 * @domain warehouse
 */
final class NexusClient extends BaseServiceClient
{
    public readonly BinTransferResource $binTransfer;
    public readonly PurchaseOrderReceiptResource $purchaseOrderReceipt;
    public readonly ReceivingResource $receiving;
    public readonly TransferResource $transfer;
    public readonly TransferReceiptResource $transferReceipt;
    public readonly TransferShippingResource $transferShipping;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->binTransfer = new BinTransferResource($client, $this->baseUrl);
        $this->purchaseOrderReceipt = new PurchaseOrderReceiptResource($client, $this->baseUrl);
        $this->receiving = new ReceivingResource($client, $this->baseUrl);
        $this->transfer = new TransferResource($client, $this->baseUrl);
        $this->transferReceipt = new TransferReceiptResource($client, $this->baseUrl);
        $this->transferShipping = new TransferShippingResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'nexus';
    }
}
