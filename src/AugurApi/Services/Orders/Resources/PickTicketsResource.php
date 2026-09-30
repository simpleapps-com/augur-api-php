<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * pickTickets resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py orders
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
     * Response data type: array
     *   pickTicketNo: float
     *   orderNo: string
     *   companyId: string
     *   carrierId: float|null
     *   trackingNo: string|null
     *   instructions: string|null
     *   shipDate: string|null
     *   invoiceNo: float|null
     *   dateCreated: string
     *   dateLastModified: string
     *   locationId: float
     *   deleteFlag: string
     *   updateCd: int
     *   printedFlag: string|null
     *   confirmableRowStatusFlag: int
     *   directShipment: string|null
     *   auxiliary: string
     *   printDate: string|null
     *   oePickTicketTypeCd: int|null
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
     * Response data type: object
     *   pickTicketNo: float
     *   orderNo: string
     *   companyId: string
     *   carrierId: float|null
     *   trackingNo: string|null
     *   instructions: string|null
     *   shipDate: string|null
     *   invoiceNo: float|null
     *   dateCreated: string
     *   dateLastModified: string
     *   locationId: float
     *   deleteFlag: string
     *   updateCd: int
     *   printedFlag: string|null
     *   confirmableRowStatusFlag: int
     *   directShipment: string|null
     *   auxiliary: string
     *   printDate: string|null
     *   oePickTicketTypeCd: int|null
     *
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
     * Response data type: array
     *   pickTicketNo: float
     *   lineNumber: float
     *   companyId: string
     *   printQuantity: float|null
     *   shipQuantity: float|null
     *   dateCreated: string
     *   dateLastModified: string
     *   unitOfMeasure: string
     *   unitSize: float
     *   unitQuantity: float
     *   oeLineNo: float
     *   qtyRequested: float|null
     *   qtyToPick: float|null
     *   invMastUid: int
     *   invoiceLineUid: int|null
     *   qtyScanned: float|null
     *   boxNumber: string|null
     *   originalQtyToPick: float|null
     *   updateCd: int
     *
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
     * Response data type: object
     *   pickTicketNo: float
     *   lineNumber: float
     *   companyId: string
     *   printQuantity: float|null
     *   shipQuantity: float|null
     *   dateCreated: string
     *   dateLastModified: string
     *   unitOfMeasure: string
     *   unitSize: float
     *   unitQuantity: float
     *   oeLineNo: float
     *   qtyRequested: float|null
     *   qtyToPick: float|null
     *   invMastUid: int
     *   invoiceLineUid: int|null
     *   qtyScanned: float|null
     *   boxNumber: string|null
     *   originalQtyToPick: float|null
     *   updateCd: int
     *
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
