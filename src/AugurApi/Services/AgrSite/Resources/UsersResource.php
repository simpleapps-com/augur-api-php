<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * users resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-site.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-site.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-site.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * UsersAddressesListItem:
 * Returned by: $api->agrSite->users->listAddresses($userId)
 * Returned by: $api->agrSite->users->createAddresses($userId, $data)
 * Returned by: $api->agrSite->users->getAddresses($userId, $userAddressUid)
 * Returned by: $api->agrSite->users->updateAddresses($userId, $userAddressUid, $data)
 * Returned by: $api->agrSite->users->deleteAddresses($userId, $userAddressUid)
 *   userAddressUid: int — User address ID
 *   userId: int — Joomla user the address belongs to
 *   address1: string|null — Address line 1 (max 50 chars)
 *   address2: string|null — Address line 2 (max 50 chars)
 *   address3: string|null — Address line 3 (max 50 chars)
 *   city: string|null — City (max 50 chars)
 *   state: string|null — State or province (max 50 chars)
 *   postalCode: string|null — Postal code (max 10 chars)
 *   country: string|null — Country (max 50 chars)
 *   emailAddress: string|null — Email address (max 255 chars)
 *   name: string|null — Name on the address (max 255 chars)
 *   phoneNumberMain: string|null — Main phone number (max 20 chars)
 *   phoneNumberMobile: string|null — Mobile phone number (max 20 chars)
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * UsersAddressesCreateBody: Add an address for the user in the path
 * Request body of: $api->agrSite->users->createAddresses($userId, $data)
 *   address1?: string|null — Address line 1
 *   address2?: string|null — Address line 2
 *   address3?: string|null — Address line 3
 *   city?: string|null — City
 *   state?: string|null — State or province
 *   postalCode?: string|null — Postal code
 *   country?: string|null — Country
 *   emailAddress?: string|null — Email address
 *   name?: string|null — Name on the address
 *   phoneNumberMain?: string|null — Main phone number
 *   phoneNumberMobile?: string|null — Mobile phone number
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted) (Default: 704)
 *   processCd?: int|null — Process code (704 = Active, 1185 = Import Complete) (Default: 704)
 *   updateCd?: int|null — Update code (1185 = Import Complete) (Default: 1185)
 *
 * UsersAddressesUpdateBody: Partial update of a user address; an absent field keeps its current
 * value
 * Request body of: $api->agrSite->users->updateAddresses($userId, $userAddressUid, $data)
 *   address1?: string|null — Address line 1
 *   address2?: string|null — Address line 2
 *   address3?: string|null — Address line 3
 *   city?: string|null — City
 *   state?: string|null — State or province
 *   postalCode?: string|null — Postal code
 *   country?: string|null — Country
 *   emailAddress?: string|null — Email address
 *   name?: string|null — Name on the address
 *   phoneNumberMain?: string|null — Main phone number
 *   phoneNumberMobile?: string|null — Mobile phone number
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code (704 = Active, 1185 = Import Complete)
 *
 * @phpstan-type UsersAddressesListItem array{userAddressUid: int, userId: int, address1: string|null, address2: string|null, address3: string|null, city: string|null, state: string|null, postalCode: string|null, country: string|null, emailAddress: string|null, name: string|null, phoneNumberMain: string|null, phoneNumberMobile: string|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type UsersAddressesCreateBody array{address1?: string|null, address2?: string|null, address3?: string|null, city?: string|null, state?: string|null, postalCode?: string|null, country?: string|null, emailAddress?: string|null, name?: string|null, phoneNumberMain?: string|null, phoneNumberMobile?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type UsersAddressesUpdateBody array{address1?: string|null, address2?: string|null, address3?: string|null, city?: string|null, state?: string|null, postalCode?: string|null, country?: string|null, emailAddress?: string|null, name?: string|null, phoneNumberMain?: string|null, phoneNumberMobile?: string|null, statusCd?: int|null, processCd?: int|null}
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
     * List user addresses
     * Call: $api->agrSite->users->listAddresses($userId)
     *
     * List a user's saved addresses
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a user_address column.
     *   404: No Joomla user with this userId.
     *
     * GET https://agr-site.augur-api.com/users/{userId}/addresses
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1users~1{userId}~1addresses/get
     *
     * Query params ($params; `?` = optional):
     *   emailAddress?: string — Filter by email_address
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: user_address_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of UsersAddressesListItem (fields listed on the class)
     *
     * @param int $userId Joomla user the addresses belong to
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
     * Create a new user_address row
     * Call: $api->agrSite->users->createAddresses($userId, $data)
     *
     * Request body: Add an address for the user in the path
     *
     * Errors:
     *   400: userId is 0 or negative.
     *   404: No Joomla user with this userId.
     *
     * POST https://agr-site.augur-api.com/users/{userId}/addresses
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1users~1{userId}~1addresses/post
     *
     * Request body ($data): UsersAddressesCreateBody (fields listed on the class)
     *
     * Response data type: UsersAddressesListItem (fields listed on the class)
     *
     * @param int $userId Joomla user the addresses belong to
     * @param UsersAddressesCreateBody $data
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
     * Soft-delete a user_address row
     * Call: $api->agrSite->users->deleteAddresses($userId, $userAddressUid)
     *
     * Errors:
     *   400: userId or userAddressUid is 0 or negative.
     *   404: No user address with this ID.
     *
     * DELETE https://agr-site.augur-api.com/users/{userId}/addresses/{userAddressUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1users~1{userId}~1addresses~1{userAddressUid}/delete
     *
     * Response data type: UsersAddressesListItem (fields listed on the class)
     *
     * @param int $userId Joomla user the addresses belong to
     * @param int $userAddressUid User address ID
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
     * Get a user_address
     * Call: $api->agrSite->users->getAddresses($userId, $userAddressUid)
     *
     * Get a user_address row by UID
     *
     * Errors:
     *   400: userId or userAddressUid is 0 or negative.
     *   404: No user address with this ID.
     *
     * GET https://agr-site.augur-api.com/users/{userId}/addresses/{userAddressUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1users~1{userId}~1addresses~1{userAddressUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: UsersAddressesListItem (fields listed on the class)
     *
     * @param int $userId Joomla user the addresses belong to
     * @param int $userAddressUid User address ID
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
     * Update a user_address row
     * Call: $api->agrSite->users->updateAddresses($userId, $userAddressUid, $data)
     *
     * Request body: Partial update of a user address; an absent field keeps its current value
     *
     * Errors:
     *   400: userId or userAddressUid is 0 or negative.
     *   404: No user address with this ID.
     *
     * PUT https://agr-site.augur-api.com/users/{userId}/addresses/{userAddressUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1users~1{userId}~1addresses~1{userAddressUid}/put
     *
     * Request body ($data): UsersAddressesUpdateBody (fields listed on the class)
     *
     * Response data type: UsersAddressesListItem (fields listed on the class)
     *
     * @param int $userId Joomla user the addresses belong to
     * @param int $userAddressUid User address ID
     * @param UsersAddressesUpdateBody $data
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
