<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Paytrace payment resource.
 *
 * @fullPath api.payments.paytrace
 * @service payments
 * @domain payments
 */
final class PaytraceResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Authorize a credit card transaction (pre-auth).
     *
     * @fullPath api.payments.paytrace.authorization
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function authorization(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/paytrace/authorization', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Capture a previously authorized transaction.
     *
     * @fullPath api.payments.paytrace.capture
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function capture(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/paytrace/capture', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Process a sale transaction (authorize and capture).
     *
     * @fullPath api.payments.paytrace.sale
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function sale(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/paytrace/sale', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Refund a settled transaction.
     *
     * @fullPath api.payments.paytrace.refund
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function refund(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/paytrace/refund', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Void a pending transaction.
     *
     * @fullPath api.payments.paytrace.void
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function void(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/paytrace/void', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
