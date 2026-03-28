<?php

declare(strict_types=1);

namespace AugurApi\Services\Ups\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * ratesShop resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py ups
 */
final class RatesShopResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /rates-shop
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
