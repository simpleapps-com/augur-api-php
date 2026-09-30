<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * projects resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py basecamp2
 */
final class ProjectsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /projects
     *
     * Response data type: array
     *   id: int
     *   name: string|null
     *   description: string|null
     *   updatedAt: string
     *   createdAt: string
     *   lastEventAt: string
     *   url: string|null
     *   appUrl: string|null
     *   templateFlag: string|null
     *   archivedFlag: string|null
     *   starredFlag: string|null
     *   trashedFlag: string|null
     *   draftFlag: string|null
     *   isClientProjectFlag: string|null
     *   color: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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
     * GET /projects/{id}
     *
     * Response data type: object
     *   id: int
     *   name: string|null
     *   description: string|null
     *   updatedAt: string
     *   createdAt: string
     *   lastEventAt: string
     *   url: string|null
     *   appUrl: string|null
     *   templateFlag: string|null
     *   archivedFlag: string|null
     *   starredFlag: string|null
     *   trashedFlag: string|null
     *   draftFlag: string|null
     *   isClientProjectFlag: string|null
     *   color: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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
     * GET /projects/{id}/metrics
     *
     * Response data type: array
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
     * GET /projects/{id}/todolists
     *
     * Response data type: array
     *   id: int
     *   name: string|null
     *   description: string|null
     *   updatedAt: string
     *   createdAt: string
     *   lastEventAt: string
     *   url: string|null
     *   appUrl: string|null
     *   templateFlag: string|null
     *   archivedFlag: string|null
     *   starredFlag: string|null
     *   trashedFlag: string|null
     *   draftFlag: string|null
     *   isClientProjectFlag: string|null
     *   color: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listTodolists(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/todolists',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /projects/{id}/todos
     *
     * Response data type: array
     *   id: int
     *   name: string|null
     *   description: string|null
     *   updatedAt: string
     *   createdAt: string
     *   lastEventAt: string
     *   url: string|null
     *   appUrl: string|null
     *   templateFlag: string|null
     *   archivedFlag: string|null
     *   starredFlag: string|null
     *   trashedFlag: string|null
     *   draftFlag: string|null
     *   isClientProjectFlag: string|null
     *   color: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
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
     * GET /projects/{projectId}/todolists/{todolistId}/todos
     *
     * Response data type: array
     *   id: int
     *   name: string|null
     *   description: string|null
     *   updatedAt: string
     *   createdAt: string
     *   lastEventAt: string
     *   url: string|null
     *   appUrl: string|null
     *   templateFlag: string|null
     *   archivedFlag: string|null
     *   starredFlag: string|null
     *   trashedFlag: string|null
     *   draftFlag: string|null
     *   isClientProjectFlag: string|null
     *   color: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listTodolistsTodos(int $projectId, int $todolistId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{projectId}/todolists/{todolistId}/todos',
            $params,
            ['projectId' => (string) $projectId, 'todolistId' => (string) $todolistId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
