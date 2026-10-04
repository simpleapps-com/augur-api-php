<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * oeHdr resource — generated from spec.
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
 * OeHdrLookupGetItem: One order header in an order lookup
 * Returned by: $api->orders->oeHdr->getLookup()
 *   oeHdrUid: int — Order header ID
 *   orderNo: string — Prophet 21 order number
 *   poNo: string|null — Customer purchase order number
 *   customerId: float — Prophet 21 customer the order belongs to
 *   ship2Name: string|null — Ship-to name
 *   ship2EmailAddress: string|null — Ship-to email address
 *   webReferenceNo: string|null — Web order reference number from the storefront
 *   customerName: string|null — Customer name
 *   completed: string|null — Y when the order is complete (fully shipped)
 *   orderDate: string — Date the order was placed (Y-m-d); empty when unknown
 *   taker: string|null — User who entered the order
 *   class1Id: string|null — Order class 1
 *   jobName: string|null — Job name entered on the order
 *   orderStatus: string — PENDING, SUBMITTED, IN PROCESS, ON HOLD or SHIPPED, derived from the
 *       completed, approved, cancel and validation flags
 *
 * OeHdrDocListData: One order, quote or RMA document: the `oe_hdr` header with its lines and pick
 * tickets.
 * Returned by: $api->orders->oeHdr->listDoc($orderNo)
 *   orderNo: string — Prophet 21 order number
 *   customerId: float — Prophet 21 customer the order belongs to
 *   customerName: string|null — Customer name
 *   jobName: string|null — Job name entered on the order
 *   orderDate: string|null — Date the order was placed (Y-m-d)
 *   requestedDate: string|null — Date the customer requested delivery (Y-m-d)
 *   cancelFlag: string|null — Y when the order is canceled
 *   completed: string|null — Y when the order is complete (fully shipped)
 *   deleteFlag: string — Y when the order is deleted in Prophet 21
 *   poNo: string|null — Customer purchase order number
 *   ship2Name: string|null — Ship-to name
 *   ship2Add1: string|null — Ship-to address line 1
 *   ship2Add2: string|null — Ship-to address line 2
 *   ship2Add3: string|null — Ship-to address line 3
 *   ship2City: string|null — Ship-to city
 *   ship2State: string|null — Ship-to state or province
 *   ship2Zip: string|null — Ship-to postal code
 *   ship2Country: string|null — Ship-to country
 *   ship2EmailAddress: string|null — Ship-to email address
 *   shipToPhone: string|null — Ship-to phone number
 *   deliveryInstructions: string|null — Delivery instructions for the carrier
 *   class1Id: string|null — Order class 1
 *   class2Id: string|null — Order class 2
 *   class3Id: string|null — Order class 3
 *   class4Id: string|null — Order class 4
 *   class5Id: string|null — Order class 5
 *   contactId: string|null — Prophet 21 contact who placed the order
 *   webReferenceNo: string|null — Web order reference number from the storefront
 *   orderStatus: string — PENDING, SUBMITTED, IN PROCESS, ON HOLD or SHIPPED, derived from the
 *       completed, approved, cancel and validation flags
 *   taker: string|null — User who entered the order
 *   contactFirstName: string|null — First name of the ordering contact; null when the order has no
 *       contact
 *   contactLastName: string|null — Last name of the ordering contact; null when the order has no
 *       contact
 *   carrierId: float|null — Prophet 21 address id of the order's carrier
 *   carrierName: string — Carrier name; empty when the order has no carrier
 *   lines: list<OeHdrDocListDataLinesItem> — Order lines, by line number
 *     each item: OeHdrDocListDataLinesItem — One `oe_line` row on an order document.
 *   pickTickets: list<OeHdrDocListDataPickTicketsItem> — Pick tickets issued for the order
 *     each item: OeHdrDocListDataPickTicketsItem — One `oe_pick_ticket` on an order document, with
 *         its shipped lines.
 *
 * OeHdrDocListDataLinesItem: One `oe_line` row on an order document.
 * Field `lines` of OeHdrDocListData
 *   invMastUid: int — Item (inv_mast) ordered on the line
 *   cancelFlag: string|null — Y when the line is canceled
 *   complete: string|null — Y when the line is complete
 *   deleteFlag: string — Y when the line is deleted in Prophet 21
 *   disposition: string|null — Prophet 21 disposition code for unallocated quantity (e.g. B =
 *       backorder)
 *   itemDesc: string|null — Item description
 *   displayDesc: string|null — Item description shown on the storefront
 *   itemId: string — Item ID
 *   shortCode: string|null — Item short code
 *   lineNo: float — Line number on the order
 *   orderNo: string — Order the line belongs to
 *   originalQtyOrdered: float|null — Quantity on the line when it was entered
 *   qtyAllocated: float|null — Quantity allocated from stock
 *   qtyCanceled: float|null — Quantity canceled
 *   qtyInvoiced: float|null — Quantity invoiced
 *   qtyOnPickTickets: float|null — Quantity on open pick tickets
 *   qtyOrdered: float|null — Quantity ordered
 *   unitOfMeasure: string|null — Unit of measure the line was sold in
 *   unitQuantity: float — Quantity in the line's unit of measure
 *   unitSize: float — Base units per unit of measure
 *   unitPrice: float|null — Price per unit of measure
 *   extendedPrice: float|null — Line total
 *   oeLineUid: int — Order line ID
 *   parentOeLineUid: int — Parent line's oeLineUid for an assembly component; 0 for a top-level
 *       line
 *   trinityItemId: string|null — Trinity private-label item ID (trinitysurfaces only)
 *   trinityItemDesc: string|null — Trinity private-label item description (trinitysurfaces only)
 *   agentItemId: string|null — Agent private-label item ID (trinitysurfaces only)
 *   agentItemDesc: string|null — Agent private-label item description (trinitysurfaces only)
 *
 * OeHdrDocListDataPickTicketsItem: One `oe_pick_ticket` on an order document, with its shipped
 * lines.
 * Field `pickTickets` of OeHdrDocListData
 *   pickTicketNo: float — Pick ticket number
 *   trackingNo: string|null — Carrier tracking number
 *   orderNo: string — Order the pick ticket belongs to
 *   invoiceNo: float|null — Invoice raised for the pick ticket; null until invoiced
 *   shipDate: string|null — Date the pick ticket shipped (Y-m-d)
 *   printedFlag: string|null — Y when the pick ticket has been printed
 *   printDate: string|null — Date the pick ticket was printed (Y-m-d)
 *   instructions: string|null — Picking or shipping instructions
 *   carrierId: float|null — Prophet 21 address id of the pick ticket's carrier
 *   carrierName: string — Carrier name; empty when the pick ticket has no carrier
 *   lines: list<OeHdrDocListDataPickTicketsItemLinesItem> — Lines on the pick ticket
 *     each item: OeHdrDocListDataPickTicketsItemLinesItem — One `oe_pick_ticket_detail` row on a
 *         pick ticket.
 *
 * OeHdrDocListDataPickTicketsItemLinesItem: One `oe_pick_ticket_detail` row on a pick ticket.
 * Field `lines` of OeHdrDocListDataPickTicketsItem
 *   lineNumber: float — Line number on the pick ticket
 *   shipQuantity: float|null — Quantity shipped
 *   qtyRequested: float|null — Quantity requested for picking
 *   invMastUid: int — Item (inv_mast) on the line
 *   itemId: string — Item ID
 *   itemDesc: string|null — Item description
 *   displayDesc: string|null — Item description shown on the storefront
 *   trinityItemId: string|null — Trinity private-label item ID (trinitysurfaces only)
 *   trinityItemDesc: string|null — Trinity private-label item description (trinitysurfaces only)
 *   agentItemId: string|null — Agent private-label item ID (trinitysurfaces only)
 *   agentItemDesc: string|null — Agent private-label item description (trinitysurfaces only)
 *
 * @phpstan-type OeHdrLookupGetItem array{oeHdrUid: int, orderNo: string, poNo: string|null, customerId: float, ship2Name: string|null, ship2EmailAddress: string|null, webReferenceNo: string|null, customerName: string|null, completed: string|null, orderDate: string, taker: string|null, class1Id: string|null, jobName: string|null, orderStatus: string}
 * @phpstan-type OeHdrDocListData array{orderNo: string, customerId: float, customerName: string|null, jobName: string|null, orderDate: string|null, requestedDate: string|null, cancelFlag: string|null, completed: string|null, deleteFlag: string, poNo: string|null, ship2Name: string|null, ship2Add1: string|null, ship2Add2: string|null, ship2Add3: string|null, ship2City: string|null, ship2State: string|null, ship2Zip: string|null, ship2Country: string|null, ship2EmailAddress: string|null, shipToPhone: string|null, deliveryInstructions: string|null, class1Id: string|null, class2Id: string|null, class3Id: string|null, class4Id: string|null, class5Id: string|null, contactId: string|null, webReferenceNo: string|null, orderStatus: string, taker: string|null, contactFirstName: string|null, contactLastName: string|null, carrierId: float|null, carrierName: string, lines: list<OeHdrDocListDataLinesItem>, pickTickets: list<OeHdrDocListDataPickTicketsItem>}
 * @phpstan-type OeHdrDocListDataLinesItem array{invMastUid: int, cancelFlag: string|null, complete: string|null, deleteFlag: string, disposition: string|null, itemDesc: string|null, displayDesc: string|null, itemId: string, shortCode: string|null, lineNo: float, orderNo: string, originalQtyOrdered: float|null, qtyAllocated: float|null, qtyCanceled: float|null, qtyInvoiced: float|null, qtyOnPickTickets: float|null, qtyOrdered: float|null, unitOfMeasure: string|null, unitQuantity: float, unitSize: float, unitPrice: float|null, extendedPrice: float|null, oeLineUid: int, parentOeLineUid: int, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}
 * @phpstan-type OeHdrDocListDataPickTicketsItem array{pickTicketNo: float, trackingNo: string|null, orderNo: string, invoiceNo: float|null, shipDate: string|null, printedFlag: string|null, printDate: string|null, instructions: string|null, carrierId: float|null, carrierName: string, lines: list<OeHdrDocListDataPickTicketsItemLinesItem>}
 * @phpstan-type OeHdrDocListDataPickTicketsItemLinesItem array{lineNumber: float, shipQuantity: float|null, qtyRequested: float|null, invMastUid: int, itemId: string, itemDesc: string|null, displayDesc: string|null, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}
 */
final class OeHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /oe-hdr/lookup
     *
     * Search order headers
     * Call: $api->orders->oeHdr->getLookup()
     *
     * Search order headers (canceled orders excluded) by customer address, class, completion,
     * salesrep, taker or free text
     *
     * Response data, each item: One order header in an order lookup
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an oe_hdr column, or dateOrderCompleted is
     *       not a date.
     *
     * GET https://orders.augur-api.com/oe-hdr/lookup
     * Contract: https://orders.augur-api.com/openapi.json#/paths/~1oe-hdr~1lookup/get
     *
     * Query params ($params; `?` = optional):
     *   addressId?: float — Only orders for this Prophet 21 customer address
     *   class1Id?: string — Only orders with this order class 1
     *   completed?: string — Y for completed orders, N for open orders; ORed with
     *       dateOrderCompleted when both are sent
     *   dateOrderCompleted?: string — Orders completed after this date; ORed with completed when
     *       both are sent
     *   limit?: int — Maximum orders to return (default 10)
     *   offset?: int — Orders to skip before the first one returned
     *   orderBy?: string — Sort as column|ASC or column|DESC on an oe_hdr column (default
     *       order_no|ASC)
     *   q?: string — Text matched anywhere in the order number, PO number, web reference number,
     *       ship-to name or ship-to email
     *   salesrepId?: string — Only orders assigned to this salesrep (their 100 most recent)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *   taker?: string — Only orders entered by this user
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of OeHdrLookupGetItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /oe-hdr/{orderNo}/doc
     *
     * get the order document
     * Call: $api->orders->oeHdr->listDoc($orderNo)
     *
     * Response data: One order, quote or RMA document: the `oe_hdr` header with its lines and pick
     * tickets.
     *
     * Errors:
     *   400: postalCode is not five digits or does not match the order's ship-to postal code.
     *   404: No order with this number.
     *
     * GET https://orders.augur-api.com/oe-hdr/{orderNo}/doc
     * Contract: https://orders.augur-api.com/openapi.json#/paths/~1oe-hdr~1{orderNo}~1doc/get
     *
     * Query params ($params; `?` = optional):
     *   postalCode?: string — Ship-to postal code (first 5 digits); when sent, the order is
     *       returned only if it matches, else 400
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: OeHdrDocListData (fields listed on the class)
     *
     * @param string $orderNo Prophet 21 order number
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDoc(string $orderNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{orderNo}/doc',
            $params,
            ['orderNo' => (string) $orderNo],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /oe-hdr/{orderNo}/doc
     * Call: $api->orders->oeHdr->getDoc($orderNo)
     *
     * @param string $orderNo Prophet 21 order number
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(string $orderNo, array $params = []): BaseResponse
    {
        return $this->listDoc($orderNo, $params);
    }
}
