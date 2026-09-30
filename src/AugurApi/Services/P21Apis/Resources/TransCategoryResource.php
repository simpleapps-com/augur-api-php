<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * transCategory resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-apis
 */
final class TransCategoryResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /trans-category
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /trans-category/{categoryUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function delete(int $categoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{categoryUid}',
            ['categoryUid' => (string) $categoryUid],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /trans-category/{categoryUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $categoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{categoryUid}',
            $params,
            ['categoryUid' => (string) $categoryUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /trans-category/{categoryUid}
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function update(int $categoryUid, array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{categoryUid}',
            $data,
            ['categoryUid' => (string) $categoryUid],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
