<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Settings resource.
 *
 * @fullPath api.agrSite.settings
 * @service agr_site
 * @domain augur
 */
final class SettingsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List settings.
     *
     * @fullPath api.agrSite.settings.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/settings', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get settings details.
     *
     * @fullPath api.agrSite.settings.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $settingsUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/settings/{settingsUid}',
            [],
            ['settingsUid' => (string) $settingsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create settings.
     *
     * @fullPath api.agrSite.settings.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/settings', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update settings.
     *
     * @fullPath api.agrSite.settings.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $settingsUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/settings/{settingsUid}',
            $data,
            ['settingsUid' => (string) $settingsUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete settings.
     *
     * @fullPath api.agrSite.settings.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $settingsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/settings/{settingsUid}',
            ['settingsUid' => (string) $settingsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
