<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * taxEngine resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py pricing
 */
final class TaxEngineResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /tax-engine
     *
     * Response data type: object
     *   taxEstimate: float
     *   customerId: int
     *   postalCode: string|int|float
     *   taxRate: float
     *   items: list<array{itemId: string, invMastUid: int, quantity: float, unitOfMeasure: string|null, unitPrice: float|bool, taxEstimate: float}>
     *
     * @param array{customerId: int, postalCode: string, items: list<array{itemId: string, quantity?: float, unitOfMeasure?: string|null, unitPrice?: float|null}>} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
