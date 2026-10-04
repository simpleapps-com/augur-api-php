<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * people resource — generated from spec.
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
 * PeopleListItem:
 * Returned by: $api->basecamp2->people->list()
 * Returned by: $api->basecamp2->people->get($id)
 * Returned by: $api->basecamp2->people->listTodos($id)
 * Returned by: $api->basecamp2->people->listProjectsTodos($personId, $projectId)
 *   id: int — Basecamp person ID
 *   identityId: int|null — Basecamp identity ID shared across accounts
 *   name: string|null — Full name (max 255 chars)
 *   emailAddress: string|null — Email address (max 255 chars)
 *   adminFlag: string|null — Y when the person is a Basecamp admin (max 1 chars)
 *   trashedFlag: string|null — Y when the record is in the Basecamp trash (max 1 chars)
 *   updatedAt: string — When the record was last updated in Basecamp (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   createdAt: string — When the record was created in Basecamp (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   url: string|null — Basecamp API URL for this record (max 255 chars)
 *   appUrl: string|null — Basecamp web URL for this record (max 255 chars)
 *   avatarUrl: string|null — Avatar image URL (max 255 chars)
 *   fullsizeAvatarUrl: string|null — Full-size avatar image URL (max 255 chars)
 *   updateCd: int — Update code (704 = queued for refresh, 1185 = refresh complete)
 *   statusCd: int — Status code (704 = Active, 700 = Deleted)
 *   processCd: int — Process code (704 = Active)
 *
 * MetricsListItem:
 * Returned by: $api->basecamp2->people->listMetrics($id)
 *   id: int — Todos ID (PK, FK to todos.id)
 *   projectsId: int|null — FK to projects.id
 *   todolistId: int|null — FK to todolist.id
 *   assigneeId: int|null — FK to people.id (current assignee)
 *   creatorId: int — FK to people.id (creator)
 *   todosContent: string|null — Todos title/content (max 65535 chars)
 *   todosStatusCd: int — Status (1=open, 2=completed)
 *   isStale: int — days_since_last_event > 7 (open only)
 *   hasComments: int — comment_count > 0
 *   needsResponse: int — last_commenter != assignee (open only)
 *   createdAt: string — Todos created timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   completedAt: string|null — Todos completion timestamp (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   lastActivityAt: string — Most recent event timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   firstCommentAt: string|null — First comment timestamp (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   lastCommentAt: string|null — Last comment timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   daysOpen: int|null — Days since creation (NULL if complete)
 *   daysSinceLastEvent: int|null — Days since last activity (NULL if complete)
 *   daysToFirstComment: int|null — Days from creation to first comment
 *   cycleTimeDays: int|null — Days to complete (NULL if open)
 *   commentCount: int — Total comment events
 *   activeDaysCount: int — Count of distinct days with activity
 *   activitySpanDays: int|null — Days between first and last event
 *   avgDaysBetweenActivity: float|null — Average days between active days
 *   lastCommenterId: int|null — FK to people.id (last commenter)
 *   dateCreated: string — Record creation timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — Record update timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   updateCd: int — Update code
 *   statusCd: int — Record status code
 *   processCd: int — Process status code
 *
 * @phpstan-type PeopleListItem array{id: int, identityId: int|null, name: string|null, emailAddress: string|null, adminFlag: string|null, trashedFlag: string|null, updatedAt: string, createdAt: string, url: string|null, appUrl: string|null, avatarUrl: string|null, fullsizeAvatarUrl: string|null, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type MetricsListItem array{id: int, projectsId: int|null, todolistId: int|null, assigneeId: int|null, creatorId: int, todosContent: string|null, todosStatusCd: int, isStale: int, hasComments: int, needsResponse: int, createdAt: string, completedAt: string|null, lastActivityAt: string, firstCommentAt: string|null, lastCommentAt: string|null, daysOpen: int|null, daysSinceLastEvent: int|null, daysToFirstComment: int|null, cycleTimeDays: int|null, commentCount: int, activeDaysCount: int, activitySpanDays: int|null, avgDaysBetweenActivity: float|null, lastCommenterId: int|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 */
final class PeopleResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /people
     *
     * List People with filters
     * Call: $api->basecamp2->people->list()
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://basecamp2.augur-api.com/people
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1people/get
     *
     * Query params ($params; `?` = optional):
     *   adminFlag?: string — Filter by admin status (Y/N)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset for results (Default: 0)
     *   orderBy?: string — Sort as field|ASC or field|DESC on a people column, e.g. name|asc
     *       (Default: id|asc)
     *   q?: string — Search name or emailAddress (LIKE)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *   trashedFlag?: string — Filter by trashed status (Y/N)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of PeopleListItem (fields listed on the class)
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
     * GET /people/{id}
     *
     * Get Person by ID
     * Call: $api->basecamp2->people->get($id)
     *
     * GET https://basecamp2.augur-api.com/people/{id}
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1people~1{id}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: PeopleListItem (fields listed on the class)
     *
     * @param int $id Person ID
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

    /**
     * GET /people/{id}/metrics
     *
     * List Todo Metrics by Person
     * Call: $api->basecamp2->people->listMetrics($id)
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://basecamp2.augur-api.com/people/{id}/metrics
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1people~1{id}~1metrics/get
     *
     * Query params ($params; `?` = optional):
     *   creatorId?: int — Filter by creator ID
     *   hasComments?: int — Filter by has comments (1=yes)
     *   isStale?: int — Filter stale todos (1=stale)
     *   limit?: int — Limit number of results (Default: 10)
     *   needsResponse?: int — Filter needs response (1=yes)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: id|ASC)
     *   projectsId?: int — Filter by project ID
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *   todosStatusCd?: int — Filter by status (1=open, 2=completed)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of MetricsListItem (fields listed on the class)
     *
     * @param int $id Person ID (assignee)
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listMetrics(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/metrics',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /people/{id}/todos
     *
     * List Todos for Person
     * Call: $api->basecamp2->people->listTodos($id)
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://basecamp2.augur-api.com/people/{id}/todos
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1people~1{id}~1todos/get
     *
     * Query params ($params; `?` = optional):
     *   completedFlag?: string — Filter by completion status (Y/N)
     *   dueAt?: string — Filter by due date
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Sort as field|ASC or field|DESC on a todos column (Default: id|asc)
     *   projectsId?: int — Filter by project ID (optional)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of PeopleListItem (fields listed on the class)
     *
     * @param int $id Person ID (assignee)
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listTodos(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/todos',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /people/{personId}/projects/{projectId}/todos
     *
     * List Todos for Person on Project
     * Call: $api->basecamp2->people->listProjectsTodos($personId, $projectId)
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://basecamp2.augur-api.com/people/{personId}/projects/{projectId}/todos
     * Contract:
     * https://basecamp2.augur-api.com/openapi.json#/paths/~1people~1{personId}~1projects~1{projectId}~1todos/get
     *
     * Query params ($params; `?` = optional):
     *   completedFlag?: string — Filter by completion status (Y/N)
     *   dueAt?: string — Filter by due date
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Sort as field|ASC or field|DESC on a todos column (Default: id|asc)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of PeopleListItem (fields listed on the class)
     *
     * @param int $personId Person ID (assignee)
     * @param int $projectId Basecamp project the todos belong to
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listProjectsTodos(int $personId, int $projectId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{personId}/projects/{projectId}/todos',
            $params,
            ['personId' => (string) $personId, 'projectId' => (string) $projectId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
