<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Transaction category resource.
 *
 * @fullPath api.p21Apis.transCategory
 * @service p21-apis
 * @domain category-management
 */
final class TransCategoryResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Create a new transaction category.
     *
     * @fullPath api.p21Apis.transCategory.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/trans-category', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Get transaction category details by category UID.
     *
     * @fullPath api.p21Apis.transCategory.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $categoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/trans-category/{categoryUid}',
            $params,
            ['categoryUid' => (string) $categoryUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Update transaction category by category UID.
     *
     * @fullPath api.p21Apis.transCategory.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $categoryUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/trans-category/{categoryUid}',
            $data,
            ['categoryUid' => (string) $categoryUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete transaction category by category UID.
     *
     * @fullPath api.p21Apis.transCategory.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $categoryUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/trans-category/{categoryUid}',
            ['categoryUid' => (string) $categoryUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
