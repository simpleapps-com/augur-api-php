<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Users resource.
 *
 * @fullPath api.joomla.users
 * @service joomla
 * @domain cms
 */
final class UsersResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get user list.
     *
     * @fullPath api.joomla.users.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/users', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get user detail.
     *
     * @fullPath api.joomla.users.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/users/{id}',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get user doc.
     *
     * @fullPath api.joomla.users.getDoc
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/users/{id}/doc',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get trinity user doc.
     *
     * @fullPath api.joomla.users.getTrinity
     * @return BaseResponse<array<string, mixed>>
     */
    public function getTrinity(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/users/{id}/trinity',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create a user.
     *
     * @fullPath api.joomla.users.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/users', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update user.
     *
     * @fullPath api.joomla.users.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $id, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/users/{id}',
            $data,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Block user.
     *
     * @fullPath api.joomla.users.block
     * @return BaseResponse<bool>
     */
    public function block(int $id): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/users/{id}',
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }

    /**
     * Verify the password for a user.
     *
     * @fullPath api.joomla.users.verifyPassword
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function verifyPassword(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/users/verify-password', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * List user groups.
     *
     * @fullPath api.joomla.users.getGroups
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getGroups(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/users/{id}/groups',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get user group.
     *
     * @fullPath api.joomla.users.getGroup
     * @return BaseResponse<array<string, mixed>>
     */
    public function getGroup(int $id, int $groupId): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/users/{id}/groups/{groupId}',
            [],
            ['id' => (string) $id, 'groupId' => (string) $groupId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create/update user group mapping.
     *
     * @fullPath api.joomla.users.updateGroups
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateGroups(int $id, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/users/{id}/groups',
            $data,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
