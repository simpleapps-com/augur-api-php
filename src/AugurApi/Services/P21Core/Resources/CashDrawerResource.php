<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * cashDrawer resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-core
 */
final class CashDrawerResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /cash-drawer
     *
     * Response data type: array
     * Known fields: cashDrawerId, companyId, cashDrawerDescription, currentSequenceNo, openingBalance, withdrawals, deposits, currentBalance, ... (22 total)
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
     * GET /cash-drawer/{cashDrawerUid}
     *
     * Response data type: object
     * Known fields: cashDrawerId, companyId, cashDrawerDescription, currentSequenceNo, openingBalance, withdrawals, deposits, currentBalance, ... (22 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $cashDrawerUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{cashDrawerUid}',
            $params,
            ['cashDrawerUid' => (string) $cashDrawerUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
