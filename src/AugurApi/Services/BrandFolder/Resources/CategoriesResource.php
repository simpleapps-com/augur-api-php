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
     *   itemCategoryUid: int
     *   itemCategoryId: string
     *   itemCategoryDesc: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   rootCategoryId: string
     *   labelsId: string|null
     *   imagesAssetsId: string|null
     *   roomScenesAssetsId: string|null
     *   brochuresAssetsId: string|null
     *   contractorsAssetsId: string|null
     *   dateLastProcessed: string
     *   dateLastCheckImages: string
     *   dateLastCheckRoomScene: string
     *   itemCategoryDescPc: string|null
     *   dateLastUpload: string
     *   leedAssetsId: string|null
     *   colorsList: string|null
     *   colorsCount: int
     *   focusCd: int
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
     * POST /categories/focus
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createFocus(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/focus', $data);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /categories/{itemCategoryUid}
     *
     * Response data type: object
     *   itemCategoryUid: int
     *   itemCategoryId: string
     *   itemCategoryDesc: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   rootCategoryId: string
     *   labelsId: string|null
     *   imagesAssetsId: string|null
     *   roomScenesAssetsId: string|null
     *   brochuresAssetsId: string|null
     *   contractorsAssetsId: string|null
     *   dateLastProcessed: string
     *   dateLastCheckImages: string
     *   dateLastCheckRoomScene: string
     *   itemCategoryDescPc: string|null
     *   dateLastUpload: string
     *   leedAssetsId: string|null
     *   colorsList: string|null
     *   colorsCount: int
     *   focusCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
