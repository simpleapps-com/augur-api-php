<?php

declare(strict_types=1);

namespace AugurApi\Services\Commerce\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * checkout resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py commerce
 */
final class CheckoutResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /checkout
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /checkout/{checkoutUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $checkoutUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{checkoutUid}',
            $params,
            ['checkoutUid' => (string) $checkoutUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /checkout/{checkoutUid}/activate
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateActivate(int $checkoutUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{checkoutUid}/activate',
            $data,
            ['checkoutUid' => (string) $checkoutUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /checkout/{checkoutUid}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDoc(int $checkoutUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{checkoutUid}/doc',
            $params,
            ['checkoutUid' => (string) $checkoutUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Alias for listDoc — GET /checkout/{checkoutUid}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $checkoutUid, array $params = []): BaseResponse
    {
        return $this->listDoc($checkoutUid, $params);
    }

    /**
     * POST /checkout/{checkoutUid}/prophet21-hdr
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createProphet21Hdr(int $checkoutUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{checkoutUid}/prophet21-hdr',
            $data,
            ['checkoutUid' => (string) $checkoutUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /checkout/{checkoutUid}/prophet21-hdr/{prophet21HdrUid}/prophet21-line
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createProphet21HdrProphet21Line(int $checkoutUid, int $prophet21HdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{checkoutUid}/prophet21-hdr/{prophet21HdrUid}/prophet21-line',
            $data,
            ['checkoutUid' => (string) $checkoutUid, 'prophet21HdrUid' => (string) $prophet21HdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /checkout/{checkoutUid}/validate
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateValidate(int $checkoutUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{checkoutUid}/validate',
            $data,
            ['checkoutUid' => (string) $checkoutUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
