<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * todos resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py basecamp2
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
     * Response data type: array
     * Known fields: id, todolistId, content, dueAt, dueOn, updatedAt, createdAt, completedAt, ... (29 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /todos/{id}
     *
     * Response data type: object
     * Known fields: id, todolistId, content, dueAt, dueOn, updatedAt, createdAt, completedAt, ... (29 total)
     *
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /todos/{id}/comments
     *
     * Response data type: array
     * Known fields: id, todolistId, content, dueAt, dueOn, updatedAt, createdAt, completedAt, ... (29 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listComments(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/comments',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /todos/{id}/events
     *
     * Response data type: array
     * Known fields: id, eventNum, eventTypeCd, peopleId, eventAt, commentId, dateCreated, dateLastModified, ... (12 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listEvents(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/events',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /todos/{id}/events/{eventNum}
     *
     * Response data type: object
     * Known fields: id, eventNum, eventTypeCd, peopleId, eventAt, commentId, dateCreated, dateLastModified, ... (12 total)
     *
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /todos/{id}/metrics
     *
     * Response data type: object
     * Known fields: id, projectsId, todolistId, assigneeId, creatorId, todosContent, todosStatusCd, isStale, ... (29 total)
     *
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /todos/{id}/sessions
     *
     * Response data type: array
     * Known fields: todosSessionsUid, todosId, sessionNum, sessionStatusCd, subject, problem, investigation, plan, ... (14 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listSessions(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/sessions',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /todos/{id}/sessions
     *
     * Response data type: object
     * Known fields: todosSessionsUid, todosId, sessionNum, sessionStatusCd, subject, problem, investigation, plan, ... (14 total)
     *
     * @param array<string, mixed> $data
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /todos/{id}/sessions/{sessionId}
     *
     * Response data type: object
     * Known fields: todosSessionsUid, todosId, sessionNum, sessionStatusCd, subject, problem, investigation, plan, ... (14 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteSessions(int $id, int $sessionId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{id}/sessions/{sessionId}',
            ['id' => (string) $id, 'sessionId' => (string) $sessionId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /todos/{id}/sessions/{sessionId}
     *
     * Response data type: object
     * Known fields: todosSessionsUid, todosId, sessionNum, sessionStatusCd, subject, problem, investigation, plan, ... (14 total)
     *
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /todos/{id}/sessions/{sessionId}
     *
     * Response data type: object
     * Known fields: todosSessionsUid, todosId, sessionNum, sessionStatusCd, subject, problem, investigation, plan, ... (14 total)
     *
     * @param array<string, mixed> $data
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
