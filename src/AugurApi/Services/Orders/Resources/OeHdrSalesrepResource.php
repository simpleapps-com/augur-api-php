<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Order entry header salesrep resource.
 *
 * @fullPath api.orders.oeHdrSalesrep
 * @service orders
 * @domain order-management
 */
final class OeHdrSalesrepResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get order entry header data for salesrep.
     *
     * @fullPath api.orders.oeHdrSalesrep.getOeHdr
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getOeHdr(string $salesrepId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/oe-hdr-salesrep/{salesrepId}/oe-hdr',
            $params,
            ['salesrepId' => $salesrepId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get order entry header details for salesrep.
     *
     * @fullPath api.orders.oeHdrSalesrep.getOeHdrDoc
     * @return BaseResponse<array<string, mixed>>
     */
    public function getOeHdrDoc(string $salesrepId, string $orderNo): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/oe-hdr-salesrep/{salesrepId}/oe-hdr/{orderNo}/doc',
            [],
            ['salesrepId' => $salesrepId, 'orderNo' => $orderNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
