<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * poHdr resource — generated from spec.
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
 * PoHdrListItem: One purchase order with its vendor, supplier and lines
 * Returned by: $api->orders->poHdr->list()
 * Returned by: $api->orders->poHdr->get($poNo)
 * Returned by: $api->orders->poHdr->listDoc($poNo)
 *   poHdrUid: int — Purchase order header ID
 *   complete: string|null — Y when the purchase order is complete
 *   poNo: float — Prophet 21 purchase order number
 *   vendorId: float — Prophet 21 vendor the purchase order is placed with
 *   vendorName: string|null — Vendor name; empty when the vendor cannot be read
 *   supplierId: float|null — Prophet 21 supplier
 *   supplierName: string|null — Supplier name; empty when there is no supplier
 *   divisionId: float|null — Prophet 21 division
 *   orderDate: PoHdrListItemOrderDate|null — When the purchase order was placed
 *   companyNo: string — Prophet 21 company
 *   ship2Name: string|null — Ship-to name
 *   packingSlipNumber: string|null — Vendor packing slip number
 *   ship2Add1: string|null — Ship-to address line 1
 *   ship2Add2: string|null — Ship-to address line 2
 *   locationId: float — Prophet 21 location receiving the purchase order
 *   lines: list<PoHdrListItemLinesItem> — Purchase order lines
 *     each item: PoHdrListItemLinesItem — One purchase order line with its item and the receiving
 *         location's bin settings
 *
 * PoHdrListItemOrderDate: When the purchase order was placed
 * Field `orderDate` of PoHdrListItem
 *   date: string — Date and time (Y-m-d H:i:s.u)
 *   timezone_type: int — PHP timezone type (3 = named timezone)
 *   timezone: string — Timezone name, e.g. UTC
 *
 * PoHdrListItemLinesItem: One purchase order line with its item and the receiving location's bin
 * settings
 * Field `lines` of PoHdrListItem
 *   lineNo: float — Line number on the purchase order
 *   qtyOrdered: float — Quantity ordered
 *   qtyReceived: float — Quantity received so far
 *   qtyOutstanding: float — Quantity still to receive: qtyOrdered - qtyReceived
 *   invMastUid: int — Item (inv_mast) on the line
 *   itemId: string — Item ID
 *   itemDesc: string|null — Item description
 *   serialized: string — Y when the item is serialized
 *   trackBins: string|null — Y when the receiving location tracks bins for the item
 *   primaryBin: string|null — Item's primary bin at the receiving location
 *   lotAssignmentRequired: string — Y when receiving the item requires a lot assignment, else N
 *
 * @phpstan-type PoHdrListItem array{poHdrUid: int, complete: string|null, poNo: float, vendorId: float, vendorName: string|null, supplierId: float|null, supplierName: string|null, divisionId: float|null, orderDate: PoHdrListItemOrderDate|null, companyNo: string, ship2Name: string|null, packingSlipNumber: string|null, ship2Add1: string|null, ship2Add2: string|null, locationId: float, lines: list<PoHdrListItemLinesItem>}
 * @phpstan-type PoHdrListItemOrderDate array{date: string, timezone_type: int, timezone: string}
 * @phpstan-type PoHdrListItemLinesItem array{lineNo: float, qtyOrdered: float, qtyReceived: float, qtyOutstanding: float, invMastUid: int, itemId: string, itemDesc: string|null, serialized: string, trackBins: string|null, primaryBin: string|null, lotAssignmentRequired: string}
 */
final class PoHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /po-hdr
     *
     * List purchase orders
     * Call: $api->orders->poHdr->list()
     *
     * List purchase order documents, each with its lines
     *
     * Response data, each item: One purchase order with its vendor, supplier and lines
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a po_hdr column.
     *
     * GET https://orders.augur-api.com/po-hdr
     * Contract: https://orders.augur-api.com/openapi.json#/paths/~1po-hdr/get
     *
     * Query params ($params; `?` = optional):
     *   complete?: string — Y for completed purchase orders, N for open ones
     *   limit?: int — Maximum purchase orders to return (default 10)
     *   locationId?: int — Only purchase orders received into this Prophet 21 location
     *   offset?: int — Purchase orders to skip before the first one returned
     *   orderBy?: string — Sort as column|ASC or column|DESC on a po_hdr column (default
     *       po_hdr_uid|ASC)
     *   q?: string — Text matched anywhere in the PO number, PO description or external PO number
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of PoHdrListItem (fields listed on the class)
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
     * GET /po-hdr/{poNo}
     *
     * get the purchase order details
     * Call: $api->orders->poHdr->get($poNo)
     *
     * Response data: One purchase order with its vendor, supplier and lines
     *
     * Errors:
     *   404: No purchase order with this number.
     *
     * GET https://orders.augur-api.com/po-hdr/{poNo}
     * Contract: https://orders.augur-api.com/openapi.json#/paths/~1po-hdr~1{poNo}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: PoHdrListItem (fields listed on the class)
     *
     * @param int $poNo Prophet 21 purchase order number
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $poNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{poNo}',
            $params,
            ['poNo' => (string) $poNo],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /po-hdr/{poNo}/doc
     *
     * get the purchase order document
     * Call: $api->orders->poHdr->listDoc($poNo)
     *
     * Response data: One purchase order with its vendor, supplier and lines
     *
     * Errors:
     *   404: No purchase order with this number.
     *
     * GET https://orders.augur-api.com/po-hdr/{poNo}/doc
     * Contract: https://orders.augur-api.com/openapi.json#/paths/~1po-hdr~1{poNo}~1doc/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: PoHdrListItem (fields listed on the class)
     *
     * @param int $poNo Prophet 21 purchase order number
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDoc(int $poNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{poNo}/doc',
            $params,
            ['poNo' => (string) $poNo],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /po-hdr/{poNo}/doc
     * Call: $api->orders->poHdr->getDoc($poNo)
     *
     * @param int $poNo Prophet 21 purchase order number
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $poNo, array $params = []): BaseResponse
    {
        return $this->listDoc($poNo, $params);
    }
}
