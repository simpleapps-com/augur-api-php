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
     *   id: int
     *   todolistId: int|null
     *   content: string|null
     *   dueAt: string|null
     *   dueOn: string|null
     *   updatedAt: string
     *   createdAt: string
     *   completedAt: string|null
     *   commentsCount: int|null
     *   privateFlag: string|null
     *   trashedFlag: string|null
     *   creatorId: int|null
     *   assigneeId: int|null
     *   completedFlag: string|null
     *   url: string|null
     *   appUrl: string|null
     *   updateCd: int
     *   position: int
     *   projectsId: int
     *   detailJson: string|null
     *   pullDetailCd: int
     *   processCd: int
     *   agrInfoCd: int
     *   statusCd: int
     *   lastCommentAt: string
     *   vector: string|null
     *   vectorCd: int
     *   vectorFlag: string
     *   dateLastVector: string
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
     * Response data type: object
     *   id: int
     *   todolistId: int|null
     *   content: string|null
     *   dueAt: string|null
     *   dueOn: string|null
     *   updatedAt: string
     *   createdAt: string
     *   completedAt: string|null
     *   commentsCount: int|null
     *   privateFlag: string|null
     *   trashedFlag: string|null
     *   creatorId: int|null
     *   assigneeId: int|null
     *   completedFlag: string|null
     *   url: string|null
     *   appUrl: string|null
     *   updateCd: int
     *   position: int
     *   projectsId: int
     *   detailJson: string|null
     *   pullDetailCd: int
     *   processCd: int
     *   agrInfoCd: int
     *   statusCd: int
     *   lastCommentAt: string
     *   vector: string|null
     *   vectorCd: int
     *   vectorFlag: string
     *   dateLastVector: string
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /todos/{id}/comments
     *
     * Response data type: array
     *   id: int
     *   todolistId: int|null
     *   content: string|null
     *   dueAt: string|null
     *   dueOn: string|null
     *   updatedAt: string
     *   createdAt: string
     *   completedAt: string|null
     *   commentsCount: int|null
     *   privateFlag: string|null
     *   trashedFlag: string|null
     *   creatorId: int|null
     *   assigneeId: int|null
     *   completedFlag: string|null
     *   url: string|null
     *   appUrl: string|null
     *   updateCd: int
     *   position: int
     *   projectsId: int
     *   detailJson: string|null
     *   pullDetailCd: int
     *   processCd: int
     *   agrInfoCd: int
     *   statusCd: int
     *   lastCommentAt: string
     *   vector: string|null
     *   vectorCd: int
     *   vectorFlag: string
     *   dateLastVector: string
     *
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
     * Response data type: array
     *   id: int
     *   eventNum: int
     *   eventTypeCd: int
     *   peopleId: int
     *   eventAt: string
     *   commentId: int|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   todosSessionsUid: int|null
     *
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
     * Response data type: object
     *   id: int
     *   eventNum: int
     *   eventTypeCd: int
     *   peopleId: int
     *   eventAt: string
     *   commentId: int|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   todosSessionsUid: int|null
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /todos/{id}/metrics
     *
     * Response data type: object
     *   id: int
     *   projectsId: int|null
     *   todolistId: int|null
     *   assigneeId: int|null
     *   creatorId: int
     *   todosContent: string|null
     *   todosStatusCd: int
     *   isStale: int
     *   hasComments: int
     *   needsResponse: int
     *   createdAt: string
     *   completedAt: string|null
     *   lastActivityAt: string
     *   firstCommentAt: string|null
     *   lastCommentAt: string|null
     *   daysOpen: int|null
     *   daysSinceLastEvent: int|null
     *   daysToFirstComment: int|null
     *   cycleTimeDays: int|null
     *   commentCount: int
     *   activeDaysCount: int
     *   activitySpanDays: int|null
     *   avgDaysBetweenActivity: float|null
     *   lastCommenterId: int|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /todos/{id}/sessions
     *
     * Response data type: array
     *   todosSessionsUid: int
     *   todosId: int
     *   sessionNum: int
     *   sessionStatusCd: int
     *   subject: string|null
     *   problem: string|null
     *   investigation: string|null
     *   plan: string|null
     *   outcome: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
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
     * Response data type: object
     *   todosSessionsUid: int
     *   todosId: int
     *   sessionNum: int
     *   sessionStatusCd: int
     *   subject: string|null
     *   problem: string|null
     *   investigation: string|null
     *   plan: string|null
     *   outcome: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /todos/{id}/sessions/{sessionId}
     *
     * Response data type: object
     *   todosSessionsUid: int
     *   todosId: int
     *   sessionNum: int
     *   sessionStatusCd: int
     *   subject: string|null
     *   problem: string|null
     *   investigation: string|null
     *   plan: string|null
     *   outcome: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /todos/{id}/sessions/{sessionId}
     *
     * Response data type: object
     *   todosSessionsUid: int
     *   todosId: int
     *   sessionNum: int
     *   sessionStatusCd: int
     *   subject: string|null
     *   problem: string|null
     *   investigation: string|null
     *   plan: string|null
     *   outcome: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /todos/{id}/sessions/{sessionId}
     *
     * Response data type: object
     *   todosSessionsUid: int
     *   todosId: int
     *   sessionNum: int
     *   sessionStatusCd: int
     *   subject: string|null
     *   problem: string|null
     *   investigation: string|null
     *   plan: string|null
     *   outcome: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
