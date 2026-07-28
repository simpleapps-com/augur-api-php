<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * users resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 */
final class UsersResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /users/{userId}/addresses
     *
     * Response data type: array
     * Known fields: userAddressUid, userId, address1, address2, address3, city, state, postalCode, ... (18 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAddresses(int $userId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{userId}/addresses',
            $params,
            ['userId' => (string) $userId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /users/{userId}/addresses
     *
     * Response data type: object
     * Known fields: userAddressUid, userId, address1, address2, address3, city, state, postalCode, ... (18 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAddresses(int $userId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{userId}/addresses',
            $data,
            ['userId' => (string) $userId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /users/{userId}/addresses/{userAddressUid}
     *
     * Response data type: object
     * Known fields: userAddressUid, userId, address1, address2, address3, city, state, postalCode, ... (18 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteAddresses(int $userId, int $userAddressUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{userId}/addresses/{userAddressUid}',
            ['userId' => (string) $userId, 'userAddressUid' => (string) $userAddressUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /users/{userId}/addresses/{userAddressUid}
     *
     * Response data type: object
     * Known fields: userAddressUid, userId, address1, address2, address3, city, state, postalCode, ... (18 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getAddresses(int $userId, int $userAddressUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{userId}/addresses/{userAddressUid}',
            $params,
            ['userId' => (string) $userId, 'userAddressUid' => (string) $userAddressUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /users/{userId}/addresses/{userAddressUid}
     *
     * Response data type: object
     * Known fields: userAddressUid, userId, address1, address2, address3, city, state, postalCode, ... (18 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateAddresses(int $userId, int $userAddressUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{userId}/addresses/{userAddressUid}',
            $data,
            ['userId' => (string) $userId, 'userAddressUid' => (string) $userAddressUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
