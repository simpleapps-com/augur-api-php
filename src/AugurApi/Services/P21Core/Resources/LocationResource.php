<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * location resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-core
 */
final class LocationResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /location
     *
     * Response data type: array
     *   locationId: float
     *   companyId: string
     *   defaultBranchId: string|null
     *   deleteFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   locationName: string|null
     *   lotBinIntegration: string|null
     *   fedexLocAcctNo: string|null
     *   fedexMeterNo: string|null
     *   upsAccountNo: string|null
     *   upsPickupTypeCd: int|null
     *   upsCustomerTypeCd: int|null
     *   upsOltAccessKey: string|null
     *   upsOltPassword: string|null
     *   upsOltUserId: string|null
     *   distributionCenter: string
     *   updateCd: int
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
     * GET /location/{locationId}
     *
     * Response data type: object
     *   locationId: float
     *   companyId: string
     *   defaultBranchId: string|null
     *   deleteFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   locationName: string|null
     *   lotBinIntegration: string|null
     *   fedexLocAcctNo: string|null
     *   fedexMeterNo: string|null
     *   upsAccountNo: string|null
     *   upsPickupTypeCd: int|null
     *   upsCustomerTypeCd: int|null
     *   upsOltAccessKey: string|null
     *   upsOltPassword: string|null
     *   upsOltUserId: string|null
     *   distributionCenter: string
     *   updateCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(float $locationId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{locationId}',
            $params,
            ['locationId' => (string) $locationId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
