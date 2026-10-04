<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * metrics resource — generated from spec.
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
 * MetricsListItem:
 * Returned by: $api->basecamp2->metrics->list()
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
 * @phpstan-type MetricsListItem array{id: int, projectsId: int|null, todolistId: int|null, assigneeId: int|null, creatorId: int, todosContent: string|null, todosStatusCd: int, isStale: int, hasComments: int, needsResponse: int, createdAt: string, completedAt: string|null, lastActivityAt: string, firstCommentAt: string|null, lastCommentAt: string|null, daysOpen: int|null, daysSinceLastEvent: int|null, daysToFirstComment: int|null, cycleTimeDays: int|null, commentCount: int, activeDaysCount: int, activitySpanDays: int|null, avgDaysBetweenActivity: float|null, lastCommenterId: int|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 */
final class MetricsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /metrics
     *
     * List Todo Metrics
     * Call: $api->basecamp2->metrics->list()
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://basecamp2.augur-api.com/metrics
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1metrics/get
     *
     * Query params ($params; `?` = optional):
     *   assigneeId?: int — Filter by assignee ID
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
}
