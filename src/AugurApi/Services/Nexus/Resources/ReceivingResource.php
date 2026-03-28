<?php

declare(strict_types=1);

namespace AugurApi\Services\Nexus\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * receiving resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py nexus
 */
final class ReceivingResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /receiving
     *
     * Response data type: array
     * Known fields: receivingUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (13 total)
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
     * POST /receiving
     *
     * Response data type: object
     * Known fields: receivingUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (13 total)
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
     * DELETE /receiving/{receivingUid}
     *
     * Response data type: object
     * Known fields: receivingUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (13 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $receivingUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{receivingUid}',
            ['receivingUid' => (string) $receivingUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /receiving/{receivingUid}
     *
     * Response data type: object
     * Known fields: receivingUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (13 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $receivingUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{receivingUid}',
            $params,
            ['receivingUid' => (string) $receivingUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /receiving/{receivingUid}
     *
     * Response data type: object
     * Known fields: receivingUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (13 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $receivingUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{receivingUid}',
            $data,
            ['receivingUid' => (string) $receivingUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
