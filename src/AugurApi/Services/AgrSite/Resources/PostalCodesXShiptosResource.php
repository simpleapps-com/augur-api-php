<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * postalCodesXShiptos resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 */
final class PostalCodesXShiptosResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /postal-codes-x-shiptos
     *
     * Response data type: array
     *   postalCodesXShiptosUid: int
     *   postalCode: string
     *   shipToId: float
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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
     * POST /postal-codes-x-shiptos
     *
     * Response data type: object
     *   postalCodesXShiptosUid: int
     *   postalCode: string
     *   shipToId: float
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /postal-codes-x-shiptos/{postalCodesXShiptosUid}
     *
     * Response data type: object
     *   postalCodesXShiptosUid: int
     *   postalCode: string
     *   shipToId: float
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $postalCodesXShiptosUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{postalCodesXShiptosUid}',
            ['postalCodesXShiptosUid' => (string) $postalCodesXShiptosUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /postal-codes-x-shiptos/{postalCodesXShiptosUid}
     *
     * Response data type: object
     *   postalCodesXShiptosUid: int
     *   postalCode: string
     *   shipToId: float
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $postalCodesXShiptosUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{postalCodesXShiptosUid}',
            $params,
            ['postalCodesXShiptosUid' => (string) $postalCodesXShiptosUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /postal-codes-x-shiptos/{postalCodesXShiptosUid}
     *
     * Response data type: object
     *   postalCodesXShiptosUid: int
     *   postalCode: string
     *   shipToId: float
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $postalCodesXShiptosUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{postalCodesXShiptosUid}',
            $data,
            ['postalCodesXShiptosUid' => (string) $postalCodesXShiptosUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
