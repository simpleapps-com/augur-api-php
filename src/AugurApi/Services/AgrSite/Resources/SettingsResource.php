<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * settings resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 */
final class SettingsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /settings
     *
     * Response data type: array
     * Known fields: settingsUid, serviceName, name, value, dateCreated, dateLastModified, updateCd, statusCd, ... (9 total)
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
     * POST /settings
     *
     * Response data type: object
     * Known fields: settingsUid, serviceName, name, value, dateCreated, dateLastModified, updateCd, statusCd, ... (9 total)
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
     * DELETE /settings/{settingsUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $settingsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{settingsUid}',
            ['settingsUid' => (string) $settingsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /settings/{settingsUid}
     *
     * Response data type: object
     * Known fields: settingsUid, serviceName, name, value, dateCreated, dateLastModified, updateCd, statusCd, ... (9 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $settingsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{settingsUid}',
            $params,
            ['settingsUid' => (string) $settingsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /settings/{settingsUid}
     *
     * Response data type: object
     * Known fields: settingsUid, serviceName, name, value, dateCreated, dateLastModified, updateCd, statusCd, ... (9 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $settingsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{settingsUid}',
            $data,
            ['settingsUid' => (string) $settingsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
