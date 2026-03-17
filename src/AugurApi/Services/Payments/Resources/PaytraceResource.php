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
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAuthorization(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/authorization', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /paytrace/capture
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createCapture(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/capture', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /paytrace/refund
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createRefund(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/refund', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /paytrace/sale
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createSale(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/sale', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /paytrace/void
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createVoid(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/void', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
