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
     *   freightCodeUid: int
     *   companyId: string
     *   freightCd: string
     *   freightDesc: string
     *   incomingFreight: string
     *   outgoingFreight: string
     *   incomingReduceCommission: string
     *   outgoingIncreaseCommission: string
     *   prorateMethodCodeNo: int
     *   taxGroupId: string|null
     *   revenueAccountNo: string
     *   rowStatus: int
     *   dateCreated: string|null
     *   dateLastModified: string|null
     *   lastMaintainedBy: string
     *   freeFreightBasisCd: int|null
     *   freeInFreightMin: float|null
     *   freeOutFreightMin: float|null
     *   directShipFreeFreightFlag: string|null
     *   freeInFreightMinWeb: float|null
     *   freeOutFreightMinWeb: float|null
     *   handlingChargeOptionCd: int|null
     *   externalTaxProductCodeIn: string|null
     *   externalTaxProductCodeOut: string|null
     *   incomingIncreaseCommission: string|null
     *   paySpecialFlag: string|null
     *   skipFirstShipmentFlag: string|null
     *   excludeFromSalesMasterInquiry: string
     *   deductibleFlag: string|null
     *   freeColdFreight: string
     *   freeHazmatFreight: string
     *   freeExpressFreight: string
     *   freeBulkFreight: string
     *   fedexPaymentMethod: int|null
     *   excludeDiscountedFreight: string
     *   freeFreightDefaultFlag: string|null
     *   outgoingAdjustCommissionByProfitFlag: string|null
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
     * GET /freight-code/{freightCodeUid}
     *
     * Response data type: object
     *   freightCodeUid: int
     *   companyId: string
     *   freightCd: string
     *   freightDesc: string
     *   incomingFreight: string
     *   outgoingFreight: string
     *   incomingReduceCommission: string
     *   outgoingIncreaseCommission: string
     *   prorateMethodCodeNo: int
     *   taxGroupId: string|null
     *   revenueAccountNo: string
     *   rowStatus: int
     *   dateCreated: string|null
     *   dateLastModified: string|null
     *   lastMaintainedBy: string
     *   freeFreightBasisCd: int|null
     *   freeInFreightMin: float|null
     *   freeOutFreightMin: float|null
     *   directShipFreeFreightFlag: string|null
     *   freeInFreightMinWeb: float|null
     *   freeOutFreightMinWeb: float|null
     *   handlingChargeOptionCd: int|null
     *   externalTaxProductCodeIn: string|null
     *   externalTaxProductCodeOut: string|null
     *   incomingIncreaseCommission: string|null
     *   paySpecialFlag: string|null
     *   skipFirstShipmentFlag: string|null
     *   excludeFromSalesMasterInquiry: string
     *   deductibleFlag: string|null
     *   freeColdFreight: string
     *   freeHazmatFreight: string
     *   freeExpressFreight: string
     *   freeBulkFreight: string
     *   fedexPaymentMethod: int|null
     *   excludeDiscountedFreight: string
     *   freeFreightDefaultFlag: string|null
     *   outgoingAdjustCommissionByProfitFlag: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
