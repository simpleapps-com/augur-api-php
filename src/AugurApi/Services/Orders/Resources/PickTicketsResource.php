<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * pickTickets resource — generated from spec.
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
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * PickTicketsListItem:
 * Returned by: $api->orders->pickTickets->list()
 * Returned by: $api->orders->pickTickets->get($pickTicketNo)
 *   pickTicketNo: float — Prophet 21 pick ticket number
 *   orderNo: string — Prophet 21 sales order number (max 8 chars)
 *   companyId: string — Prophet 21 company id (max 8 chars)
 *   carrierId: float|null — Prophet 21 carrier id for the shipment
 *   trackingNo: string|null — Shipment tracking number (max 40 chars)
 *   instructions: string|null — Instructions on the pick ticket (max 255 chars)
 *   shipDate: string|null — Date the pick ticket shipped (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   invoiceNo: float|null — Prophet 21 invoice number for the shipment
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   locationId: float — Prophet 21 location the pick ticket ships from
 *   deleteFlag: string — Y when the pick ticket is deleted (max 1 chars)
 *   updateCd: int — Update code (704 = queued for refresh from Prophet 21, 1185 = current)
 *   printedFlag: string|null — Y when the pick ticket has been printed (max 1 chars)
 *   confirmableRowStatusFlag: int — Confirmable row status flag
 *   directShipment: string|null — Y when the pick ticket is a direct shipment (max 1 chars)
 *   auxiliary: string — Y when the pick ticket is auxiliary (max 1 chars)
 *   printDate: string|null — When the pick ticket was printed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   oePickTicketTypeCd: int|null — Pick ticket type code
 *
 * PickTicketsLinesListItem: One pick ticket line (`oe_pick_ticket_detail`) with its item ID and
 * tracking pattern
 * Returned by: $api->orders->pickTickets->listLines($pickTicketNo)
 * Returned by: $api->orders->pickTickets->getLines($pickTicketNo, $lineNumber)
 *   pickTicketNo: float — Pick ticket the line belongs to
 *   lineNumber: float — Line number on the pick ticket
 *   companyId: string — Prophet 21 company
 *   printQuantity: float|null — Quantity printed on the pick ticket
 *   shipQuantity: float|null — Quantity shipped
 *   dateCreated: string — When the line was created (Y-m-d H:i:s)
 *   dateLastModified: string — When the line last changed (Y-m-d H:i:s)
 *   unitOfMeasure: string — Unit of measure the line is picked in
 *   unitSize: float — Base units per unit of measure
 *   unitQuantity: float — Quantity in the line's unit of measure
 *   oeLineNo: float — Order line number the pick ticket line fills
 *   qtyRequested: float|null — Quantity requested for picking
 *   qtyToPick: float|null — Quantity still to pick
 *   invMastUid: int — Item (inv_mast) on the line
 *   invoiceLineUid: int|null — Invoice line raised for the line; null until invoiced
 *   qtyScanned: float|null — Quantity scanned while picking
 *   boxNumber: string|null — Box the line was packed in
 *   originalQtyToPick: float|null — Quantity to pick when the pick ticket was created
 *   updateCd: int — Update code (704 = queued for refresh from Prophet 21, 1185 = current)
 *   itemId: string|null — Item ID; null when the line has no item
 *   trackingPattern: string|null — How the item is tracked: base, lot, serial or lot_serial; null
 *       when the line has no item
 *
 * @phpstan-type PickTicketsListItem array{pickTicketNo: float, orderNo: string, companyId: string, carrierId: float|null, trackingNo: string|null, instructions: string|null, shipDate: string|null, invoiceNo: float|null, dateCreated: string, dateLastModified: string, locationId: float, deleteFlag: string, updateCd: int, printedFlag: string|null, confirmableRowStatusFlag: int, directShipment: string|null, auxiliary: string, printDate: string|null, oePickTicketTypeCd: int|null}
 * @phpstan-type PickTicketsLinesListItem array{pickTicketNo: float, lineNumber: float, companyId: string, printQuantity: float|null, shipQuantity: float|null, dateCreated: string, dateLastModified: string, unitOfMeasure: string, unitSize: float, unitQuantity: float, oeLineNo: float, qtyRequested: float|null, qtyToPick: float|null, invMastUid: int, invoiceLineUid: int|null, qtyScanned: float|null, boxNumber: string|null, originalQtyToPick: float|null, updateCd: int, itemId: string|null, trackingPattern: string|null}
 */
final class PickTicketsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /pick-tickets
     *
     * List Pick Tickets
     * Call: $api->orders->pickTickets->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an oe_pick_ticket column.
     *
     * GET https://orders.augur-api.com/pick-tickets
     * Contract: https://orders.augur-api.com/openapi.json#/paths/~1pick-tickets/get
     *
     * Query params ($params; `?` = optional):
     *   companyId?: string — Only pick tickets for this Prophet 21 company
     *   deleteFlag?: string — Y for deleted pick tickets, N for live ones
     *   limit?: int — Limit number of results (Default: 10)
     *   locationId?: float — Only pick tickets shipping from this Prophet 21 location
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: pick_ticket_no|ASC)
     *   orderNo?: string — Order Number
     *   printedFlag?: string — Y for printed pick tickets, N for unprinted ones
     *   q?: string — Search Query
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of PickTicketsListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /pick-tickets/{pickTicketNo}
     *
     * Get Pick Ticket Details
     * Call: $api->orders->pickTickets->get($pickTicketNo)
     *
     * Errors:
     *   404: No pick ticket with this number.
     *
     * GET https://orders.augur-api.com/pick-tickets/{pickTicketNo}
     * Contract: https://orders.augur-api.com/openapi.json#/paths/~1pick-tickets~1{pickTicketNo}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: PickTicketsListItem (fields listed on the class)
     *
     * @param float $pickTicketNo Prophet 21 pick ticket number
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(float $pickTicketNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{pickTicketNo}',
            $params,
            ['pickTicketNo' => (string) $pickTicketNo],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /pick-tickets/{pickTicketNo}/lines
     *
     * List Pick Ticket Lines
     * Call: $api->orders->pickTickets->listLines($pickTicketNo)
     *
     * Response data, each item: One pick ticket line (`oe_pick_ticket_detail`) with its item ID and
     * tracking pattern
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an oe_pick_ticket_detail column.
     *   404: No pick ticket with this number.
     *
     * GET https://orders.augur-api.com/pick-tickets/{pickTicketNo}/lines
     * Contract:
     * https://orders.augur-api.com/openapi.json#/paths/~1pick-tickets~1{pickTicketNo}~1lines/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: line_number|ASC)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of PickTicketsLinesListItem (fields listed on the class)
     *
     * @param float $pickTicketNo Prophet 21 pick ticket number
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listLines(float $pickTicketNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{pickTicketNo}/lines',
            $params,
            ['pickTicketNo' => (string) $pickTicketNo],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /pick-tickets/{pickTicketNo}/lines/{lineNumber}
     *
     * Get Pick Ticket Line Detail
     * Call: $api->orders->pickTickets->getLines($pickTicketNo, $lineNumber)
     *
     * Response data: One pick ticket line (`oe_pick_ticket_detail`) with its item ID and tracking
     * pattern
     *
     * Errors:
     *   404: No line with this number on the pick ticket.
     *
     * GET https://orders.augur-api.com/pick-tickets/{pickTicketNo}/lines/{lineNumber}
     * Contract:
     * https://orders.augur-api.com/openapi.json#/paths/~1pick-tickets~1{pickTicketNo}~1lines~1{lineNumber}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: PickTicketsLinesListItem (fields listed on the class)
     *
     * @param float $pickTicketNo Prophet 21 pick ticket number
     * @param float $lineNumber Line number on the pick ticket
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLines(float $pickTicketNo, float $lineNumber, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{pickTicketNo}/lines/{lineNumber}',
            $params,
            ['pickTicketNo' => (string) $pickTicketNo, 'lineNumber' => (string) $lineNumber],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
