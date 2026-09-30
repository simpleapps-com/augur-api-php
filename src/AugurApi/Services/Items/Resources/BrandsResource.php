<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * brands resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 */
final class BrandsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /brands
     *
     * Response data type: array
     *   brandsUid: int
     *   brandsName: string
     *   brandsId: string
     *   brandsDesc: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   contentId: int|null
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
     * POST /brands
     *
     * Response data type: object
     *   brandsUid: int
     *   brandsName: string
     *   brandsId: string
     *   brandsDesc: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   contentId: int|null
     *
     * @param array{brandsName: string, brandsDesc?: string, contentId?: int} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /brands/{brandsUid}
     *
     * Response data type: object
     *   brandsUid: int
     *   brandsName: string
     *   brandsId: string
     *   brandsDesc: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   contentId: int|null
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $brandsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{brandsUid}',
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /brands/{brandsUid}
     *
     * Response data type: object
     *   brandsUid: int
     *   brandsName: string
     *   brandsId: string
     *   brandsDesc: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   contentId: int|null
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $brandsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{brandsUid}',
            $params,
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /brands/{brandsUid}
     *
     * Response data type: object
     *   brandsUid: int
     *   brandsName: string
     *   brandsId: string
     *   brandsDesc: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   contentId: int|null
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $brandsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{brandsUid}',
            $data,
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /brands/{brandsUid}/attributes
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listAttributes(int $brandsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{brandsUid}/attributes',
            $params,
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /brands/{brandsUid}/facets
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listFacets(int $brandsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{brandsUid}/facets',
            $params,
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /brands/{brandsUid}/items
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listItems(int $brandsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{brandsUid}/items',
            $params,
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /brands/{brandsUid}/items
     *
     * Response data type: object
     *   brandsXItemsUid: int
     *   brandsUid: int
     *   invMastUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createItems(int $brandsUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{brandsUid}/items',
            $data,
            ['brandsUid' => (string) $brandsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /brands/{brandsUid}/items/{brandsXItemsUid}
     *
     * Response data type: object
     *   brandsXItemsUid: int
     *   brandsUid: int
     *   invMastUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteItems(int $brandsUid, int $brandsXItemsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{brandsUid}/items/{brandsXItemsUid}',
            ['brandsUid' => (string) $brandsUid, 'brandsXItemsUid' => (string) $brandsXItemsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /brands/{brandsUid}/items/{brandsXItemsUid}
     *
     * Response data type: object
     *   brandsXItemsUid: int
     *   brandsUid: int
     *   invMastUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getItems(int $brandsUid, int $brandsXItemsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{brandsUid}/items/{brandsXItemsUid}',
            $params,
            ['brandsUid' => (string) $brandsUid, 'brandsXItemsUid' => (string) $brandsXItemsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /brands/{brandsUid}/items/{brandsXItemsUid}
     *
     * Response data type: object
     *   brandsXItemsUid: int
     *   brandsUid: int
     *   invMastUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateItems(int $brandsUid, int $brandsXItemsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{brandsUid}/items/{brandsXItemsUid}',
            $data,
            ['brandsUid' => (string) $brandsUid, 'brandsXItemsUid' => (string) $brandsXItemsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
