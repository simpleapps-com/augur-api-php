<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * shippingMethods resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py logistics
 */
final class ShippingMethodsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /shipping-methods
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
     * DELETE /shipping-methods/{shippingMethodsUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $shippingMethodsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{shippingMethodsUid}',
            ['shippingMethodsUid' => (string) $shippingMethodsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /shipping-methods/{shippingMethodsUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $shippingMethodsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{shippingMethodsUid}',
            $params,
            ['shippingMethodsUid' => (string) $shippingMethodsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /shipping-methods/{shippingMethodsUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $shippingMethodsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{shippingMethodsUid}',
            $data,
            ['shippingMethodsUid' => (string) $shippingMethodsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
