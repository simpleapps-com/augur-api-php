<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Orders\Resources\InvoiceHdrResource;
use AugurApi\Services\Orders\Resources\OeHdrResource;
use AugurApi\Services\Orders\Resources\OeHdrSalesrepResource;
use AugurApi\Services\Orders\Resources\PickTicketsResource;
use AugurApi\Services\Orders\Resources\PoHdrResource;

/**
 * Orders service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py orders
 */
final class OrdersClient extends BaseServiceClient
{
    public readonly InvoiceHdrResource $invoiceHdr;
    public readonly OeHdrResource $oeHdr;
    public readonly OeHdrSalesrepResource $oeHdrSalesrep;
    public readonly PickTicketsResource $pickTickets;
    public readonly PoHdrResource $poHdr;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->invoiceHdr = new InvoiceHdrResource($client, $this->baseUrl . '/invoice-hdr');
        $this->oeHdr = new OeHdrResource($client, $this->baseUrl . '/oe-hdr');
        $this->oeHdrSalesrep = new OeHdrSalesrepResource($client, $this->baseUrl . '/oe-hdr-salesrep');
        $this->pickTickets = new PickTicketsResource($client, $this->baseUrl . '/pick-tickets');
        $this->poHdr = new PoHdrResource($client, $this->baseUrl . '/po-hdr');
    }

    protected function getServiceName(): string
    {
        return 'orders';
    }
}
