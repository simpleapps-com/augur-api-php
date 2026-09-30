<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * categories resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 */
final class CategoriesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /categories/lookup
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /categories/{itemCategoryUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /categories/{itemCategoryUid}/attributes
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listAttributes(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}/attributes',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /categories/{itemCategoryUid}/facets
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listFacets(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}/facets',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /categories/{itemCategoryUid}/images
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listImages(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}/images',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /categories/{itemCategoryUid}/items
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listItems(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}/items',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
