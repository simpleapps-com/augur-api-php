<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * settings resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-site.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-site.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-site.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * SettingsListItem:
 * Returned by: $api->agrSite->settings->list()
 * Returned by: $api->agrSite->settings->create($data)
 * Returned by: $api->agrSite->settings->get($settingsUid)
 * Returned by: $api->agrSite->settings->update($settingsUid, $data)
 * Returned by: $api->agrSite->settings->delete($settingsUid)
 *   settingsUid: int — Setting ID
 *   serviceName: string — Service the setting belongs to (max 100 chars)
 *   name: string — Setting name (max 100 chars)
 *   value: string|null — Setting value (max 255 chars)
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * SettingsCreateBody: Create a setting, or return the existing one with the same service and name
 * Request body of: $api->agrSite->settings->create($data)
 *   serviceName: string|null — Service the setting belongs to; nothing is stored when missing
 *   name: string|null — Setting name; nothing is stored when missing
 *   value?: string|null — Setting value
 *
 * SettingsUpdateBody: Partial update of a setting; an absent field keeps its current value
 * Request body of: $api->agrSite->settings->update($settingsUid, $data)
 *   serviceName?: string|null — Service the setting belongs to
 *   name?: string|null — Setting name
 *   value?: string|null — Setting value
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   updateCd?: int|null — Update code (1185 = Import Complete)
 *   processCd?: int|null — Process code (704 = Active, 1185 = Import Complete)
 *
 * @phpstan-type SettingsListItem array{settingsUid: int, serviceName: string, name: string, value: string|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type SettingsCreateBody array{serviceName: string|null, name: string|null, value?: string|null}
 * @phpstan-type SettingsUpdateBody array{serviceName?: string|null, name?: string|null, value?: string|null, statusCd?: int|null, updateCd?: int|null, processCd?: int|null}
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
     * List Settings
     * Call: $api->agrSite->settings->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a settings column.
     *
     * GET https://agr-site.augur-api.com/settings
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1settings/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: settings_uid|ASC)
     *   serviceName: string — Only settings for this service
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of SettingsListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /settings
     *
     * Create Settings
     * Call: $api->agrSite->settings->create($data)
     *
     * Request body: Create a setting, or return the existing one with the same service and name
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://agr-site.augur-api.com/settings
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1settings/post
     *
     * Request body ($data): SettingsCreateBody (fields listed on the class)
     *
     * Response data type: SettingsListItem (fields listed on the class)
     *
     * @param SettingsCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /settings/{settingsUid}
     *
     * DELETE Settings
     * Call: $api->agrSite->settings->delete($settingsUid)
     *
     * Errors:
     *   404: No setting with this ID.
     *
     * DELETE https://agr-site.augur-api.com/settings/{settingsUid}
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1settings~1{settingsUid}/delete
     *
     * Response data type: SettingsListItem (fields listed on the class)
     *
     * @param int $settingsUid Setting ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $settingsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{settingsUid}',
            ['settingsUid' => (string) $settingsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /settings/{settingsUid}
     *
     * Get Settings Details
     * Call: $api->agrSite->settings->get($settingsUid)
     *
     * Errors:
     *   404: No setting with this ID.
     *
     * GET https://agr-site.augur-api.com/settings/{settingsUid}
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1settings~1{settingsUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: SettingsListItem (fields listed on the class)
     *
     * @param int $settingsUid Setting ID
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /settings/{settingsUid}
     *
     * Update Settings
     * Call: $api->agrSite->settings->update($settingsUid, $data)
     *
     * Request body: Partial update of a setting; an absent field keeps its current value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No setting with this ID.
     *
     * PUT https://agr-site.augur-api.com/settings/{settingsUid}
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1settings~1{settingsUid}/put
     *
     * Request body ($data): SettingsUpdateBody (fields listed on the class)
     *
     * Response data type: SettingsListItem (fields listed on the class)
     *
     * @param int $settingsUid Setting ID
     * @param SettingsUpdateBody $data
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
