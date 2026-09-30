<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * people resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py basecamp2
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
     * Response data type: array
     *   id: int
     *   identityId: int|null
     *   name: string|null
     *   emailAddress: string|null
     *   adminFlag: string|null
     *   trashedFlag: string|null
     *   updatedAt: string
     *   createdAt: string
     *   url: string|null
     *   appUrl: string|null
     *   avatarUrl: string|null
     *   fullsizeAvatarUrl: string|null
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
     * GET /people/{id}
     *
     * Response data type: object
     *   id: int
     *   identityId: int|null
     *   name: string|null
     *   emailAddress: string|null
     *   adminFlag: string|null
     *   trashedFlag: string|null
     *   updatedAt: string
     *   createdAt: string
     *   url: string|null
     *   appUrl: string|null
     *   avatarUrl: string|null
     *   fullsizeAvatarUrl: string|null
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
     * GET /people/{id}/metrics
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
     * GET /people/{id}/todos
     *
     * Response data type: array
     *   id: int
     *   identityId: int|null
     *   name: string|null
     *   emailAddress: string|null
     *   adminFlag: string|null
     *   trashedFlag: string|null
     *   updatedAt: string
     *   createdAt: string
     *   url: string|null
     *   appUrl: string|null
     *   avatarUrl: string|null
     *   fullsizeAvatarUrl: string|null
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
     * GET /people/{personId}/projects/{projectId}/todos
     *
     * Response data type: array
     *   id: int
     *   identityId: int|null
     *   name: string|null
     *   emailAddress: string|null
     *   adminFlag: string|null
     *   trashedFlag: string|null
     *   updatedAt: string
     *   createdAt: string
     *   url: string|null
     *   appUrl: string|null
     *   avatarUrl: string|null
     *   fullsizeAvatarUrl: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
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
