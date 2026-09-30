<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * itemUom resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 */
final class ItemUomResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /item-uom
     *
     * Response data type: array
     *   unitOfMeasure: string
     *   deleteFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   unitSize: float
     *   sellingUnit: string|null
     *   purchasingUnit: string|null
     *   invMastUid: int
     *   createdBy: string|null
     *   itemUomUid: int
     *   b2bUnitFlag: string
     *   tallyFactor: float|null
     *   wwmsFlag: string|null
     *   prodOrderFactor: int|null
     *   minimumOrderQty: float|null
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
     * GET /item-uom/{itemUomUid}
     *
     * Response data type: object
     *   unitOfMeasure: string
     *   deleteFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   unitSize: float
     *   sellingUnit: string|null
     *   purchasingUnit: string|null
     *   invMastUid: int
     *   createdBy: string|null
     *   itemUomUid: int
     *   b2bUnitFlag: string
     *   tallyFactor: float|null
     *   wwmsFlag: string|null
     *   prodOrderFactor: int|null
     *   minimumOrderQty: float|null
     *   updateCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $itemUomUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemUomUid}',
            $params,
            ['itemUomUid' => (string) $itemUomUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
