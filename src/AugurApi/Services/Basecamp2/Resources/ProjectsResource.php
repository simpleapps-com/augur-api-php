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
     * Known fields: id, name, description, updatedAt, createdAt, lastEventAt, url, appUrl, ... (18 total)
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
     * GET /projects/{id}
     *
     * Response data type: object
     * Known fields: id, name, description, updatedAt, createdAt, lastEventAt, url, appUrl, ... (18 total)
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
     * GET /projects/{id}/metrics
     *
     * Response data type: array
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
     * GET /projects/{id}/todolists
     *
     * Response data type: array
     * Known fields: id, name, description, updatedAt, createdAt, lastEventAt, url, appUrl, ... (18 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listTodolists(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/todolists',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /projects/{id}/todos
     *
     * Response data type: array
     * Known fields: id, name, description, updatedAt, createdAt, lastEventAt, url, appUrl, ... (18 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listTodos(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/todos',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /projects/{projectId}/todolists/{todolistId}/todos
     *
     * Response data type: array
     * Known fields: id, name, description, updatedAt, createdAt, lastEventAt, url, appUrl, ... (18 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listTodolistsTodos(int $projectId, int $todolistId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{projectId}/todolists/{todolistId}/todos',
            $params,
            ['projectId' => (string) $projectId, 'todolistId' => (string) $todolistId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
