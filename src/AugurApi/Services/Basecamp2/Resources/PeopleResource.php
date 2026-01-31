<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * People resource.
 *
 * @fullPath api.basecamp2.people
 * @service basecamp2
 * @domain project-management
 */
final class PeopleResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List people with filters.
     *
     * @fullPath api.basecamp2.people.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/people', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get person by ID.
     *
     * @fullPath api.basecamp2.people.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/people/{id}',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * List todos for person.
     *
     * @fullPath api.basecamp2.people.getTodos
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getTodos(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/people/{id}/todos',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * List todos for person on project.
     *
     * @fullPath api.basecamp2.people.getProjectTodos
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getProjectTodos(int $personId, int $projectId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/people/{personId}/projects/{projectId}/todos',
            $params,
            ['personId' => (string) $personId, 'projectId' => (string) $projectId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * List todo metrics by person.
     *
     * @fullPath api.basecamp2.people.getMetrics
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getMetrics(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/people/{id}/metrics',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
