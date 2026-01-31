<?php

declare(strict_types=1);

namespace AugurApi\Services\Shipping\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Rates resource.
 *
 * @fullPath api.shipping.rates
 * @service shipping
 * @domain shipping-and-logistics
 */
final class RatesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get comprehensive shipping rates from multiple carriers.
     *
     * @fullPath api.shipping.rates.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/rates', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
