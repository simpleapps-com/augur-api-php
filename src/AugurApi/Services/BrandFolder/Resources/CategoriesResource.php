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
     * GET /categories
     *
     * Response data type: array
     * Known fields: itemCategoryUid, itemCategoryId, itemCategoryDesc, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (23 total)
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

    /**
     * GET /categories/{itemCategoryUid}
     *
     * Response data type: object
     * Known fields: itemCategoryUid, itemCategoryId, itemCategoryDesc, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (23 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
