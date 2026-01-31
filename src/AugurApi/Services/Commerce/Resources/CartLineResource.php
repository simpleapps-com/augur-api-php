<?php

declare(strict_types=1);

namespace AugurApi\Services\Commerce\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Cart line resource.
 *
 * @fullPath api.commerce.cartLine
 * @service commerce
 * @domain commerce
 */
final class CartLineResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get cart lines.
     *
     * @fullPath api.commerce.cartLine.get
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function get(int $cartHdrUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/cart-line/{cartHdrUid}',
            [],
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Delete all cart lines.
     *
     * @fullPath api.commerce.cartLine.deleteAll
     * @return BaseResponse<bool>
     */
    public function deleteAll(int $cartHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/cart-line/{cartHdrUid}',
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }

    /**
     * Add item to the cart.
     *
     * @fullPath api.commerce.cartLine.add
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function add(int $cartHdrUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/cart-line/{cartHdrUid}/add',
            $data,
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update item in the cart.
     *
     * @fullPath api.commerce.cartLine.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $cartHdrUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/cart-line/{cartHdrUid}/update',
            $data,
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete a specific cart line.
     *
     * @fullPath api.commerce.cartLine.deleteLine
     * @return BaseResponse<bool>
     */
    public function deleteLine(int $cartHdrUid, int $lineNo): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/cart-line/{cartHdrUid}/lines/{lineNo}',
            ['cartHdrUid' => (string) $cartHdrUid, 'lineNo' => (string) $lineNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
