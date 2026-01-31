<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Transaction user resource.
 *
 * @fullPath api.p21Apis.transUser
 * @service p21-apis
 * @domain user-management
 */
final class TransUserResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Create a new transaction user.
     *
     * @fullPath api.p21Apis.transUser.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/trans-user', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Get transaction user details by user UID.
     *
     * @fullPath api.p21Apis.transUser.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $usersUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/trans-user/{usersUid}',
            $params,
            ['usersUid' => (string) $usersUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Update transaction user by user UID.
     *
     * @fullPath api.p21Apis.transUser.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $usersUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/trans-user/{usersUid}',
            $data,
            ['usersUid' => (string) $usersUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete transaction user by user UID.
     *
     * @fullPath api.p21Apis.transUser.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $usersUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/trans-user/{usersUid}',
            ['usersUid' => (string) $usersUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
