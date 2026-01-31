<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Price engine resource.
 *
 * @fullPath api.pricing.priceEngine
 * @service pricing
 * @domain pricing
 */
final class PriceEngineResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get item price.
     *
     * @fullPath api.pricing.priceEngine.getPrice
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getPrice(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/price-engine', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
