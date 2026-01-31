<?php

declare(strict_types=1);

namespace AugurApi\Services\Ups\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * RatesShop resource.
 *
 * @fullPath api.ups.ratesShop
 * @service ups
 * @domain shipping-and-logistics
 */
final class RatesShopResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Shop UPS shipping rates for packages.
     *
     * @fullPath api.ups.ratesShop.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/rates-shop', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
