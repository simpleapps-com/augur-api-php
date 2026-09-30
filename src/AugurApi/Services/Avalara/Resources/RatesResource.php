<?php

declare(strict_types=1);

namespace AugurApi\Services\Avalara\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * rates resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py avalara
 */
final class RatesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /rates
     *
     * Response data type: number
     *
     * @param array{address: array{line_1: string, line_2: string, line_3: string, city: string, region: string, postal_code: string, country_code: string}, items: list<array{amount: float, quantity: float, item_code: string, tax_code: string, unit_price?: float}>} $data
     * @return BaseResponse<float>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<float> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
