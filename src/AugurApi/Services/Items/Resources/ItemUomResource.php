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
     * Known fields: unitOfMeasure, deleteFlag, dateCreated, dateLastModified, lastMaintainedBy, unitSize, sellingUnit, purchasingUnit, ... (17 total)
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
     * GET /item-uom/{itemUomUid}
     *
     * Response data type: object
     * Known fields: unitOfMeasure, deleteFlag, dateCreated, dateLastModified, lastMaintainedBy, unitSize, sellingUnit, purchasingUnit, ... (17 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
