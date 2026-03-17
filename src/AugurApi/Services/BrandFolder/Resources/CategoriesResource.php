<?php

declare(strict_types=1);

namespace AugurApi\Services\BrandFolder\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * categories resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py brand-folder
 */
final class CategoriesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /categories/focus
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createFocus(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/focus', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
