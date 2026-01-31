<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Moneris payment resource.
 *
 * @fullPath api.payments.moneris
 * @service payments
 * @domain payments
 */
final class MonerisResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Pre-authorize a transaction.
     *
     * @fullPath api.payments.moneris.preAuth
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function preAuth(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/moneris/pre-auth', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Complete a pre-authorization transaction.
     *
     * @fullPath api.payments.moneris.preAuthComplete
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function preAuthComplete(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/moneris/pre-auth-complete', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
