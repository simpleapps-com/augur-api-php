<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Unified payment resource.
 *
 * @fullPath api.payments.unified
 * @service payments
 * @domain payments
 */
final class UnifiedResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Create a transaction with customer and account information.
     *
     * @fullPath api.payments.unified.transactionSetup
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function transactionSetup(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/unified/transaction-setup', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Validate a transaction with customer and account information.
     *
     * @fullPath api.payments.unified.validate
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function validate(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/unified/validate', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get account query with transaction setup id.
     *
     * @fullPath api.payments.unified.accountQuery
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function accountQuery(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/unified/account-query', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Update billing information with transaction setup id.
     *
     * @fullPath api.payments.unified.billingUpdate
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function billingUpdate(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/unified/billing-update', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get card information with transaction setup id.
     *
     * @fullPath api.payments.unified.cardInfo
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function cardInfo(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/unified/card-info', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get surcharge with payment account id.
     *
     * @fullPath api.payments.unified.surcharge
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function surcharge(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/unified/surcharge', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
