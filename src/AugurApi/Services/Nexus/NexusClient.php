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
 * Nexus service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py nexus
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
        $this->binTransfer = new BinTransferResource($client, $this->baseUrl . '/bin-transfer');
        $this->purchaseOrderReceipt = new PurchaseOrderReceiptResource($client, $this->baseUrl . '/purchase-order-receipt');
        $this->receiving = new ReceivingResource($client, $this->baseUrl . '/receiving');
        $this->transfer = new TransferResource($client, $this->baseUrl . '/transfer');
        $this->transferReceipt = new TransferReceiptResource($client, $this->baseUrl . '/transfer-receipt');
        $this->transferShipping = new TransferShippingResource($client, $this->baseUrl . '/transfer-shipping');
    }

    protected function getServiceName(): string
    {
        return 'nexus';
    }
}
