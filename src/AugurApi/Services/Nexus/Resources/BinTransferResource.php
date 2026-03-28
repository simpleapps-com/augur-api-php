<?php

declare(strict_types=1);

namespace AugurApi\Services\Nexus\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * binTransfer resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py nexus
 */
final class BinTransferResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /bin-transfer
     *
     * Response data type: array
     * Known fields: binTransferHdrUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, jsonData, ... (13 total)
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
     * POST /bin-transfer
     *
     * Response data type: object
     * Known fields: binTransferHdrUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, jsonData, ... (13 total)
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
     * DELETE /bin-transfer/{binTransferHdrUid}
     *
     * Response data type: object
     * Known fields: binTransferHdrUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, jsonData, ... (13 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $binTransferHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{binTransferHdrUid}',
            ['binTransferHdrUid' => (string) $binTransferHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /bin-transfer/{binTransferHdrUid}
     *
     * Response data type: object
     * Known fields: binTransferHdrUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, jsonData, ... (13 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $binTransferHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{binTransferHdrUid}',
            $params,
            ['binTransferHdrUid' => (string) $binTransferHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /bin-transfer/{binTransferHdrUid}
     *
     * Response data type: object
     * Known fields: binTransferHdrUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, jsonData, ... (13 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $binTransferHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{binTransferHdrUid}',
            $data,
            ['binTransferHdrUid' => (string) $binTransferHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /bin-transfer/{binTransferHdrUid}/status
     *
     * Response data type: object
     * Known fields: binTransferHdrUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, jsonData, ... (14 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listStatus(int $binTransferHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{binTransferHdrUid}/status',
            $params,
            ['binTransferHdrUid' => (string) $binTransferHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
