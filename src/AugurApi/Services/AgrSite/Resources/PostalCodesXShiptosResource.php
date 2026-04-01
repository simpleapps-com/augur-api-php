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
     * Known fields: postalCodesXShiptosUid, postalCode, shipToId, dateCreated, dateLastModified, updateCd, statusCd, processCd
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/postal-codes-x-shiptos', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /postal-codes-x-shiptos
     *
     * Response data type: object
     * Known fields: postalCodesXShiptosUid, postalCode, shipToId, dateCreated, dateLastModified, updateCd, statusCd, processCd
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/postal-codes-x-shiptos', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /postal-codes-x-shiptos/{postalCodesXShiptosUid}
     *
     * Response data type: object
     * Known fields: postalCodesXShiptosUid, postalCode, shipToId, dateCreated, dateLastModified, updateCd, statusCd, processCd
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $postalCodesXShiptosUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/postal-codes-x-shiptos/{postalCodesXShiptosUid}',
            ['postalCodesXShiptosUid' => (string) $postalCodesXShiptosUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /postal-codes-x-shiptos/{postalCodesXShiptosUid}
     *
     * Response data type: object
     * Known fields: postalCodesXShiptosUid, postalCode, shipToId, dateCreated, dateLastModified, updateCd, statusCd, processCd
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $postalCodesXShiptosUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/postal-codes-x-shiptos/{postalCodesXShiptosUid}',
            $params,
            ['postalCodesXShiptosUid' => (string) $postalCodesXShiptosUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /postal-codes-x-shiptos/{postalCodesXShiptosUid}
     *
     * Response data type: object
     * Known fields: postalCodesXShiptosUid, postalCode, shipToId, dateCreated, dateLastModified, updateCd, statusCd, processCd
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $postalCodesXShiptosUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/postal-codes-x-shiptos/{postalCodesXShiptosUid}',
            $data,
            ['postalCodesXShiptosUid' => (string) $postalCodesXShiptosUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
