<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * modules resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://joomla.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://joomla.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://joomla.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py joomla
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ModulesListItem:
 * Returned by: $api->joomla->modules->list()
 * Returned by: $api->joomla->modules->get($id)
 *   id: int — Module ID
 *   assetId: int — Joomla asset (ACL) ID
 *   title: string — Title (max 100 chars)
 *   note: string — Admin note (max 255 chars)
 *   content: string|null — Custom module content (HTML) (max 2147483647 chars)
 *   ordering: int — Sort position within the position
 *   position: string — Template position the module renders in (max 50 chars)
 *   checkedOut: int — User who has the record checked out; 0 when none
 *   checkedOutTime: string — When the record was checked out (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   publishUp: string — Start publishing (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   publishDown: string — Finish publishing (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   published: int — Publish state (1 = published, 0 = unpublished, -2 = trashed)
 *   module: string|null — Module type (e.g. mod_custom) (max 50 chars)
 *   access: int — Access level ID
 *   showtitle: int — 1 when the title is shown
 *   params: string — Joomla params JSON (max 2147483647 chars)
 *   clientId: int — 0 = site, 1 = administrator
 *   language: string — Language tag (* = all) (max 7 chars)
 *
 * @phpstan-type ModulesListItem array{id: int, assetId: int, title: string, note: string, content: string|null, ordering: int, position: string, checkedOut: int, checkedOutTime: string, publishUp: string, publishDown: string, published: int, module: string|null, access: int, showtitle: int, params: string, clientId: int, language: string}
 */
final class ModulesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /modules
     *
     * List Modules
     * Call: $api->joomla->modules->list()
     *
     * List Joomla site modules (#__modules rows)
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a modules column. Or menuId is not 0 or a
     *       menu item ID.
     *
     * GET https://joomla.augur-api.com/modules
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1modules/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   menuId?: int — Modules shown on this menu item (menu.id), per Joomla assignment rules
     *   module?: string — Module type (e.g. mod_custom)
     *   offset?: int — Offset number of results (Default: 0)
     *   orderBy?: string — Sort ordering (Default: id|ASC)
     *   position?: string — Template position
     *   published?: int — 1 published (Default), 0 unpublished, -1 all
     *   q?: string — Title contains
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ModulesListItem (fields listed on the class)
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
     * GET /modules/{id}
     *
     * Get Module
     * Call: $api->joomla->modules->get($id)
     *
     * Get one Joomla site module (#__modules row)
     *
     * Errors:
     *   404: No site module with this ID.
     *
     * GET https://joomla.augur-api.com/modules/{id}
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1modules~1{id}/get
     *
     * Query params ($params; `?` = optional):
     *   normalize?: string — Y decodes params from JSON and returns Joomla zero dates as null
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ModulesListItem (fields listed on the class)
     *
     * @param int $id modules.id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
