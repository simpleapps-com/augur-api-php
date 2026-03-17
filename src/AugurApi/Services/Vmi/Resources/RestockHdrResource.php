<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * restockHdr resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
 */
final class RestockHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /restock-hdr
     *
     * Response data type: array
     * Known fields: restockHdrUid, warehouseUid, distributorsUid, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (15 total)
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
     * POST /restock-hdr
     *
     * Response data type: object
     * Known fields: restockHdrUid, warehouseUid, distributorsUid, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (15 total)
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
     * DELETE /restock-hdr/{restockHdrUid}
     *
     * Response data type: object
     * Known fields: restockHdrUid, warehouseUid, distributorsUid, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (15 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $restockHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{restockHdrUid}',
            ['restockHdrUid' => (string) $restockHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /restock-hdr/{restockHdrUid}
     *
     * Response data type: object
     * Known fields: restockHdrUid, warehouseUid, distributorsUid, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (15 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $restockHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{restockHdrUid}',
            $params,
            ['restockHdrUid' => (string) $restockHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /restock-hdr/{restockHdrUid}
     *
     * Response data type: object
     * Known fields: restockHdrUid, warehouseUid, distributorsUid, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (15 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $restockHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{restockHdrUid}',
            $data,
            ['restockHdrUid' => (string) $restockHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
