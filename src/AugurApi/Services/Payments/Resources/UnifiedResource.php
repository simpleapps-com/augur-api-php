<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * unified resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py payments
 */
final class UnifiedResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /unified/account-query
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listAccountQuery(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/account-query', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /unified/billing-update
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listBillingUpdate(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/billing-update', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /unified/card-info
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listCardInfo(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/card-info', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /unified/surcharge
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listSurcharge(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/surcharge', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /unified/transaction-response
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listTransactionResponse(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/transaction-response', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /unified/transaction-setup
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listTransactionSetup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/transaction-setup', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /unified/validate
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listValidate(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/validate', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
