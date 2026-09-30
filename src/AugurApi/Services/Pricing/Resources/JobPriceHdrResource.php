<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * jobPriceHdr resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py pricing
 */
final class JobPriceHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /job-price-hdr
     *
     * Response data type: array
     *   jobPriceHdrUid: int
     *   jobNo: string
     *   jobDescription: string|null
     *   companyId: string
     *   customerId: float|null
     *   salesLocId: float|null
     *   contractNo: string|null
     *   contactId: string|null
     *   startDate: string
     *   endDate: string
     *   shipToId: float|null
     *   approved: string|null
     *   cancelled: string|null
     *   taker: string
     *   poNo: string|null
     *   rowStatusFlag: int
     *   dateLastModified: string
     *   dateCreated: string
     *   lastMaintainedBy: string
     *   corpAddressId: float|null
     *   salesrepId: string|null
     *   currencyLineUid: int|null
     *   currencyConversion: string
     *   consignmentFlag: string
     *   contractTypeCd: int
     *   extendedDesc: string|null
     *   noOfPeriods: int|null
     *   cadChaContractCd: int|null
     *   cadChaSupplierId: float|null
     *   cadChaQuoteNo: string|null
     *   cadChaLocationId: float|null
     *   anniversaryDate: string|null
     *   useTotesFlag: string|null
     *   handHeldAddFlag: string|null
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
     * GET /job-price-hdr/{jobPriceHdrUid}
     *
     * Response data type: object
     *   jobPriceHdrUid: int
     *   jobNo: string
     *   jobDescription: string|null
     *   companyId: string
     *   customerId: float|null
     *   salesLocId: float|null
     *   contractNo: string|null
     *   contactId: string|null
     *   startDate: string
     *   endDate: string
     *   shipToId: float|null
     *   approved: string|null
     *   cancelled: string|null
     *   taker: string
     *   poNo: string|null
     *   rowStatusFlag: int
     *   dateLastModified: string
     *   dateCreated: string
     *   lastMaintainedBy: string
     *   corpAddressId: float|null
     *   salesrepId: string|null
     *   currencyLineUid: int|null
     *   currencyConversion: string
     *   consignmentFlag: string
     *   contractTypeCd: int
     *   extendedDesc: string|null
     *   noOfPeriods: int|null
     *   cadChaContractCd: int|null
     *   cadChaSupplierId: float|null
     *   cadChaQuoteNo: string|null
     *   cadChaLocationId: float|null
     *   anniversaryDate: string|null
     *   useTotesFlag: string|null
     *   handHeldAddFlag: string|null
     *   updateCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $jobPriceHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{jobPriceHdrUid}',
            $params,
            ['jobPriceHdrUid' => (string) $jobPriceHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /job-price-hdr/{jobPriceHdrUid}/lines
     *
     * Response data type: array
     *   jobPriceLineUid: int
     *   jobPriceHdrUid: int
     *   invMastUid: int|null
     *   uom: string|null
     *   unitSize: float|null
     *   pricingMethod: int|null
     *   sourcePrice: int|null
     *   price: float|null
     *   qtyOrdered: float|null
     *   qtyMaximum: float|null
     *   otherCostTypeCd: int|null
     *   otherCostValue: float|null
     *   otherCostSourceCd: int|null
     *   otherCostCalcMethodCd: int|null
     *   otherCostCalcValue: float|null
     *   commissionCostTypeCd: int|null
     *   commissionCostValue: float|null
     *   commissionCostSourceCd: int|null
     *   commissionCostCalcMethodCd: int|null
     *   commissionCostCalcValue: float|null
     *   rowStatusFlag: int
     *   dateLastModified: string
     *   dateCreated: string
     *   lastMaintainedBy: string
     *   multiplier: float|null
     *   lineNo: int
     *   sourceLocationId: float|null
     *   customerPartNo: string|null
     *   expirationDate: string|null
     *   vendorAuthNo: string|null
     *   poCost: float|null
     *   currencyId: float|null
     *   discountGroupId: string|null
     *   custPoNo: string|null
     *   itemCategoryUid: int|null
     *   subCategoryUid: int|null
     *   productGroupId: string|null
     *   terminalId: float|null
     *   contractLineCostPageUid: int|null
     *   contractLinePricePageUid: int|null
     *   budgetCd: string|null
     *   itemRevisionUid: int|null
     *   lineStartDate: string|null
     *   initialCommitmentAmount: float|null
     *   commitmentAmount: float|null
     *   totalCommitmentAmount: float|null
     *   pickFee: float|null
     *   cadPurchaseCost: float|null
     *   startingVirtualInventoryQty: float|null
     *   snapshotCost: float|null
     *   minimumMccCode: string|null
     *   commissionClassId: string|null
     *   commissionOverridePercent: float|null
     *   updateCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listLines(int $jobPriceHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{jobPriceHdrUid}/lines',
            $params,
            ['jobPriceHdrUid' => (string) $jobPriceHdrUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /job-price-hdr/{jobPriceHdrUid}/lines/{jobPriceLineUid}
     *
     * Response data type: object
     *   jobPriceLineUid: int
     *   jobPriceHdrUid: int
     *   invMastUid: int|null
     *   uom: string|null
     *   unitSize: float|null
     *   pricingMethod: int|null
     *   sourcePrice: int|null
     *   price: float|null
     *   qtyOrdered: float|null
     *   qtyMaximum: float|null
     *   otherCostTypeCd: int|null
     *   otherCostValue: float|null
     *   otherCostSourceCd: int|null
     *   otherCostCalcMethodCd: int|null
     *   otherCostCalcValue: float|null
     *   commissionCostTypeCd: int|null
     *   commissionCostValue: float|null
     *   commissionCostSourceCd: int|null
     *   commissionCostCalcMethodCd: int|null
     *   commissionCostCalcValue: float|null
     *   rowStatusFlag: int
     *   dateLastModified: string
     *   dateCreated: string
     *   lastMaintainedBy: string
     *   multiplier: float|null
     *   lineNo: int
     *   sourceLocationId: float|null
     *   customerPartNo: string|null
     *   expirationDate: string|null
     *   vendorAuthNo: string|null
     *   poCost: float|null
     *   currencyId: float|null
     *   discountGroupId: string|null
     *   custPoNo: string|null
     *   itemCategoryUid: int|null
     *   subCategoryUid: int|null
     *   productGroupId: string|null
     *   terminalId: float|null
     *   contractLineCostPageUid: int|null
     *   contractLinePricePageUid: int|null
     *   budgetCd: string|null
     *   itemRevisionUid: int|null
     *   lineStartDate: string|null
     *   initialCommitmentAmount: float|null
     *   commitmentAmount: float|null
     *   totalCommitmentAmount: float|null
     *   pickFee: float|null
     *   cadPurchaseCost: float|null
     *   startingVirtualInventoryQty: float|null
     *   snapshotCost: float|null
     *   minimumMccCode: string|null
     *   commissionClassId: string|null
     *   commissionOverridePercent: float|null
     *   updateCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLines(int $jobPriceHdrUid, int $jobPriceLineUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{jobPriceHdrUid}/lines/{jobPriceLineUid}',
            $params,
            ['jobPriceHdrUid' => (string) $jobPriceHdrUid, 'jobPriceLineUid' => (string) $jobPriceLineUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
