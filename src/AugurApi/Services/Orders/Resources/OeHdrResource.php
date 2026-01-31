<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Order entry header resource.
 *
 * @fullPath api.orders.oeHdr
 * @service orders
 * @domain order-management
 */
final class OeHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Lookup order entry header summary.
     *
     * @fullPath api.orders.oeHdr.lookup
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function lookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/oe-hdr/lookup', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get the order document.
     *
     * @fullPath api.orders.oeHdr.getDoc
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(string $orderNo): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/oe-hdr/{orderNo}/doc',
            [],
            ['orderNo' => $orderNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
