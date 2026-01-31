<?php

declare(strict_types=1);

namespace AugurApi\Services\Commerce\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Cart header resource.
 *
 * @fullPath api.commerce.cartHdr
 * @service commerce
 * @domain commerce
 */
final class CartHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List cart headers by user_id.
     *
     * @fullPath api.commerce.cartHdr.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/cart-hdr/list', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Lookup cart header.
     *
     * @fullPath api.commerce.cartHdr.lookup
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function lookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/cart-hdr/lookup', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * List also bought data for cart header.
     *
     * @fullPath api.commerce.cartHdr.getAlsoBought
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getAlsoBought(int $cartHdrUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/cart-hdr/{cartHdrUid}/also-bought',
            [],
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
