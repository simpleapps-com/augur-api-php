<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * roles resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-int
 */
final class RolesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /roles
     *
     * Response data type: array
     * Known fields: rolesUid, roleId, roleName, description, systemFlag, dateCreated, dateLastModified, updateCd, ... (10 total)
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
     * POST /roles
     *
     * Response data type: object
     * Known fields: rolesUid, roleId, roleName, description, systemFlag, dateCreated, dateLastModified, updateCd, ... (10 total)
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
     * DELETE /roles/{rolesUid}
     *
     * Response data type: object
     * Known fields: rolesUid, roleId, roleName, description, systemFlag, dateCreated, dateLastModified, updateCd, ... (10 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $rolesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{rolesUid}',
            ['rolesUid' => (string) $rolesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /roles/{rolesUid}
     *
     * Response data type: object
     * Known fields: rolesUid, roleId, roleName, description, systemFlag, dateCreated, dateLastModified, updateCd, ... (10 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $rolesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{rolesUid}',
            $params,
            ['rolesUid' => (string) $rolesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /roles/{rolesUid}
     *
     * Response data type: object
     * Known fields: rolesUid, roleId, roleName, description, systemFlag, dateCreated, dateLastModified, updateCd, ... (10 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $rolesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{rolesUid}',
            $data,
            ['rolesUid' => (string) $rolesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
