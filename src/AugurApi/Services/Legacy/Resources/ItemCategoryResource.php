<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Item Category resource.
 *
 * @fullPath api.legacy.itemCategory
 * @service legacy
 * @domain augur
 */
final class ItemCategoryResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get Item Category Details.
     *
     * @fullPath api.legacy.itemCategory.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $itemCategoryUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/item-category/{itemCategoryUid}',
            [],
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
