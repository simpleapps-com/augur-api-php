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
     * Known fields: id, identityId, name, emailAddress, adminFlag, trashedFlag, updatedAt, createdAt, ... (15 total)
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
     * GET /people/{id}
     *
     * Response data type: object
     * Known fields: id, identityId, name, emailAddress, adminFlag, trashedFlag, updatedAt, createdAt, ... (15 total)
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
     * GET /people/{id}/metrics
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
     * GET /people/{id}/todos
     *
     * Response data type: array
     * Known fields: id, identityId, name, emailAddress, adminFlag, trashedFlag, updatedAt, createdAt, ... (15 total)
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
     * GET /people/{personId}/projects/{projectId}/todos
     *
     * Response data type: array
     * Known fields: id, identityId, name, emailAddress, adminFlag, trashedFlag, updatedAt, createdAt, ... (15 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listProjectsTodos(int $personId, int $projectId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{personId}/projects/{projectId}/todos',
            $params,
            ['personId' => (string) $personId, 'projectId' => (string) $projectId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
