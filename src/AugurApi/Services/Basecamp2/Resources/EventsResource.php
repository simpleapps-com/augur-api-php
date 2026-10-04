<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * events resource — generated from spec.
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
 * EventsListItem:
 * Returned by: $api->basecamp2->events->list()
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
 * @phpstan-type EventsListItem array{id: int, eventNum: int, eventTypeCd: int, peopleId: int, eventAt: string, commentId: int|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, todosSessionsUid: int|null}
 */
final class EventsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /events
     *
     * List Todo Events
     * Call: $api->basecamp2->events->list()
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://basecamp2.augur-api.com/events
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1events/get
     *
     * Query params ($params; `?` = optional):
     *   eventTypeCd?: int — Filter by event type (1=created, 2=comment, 3=completed)
     *   id?: int — Filter by todos ID
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
