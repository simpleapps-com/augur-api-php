<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMastFiles resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-pim
 */
final class InvMastFilesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast-files
     *
     * Response data type: array
     * Known fields: invMastFilesUid, invMastUid, fileName, filePath, linkArea, rowStatusFlag, sequenceNo, dateCreated, ... (13 total)
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
     * POST /inv-mast-files
     *
     * Response data type: object
     * Known fields: invMastFilesUid, invMastUid, fileName, filePath, linkArea, rowStatusFlag, sequenceNo, dateCreated, ... (13 total)
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
     * DELETE /inv-mast-files/{invMastFilesUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $invMastFilesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastFilesUid}',
            ['invMastFilesUid' => (string) $invMastFilesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast-files/{invMastFilesUid}
     *
     * Response data type: object
     * Known fields: invMastFilesUid, invMastUid, fileName, filePath, linkArea, rowStatusFlag, sequenceNo, dateCreated, ... (13 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastFilesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastFilesUid}',
            $params,
            ['invMastFilesUid' => (string) $invMastFilesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /inv-mast-files/{invMastFilesUid}
     *
     * Response data type: object
     * Known fields: invMastFilesUid, invMastUid, fileName, filePath, linkArea, rowStatusFlag, sequenceNo, dateCreated, ... (13 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invMastFilesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastFilesUid}',
            $data,
            ['invMastFilesUid' => (string) $invMastFilesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
