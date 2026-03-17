<?php

declare(strict_types=1);

namespace AugurApi\Services\Commerce\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * cartLine resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py commerce
 */
final class CartLineResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * DELETE /cart-line/{cartHdrUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $cart_hdr_uid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{cartHdrUid}',
            ['cart_hdr_uid' => (string) $cart_hdr_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /cart-line/{cartHdrUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $cart_hdr_uid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{cartHdrUid}',
            $params,
            ['cart_hdr_uid' => (string) $cart_hdr_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /cart-line/{cartHdrUid}/add
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAdd(int $cart_hdr_uid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{cartHdrUid}/add',
            $data,
            ['cart_hdr_uid' => (string) $cart_hdr_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /cart-line/{cartHdrUid}/lines/{lineNo}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteLines(int $cart_hdr_uid, int $line_no): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{cartHdrUid}/lines/{lineNo}',
            ['cart_hdr_uid' => (string) $cart_hdr_uid, 'line_no' => (string) $line_no],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /cart-line/{cartHdrUid}/update
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createUpdate(int $cart_hdr_uid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{cartHdrUid}/update',
            $data,
            ['cart_hdr_uid' => (string) $cart_hdr_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
