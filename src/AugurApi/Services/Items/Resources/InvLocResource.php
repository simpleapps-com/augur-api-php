<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invLoc resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 */
final class InvLocResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-loc
     *
     * Response data type: array
     *   companyId: string
     *   locationId: float
     *   invMastUid: int
     *   qtyOnHand: float|null
     *   qtyInProcess: float|null
     *   dateCreated: string
     *   dateLastModified: string
     *   nextDueInPoDate: string|null
     *   sellable: string|null
     *   movingAverageCost: float|null
     *   standardCost: float|null
     *   protectedStockQty: float|null
     *   invMin: float|null
     *   invMax: float|null
     *   safetyStock: float|null
     *   stockable: string|null
     *   averageMonthlyUsage: float|null
     *   noCharge: string|null
     *   price1: float|null
     *   price2: float|null
     *   price3: float|null
     *   price4: float|null
     *   price5: float|null
     *   price6: float|null
     *   price7: float|null
     *   price8: float|null
     *   price9: float|null
     *   price10: float|null
     *   orderQuantity: float|null
     *   qtyAllocated: float|null
     *   qtyBackordered: float|null
     *   qtyInTransit: float|null
     *   trackBins: string|null
     *   primaryBin: string|null
     *   qtyReservedDueIn: float|null
     *   dateLastCounted: string|null
     *   deadstockFlag: string
     *   primarySupplierId: float|null
     *   lastSaleDate: string|null
     *   lastPurchaseDate: string|null
     *   invLastChangedDate: string|null
     *   minReplenishmentQty: float|null
     *   discontinued: string
     *   priceFamilyUid: int|null
     *   deleteFlag: string|null
     *   defaultSellingUnit: string|null
     *   futureStandardCost: float|null
     *   effectiveDate: string|null
     *   restrictedFlag: string|null
     *   updateCd: int
     *   productGroupId: string|null
     *   purchaseDiscountGroup: string|null
     *   salesDiscountGroup: string|null
     *   purchaseClass: string|null
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
}
