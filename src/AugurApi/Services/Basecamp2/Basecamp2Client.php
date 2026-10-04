<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Basecamp2\Resources\CommentsResource;
use AugurApi\Services\Basecamp2\Resources\EventsResource;
use AugurApi\Services\Basecamp2\Resources\MetricsResource;
use AugurApi\Services\Basecamp2\Resources\PeopleResource;
use AugurApi\Services\Basecamp2\Resources\ProjectsResource;
use AugurApi\Services\Basecamp2\Resources\TodolistsResource;
use AugurApi\Services\Basecamp2\Resources\TodosResource;
use AugurApi\Services\Basecamp2\Resources\TodosSummaryResource;

/**
 * Basecamp2 service client — generated from spec.
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
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /comments → $api->basecamp2->comments->list() → list of CommentsListItem
 *   GET /comments/{id} → $api->basecamp2->comments->get($id) → CommentsListItem
 *   GET /events → $api->basecamp2->events->list() → list of EventsListItem
 *   GET /metrics → $api->basecamp2->metrics->list() → list of MetricsListItem
 *   GET /people → $api->basecamp2->people->list() → list of PeopleListItem
 *   GET /people/{id} → $api->basecamp2->people->get($id) → PeopleListItem
 *   GET /people/{id}/metrics → $api->basecamp2->people->listMetrics($id) → list of MetricsListItem
 *   GET /people/{id}/todos → $api->basecamp2->people->listTodos($id) → list of PeopleListItem
 *   GET /people/{personId}/projects/{projectId}/todos →
 *       $api->basecamp2->people->listProjectsTodos($personId, $projectId) → list of PeopleListItem
 *   GET /projects → $api->basecamp2->projects->list() → list of ProjectsListItem
 *   GET /projects/{id} → $api->basecamp2->projects->get($id) → ProjectsListItem
 *   GET /projects/{id}/metrics → $api->basecamp2->projects->listMetrics($id) →
 *       list of MetricsListItem
 *   GET /projects/{id}/todolists → $api->basecamp2->projects->listTodolists($id) →
 *       list of ProjectsListItem
 *   GET /projects/{id}/todos → $api->basecamp2->projects->listTodos($id) → list of ProjectsListItem
 *   GET /projects/{projectId}/todolists/{todolistId}/todos →
 *       $api->basecamp2->projects->listTodolistsTodos($projectId, $todolistId) →
 *       list of ProjectsListItem
 *   GET /todolists → $api->basecamp2->todolists->list() → list of TodolistsListItem
 *   GET /todolists/{id} → $api->basecamp2->todolists->get($id) → TodolistsListItem
 *   GET /todos → $api->basecamp2->todos->list() → list of TodosListItem
 *   GET /todos-summary → $api->basecamp2->todosSummary->list() → list of TodosSummaryListItem
 *   GET /todos-summary/{id} → $api->basecamp2->todosSummary->get($id) → TodosSummaryListItem
 *   GET /todos/{id} → $api->basecamp2->todos->get($id) → TodosListItem
 *   GET /todos/{id}/comments → $api->basecamp2->todos->listComments($id) → list of TodosListItem
 *   GET /todos/{id}/events → $api->basecamp2->todos->listEvents($id) → list of EventsListItem
 *   GET /todos/{id}/events/{eventNum} → $api->basecamp2->todos->getEvents($id, $eventNum) →
 *       EventsListItem
 *   GET /todos/{id}/metrics → $api->basecamp2->todos->listMetrics($id) → MetricsListItem
 *   GET /todos/{id}/sessions → $api->basecamp2->todos->listSessions($id) →
 *       list of TodosSessionsListItem
 *   POST /todos/{id}/sessions → $api->basecamp2->todos->createSessions($id, $data) →
 *       TodosSessionsListItem
 *   GET /todos/{id}/sessions/{sessionId} → $api->basecamp2->todos->getSessions($id, $sessionId) →
 *       TodosSessionsListItem
 *   PUT /todos/{id}/sessions/{sessionId} →
 *       $api->basecamp2->todos->updateSessions($id, $sessionId, $data) → TodosSessionsListItem
 *   DELETE /todos/{id}/sessions/{sessionId} →
 *       $api->basecamp2->todos->deleteSessions($id, $sessionId) → TodosSessionsListItem
 */
final class Basecamp2Client extends BaseServiceClient
{
    public readonly CommentsResource $comments;
    public readonly EventsResource $events;
    public readonly MetricsResource $metrics;
    public readonly PeopleResource $people;
    public readonly ProjectsResource $projects;
    public readonly TodolistsResource $todolists;
    public readonly TodosResource $todos;
    public readonly TodosSummaryResource $todosSummary;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->comments = new CommentsResource($this->client, $this->baseUrl . '/comments');
        $this->events = new EventsResource($this->client, $this->baseUrl . '/events');
        $this->metrics = new MetricsResource($this->client, $this->baseUrl . '/metrics');
        $this->people = new PeopleResource($this->client, $this->baseUrl . '/people');
        $this->projects = new ProjectsResource($this->client, $this->baseUrl . '/projects');
        $this->todolists = new TodolistsResource($this->client, $this->baseUrl . '/todolists');
        $this->todos = new TodosResource($this->client, $this->baseUrl . '/todos');
        $this->todosSummary = new TodosSummaryResource($this->client, $this->baseUrl . '/todos-summary');
    }

    protected function getServiceName(): string
    {
        return 'basecamp2';
    }
}
