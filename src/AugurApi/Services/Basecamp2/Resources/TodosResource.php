<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * todos resource — generated from spec.
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
 * TodosListItem:
 * Returned by: $api->basecamp2->todos->list()
 * Returned by: $api->basecamp2->todos->get($id)
 * Returned by: $api->basecamp2->todos->listComments($id)
 *   id: int — Basecamp to-do ID
 *   todolistId: int|null — Todolist the to-do belongs to
 *   content: string|null — To-do title (max 255 chars)
 *   dueAt: string|null — Due date and time (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dueOn: string|null — Due date (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   updatedAt: string — When the record was last updated in Basecamp (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   createdAt: string — When the record was created in Basecamp (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   completedAt: string|null — When the to-do was completed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   commentsCount: int|null — Number of comments on the to-do
 *   privateFlag: string|null — Y when the to-do is hidden from clients (max 1 chars)
 *   trashedFlag: string|null — Y when the record is in the Basecamp trash (max 1 chars)
 *   creatorId: int|null — Person who created the to-do
 *   assigneeId: int|null — Person the to-do is assigned to
 *   completedFlag: string|null — Y when the to-do is complete (max 1 chars)
 *   url: string|null — Basecamp API URL for this record (max 255 chars)
 *   appUrl: string|null — Basecamp web URL for this record (max 255 chars)
 *   updateCd: int — Update code (704 = queued for refresh, 1185 = refresh complete)
 *   position: int — Sort position within the todolist
 *   projectsId: int — Project the to-do belongs to
 *   detailJson: string|null — Full Basecamp to-do detail as JSON (max 4294967295 chars)
 *   pullDetailCd: int — Detail fetch queue code (704 = queued, 1185 = fetched)
 *   processCd: int — Process code (704 = Active)
 *   agrInfoCd: int — agr_info sync queue code (704 = queued, 705 = skipped)
 *   statusCd: int — Status code (704 = Active, 700 = Deleted)
 *   lastCommentAt: string — When the latest comment was posted (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   vector: string|null — The 1536 dimensional vector that represents the comment (max 65535 chars)
 *   vectorCd: int — Comments embedding queue code (704 = queued, 1185 = done)
 *   vectorFlag: string — Y when an embedding exists for the to-do (max 1 chars)
 *   dateLastVector: string — When the comments embedding was last built (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *
 * EventsListItem:
 * Returned by: $api->basecamp2->todos->listEvents($id)
 * Returned by: $api->basecamp2->todos->getEvents($id, $eventNum)
 *   id: int — FK to todos.id
 *   eventNum: int — Event sequence number (0=created, 1+=comments/completed)
 *   eventTypeCd: int — CodeBasecamp enum (1=created, 2=comment, 3=completed)
 *   peopleId: int — FK to people.id
 *   eventAt: string — When the event occurred (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   commentId: int|null — Basecamp comment ID (only for comment events)
 *   dateCreated: string — Record creation timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — Record update timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   updateCd: int — Update code (704 = queued for refresh, 1185 = refresh complete)
 *   statusCd: int — Status code (704 = Active, 700 = Deleted)
 *   processCd: int — Process code (704 = Active)
 *   todosSessionsUid: int|null — FK to todos_sessions.todos_sessions_uid (optional session context)
 *
 * MetricsListItem:
 * Returned by: $api->basecamp2->todos->listMetrics($id)
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
 * TodosSessionsListItem:
 * Returned by: $api->basecamp2->todos->listSessions($id)
 * Returned by: $api->basecamp2->todos->createSessions($id, $data)
 * Returned by: $api->basecamp2->todos->getSessions($id, $sessionId)
 * Returned by: $api->basecamp2->todos->updateSessions($id, $sessionId, $data)
 * Returned by: $api->basecamp2->todos->deleteSessions($id, $sessionId)
 *   todosSessionsUid: int — Primary key
 *   todosId: int — FK to todos.id
 *   sessionNum: int — Session sequence number (1, 2, 3...)
 *   sessionStatusCd: int — Session status (open/closed/blocked)
 *   subject: string|null — Session subject/title (max 255 chars)
 *   problem: string|null — Problem statement (max 65535 chars)
 *   investigation: string|null — Investigation notes (max 65535 chars)
 *   plan: string|null — Execution plan (max 65535 chars)
 *   outcome: string|null — Session outcome/result (max 65535 chars)
 *   dateCreated: string — Record creation timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — Record update timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   updateCd: int — Datasync update code
 *   statusCd: int — Record status
 *   processCd: int — Processing code
 *
 * TodosSessionsCreateBody: New work session on a todos record, which comes from the path; every
 * body field is optional
 * Request body of: $api->basecamp2->todos->createSessions($id, $data)
 *   subject?: string|null — Session subject
 *   problem?: string|null — Problem statement
 *   investigation?: string|null — Investigation notes
 *   plan?: string|null — Planned approach
 *   outcome?: string|null — Session outcome
 *
 * TodosSessionsUpdateBody: Partial update of a work session; an absent field keeps its current
 * value, an explicit null clears a text field
 * Request body of: $api->basecamp2->todos->updateSessions($id, $sessionId, $data)
 *   subject?: string|null — Session subject
 *   problem?: string|null — Problem statement
 *   investigation?: string|null — Investigation notes
 *   plan?: string|null — Planned approach
 *   outcome?: string|null — Session outcome
 *   sessionStatusCd?: int|null — Session status (100 = Open, 101 = Closed, 102 = Blocked)
 *   statusCd?: int|null — Status code; an invalid code is ignored
 *   processCd?: int|null — Process code; an invalid code is ignored
 *   updateCd?: int|null — Update code; an invalid code is ignored
 *
 * @phpstan-type TodosListItem array{id: int, todolistId: int|null, content: string|null, dueAt: string|null, dueOn: string|null, updatedAt: string, createdAt: string, completedAt: string|null, commentsCount: int|null, privateFlag: string|null, trashedFlag: string|null, creatorId: int|null, assigneeId: int|null, completedFlag: string|null, url: string|null, appUrl: string|null, updateCd: int, position: int, projectsId: int, detailJson: string|null, pullDetailCd: int, processCd: int, agrInfoCd: int, statusCd: int, lastCommentAt: string, vector: string|null, vectorCd: int, vectorFlag: string, dateLastVector: string}
 * @phpstan-type EventsListItem array{id: int, eventNum: int, eventTypeCd: int, peopleId: int, eventAt: string, commentId: int|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, todosSessionsUid: int|null}
 * @phpstan-type MetricsListItem array{id: int, projectsId: int|null, todolistId: int|null, assigneeId: int|null, creatorId: int, todosContent: string|null, todosStatusCd: int, isStale: int, hasComments: int, needsResponse: int, createdAt: string, completedAt: string|null, lastActivityAt: string, firstCommentAt: string|null, lastCommentAt: string|null, daysOpen: int|null, daysSinceLastEvent: int|null, daysToFirstComment: int|null, cycleTimeDays: int|null, commentCount: int, activeDaysCount: int, activitySpanDays: int|null, avgDaysBetweenActivity: float|null, lastCommenterId: int|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type TodosSessionsListItem array{todosSessionsUid: int, todosId: int, sessionNum: int, sessionStatusCd: int, subject: string|null, problem: string|null, investigation: string|null, plan: string|null, outcome: string|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type TodosSessionsCreateBody array{subject?: string|null, problem?: string|null, investigation?: string|null, plan?: string|null, outcome?: string|null}
 * @phpstan-type TodosSessionsUpdateBody array{subject?: string|null, problem?: string|null, investigation?: string|null, plan?: string|null, outcome?: string|null, sessionStatusCd?: int|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 */
final class TodosResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /todos
     *
     * List Todos
     * Call: $api->basecamp2->todos->list()
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://basecamp2.augur-api.com/todos
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1todos/get
     *
     * Query params ($params; `?` = optional):
     *   assigneeId?: int — Filter by assignee ID
     *   completedFlag?: string — Filter by completion status (Y/N)
     *   dueAt?: string — Filter by due date
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Sort field (Default: id|asc)
     *   projectsId?: int — Filter by project ID
     *   todolistId?: int — Filter by todolist ID
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of TodosListItem (fields listed on the class)
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
     * GET /todos/{id}
     *
     * Get Todo Details
     * Call: $api->basecamp2->todos->get($id)
     *
     * GET https://basecamp2.augur-api.com/todos/{id}
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1todos~1{id}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: TodosListItem (fields listed on the class)
     *
     * @param int $id Todo ID
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
     * GET /todos/{id}/comments
     *
     * List Comments for Todo
     * Call: $api->basecamp2->todos->listComments($id)
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://basecamp2.augur-api.com/todos/{id}/comments
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1todos~1{id}~1comments/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Sort field (Default: id|asc)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of TodosListItem (fields listed on the class)
     *
     * @param int $id Todo ID
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listComments(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/comments',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /todos/{id}/events
     *
     * List Events for a Todo
     * Call: $api->basecamp2->todos->listEvents($id)
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://basecamp2.augur-api.com/todos/{id}/events
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1todos~1{id}~1events/get
     *
     * Query params ($params; `?` = optional):
     *   eventTypeCd?: int — Filter by event type (1=created, 2=comment, 3=completed)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Sort as field|ASC or field|DESC on a todos_events column (Default:
     *       id|desc)
     *   peopleId?: int — Filter by person ID
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of EventsListItem (fields listed on the class)
     *
     * @param int $id Todos ID
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listEvents(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/events',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /todos/{id}/events/{eventNum}
     *
     * Get Todo Event Details
     * Call: $api->basecamp2->todos->getEvents($id, $eventNum)
     *
     * Errors:
     *   404: No row exists with this ID.
     *
     * GET https://basecamp2.augur-api.com/todos/{id}/events/{eventNum}
     * Contract:
     * https://basecamp2.augur-api.com/openapi.json#/paths/~1todos~1{id}~1events~1{eventNum}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: EventsListItem (fields listed on the class)
     *
     * @param int $id Todos ID
     * @param int $eventNum Event sequence number (0=created, 1+=comments)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getEvents(int $id, int $eventNum, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/events/{eventNum}',
            $params,
            ['id' => (string) $id, 'eventNum' => (string) $eventNum],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /todos/{id}/metrics
     *
     * Get Todo Metrics Detail
     * Call: $api->basecamp2->todos->listMetrics($id)
     *
     * GET https://basecamp2.augur-api.com/todos/{id}/metrics
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1todos~1{id}~1metrics/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: MetricsListItem (fields listed on the class)
     *
     * @param int $id Todo ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listMetrics(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/metrics',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /todos/{id}/sessions
     *
     * List Sessions for Todo
     * Call: $api->basecamp2->todos->listSessions($id)
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://basecamp2.augur-api.com/todos/{id}/sessions
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1todos~1{id}~1sessions/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Sort as field|ASC or field|DESC on a todos_sessions column (Default:
     *       todos_sessions_uid|asc)
     *   sessionStatusCd?: int — Filter by session status (100=open, 101=closed, 102=blocked)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of TodosSessionsListItem (fields listed on the class)
     *
     * @param int $id Todo ID
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listSessions(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/sessions',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /todos/{id}/sessions
     *
     * Create Session for Todo
     * Call: $api->basecamp2->todos->createSessions($id, $data)
     *
     * Request body: New work session on a todos record, which comes from the path; every body field
     * is optional
     *
     * POST https://basecamp2.augur-api.com/todos/{id}/sessions
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1todos~1{id}~1sessions/post
     *
     * Request body ($data): TodosSessionsCreateBody (fields listed on the class)
     *
     * Response data type: TodosSessionsListItem (fields listed on the class)
     *
     * @param int $id Todo ID
     * @param TodosSessionsCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createSessions(int $id, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{id}/sessions',
            $data,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /todos/{id}/sessions/{sessionId}
     *
     * Delete Session
     * Call: $api->basecamp2->todos->deleteSessions($id, $sessionId)
     *
     * DELETE https://basecamp2.augur-api.com/todos/{id}/sessions/{sessionId}
     * Contract:
     * https://basecamp2.augur-api.com/openapi.json#/paths/~1todos~1{id}~1sessions~1{sessionId}/delete
     *
     * Response data type: TodosSessionsListItem (fields listed on the class)
     *
     * @param int $id Todo ID
     * @param int $sessionId Session UID
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteSessions(int $id, int $sessionId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{id}/sessions/{sessionId}',
            ['id' => (string) $id, 'sessionId' => (string) $sessionId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /todos/{id}/sessions/{sessionId}
     *
     * Get Session Details
     * Call: $api->basecamp2->todos->getSessions($id, $sessionId)
     *
     * GET https://basecamp2.augur-api.com/todos/{id}/sessions/{sessionId}
     * Contract:
     * https://basecamp2.augur-api.com/openapi.json#/paths/~1todos~1{id}~1sessions~1{sessionId}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: TodosSessionsListItem (fields listed on the class)
     *
     * @param int $id Todo ID
     * @param int $sessionId Session UID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getSessions(int $id, int $sessionId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/sessions/{sessionId}',
            $params,
            ['id' => (string) $id, 'sessionId' => (string) $sessionId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /todos/{id}/sessions/{sessionId}
     *
     * Update Session
     * Call: $api->basecamp2->todos->updateSessions($id, $sessionId, $data)
     *
     * Request body: Partial update of a work session; an absent field keeps its current value, an
     * explicit null clears a text field
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * PUT https://basecamp2.augur-api.com/todos/{id}/sessions/{sessionId}
     * Contract:
     * https://basecamp2.augur-api.com/openapi.json#/paths/~1todos~1{id}~1sessions~1{sessionId}/put
     *
     * Request body ($data): TodosSessionsUpdateBody (fields listed on the class)
     *
     * Response data type: TodosSessionsListItem (fields listed on the class)
     *
     * @param int $id Todo ID
     * @param int $sessionId Session UID
     * @param TodosSessionsUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateSessions(int $id, int $sessionId, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{id}/sessions/{sessionId}',
            $data,
            ['id' => (string) $id, 'sessionId' => (string) $sessionId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
