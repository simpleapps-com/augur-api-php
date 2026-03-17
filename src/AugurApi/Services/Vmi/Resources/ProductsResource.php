<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * products resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
 */
final class ProductsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /products
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
     * GET /products/find
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listFind(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/find', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /products/{productsUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $productsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{productsUid}',
            ['productsUid' => (string) $productsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /products/{productsUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $productsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{productsUid}',
            $params,
            ['productsUid' => (string) $productsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /products/{productsUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $productsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{productsUid}',
            $data,
            ['productsUid' => (string) $productsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /products/{productsUid}/enable
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateEnable(int $productsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{productsUid}/enable',
            $data,
            ['productsUid' => (string) $productsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
