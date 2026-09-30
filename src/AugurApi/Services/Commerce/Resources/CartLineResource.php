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
     * @return BaseResponse<mixed>
     */
    public function delete(int $cartHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{cartHdrUid}',
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /cart-line/{cartHdrUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $cartHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{cartHdrUid}',
            $params,
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /cart-line/{cartHdrUid}/add
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createAdd(int $cartHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{cartHdrUid}/add',
            $data,
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /cart-line/{cartHdrUid}/lines/{lineNo}
     *
     * @return BaseResponse<mixed>
     */
    public function deleteLines(int $cartHdrUid, int $lineNo): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{cartHdrUid}/lines/{lineNo}',
            ['cartHdrUid' => (string) $cartHdrUid, 'lineNo' => (string) $lineNo],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /cart-line/{cartHdrUid}/update
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createUpdate(int $cartHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{cartHdrUid}/update',
            $data,
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
