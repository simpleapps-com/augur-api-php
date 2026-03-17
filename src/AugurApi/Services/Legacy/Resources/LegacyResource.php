<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * legacy resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py legacy
 */
final class LegacyResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /legacy/state
     *
     * Response data type: array
     * Known fields: stateUid, countryUid, twoLetterCode, stateName, dateCreated, createdBy, dateLastModified, lastMaintainedBy, ... (17 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listState(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/state', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /legacy/state
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createState(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/state', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /legacy/state/{stateUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteState(int $stateUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/state/{stateUid}',
            ['stateUid' => (string) $stateUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /legacy/state/{stateUid}
     *
     * Response data type: object
     * Known fields: stateUid, countryUid, twoLetterCode, stateName, dateCreated, createdBy, dateLastModified, lastMaintainedBy, ... (17 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getState(int $stateUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/state/{stateUid}',
            $params,
            ['stateUid' => (string) $stateUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /legacy/state/{stateUid}
     *
     * Response data type: object
     * Known fields: stateUid, countryUid, twoLetterCode, stateName, dateCreated, createdBy, dateLastModified, lastMaintainedBy, ... (17 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateState(int $stateUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/state/{stateUid}',
            $data,
            ['stateUid' => (string) $stateUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
