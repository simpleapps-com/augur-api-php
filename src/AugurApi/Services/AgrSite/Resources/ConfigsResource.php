<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * configs resource — generated from spec.
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
 * ConfigsListItem: A service that has a config file for the site
 * Returned by: $api->agrSite->configs->list()
 *   serviceName: string — Service name, taken from the config file name (snake_case, e.g. p21_sism)
 *   isActive: bool — True when the file sets a prefix, which marks the service active for the site
 *
 * ConfigsGetData: A site's config for one service: every key the service definition declares, set
 * or not
 * Returned by: $api->agrSite->configs->get($serviceName)
 * Returned by: $api->agrSite->configs->update($serviceName, $data)
 *   serviceName: string — Service the config belongs to (snake_case, e.g. p21_sism)
 *   fileExists: bool — True when the site has a config file for the service
 *   configs: list<ConfigsGetDataConfigsItem> — Every app.config key of the service, in definition
 *       order
 *     each item: ConfigsGetDataConfigsItem — One app.config key of a service, with the site's value
 *         and the definition's rules
 *
 * ConfigsGetDataConfigsItem: One app.config key of a service, with the site's value and the
 * definition's rules
 * Field `configs` of ConfigsGetData
 *   configName: string — Key name from the service definition's app.config (snake_case)
 *   value: string|int|float|bool|null — Value in the site's config file, or the default when the
 *       key is not set; null when neither exists
 *   default: string|int|float|bool|null — Default from the service definition; null when the
 *       definition has none
 *   type: string — Declared type: string, int, or float
 *   allowedValues: list<string> — Values the key accepts; empty when any value of the type is
 *       accepted
 *   isSet: bool — True when the key is present in the site's config file
 *
 * ConfigsUpdateBody: Set one or more keys in a site's config file for one service; keys not sent
 * are left unchanged
 * Request body of: $api->agrSite->configs->update($serviceName, $data)
 *   values: array<string, string> — Config keys to set, keyed by the snake_case name from the
 *       service definition's app.config; a JSON number is accepted and read as its string form,
 *       then cast to the key's declared type and checked against its allowed values
 *     map of string
 *
 * @phpstan-type ConfigsListItem array{serviceName: string, isActive: bool}
 * @phpstan-type ConfigsGetData array{serviceName: string, fileExists: bool, configs: list<ConfigsGetDataConfigsItem>}
 * @phpstan-type ConfigsGetDataConfigsItem array{configName: string, value: string|int|float|bool|null, default: string|int|float|bool|null, type: string, allowedValues: list<string>, isSet: bool}
 * @phpstan-type ConfigsUpdateBody array{values: array<string, string>}
 */
final class ConfigsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /configs
     *
     * List service configs
     * Call: $api->agrSite->configs->list()
     *
     * Services that have a config file for the site
     *
     * Response data, each item: A service that has a config file for the site
     *
     * GET https://agr-site.augur-api.com/configs
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1configs/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ConfigsListItem (fields listed on the class)
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
     * GET /configs/{serviceName}
     *
     * Get a service config
     * Call: $api->agrSite->configs->get($serviceName)
     *
     * Every app.config key of one service for the site: value, default, type, allowed values, and
     * whether the site config file sets it
     *
     * Response data: A site's config for one service: every key the service definition declares,
     * set or not
     *
     * Errors:
     *   404: The site has no domain, or no service definition with an app.config block exists for
     *       serviceName.
     *
     * GET https://agr-site.augur-api.com/configs/{serviceName}
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1configs~1{serviceName}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ConfigsGetData (fields listed on the class)
     *
     * @param string $serviceName Service name, snake_case (e.g. p21_sism)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $serviceName, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{serviceName}',
            $params,
            ['serviceName' => (string) $serviceName],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /configs/{serviceName}
     *
     * Update a service config
     * Call: $api->agrSite->configs->update($serviceName, $data)
     *
     * Set one or more app.config keys in the site config file for one service; keys not sent are
     * left unchanged. Body: {"values": {"default_scheduled_import_master_uid": "12"}}. GET
     * /configs/{serviceName} lists every settable key with its type and allowed values. A value
     * MUST be a string or number and is stored as the key's declared type (int, float, string), so
     * "12" and 12 both store 12 for an int key. A body that is not JSON or has no values returns
     * 400; a boolean, null, or nested value, an unknown key, prefix, a wrong type, or a value
     * outside allowed_values returns 422 naming every bad key and the valid options, and nothing is
     * written
     *
     * Request body: Set one or more keys in a site's config file for one service; keys not sent are
     * left unchanged
     * Response data: A site's config for one service: every key the service definition declares,
     * set or not
     *
     * Errors:
     *   400: Bad request: the body is missing, or values is missing, empty, or not an object of
     *       scalars; message says which.
     *   404: The site has no domain, or no service definition with an app.config block exists for
     *       serviceName.
     *   422: A value is not a string or number, a key is unknown or protected (prefix), a value
     *       does not parse as the key's type, or a value is outside allowed_values; message lists
     *       the errors and the valid options. Nothing is written.
     *
     * PUT https://agr-site.augur-api.com/configs/{serviceName}
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1configs~1{serviceName}/put
     *
     * Request body ($data): ConfigsUpdateBody (fields listed on the class)
     *
     * Response data type: ConfigsGetData (fields listed on the class)
     *
     * @param string $serviceName Service name, snake_case (e.g. p21_sism)
     * @param ConfigsUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(string $serviceName, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{serviceName}',
            $data,
            ['serviceName' => (string) $serviceName],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
