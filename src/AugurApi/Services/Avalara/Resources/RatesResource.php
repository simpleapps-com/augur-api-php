<?php

declare(strict_types=1);

namespace AugurApi\Services\Avalara\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Rates resource.
 *
 * @fullPath api.avalara.rates
 * @service avalara
 * @domain tax-calculation
 */
final class RatesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Calculate tax rates for transaction lines.
     *
     * @fullPath api.avalara.rates.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/rates', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
