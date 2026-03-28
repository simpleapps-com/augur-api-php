<?php

declare(strict_types=1);

namespace AugurApi\Services\Nexus\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * transfer resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py nexus
 */
final class TransferResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /transfer
     *
     * Response data type: array
     * Known fields: transferUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (11 total)
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
     * POST /transfer
     *
     * Response data type: object
     * Known fields: transferUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (11 total)
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
     * DELETE /transfer/{transferUid}
     *
     * Response data type: object
     * Known fields: transferUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (11 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $transferUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{transferUid}',
            ['transferUid' => (string) $transferUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /transfer/{transferUid}
     *
     * Response data type: object
     * Known fields: transferUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (11 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $transferUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{transferUid}',
            $params,
            ['transferUid' => (string) $transferUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /transfer/{transferUid}
     *
     * Response data type: object
     * Known fields: transferUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (11 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $transferUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{transferUid}',
            $data,
            ['transferUid' => (string) $transferUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
