<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * paypal resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py payments
 */
final class PaypalResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /paypal/authorization/capture
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAuthorizationCapture(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/authorization/capture',
            $data,
            [],
            $params,
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /paypal/authorization/void
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAuthorizationVoid(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/authorization/void',
            $data,
            [],
            $params,
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /paypal/capture/refund
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function createCaptureRefund(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/capture/refund',
            $data,
            [],
            $params,
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /paypal/order
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function createOrder(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/order',
            $data,
            [],
            $params,
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /paypal/order-return
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listOrderReturn(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/order-return', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /paypal/order/authorize
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function createOrderAuthorize(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/order/authorize',
            $data,
            [],
            $params,
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /paypal/order/capture
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function createOrderCapture(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/order/capture',
            $data,
            [],
            $params,
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /paypal/order/details
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listOrderDetails(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/order/details', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /paypal/refund
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listRefund(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/refund', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /paypal/webhook
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function createWebhook(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/webhook',
            $data,
            [],
            $params,
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
