<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * priceEngine resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py pricing
 */
final class PriceEngineResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /price-engine
     *
     * Response data type: object
     *   unitPrice: float
     *   pricedFrom: 'jobPricing'|'sourceCd'|'libraryPrice'|'libraryMultiplier'|'defaultCompanyPrice'|bool
     *   priceType: 'J'|'S'|'L'|'C'|bool
     *   jobPrice: float|bool
     *   listPrice: float
     *   customer: array{customerId: float, valid: bool, sourcePriceCd: int|bool, sourcePriceDesc: string|null, pricingMethodCd: int|null, pricingMethodDesc: string|null, hasJobPricing: bool, jobPricingEnabled: bool, corpAddressId: float|null, corpAddressJobCount: int, customerShipToJobCount: int}
     *   item: array{itemId: string, valid: bool, invMastUid: int|null, quantity: float, unitOfMeasure: string|null}
     *   options: list<mixed>
     *   messages: list<string>
     *   jobNo?: string|null
     *   jobPriceHdrUid?: int|null
     *   contractNo?: string|null
     *   libraryPriceData?: array{unitPrice: float|bool, sourcePrice: float|null, quantity: float, pricePageUid: int, pricePageDescription: string, pricePageCdType: int, pricePageCdDesc: string, effectiveDate: string, expirationDate: string, itemId: string, invMastUid: int, pricingMethodCd: int, pricingMethodCdDesc: string, sourcePriceCd: int, sourcePriceCdDesc: string, calculationMethodCd: int, calculationMethodCdDesc: string, totalingMethodCd: int, totalingMethodCdDesc: string, calculatorType: string, purchasePricingUnit: string|null, purchasePricingUnitSize: float|null, salesPricingUnit: string|null, salesPricingUnitSize: float|null, unitOfMeasure: string|null, unitOfMeasureSize: float|null, defaultSellingUnit: string|null, defaultSellingUnitSize: float|null, defaultPurchasingUnit: string|null, defaultPurchasingUnitSize: float|null, baseUnit: string|null, baseUnitSize: float|null, multiplier: int|float, breaks: list<array{calculationValue: float|null, break: float|null, startQuantity: float, endQuantity: float|null, unitPrice: float|bool}>, baseSize?: float|null, basePrice?: float|null, potentialCostValue?: float|null, costPageUid?: float|null, costPageDescription?: string|null, costPageMatched?: bool|null, costSource?: string|null, lastReceivedPoCostSupplierId?: float|null, invLocProductGroupId?: string|null, pricePageProductGroupId?: string|null, pricePageSupplierId?: float|null, pricePageDiscountGroupId?: string|null, pricePageMfgClassId?: string|null, pricePagePriceFamilyUid?: float|null, invLocSalesDiscountGroup?: string|null, invLocPriceFamilyUid?: float|null}|array{unitPrice: float|bool, pricedFrom?: string|null, sourcePrice?: float|null, sourcePriceCd?: int|null, multiplier?: float|null, priceLibraryUid?: int|null, unitOfMeasureSize?: float|null}|null
     *   defaultCompanyPrice?: array{unitPrice: float|bool, purchasePricingUnitSize: float|null, sourceTypeCd: int, sourceTypeDesc: string|null, unitOfMeasure: string, unitOfMeasureSize: float, basePrice: float, baseSize: float}
     *   webPrice?: float|bool
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /price-engine
     *
     * Response data type: object
     *   customerId: int
     *   shipToId: int
     *   itemCount: int
     *   items: list<array{itemId: string, quantity: float, unitOfMeasure: string, priceEngine: array{unitPrice: float, pricedFrom: 'jobPricing'|'sourceCd'|'libraryPrice'|'libraryMultiplier'|'defaultCompanyPrice'|bool, priceType: 'J'|'S'|'L'|'C'|bool, jobPrice: float|bool, listPrice: float, customer: array{customerId: float, valid: bool, sourcePriceCd: int|bool, sourcePriceDesc: string|null, pricingMethodCd: int|null, pricingMethodDesc: string|null, hasJobPricing: bool, jobPricingEnabled: bool, corpAddressId: float|null, corpAddressJobCount: int, customerShipToJobCount: int}, item: array{itemId: string, valid: bool, invMastUid: int|null, quantity: float, unitOfMeasure: string|null}, options: list<mixed>, messages: list<string>, jobNo?: string|null, jobPriceHdrUid?: int|null, contractNo?: string|null, libraryPriceData?: array{unitPrice: float|bool, sourcePrice: float|null, quantity: float, pricePageUid: int, pricePageDescription: string, pricePageCdType: int, pricePageCdDesc: string, effectiveDate: string, expirationDate: string, itemId: string, invMastUid: int, pricingMethodCd: int, pricingMethodCdDesc: string, sourcePriceCd: int, sourcePriceCdDesc: string, calculationMethodCd: int, calculationMethodCdDesc: string, totalingMethodCd: int, totalingMethodCdDesc: string, calculatorType: string, purchasePricingUnit: string|null, purchasePricingUnitSize: float|null, salesPricingUnit: string|null, salesPricingUnitSize: float|null, unitOfMeasure: string|null, unitOfMeasureSize: float|null, defaultSellingUnit: string|null, defaultSellingUnitSize: float|null, defaultPurchasingUnit: string|null, defaultPurchasingUnitSize: float|null, baseUnit: string|null, baseUnitSize: float|null, multiplier: int|float, breaks: list<array{calculationValue: float|null, break: float|null, startQuantity: float, endQuantity: float|null, unitPrice: float|bool}>, baseSize?: float|null, basePrice?: float|null, potentialCostValue?: float|null, costPageUid?: float|null, costPageDescription?: string|null, costPageMatched?: bool|null, costSource?: string|null, lastReceivedPoCostSupplierId?: float|null, invLocProductGroupId?: string|null, pricePageProductGroupId?: string|null, pricePageSupplierId?: float|null, pricePageDiscountGroupId?: string|null, pricePageMfgClassId?: string|null, pricePagePriceFamilyUid?: float|null, invLocSalesDiscountGroup?: string|null, invLocPriceFamilyUid?: float|null}|array{unitPrice: float|bool, pricedFrom?: string|null, sourcePrice?: float|null, sourcePriceCd?: int|null, multiplier?: float|null, priceLibraryUid?: int|null, unitOfMeasureSize?: float|null}|null, defaultCompanyPrice?: array{unitPrice: float|bool, purchasePricingUnitSize: float|null, sourceTypeCd: int, sourceTypeDesc: string|null, unitOfMeasure: string, unitOfMeasureSize: float, basePrice: float, baseSize: float}, webPrice?: float|bool}}>
     *
     * @param array{customerId: int, items: list<array{itemId: string, quantity?: float, unitOfMeasure?: string|null}>, shipToId?: int|null} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
