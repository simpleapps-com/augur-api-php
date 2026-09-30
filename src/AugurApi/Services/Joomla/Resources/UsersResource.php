<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * users resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py joomla
 */
final class UsersResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /users
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /users
     *
     * @param array{username: string, password: string, siteId?: string} $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function create(array $data, array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '',
            $data,
            [],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /users/verify-password
     *
     * Response data type: object
     *   id: int
     *   isVerified: bool
     *   username: string
     *   token: string
     *   email: string
     *
     * @param array{username: string, password: string, siteId?: string} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createVerifyPassword(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/verify-password', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /users/{id}
     *
     * @return BaseResponse<mixed>
     */
    public function delete(int $id): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{id}',
            ['id' => (string) $id],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /users/{id}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /users/{id}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function update(int $id, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{id}',
            $data,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /users/{id}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listDoc(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/doc',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /users/{id}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getDoc(int $id, array $params = []): BaseResponse
    {
        return $this->listDoc($id, $params);
    }

    /**
     * GET /users/{id}/groups
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listGroups(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/groups',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /users/{id}/groups
     *
     * @param array{groupId: int} $data
     * @return BaseResponse<mixed>
     */
    public function createGroups(int $id, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{id}/groups',
            $data,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /users/{id}/groups/{groupId}
     *
     * @return BaseResponse<mixed>
     */
    public function deleteGroups(int $id, int $groupId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{id}/groups/{groupId}',
            ['id' => (string) $id, 'groupId' => (string) $groupId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /users/{id}/groups/{groupId}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getGroups(int $id, int $groupId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/groups/{groupId}',
            $params,
            ['id' => (string) $id, 'groupId' => (string) $groupId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /users/{id}/trinity
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listTrinity(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/trinity',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
