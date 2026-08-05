<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * freightCode resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-core
 */
final class FreightCodeResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /freight-code
     *
     * Response data type: array
     * Known fields: freightCodeUid, companyId, freightCd, freightDesc, incomingFreight, outgoingFreight, incomingReduceCommission, outgoingIncreaseCommission, ... (40 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /freight-code/{freightCodeUid}
     *
     * Response data type: object
     * Known fields: freightCodeUid, companyId, freightCd, freightDesc, incomingFreight, outgoingFreight, incomingReduceCommission, outgoingIncreaseCommission, ... (40 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $freightCodeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{freightCodeUid}',
            $params,
            ['freightCodeUid' => (string) $freightCodeUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
