<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Todos resource.
 *
 * @fullPath api.basecamp2.todos
 * @service basecamp2
 * @domain project-management
 */
final class TodosResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List todos.
     *
     * @fullPath api.basecamp2.todos.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/todos', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get todo details.
     *
     * @fullPath api.basecamp2.todos.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/todos/{id}',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * List comments for todo.
     *
     * @fullPath api.basecamp2.todos.getComments
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getComments(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/todos/{id}/comments',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * List events for a todo.
     *
     * @fullPath api.basecamp2.todos.getEvents
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getEvents(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/todos/{id}/events',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get todo metrics detail.
     *
     * @fullPath api.basecamp2.todos.getMetrics
     * @return BaseResponse<array<string, mixed>>
     */
    public function getMetrics(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/todos/{id}/metrics',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * List todo summaries.
     *
     * @fullPath api.basecamp2.todos.listSummaries
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listSummaries(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/todos-summary', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get todo summary details.
     *
     * @fullPath api.basecamp2.todos.getSummary
     * @return BaseResponse<array<string, mixed>>
     */
    public function getSummary(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/todos-summary/{id}',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get a specific event for a todo.
     *
     * @fullPath api.basecamp2.todos.getEvent
     * @return BaseResponse<array<string, mixed>>
     */
    public function getEvent(int $id, int $eventNum): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/todos/{id}/events/{eventNum}',
            [],
            ['id' => (string) $id, 'eventNum' => (string) $eventNum],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * List sessions for a todo.
     *
     * @fullPath api.basecamp2.todos.getSessions
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getSessions(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/todos/{id}/sessions',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get a specific session for a todo.
     *
     * @fullPath api.basecamp2.todos.getSession
     * @return BaseResponse<array<string, mixed>>
     */
    public function getSession(int $id, int $sessionId): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/todos/{id}/sessions/{sessionId}',
            [],
            ['id' => (string) $id, 'sessionId' => (string) $sessionId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create a new session for a todo.
     *
     * @fullPath api.basecamp2.todos.createSession
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createSession(int $id, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/todos/{id}/sessions',
            $data,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($res) => $res);
    }

    /**
     * Update an existing session for a todo.
     *
     * @fullPath api.basecamp2.todos.updateSession
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateSession(int $id, int $sessionId, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/todos/{id}/sessions/{sessionId}',
            $data,
            ['id' => (string) $id, 'sessionId' => (string) $sessionId],
        );

        return BaseResponse::fromArray($response, static fn ($res) => $res);
    }

    /**
     * Delete a session for a todo.
     *
     * @fullPath api.basecamp2.todos.deleteSession
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteSession(int $id, int $sessionId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/todos/{id}/sessions/{sessionId}',
            ['id' => (string) $id, 'sessionId' => (string) $sessionId],
        );

        return BaseResponse::fromArray($response, static fn ($res) => $res);
    }
}
