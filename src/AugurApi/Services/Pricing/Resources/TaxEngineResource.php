<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Tax engine resource.
 *
 * @fullPath api.pricing.taxEngine
 * @service pricing
 * @domain pricing
 */
final class TaxEngineResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Run tax engine.
     *
     * @fullPath api.pricing.taxEngine.calculate
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function calculate(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/tax-engine', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
