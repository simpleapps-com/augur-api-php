<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Projects resource.
 *
 * @fullPath api.basecamp2.projects
 * @service basecamp2
 * @domain project-management
 */
final class ProjectsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List projects.
     *
     * @fullPath api.basecamp2.projects.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/projects', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get project by ID.
     *
     * @fullPath api.basecamp2.projects.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/projects/{id}',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * List todos for project.
     *
     * @fullPath api.basecamp2.projects.getTodos
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getTodos(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/projects/{id}/todos',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * List todo metrics by project.
     *
     * @fullPath api.basecamp2.projects.getMetrics
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getMetrics(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/projects/{id}/metrics',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * List todolists for a project.
     *
     * @fullPath api.basecamp2.projects.getTodolists
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getTodolists(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/projects/{id}/todolists',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * List todos for a specific todolist within a project.
     *
     * @fullPath api.basecamp2.projects.getTodolistTodos
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getTodolistTodos(int $projectId, int $todolistId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/projects/{projectId}/todolists/{todolistId}/todos',
            $params,
            ['projectId' => (string) $projectId, 'todolistId' => (string) $todolistId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
