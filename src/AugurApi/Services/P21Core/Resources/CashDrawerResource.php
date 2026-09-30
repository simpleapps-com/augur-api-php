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
     *   cashDrawerId: string
     *   companyId: string
     *   cashDrawerDescription: string
     *   currentSequenceNo: float
     *   openingBalance: float|null
     *   withdrawals: float|null
     *   deposits: float|null
     *   currentBalance: float
     *   drawerOpen: string
     *   bankNo: float|null
     *   cashOnHandAccountNumber: string
     *   deleteFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   cashCardLoad: float|null
     *   cashDrawerUid: int
     *   locIdForBranchConflict: float|null
     *   defaultCloseBranchId: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /cash-drawer/{cashDrawerUid}
     *
     * Response data type: object
     *   cashDrawerId: string
     *   companyId: string
     *   cashDrawerDescription: string
     *   currentSequenceNo: float
     *   openingBalance: float|null
     *   withdrawals: float|null
     *   deposits: float|null
     *   currentBalance: float
     *   drawerOpen: string
     *   bankNo: float|null
     *   cashOnHandAccountNumber: string
     *   deleteFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   cashCardLoad: float|null
     *   cashDrawerUid: int
     *   locIdForBranchConflict: float|null
     *   defaultCloseBranchId: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
