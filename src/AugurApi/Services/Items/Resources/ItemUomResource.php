<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Item UOM resource.
 *
 * @fullPath api.items.itemUom
 * @service items
 * @domain inventory-management
 */
final class ItemUomResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List item units of measure.
     *
     * @fullPath api.items.itemUom.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/item-uom', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get item unit of measure details.
     *
     * @fullPath api.items.itemUom.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $itemUomUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/item-uom/{itemUomUid}',
            [],
            ['itemUomUid' => (string) $itemUomUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
