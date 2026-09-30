<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * ups resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py logistics
 */
final class UpsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /ups/rates
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listRates(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/rates', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
