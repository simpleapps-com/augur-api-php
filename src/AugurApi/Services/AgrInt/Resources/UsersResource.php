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
     *   usersUid: int
     *   username: string
     *   name: string|null
     *   email: string
     *   phoneNumber: string|null
     *   dateCreated: string
     *   dateLastModified: string
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
     * POST /users
     *
     * Response data type: object
     *   usersUid: int
     *   username: string
     *   name: string|null
     *   email: string
     *   phoneNumber: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{username: string, password: string, email: string, name?: string|null, phoneNumber?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /users/rotate
     *
     * Response data type: object
     *   usersUid: int
     *   username: string
     *   token?: string
     *
     * @param array{token: string} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createRotate(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/rotate', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /users/validate
     *
     * Response data type: object
     *   valid?: bool
     *   scope?: string
     *   userId?: int
     *   username?: string
     *   email?: string
     *   name?: string
     *   roles?: list<string>
     *   bundles?: list<string>
     *   resources?: list<string>
     *
     * @param array{token: string} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createValidate(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/validate', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /users/verify
     *
     * Response data type: object
     *   usersUid: int
     *   username: string
     *   token?: string
     *
     * @param array{siteId: string, username: string, password: string} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createVerify(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/verify', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /users/{usersUid}
     *
     * Response data type: object
     *   usersUid: int
     *   username: string
     *   name: string|null
     *   email: string
     *   phoneNumber: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /users/{usersUid}
     *
     * Response data type: object
     *   usersUid: int
     *   username: string
     *   name: string|null
     *   email: string
     *   phoneNumber: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /users/{usersUid}
     *
     * Response data type: object
     *   usersUid: int
     *   username: string
     *   name: string|null
     *   email: string
     *   phoneNumber: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{username?: string|null, password?: string|null, name?: string|null, email?: string|null, phoneNumber?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null} $data
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /users/{usersUid}/roles
     *
     * Response data type: array
     *   usersXRolesUid: int
     *   usersUid: int
     *   rolesUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listRoles(int $usersUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersUid}/roles',
            $params,
            ['usersUid' => (string) $usersUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /users/{usersUid}/roles
     *
     * Response data type: object
     *   usersXRolesUid: int
     *   usersUid: int
     *   rolesUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{rolesUid: int} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createRoles(int $usersUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{usersUid}/roles',
            $data,
            ['usersUid' => (string) $usersUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /users/{usersUid}/roles/{usersXRolesUid}
     *
     * Response data type: object
     *   usersXRolesUid: int
     *   usersUid: int
     *   rolesUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /users/{usersUid}/roles/{usersXRolesUid}
     *
     * Response data type: object
     *   usersXRolesUid: int
     *   usersUid: int
     *   rolesUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /users/{usersUid}/roles/{usersXRolesUid}
     *
     * Response data type: object
     *   usersXRolesUid: int
     *   usersUid: int
     *   rolesUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{statusCd?: int|null, processCd?: int|null} $data
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
