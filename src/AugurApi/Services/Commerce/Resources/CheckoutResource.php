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
    public function get(int $checkout_uid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{checkoutUid}',
            $params,
            ['checkout_uid' => (string) $checkout_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /checkout/{checkoutUid}/activate
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateActivate(int $checkout_uid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{checkoutUid}/activate',
            $data,
            ['checkout_uid' => (string) $checkout_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /checkout/{checkoutUid}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDoc(int $checkout_uid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{checkoutUid}/doc',
            $params,
            ['checkout_uid' => (string) $checkout_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Alias for listDoc — GET /checkout/{checkoutUid}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $checkout_uid, array $params = []): BaseResponse
    {
        return $this->listDoc($checkout_uid, $params);
    }

    /**
     * POST /checkout/{checkoutUid}/prophet21-hdr
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createProphet21Hdr(int $checkout_uid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{checkoutUid}/prophet21-hdr',
            $data,
            ['checkout_uid' => (string) $checkout_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /checkout/{checkoutUid}/prophet21-hdr/{prophet21HdrUid}/prophet21-line
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createProphet21HdrProphet21Line(int $checkout_uid, int $prophet21_hdr_uid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{checkoutUid}/prophet21-hdr/{prophet21HdrUid}/prophet21-line',
            $data,
            ['checkout_uid' => (string) $checkout_uid, 'prophet21_hdr_uid' => (string) $prophet21_hdr_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /checkout/{checkoutUid}/validate
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateValidate(int $checkout_uid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{checkoutUid}/validate',
            $data,
            ['checkout_uid' => (string) $checkout_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
