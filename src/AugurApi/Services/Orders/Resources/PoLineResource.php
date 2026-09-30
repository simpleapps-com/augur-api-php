<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * poLine resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py orders
 */
final class PoLineResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /po-line
     *
     * Response data type: array
     *   poNo: float
     *   qtyOrdered: float
     *   qtyReceived: float
     *   receivedDate: string|null
     *   unitPrice: float
     *   companyNo: string
     *   mfgPartNo: string|null
     *   deleteFlag: string
     *   dateDue: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   nextDueInPoCost: float|null
     *   complete: string
     *   vouchCompleted: string
     *   cancelFlag: string|null
     *   inBoundCurryId: float|null
     *   accountNo: string|null
     *   qtyToVouch: float|null
     *   closedFlag: string|null
     *   itemDescription: string|null
     *   unitOfMeasure: string|null
     *   unitSize: float
     *   unitQuantity: float
     *   lineNo: float
     *   pricingBookId: string|null
     *   pricingBookItemId: string|null
     *   pricingBookSupplierId: float|null
     *   pricingBookDiscGrpId: string|null
     *   pricingBookEffectiveDate: string|null
     *   combinable: string|null
     *   calcType: string|null
     *   calcValue: float|null
     *   requiredDate: string|null
     *   nextBreak: float|null
     *   nextUtPrice: float|null
     *   baseUtPrice: float
     *   priceEdit: string|null
     *   newItem: string|null
     *   quantityChanged: string|null
     *   pricingUnit: string|null
     *   pricingUnitSize: float|null
     *   extendedDesc: string|null
     *   unitPriceDisplay: float
     *   invMastUid: int
     *   excludeFromLeadTime: string
     *   sourceType: int|null
     *   expDateUpdates: int|null
     *   poLineUid: int
     *   ediNewStatus: string
     *   lineType: string|null
     *   contractNumber: string|null
     *   createdBy: string|null
     *   parentPoLineNo: int|null
     *   supplierShipDate: string|null
     *   enteredAsCode: string|null
     *   gporRunUid: int|null
     *   purchasePricingPageUid: int|null
     *   expediteFlag: string|null
     *   originalUnitPriceDisplay: float|null
     *   retrievedByWms: string|null
     *   expediteNotes: string|null
     *   expediteFollowupFlag: string
     *   desiredReceiptLocationId: float|null
     *   acknowledgedDate: string|null
     *   countryOfOrigin: string|null
     *   b3Qty: float
     *   qtyReady: float|null
     *   qtyReadyUnitSize: float|null
     *   qtyReadyUom: string|null
     *   unitQtyReady: float|null
     *   bulkBuyFlag: string|null
     *   cadPurchaseCost: float|null
     *   listPriceMultiplier: float|null
     *   carrierStatus: string|null
     *   expectedShipDate: string|null
     *   dateDueLastModified: string|null
     *   acknowledged: string|null
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
     * GET /po-line/{poLineUid}
     *
     * Response data type: object
     *   poNo: float
     *   qtyOrdered: float
     *   qtyReceived: float
     *   receivedDate: string|null
     *   unitPrice: float
     *   companyNo: string
     *   mfgPartNo: string|null
     *   deleteFlag: string
     *   dateDue: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   nextDueInPoCost: float|null
     *   complete: string
     *   vouchCompleted: string
     *   cancelFlag: string|null
     *   inBoundCurryId: float|null
     *   accountNo: string|null
     *   qtyToVouch: float|null
     *   closedFlag: string|null
     *   itemDescription: string|null
     *   unitOfMeasure: string|null
     *   unitSize: float
     *   unitQuantity: float
     *   lineNo: float
     *   pricingBookId: string|null
     *   pricingBookItemId: string|null
     *   pricingBookSupplierId: float|null
     *   pricingBookDiscGrpId: string|null
     *   pricingBookEffectiveDate: string|null
     *   combinable: string|null
     *   calcType: string|null
     *   calcValue: float|null
     *   requiredDate: string|null
     *   nextBreak: float|null
     *   nextUtPrice: float|null
     *   baseUtPrice: float
     *   priceEdit: string|null
     *   newItem: string|null
     *   quantityChanged: string|null
     *   pricingUnit: string|null
     *   pricingUnitSize: float|null
     *   extendedDesc: string|null
     *   unitPriceDisplay: float
     *   invMastUid: int
     *   excludeFromLeadTime: string
     *   sourceType: int|null
     *   expDateUpdates: int|null
     *   poLineUid: int
     *   ediNewStatus: string
     *   lineType: string|null
     *   contractNumber: string|null
     *   createdBy: string|null
     *   parentPoLineNo: int|null
     *   supplierShipDate: string|null
     *   enteredAsCode: string|null
     *   gporRunUid: int|null
     *   purchasePricingPageUid: int|null
     *   expediteFlag: string|null
     *   originalUnitPriceDisplay: float|null
     *   retrievedByWms: string|null
     *   expediteNotes: string|null
     *   expediteFollowupFlag: string
     *   desiredReceiptLocationId: float|null
     *   acknowledgedDate: string|null
     *   countryOfOrigin: string|null
     *   b3Qty: float
     *   qtyReady: float|null
     *   qtyReadyUnitSize: float|null
     *   qtyReadyUom: string|null
     *   unitQtyReady: float|null
     *   bulkBuyFlag: string|null
     *   cadPurchaseCost: float|null
     *   listPriceMultiplier: float|null
     *   carrierStatus: string|null
     *   expectedShipDate: string|null
     *   dateDueLastModified: string|null
     *   acknowledged: string|null
     *   updateCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $poLineUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{poLineUid}',
            $params,
            ['poLineUid' => (string) $poLineUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
