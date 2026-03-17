<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * moneris resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py payments
 */
final class MonerisResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /moneris/pre-auth
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listPreAuth(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/pre-auth', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /moneris/pre-auth-complete
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listPreAuthComplete(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/pre-auth-complete', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
