<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Pick tickets resource.
 *
 * @fullPath api.orders.pickTickets
 * @service orders
 * @domain order-management
 */
final class PickTicketsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List pick tickets.
     *
     * @fullPath api.orders.pickTickets.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/pick-tickets', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get pick ticket details.
     *
     * @fullPath api.orders.pickTickets.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $pickTicketNo): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/pick-tickets/{pickTicketNo}',
            [],
            ['pickTicketNo' => $pickTicketNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * List pick ticket lines.
     *
     * @fullPath api.orders.pickTickets.getLines
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getLines(string $pickTicketNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/pick-tickets/{pickTicketNo}/lines',
            $params,
            ['pickTicketNo' => $pickTicketNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get pick ticket line detail.
     *
     * @fullPath api.orders.pickTickets.getLine
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLine(string $pickTicketNo, int $lineNumber): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/pick-tickets/{pickTicketNo}/lines/{lineNumber}',
            [],
            ['pickTicketNo' => $pickTicketNo, 'lineNumber' => (string) $lineNumber],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
