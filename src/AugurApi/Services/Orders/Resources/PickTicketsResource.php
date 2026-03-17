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
     * Known fields: pickTicketNo, orderNo, companyId, carrierId, trackingNo, instructions, shipDate, invoiceNo, ... (19 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /pick-tickets/{pickTicketNo}
     *
     * Response data type: object
     * Known fields: pickTicketNo, orderNo, companyId, carrierId, trackingNo, instructions, shipDate, invoiceNo, ... (19 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /pick-tickets/{pickTicketNo}/lines
     *
     * Response data type: array
     * Known fields: pickTicketNo, lineNumber, companyId, printQuantity, shipQuantity, dateCreated, dateLastModified, unitOfMeasure, ... (19 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listLines(float $pickTicketNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{pickTicketNo}/lines',
            $params,
            ['pickTicketNo' => (string) $pickTicketNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /pick-tickets/{pickTicketNo}/lines/{lineNumber}
     *
     * Response data type: object
     * Known fields: pickTicketNo, lineNumber, companyId, printQuantity, shipQuantity, dateCreated, dateLastModified, unitOfMeasure, ... (19 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLines(float $lineNumber, float $pickTicketNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{pickTicketNo}/lines/{lineNumber}',
            $params,
            ['lineNumber' => (string) $lineNumber, 'pickTicketNo' => (string) $pickTicketNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
