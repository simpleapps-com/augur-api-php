<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * paytrace resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py payments
 */
final class PaytraceResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /paytrace/authorization
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function createAuthorization(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/authorization',
            $data,
            [],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paytrace/capture
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function createCapture(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/capture',
            $data,
            [],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paytrace/refund
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function createRefund(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/refund',
            $data,
            [],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paytrace/sale
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function createSale(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/sale',
            $data,
            [],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paytrace/void
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function createVoid(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/void',
            $data,
            [],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
