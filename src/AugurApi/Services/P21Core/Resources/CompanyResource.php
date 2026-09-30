<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * company resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-core
 */
final class CompanyResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /company
     *
     * Response data type: array
     *   companyUid: int
     *   companyId: string
     *   companyName: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   deleteFlag: string
     *   updateCd: int
     *   lastMaintainedBy: string
     *   addressId: float|null
     *   defaultSalesLocationId: float|null
     *   freightCodeUid: int|null
     *   upsAccountNo: string|null
     *   defaultSourcePriceCd: int|null
     *   defaultMultiplier: float|null
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
     * GET /company/{companyUid}
     *
     * Response data type: object
     *   companyUid: int
     *   companyId: string
     *   companyName: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   deleteFlag: string
     *   updateCd: int
     *   lastMaintainedBy: string
     *   addressId: float|null
     *   defaultSalesLocationId: float|null
     *   freightCodeUid: int|null
     *   upsAccountNo: string|null
     *   defaultSourcePriceCd: int|null
     *   defaultMultiplier: float|null
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $companyUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{companyUid}',
            $params,
            ['companyUid' => (string) $companyUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
