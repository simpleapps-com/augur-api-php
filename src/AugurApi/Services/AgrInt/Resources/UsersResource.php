<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * users resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-int
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
     * Response data type: array
     * Known fields: usersUid, username, password, name, email, phoneNumber, dateCreated, dateLastModified, ... (11 total)
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
     * POST /users
     *
     * Response data type: object
     * Known fields: usersUid, username, password, name, email, phoneNumber, dateCreated, dateLastModified, ... (11 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /users/rotate
     *
     * Response data type: object
     * Known fields: usersUid, username, token
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createRotate(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/rotate', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /users/validate
     *
     * Response data type: object
     * Known fields: valid, scope, userId, username, email, name
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createValidate(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/validate', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /users/verify
     *
     * Response data type: object
     * Known fields: usersUid, username, token
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createVerify(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/verify', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /users/{usersUid}
     *
     * Response data type: object
     * Known fields: usersUid, username, password, name, email, phoneNumber, dateCreated, dateLastModified, ... (11 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $usersUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{usersUid}',
            ['usersUid' => (string) $usersUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /users/{usersUid}
     *
     * Response data type: object
     * Known fields: usersUid, username, password, name, email, phoneNumber, dateCreated, dateLastModified, ... (11 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $usersUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersUid}',
            $params,
            ['usersUid' => (string) $usersUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /users/{usersUid}
     *
     * Response data type: object
     * Known fields: usersUid, username, password, name, email, phoneNumber, dateCreated, dateLastModified, ... (11 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $usersUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{usersUid}',
            $data,
            ['usersUid' => (string) $usersUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /users/{usersUid}/roles
     *
     * Response data type: array
     * Known fields: usersXRolesUid, usersUid, rolesUid, dateCreated, dateLastModified, updateCd, statusCd, processCd
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listRoles(int $usersUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersUid}/roles',
            $params,
            ['usersUid' => (string) $usersUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /users/{usersUid}/roles
     *
     * Response data type: object
     * Known fields: usersXRolesUid, usersUid, rolesUid, dateCreated, dateLastModified, updateCd, statusCd, processCd
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createRoles(int $usersUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{usersUid}/roles',
            $data,
            ['usersUid' => (string) $usersUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /users/{usersUid}/roles/{usersXRolesUid}
     *
     * Response data type: object
     * Known fields: usersXRolesUid, usersUid, rolesUid, dateCreated, dateLastModified, updateCd, statusCd, processCd
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteRoles(int $usersUid, int $usersXRolesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{usersUid}/roles/{usersXRolesUid}',
            ['usersUid' => (string) $usersUid, 'usersXRolesUid' => (string) $usersXRolesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /users/{usersUid}/roles/{usersXRolesUid}
     *
     * Response data type: object
     * Known fields: usersXRolesUid, usersUid, rolesUid, dateCreated, dateLastModified, updateCd, statusCd, processCd
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getRoles(int $usersUid, int $usersXRolesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersUid}/roles/{usersXRolesUid}',
            $params,
            ['usersUid' => (string) $usersUid, 'usersXRolesUid' => (string) $usersXRolesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /users/{usersUid}/roles/{usersXRolesUid}
     *
     * Response data type: object
     * Known fields: usersXRolesUid, usersUid, rolesUid, dateCreated, dateLastModified, updateCd, statusCd, processCd
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateRoles(int $usersUid, int $usersXRolesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{usersUid}/roles/{usersXRolesUid}',
            $data,
            ['usersUid' => (string) $usersUid, 'usersXRolesUid' => (string) $usersXRolesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
