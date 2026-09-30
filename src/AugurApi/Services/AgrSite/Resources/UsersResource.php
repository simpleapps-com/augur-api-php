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
     *   userAddressUid: int
     *   userId: int
     *   address1: string|null
     *   address2: string|null
     *   address3: string|null
     *   city: string|null
     *   state: string|null
     *   postalCode: string|null
     *   country: string|null
     *   emailAddress: string|null
     *   name: string|null
     *   phoneNumberMain: string|null
     *   phoneNumberMobile: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listAddresses(int $userId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{userId}/addresses',
            $params,
            ['userId' => (string) $userId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /users/{userId}/addresses
     *
     * Response data type: object
     *   userAddressUid: int
     *   userId: int
     *   address1: string|null
     *   address2: string|null
     *   address3: string|null
     *   city: string|null
     *   state: string|null
     *   postalCode: string|null
     *   country: string|null
     *   emailAddress: string|null
     *   name: string|null
     *   phoneNumberMain: string|null
     *   phoneNumberMobile: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /users/{userId}/addresses/{userAddressUid}
     *
     * Response data type: object
     *   userAddressUid: int
     *   userId: int
     *   address1: string|null
     *   address2: string|null
     *   address3: string|null
     *   city: string|null
     *   state: string|null
     *   postalCode: string|null
     *   country: string|null
     *   emailAddress: string|null
     *   name: string|null
     *   phoneNumberMain: string|null
     *   phoneNumberMobile: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /users/{userId}/addresses/{userAddressUid}
     *
     * Response data type: object
     *   userAddressUid: int
     *   userId: int
     *   address1: string|null
     *   address2: string|null
     *   address3: string|null
     *   city: string|null
     *   state: string|null
     *   postalCode: string|null
     *   country: string|null
     *   emailAddress: string|null
     *   name: string|null
     *   phoneNumberMain: string|null
     *   phoneNumberMobile: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /users/{userId}/addresses/{userAddressUid}
     *
     * Response data type: object
     *   userAddressUid: int
     *   userId: int
     *   address1: string|null
     *   address2: string|null
     *   address3: string|null
     *   city: string|null
     *   state: string|null
     *   postalCode: string|null
     *   country: string|null
     *   emailAddress: string|null
     *   name: string|null
     *   phoneNumberMain: string|null
     *   phoneNumberMobile: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
