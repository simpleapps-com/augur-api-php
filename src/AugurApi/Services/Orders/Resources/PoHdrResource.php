<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Purchase order header resource.
 *
 * @fullPath api.orders.poHdr
 * @service orders
 * @domain order-management
 */
final class PoHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List purchase orders.
     *
     * @fullPath api.orders.poHdr.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/po-hdr', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get purchase order details.
     *
     * @fullPath api.orders.poHdr.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $poNo): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/po-hdr/{poNo}',
            [],
            ['poNo' => $poNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get the purchase order document.
     *
     * @fullPath api.orders.poHdr.getDoc
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(string $poNo): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/po-hdr/{poNo}/doc',
            [],
            ['poNo' => $poNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Scan for similar purchase orders based on criteria.
     *
     * @fullPath api.orders.poHdr.scan
     * @param array<string, mixed> $data
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function scan(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/po-hdr/scan', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d ?? []);
    }
}
