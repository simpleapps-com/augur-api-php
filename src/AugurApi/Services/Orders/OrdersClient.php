<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Orders\Resources\InvoiceHdrResource;
use AugurApi\Services\Orders\Resources\OeHdrResource;
use AugurApi\Services\Orders\Resources\PickTicketsResource;
use AugurApi\Services\Orders\Resources\PoHdrResource;
use AugurApi\Services\Orders\Resources\PoLineResource;

/**
 * Orders service client — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://orders.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://orders.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://orders.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py orders
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /invoice-hdr/{invoiceNo}/reprint → $api->orders->invoiceHdr->listReprint($invoiceNo) →
 *       InvoiceHdrReprintListDataOption1|false
 *   GET /oe-hdr/lookup → $api->orders->oeHdr->getLookup() → list of OeHdrLookupGetItem
 *   GET /oe-hdr/{orderNo}/doc → $api->orders->oeHdr->listDoc($orderNo) → OeHdrDocListData
 *   GET /pick-tickets → $api->orders->pickTickets->list() → list of PickTicketsListItem
 *   GET /pick-tickets/{pickTicketNo} → $api->orders->pickTickets->get($pickTicketNo) →
 *       PickTicketsListItem
 *   GET /pick-tickets/{pickTicketNo}/lines → $api->orders->pickTickets->listLines($pickTicketNo) →
 *       list of PickTicketsLinesListItem
 *   GET /pick-tickets/{pickTicketNo}/lines/{lineNumber} →
 *       $api->orders->pickTickets->getLines($pickTicketNo, $lineNumber) → PickTicketsLinesListItem
 *   GET /po-hdr → $api->orders->poHdr->list() → list of PoHdrListItem
 *   GET /po-hdr/{poNo} → $api->orders->poHdr->get($poNo) → PoHdrListItem
 *   GET /po-hdr/{poNo}/doc → $api->orders->poHdr->listDoc($poNo) → PoHdrListItem
 *   GET /po-line → $api->orders->poLine->list() → list of PoLineListItem
 *   GET /po-line/{poLineUid} → $api->orders->poLine->get($poLineUid) → PoLineListItem
 */
final class OrdersClient extends BaseServiceClient
{
    public readonly InvoiceHdrResource $invoiceHdr;
    public readonly OeHdrResource $oeHdr;
    public readonly PickTicketsResource $pickTickets;
    public readonly PoHdrResource $poHdr;
    public readonly PoLineResource $poLine;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->invoiceHdr = new InvoiceHdrResource($this->client, $this->baseUrl . '/invoice-hdr');
        $this->oeHdr = new OeHdrResource($this->client, $this->baseUrl . '/oe-hdr');
        $this->pickTickets = new PickTicketsResource($this->client, $this->baseUrl . '/pick-tickets');
        $this->poHdr = new PoHdrResource($this->client, $this->baseUrl . '/po-hdr');
        $this->poLine = new PoLineResource($this->client, $this->baseUrl . '/po-line');
    }

    protected function getServiceName(): string
    {
        return 'orders';
    }
}
