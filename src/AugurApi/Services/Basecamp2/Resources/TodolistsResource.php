<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * todolists resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://basecamp2.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://basecamp2.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://basecamp2.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py basecamp2
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * TodolistsListItem:
 * Returned by: $api->basecamp2->todolists->list()
 * Returned by: $api->basecamp2->todolists->get($id)
 *   id: int — Basecamp todolist ID
 *   name: string|null — Todolist name (max 255 chars)
 *   description: string|null — Todolist description (max 255 chars)
 *   updatedAt: string — When the record was last updated in Basecamp (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   createdAt: string — When the record was created in Basecamp (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   url: string|null — Basecamp API URL for this record (max 255 chars)
 *   appUrl: string|null — Basecamp web URL for this record (max 255 chars)
 *   completedFlag: string|null — Y when every to-do on the list is complete (max 1 chars)
 *   privateFlag: string|null — Y when the list is hidden from clients (max 1 chars)
 *   trashedFlag: string|null — Y when the record is in the Basecamp trash (max 1 chars)
 *   completedCount: int|null — Number of completed todos on the list
 *   remainingCount: int|null — Number of open todos on the list
 *   creatorId: int|null — Person who created the list
 *   bucketId: int|null — Basecamp bucket (project) the list lives in
 *   updateCd: int — Update code (704 = queued for refresh, 1185 = refresh complete)
 *   position: int — Sort position within the project
 *   statusCd: int — Status code (704 = Active, 700 = Deleted)
 *   processCd: int — Process code (704 = Active)
 *   projectsId: int — Project the list belongs to
 *
 * @phpstan-type TodolistsListItem array{id: int, name: string|null, description: string|null, updatedAt: string, createdAt: string, url: string|null, appUrl: string|null, completedFlag: string|null, privateFlag: string|null, trashedFlag: string|null, completedCount: int|null, remainingCount: int|null, creatorId: int|null, bucketId: int|null, updateCd: int, position: int, statusCd: int, processCd: int, projectsId: int}
 */
final class TodolistsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /todolists
     *
     * List Todolists
     * Call: $api->basecamp2->todolists->list()
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://basecamp2.augur-api.com/todolists
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1todolists/get
     *
     * Query params ($params; `?` = optional):
     *   assigneeId?: int — Filter by assignee ID
     *   completedFlag?: string — Filter by completion status (Y/N)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Sort field (Default: id|asc)
     *   projectsId?: int — Filter by project ID
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of TodolistsListItem (fields listed on the class)
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
     * GET /todolists/{id}
     *
     * Get Todolist Details
     * Call: $api->basecamp2->todolists->get($id)
     *
     * GET https://basecamp2.augur-api.com/todolists/{id}
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1todolists~1{id}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: TodolistsListItem (fields listed on the class)
     *
     * @param int $id Todolist ID
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
