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
     * Known fields: brandsUid, brandsName, brandsId, brandsDesc, dateCreated, dateLastModified, updateCd, statusCd, ... (10 total)
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
     * POST /brands
     *
     * Response data type: object
     * Known fields: brandsUid, brandsName, brandsId, brandsDesc, dateCreated, dateLastModified, updateCd, statusCd, ... (10 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /brands/{brandsUid}
     *
     * Response data type: object
     * Known fields: brandsUid, brandsName, brandsId, brandsDesc, dateCreated, dateLastModified, updateCd, statusCd, ... (10 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /brands/{brandsUid}
     *
     * Response data type: object
     * Known fields: brandsUid, brandsName, brandsId, brandsDesc, dateCreated, dateLastModified, updateCd, statusCd, ... (10 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /brands/{brandsUid}
     *
     * Response data type: object
     * Known fields: brandsUid, brandsName, brandsId, brandsDesc, dateCreated, dateLastModified, updateCd, statusCd, ... (10 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /brands/{brandsUid}/attributes
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAttributes(int $brandsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{brandsUid}/attributes',
            $params,
            ['brandsUid' => (string) $brandsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /brands/{brandsUid}/items
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listItems(int $brandsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{brandsUid}/items',
            $params,
            ['brandsUid' => (string) $brandsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
