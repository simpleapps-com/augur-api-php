<?php

declare(strict_types=1);

namespace AugurApi\Services\BrandFolder\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Categories resource.
 *
 * @fullPath api.brandFolder.categories
 * @service brand_folder
 * @domain brand-management
 */
final class CategoriesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Set category focus configuration.
     *
     * @fullPath api.brandFolder.categories.focus.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createFocus(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/categories/focus', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
