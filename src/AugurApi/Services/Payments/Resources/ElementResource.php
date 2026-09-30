<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * element resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py payments
 */
final class ElementResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /element/payment
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createPayment(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/payment', $data);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
