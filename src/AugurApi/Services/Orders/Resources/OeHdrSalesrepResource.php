<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * oeHdrSalesrep resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py orders
 */
final class OeHdrSalesrepResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /oe-hdr-salesrep/{salesrepId}/oe-hdr
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listOeHdr(string $salesrepId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{salesrepId}/oe-hdr',
            $params,
            ['salesrepId' => (string) $salesrepId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /oe-hdr-salesrep/{salesrepId}/oe-hdr/{orderNo}/doc
     *
     * Response data type: object
     *   orderNo: string
     *   customerId: float
     *   customerName: string|null
     *   jobName: string|null
     *   orderDate: string|null
     *   requestedDate: string|null
     *   cancelFlag: string|null
     *   completed: string|null
     *   deleteFlag: string
     *   poNo: string|null
     *   ship2Name: string|null
     *   ship2Add1: string|null
     *   ship2Add2: string|null
     *   ship2Add3: string|null
     *   ship2City: string|null
     *   ship2State: string|null
     *   ship2Zip: string|null
     *   ship2Country: string|null
     *   ship2EmailAddress: string|null
     *   shipToPhone: string|null
     *   deliveryInstructions: string|null
     *   class1Id: string|null
     *   class2Id: string|null
     *   class3Id: string|null
     *   class4Id: string|null
     *   class5Id: string|null
     *   contactId: string|null
     *   webReferenceNo: string|null
     *   orderStatus: string
     *   taker: string|null
     *   contactFirstName: string|null
     *   contactLastName: string|null
     *   carrierId: float|null
     *   carrierName: string
     *   lines: list<array{invMastUid: int, cancelFlag: string|null, complete: string|null, deleteFlag: string, disposition: string|null, itemDesc: string|null, displayDesc: string|null, itemId: string, shortCode: string|null, lineNo: float, orderNo: string, originalQtyOrdered: float|null, qtyAllocated: float|null, qtyCanceled: float|null, qtyInvoiced: float|null, qtyOnPickTickets: float|null, qtyOrdered: float|null, unitOfMeasure: string|null, unitQuantity: float, unitSize: float, unitPrice: float|null, extendedPrice: float|null, oeLineUid: int, parentOeLineUid: int, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}>
     *   pickTickets: list<array{pickTicketNo: float, trackingNo: string|null, orderNo: string, invoiceNo: float|null, shipDate: string|null, printedFlag: string|null, printDate: string|null, instructions: string|null, carrierId: float|null, carrierName: string, lines: list<array{lineNumber: float, shipQuantity: float|null, qtyRequested: float|null, invMastUid: int, itemId: string, itemDesc: string|null, displayDesc: string|null, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}>}>
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listOeHdrDoc(string $salesrepId, int $orderNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{salesrepId}/oe-hdr/{orderNo}/doc',
            $params,
            ['salesrepId' => (string) $salesrepId, 'orderNo' => (string) $orderNo],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listOeHdrDoc — GET /oe-hdr-salesrep/{salesrepId}/oe-hdr/{orderNo}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getOeHdrDoc(string $salesrepId, int $orderNo, array $params = []): BaseResponse
    {
        return $this->listOeHdrDoc($salesrepId, $orderNo, $params);
    }
}
