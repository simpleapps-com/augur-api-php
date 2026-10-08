<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * users resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://joomla.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://joomla.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://joomla.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py joomla
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * UsersListItem: A Joomla user with profile values and groups (UsersHelper::generateDocument)
 * Returned by: $api->joomla->users->list()
 * Returned by: $api->joomla->users->listDoc($id)
 *   email: string — Email address
 *   id: int — Joomla user ID
 *   lastResetTime: string — Last password reset (Y-m-d H:i:s)
 *   lastvisitDate: string — Last visit (Y-m-d H:i:s)
 *   name: string — Display name
 *   registerDate: string — Registration date (Y-m-d H:i:s)
 *   username: string — Username
 *   block: int — 1 when the user is blocked
 *   profileValues: array<string, string> — Profile values keyed by profile key; {} when the user
 *       has none
 *     map of string
 *   customerId: string — Prophet 21 customer ID from the profile; empty when unset
 *   contactId: string — Prophet 21 contact ID from the profile; empty when unset
 *   timezone: string — Timezone (America/New_York when unset)
 *   language: string — Language (en-US when unset)
 *   groups: list<UsersListItemGroupsItem> — User groups the user belongs to
 *     each item: UsersListItemGroupsItem — One Joomla user group a user belongs to
 *         (UsergroupsHelper::listByUserId)
 *   shipTo?: list<UsersListItemShipToItem>|null — The contact's ship-tos; present only with
 *       includeShipTo=Y
 *     each item: UsersListItemShipToItem — One ship-to doc, backing an entry of `GET
 *         /api/customer/{customerId}/ship-to`.
 *
 * UsersListItemGroupsItem: One Joomla user group a user belongs to (UsergroupsHelper::listByUserId)
 * Field `groups` of UsersListItem
 * Field `groups` of UsersTrinityListData
 *   id: int — User group ID
 *   title: string — User group title
 *
 * UsersListItemShipToItem: One ship-to doc, backing an entry of `GET
 * /api/customer/{customerId}/ship-to`.
 * Field `shipTo` of UsersListItem
 *   shipToId: float — Prophet 21 ship-to ID (also its address ID)
 *   customerId: float — Prophet 21 customer the ship-to belongs to
 *   companyId: string — Prophet 21 company
 *   defaultBranch: string — Default branch for the ship-to
 *   defaultCarrierId: float|null — Prophet 21 address ID of the default carrier
 *   preferredLocationId: float|null — Prophet 21 location the ship-to prefers to ship from
 *   deliveryInstructions: string|null — Delivery instructions for the carrier
 *   shippingRouteUid: int|null — Shipping route assigned to the ship-to
 *   routeCode: string|null — Shipping route code
 *   routeDescription: string|null — Shipping route description
 *   address: UsersListItemShipToItemAddress|null — The ship-to's address; null when no address row
 *       matches
 *
 * UsersListItemShipToItemAddress: The ship-to's address; null when no address row matches
 * Field `address` of UsersListItemShipToItem
 *   id: float — Prophet 21 address ID
 *   name: string — Address name
 *   mailAddress1: string|null — Mailing address line 1
 *   mailAddress2: string|null — Mailing address line 2
 *   mailAddress3: string|null — Mailing address line 3
 *   mailCity: string|null — Mailing city
 *   mailState: string|null — Mailing state or province
 *   mailPostalCode: string|null — Mailing postal code
 *   mailCountry: string|null — Mailing country
 *   physAddress1: string|null — Physical address line 1
 *   physAddress2: string|null — Physical address line 2
 *   physAddress3: string|null — Physical address line 3
 *   physCity: string|null — Physical city
 *   physState: string|null — Physical state or province
 *   physPostalCode: string|null — Physical postal code
 *   physCountry: string|null — Physical country
 *   class5Id: string|null — Address class 5
 *   centralPhoneNumber: string|null — Main phone number
 *   upsCode: string|null — UPS code for the address
 *
 * UsersCreateData: The user a create call resolved to: the new user, or the existing one with that
 * username
 * Returned by: $api->joomla->users->create($data)
 *   username: string — Username
 *   id: int — Joomla user ID
 *   email: string — Email address
 *   name: string — Display name
 *
 * UsersCreateBody: Create a Joomla user, or return the existing user with this username unchanged
 * Request body of: $api->joomla->users->create($data)
 *   username: string — Username; when it already exists the existing user is returned and nothing
 *       changes
 *   email?: string|null — Email address; required for a new user
 *   name?: string|null — Display name
 *   password?: string|null — Plain-text password, stored as a bcrypt hash
 *   groups?: list<int>|null — User group IDs; Registered is always added
 *   profileValues?: array<string, mixed>|array{}|null — Profile values keyed by profile key (e.g.
 *       simpleweb_customer.simpleweb_customer_id) ([] when empty)
 *
 * UsersVerifyPasswordCreateData: The outcome of a username/password check, with a user JWT when it
 * matched
 * Returned by: $api->joomla->users->createVerifyPassword($data)
 *   id: int — Joomla user ID; 0 when the password did not match
 *   isVerified: bool — True when the password matched
 *   username: string — Username sent
 *   token: string|null — User JWT; null when the password did not match
 *   email: string — Email address; empty when the password did not match
 *   hasCustomerId: bool — True when the user's profile has a Prophet 21 customer ID
 *   hasContactId: bool — True when the user's profile has a Prophet 21 contact ID
 *   hasShipToId: bool — True when the user's profile has a default ship-to
 *
 * UsersVerifyPasswordCreateBody: Check a username and password, and issue a user JWT when they
 * match
 * Request body of: $api->joomla->users->createVerifyPassword($data)
 *   username?: string — Username
 *   password?: string — Plain-text password
 *   siteId?: string|null — Site to check against; honoured only when the caller's site is
 *       augur_info
 *
 * UsersGetData: A Joomla user's account fields, without profile or groups
 * Returned by: $api->joomla->users->get($id)
 *   activation: string — Activation code; empty once activated
 *   email: string — Email address
 *   id: int — Joomla user ID
 *   lastResetTime: string — Last password reset (Y-m-d H:i:s)
 *   lastvisitDate: string — Last visit (Y-m-d H:i:s)
 *   name: string — Display name
 *   registerDate: string — Registration date (Y-m-d H:i:s)
 *   username: string — Username
 *
 * UsersUpdateBody: Partial update of a Joomla user; an absent field keeps its current value
 * Request body of: $api->joomla->users->update($id, $data)
 *   name?: string|null — Display name
 *   email?: string|null — Email address
 *   username?: string|null — Username
 *   password?: string|null — Plain-text password, stored as a bcrypt hash; blank leaves it
 *       unchanged
 *   block?: int|null — 1 to block the user, 0 to unblock; any other value is ignored
 *   groups?: list<int>|null — User group IDs to add (existing memberships are kept)
 *   profileValues?: array<string, mixed>|array{}|null — Profile values to set, keyed by profile key
 *       ([] when empty)
 *
 * UsersGroupsListItem: A user's membership in one group, with the user and group names
 * (UserGroupMapHelper::generateDocument)
 * Returned by: $api->joomla->users->listGroups($id)
 * Returned by: $api->joomla->users->createGroups($id, $data)
 * Returned by: $api->joomla->users->getGroups($id, $groupId)
 *   userId: int — Joomla user ID
 *   username: string — Username
 *   groupId: int — User group ID
 *   title: string — User group title
 *
 * UsersGroupsCreateBody: Add the user in the path to a user group
 * Request body of: $api->joomla->users->createGroups($id, $data)
 *   groupId: int — User group ID to add the user to
 *
 * UsersTrinityListData: A Trinity user's profile, Prophet 21 role, groups, territory and role
 * Returned by: $api->joomla->users->listTrinity($id)
 *   profile: UsersTrinityListDataProfile — Account fields and profile values
 *   groups: list<UsersListItemGroupsItem> — User groups the user belongs to
 *     each item: UsersListItemGroupsItem — One Joomla user group a user belongs to
 *         (UsergroupsHelper::listByUserId)
 *   territory: string — trinitysurfaces, trinitytile, or empty when neither matches
 *   role: string — A&D, contractor, or empty
 *   p21Role?: UsersTrinityListDataP21Role|null — Prophet 21 contact role; the key is absent when
 *       the user has no contact ID
 *
 * UsersTrinityListDataProfile: Account fields and profile values
 * Field `profile` of UsersTrinityListData
 *   id: int — Joomla user ID
 *   name: string — Display name
 *   username: string — Username
 *   email: string — Email address
 *   lastvisitDate: string — Last visit (Y-m-d H:i:s)
 *   registerDate: string — Registration date (Y-m-d H:i:s)
 *   block: int — 1 when the user is blocked
 *   contactId?: int|null — Prophet 21 contact ID; null when blank
 *   customerId?: int|null — Prophet 21 customer ID; null when blank
 *   contractNo?: string|null — Default contract number, as stored
 *   shipTo?: string|null — Default ship-to ID; null when blank
 *   phone?: string|null — Phone; null when blank
 *   title?: string|null — Job title; null when blank
 *   companyName?: string|null — Company name; null when blank
 *   approved?: int|null — 1 when the customer ID is approved; null when blank
 *
 * UsersTrinityListDataP21Role: Prophet 21 contact role; the key is absent when the user has no
 * contact ID
 * Field `p21Role` of UsersTrinityListData
 *   contactRoleUid: int|null — Contact role ID from the Prophet 21 contact
 *   contactRoleId: int|null — Same value as contactRoleUid
 *   contactRoleName: string|null — Contact role name
 *   parentName: string|null — Parent role name
 *   parentGroupId: int|null — Parent Joomla group ID
 *   groupId: int|null — Joomla group ID for the role
 *   id: int — Contact role record ID
 *   address: UsersTrinityListDataP21RoleAddress — The contact's address
 *
 * UsersTrinityListDataP21RoleAddress: The contact's address
 * Field `address` of UsersTrinityListDataP21Role
 *   id: float — Prophet 21 address ID
 *   physAddress1: string|null — Physical address line 1
 *   physAddress2: string|null — Physical address line 2
 *   physCity: string|null — Physical city
 *   physState: string|null — Physical state or province
 *   physPostalCode: string|null — Physical postal code
 *   physCountry: string|null — Physical country
 *   mailAddress1: string|null — Mailing address line 1
 *   mailAddress2: string|null — Mailing address line 2
 *   mailCity: string|null — Mailing city
 *   mailState: string|null — Mailing state or province
 *   mailPostalCode: string|null — Mailing postal code
 *   mailCountry: string|null — Mailing country
 *
 * @phpstan-type UsersListItem array{email: string, id: int, lastResetTime: string, lastvisitDate: string, name: string, registerDate: string, username: string, block: int, profileValues: array<string, string>, customerId: string, contactId: string, timezone: string, language: string, groups: list<UsersListItemGroupsItem>, shipTo?: list<UsersListItemShipToItem>|null}
 * @phpstan-type UsersListItemGroupsItem array{id: int, title: string}
 * @phpstan-type UsersListItemShipToItem array{shipToId: float, customerId: float, companyId: string, defaultBranch: string, defaultCarrierId: float|null, preferredLocationId: float|null, deliveryInstructions: string|null, shippingRouteUid: int|null, routeCode: string|null, routeDescription: string|null, address: UsersListItemShipToItemAddress|null}
 * @phpstan-type UsersListItemShipToItemAddress array{id: float, name: string, mailAddress1: string|null, mailAddress2: string|null, mailAddress3: string|null, mailCity: string|null, mailState: string|null, mailPostalCode: string|null, mailCountry: string|null, physAddress1: string|null, physAddress2: string|null, physAddress3: string|null, physCity: string|null, physState: string|null, physPostalCode: string|null, physCountry: string|null, class5Id: string|null, centralPhoneNumber: string|null, upsCode: string|null}
 * @phpstan-type UsersCreateData array{username: string, id: int, email: string, name: string}
 * @phpstan-type UsersCreateBody array{username: string, email?: string|null, name?: string|null, password?: string|null, groups?: list<int>|null, profileValues?: array<string, mixed>|array{}|null}
 * @phpstan-type UsersVerifyPasswordCreateData array{id: int, isVerified: bool, username: string, token: string|null, email: string, hasCustomerId: bool, hasContactId: bool, hasShipToId: bool}
 * @phpstan-type UsersVerifyPasswordCreateBody array{username?: string, password?: string, siteId?: string|null}
 * @phpstan-type UsersGetData array{activation: string, email: string, id: int, lastResetTime: string, lastvisitDate: string, name: string, registerDate: string, username: string}
 * @phpstan-type UsersUpdateBody array{name?: string|null, email?: string|null, username?: string|null, password?: string|null, block?: int|null, groups?: list<int>|null, profileValues?: array<string, mixed>|array{}|null}
 * @phpstan-type UsersGroupsListItem array{userId: int, username: string, groupId: int, title: string}
 * @phpstan-type UsersGroupsCreateBody array{groupId: int}
 * @phpstan-type UsersTrinityListData array{profile: UsersTrinityListDataProfile, groups: list<UsersListItemGroupsItem>, territory: string, role: string, p21Role?: UsersTrinityListDataP21Role|null}
 * @phpstan-type UsersTrinityListDataProfile array{id: int, name: string, username: string, email: string, lastvisitDate: string, registerDate: string, block: int, contactId?: int|null, customerId?: int|null, contractNo?: string|null, shipTo?: string|null, phone?: string|null, title?: string|null, companyName?: string|null, approved?: int|null}
 * @phpstan-type UsersTrinityListDataP21Role array{contactRoleUid: int|null, contactRoleId: int|null, contactRoleName: string|null, parentName: string|null, parentGroupId: int|null, groupId: int|null, id: int, address: UsersTrinityListDataP21RoleAddress}
 * @phpstan-type UsersTrinityListDataP21RoleAddress array{id: float, physAddress1: string|null, physAddress2: string|null, physCity: string|null, physState: string|null, physPostalCode: string|null, physCountry: string|null, mailAddress1: string|null, mailAddress2: string|null, mailCity: string|null, mailState: string|null, mailPostalCode: string|null, mailCountry: string|null}
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
     * Get User List
     * Call: $api->joomla->users->list()
     *
     * Response data, each item: A Joomla user with profile values and groups
     * (UsersHelper::generateDocument)
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a users column.
     *
     * GET https://joomla.augur-api.com/users
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1users/get
     *
     * Query params ($params; `?` = optional):
     *   accessLevelList?: string — Access level group ID list filter
     *   blocked?: int — Filter by block status (0 active, 1 blocked, -1 all, default 0)
     *   contactId?: string — Contact ID filter
     *   customerId?: int — Customer ID filter
     *   hasContactId?: string — Y = users with a contact ID; N = users with none (missing, empty or
     *       0). Absent = no filter
     *   hasCustomerId?: string — Y = users with a customer ID; N = users with none (missing, empty
     *       or 0). Absent = no filter
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Offset number of results (Default: 0)
     *   orderBy?: string — Order by clause (e.g. id|ASC)
     *   q?: string — Username/name/email search query
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of UsersListItem (fields listed on the class)
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
     * Create a user
     * Call: $api->joomla->users->create($data)
     *
     * Request body: Create a Joomla user, or return the existing user with this username unchanged
     * Response data: The user a create call resolved to: the new user, or the existing one with
     * that username
     *
     * Auth: bearer token; spec scopes: none listed (most endpoints list `public`)
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or username is missing, or email is missing
     *       for a new user.
     *
     * POST https://joomla.augur-api.com/users
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1users/post
     *
     * Request body ($data): UsersCreateBody (fields listed on the class)
     *
     * Response data type: UsersCreateData (fields listed on the class)
     *
     * @param UsersCreateBody $data
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
     * POST /users/verify-password
     *
     * Verify the password for a user
     * Call: $api->joomla->users->createVerifyPassword($data)
     *
     * Request body: Check a username and password, and issue a user JWT when they match
     * Response data: The outcome of a username/password check, with a user JWT when it matched
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://joomla.augur-api.com/users/verify-password
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1users~1verify-password/post
     *
     * Request body ($data): UsersVerifyPasswordCreateBody (fields listed on the class)
     *
     * Response data type: UsersVerifyPasswordCreateData (fields listed on the class)
     *
     * @param UsersVerifyPasswordCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createVerifyPassword(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/verify-password', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /users/{id}
     *
     * BLOCK user
     * Call: $api->joomla->users->delete($id)
     *
     * Errors:
     *   404: No user with this ID.
     *
     * DELETE https://joomla.augur-api.com/users/{id}
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1users~1{id}/delete
     *
     * Response data type: bool
     *
     * @param int $id users.id
     * @return BaseResponse<bool>
     */
    public function delete(int $id): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{id}',
            ['id' => (string) $id],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /users/{id}
     *
     * Get User Detail
     * Call: $api->joomla->users->get($id)
     *
     * Response data: A Joomla user's account fields, without profile or groups
     *
     * Errors:
     *   404: No user with this ID.
     *
     * GET https://joomla.augur-api.com/users/{id}
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1users~1{id}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: UsersGetData (fields listed on the class)
     *
     * @param int $id users.id
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /users/{id}
     *
     * Update user
     * Call: $api->joomla->users->update($id, $data)
     *
     * Request body: Partial update of a Joomla user; an absent field keeps its current value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No user with this ID.
     *
     * PUT https://joomla.augur-api.com/users/{id}
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1users~1{id}/put
     *
     * Request body ($data): UsersUpdateBody (fields listed on the class)
     *
     * Response data type: bool
     *
     * @param int $id users.id
     * @param UsersUpdateBody $data
     * @return BaseResponse<bool>
     */
    public function update(int $id, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{id}',
            $data,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /users/{id}/doc
     *
     * Get User Doc
     * Call: $api->joomla->users->listDoc($id)
     *
     * Response data: A Joomla user with profile values and groups (UsersHelper::generateDocument)
     *
     * Errors:
     *   404: No user with this ID.
     *
     * GET https://joomla.augur-api.com/users/{id}/doc
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1users~1{id}~1doc/get
     *
     * Query params ($params; `?` = optional):
     *   includeShipTo?: string — Include ship-to header data in response
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: UsersListItem (fields listed on the class)
     *
     * @param int $id users.id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDoc(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/doc',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /users/{id}/doc
     * Call: $api->joomla->users->getDoc($id)
     *
     * @param int $id users.id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $id, array $params = []): BaseResponse
    {
        return $this->listDoc($id, $params);
    }

    /**
     * GET /users/{id}/groups
     *
     * List User Groups
     * Call: $api->joomla->users->listGroups($id)
     *
     * Response data, each item: A user's membership in one group, with the user and group names
     * (UserGroupMapHelper::generateDocument)
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a user_group_map column.
     *   404: No user with this ID.
     *
     * GET https://joomla.augur-api.com/users/{id}/groups
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1users~1{id}~1groups/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: group_id|ASC)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of UsersGroupsListItem (fields listed on the class)
     *
     * @param int $id users.id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listGroups(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/groups',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /users/{id}/groups
     *
     * Create/update User Group Mapping
     * Call: $api->joomla->users->createGroups($id, $data)
     *
     * Request body: Add the user in the path to a user group
     * Response data: A user's membership in one group, with the user and group names
     * (UserGroupMapHelper::generateDocument)
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or groupId is missing.
     *   404: No user or group with these IDs.
     *
     * POST https://joomla.augur-api.com/users/{id}/groups
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1users~1{id}~1groups/post
     *
     * Request body ($data): UsersGroupsCreateBody (fields listed on the class)
     *
     * Response data type: UsersGroupsListItem (fields listed on the class)
     *
     * @param int $id users.id
     * @param UsersGroupsCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createGroups(int $id, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{id}/groups',
            $data,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /users/{id}/groups/{groupId}
     *
     * Remove User Group
     * Call: $api->joomla->users->deleteGroups($id, $groupId)
     *
     * Remove a user from a group (hard delete of the user_usergroup_map row)
     *
     * Errors:
     *   404: The user is not in this group.
     *
     * DELETE https://joomla.augur-api.com/users/{id}/groups/{groupId}
     * Contract:
     * https://joomla.augur-api.com/openapi.json#/paths/~1users~1{id}~1groups~1{groupId}/delete
     *
     * Response data type: bool
     *
     * @param int $id users.id
     * @param int $groupId usergroups.id
     * @return BaseResponse<bool>
     */
    public function deleteGroups(int $id, int $groupId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{id}/groups/{groupId}',
            ['id' => (string) $id, 'groupId' => (string) $groupId],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /users/{id}/groups/{groupId}
     *
     * get User Group
     * Call: $api->joomla->users->getGroups($id, $groupId)
     *
     * Response data: A user's membership in one group, with the user and group names
     * (UserGroupMapHelper::generateDocument)
     *
     * Errors:
     *   404: The user is not in this group.
     *
     * GET https://joomla.augur-api.com/users/{id}/groups/{groupId}
     * Contract:
     * https://joomla.augur-api.com/openapi.json#/paths/~1users~1{id}~1groups~1{groupId}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: UsersGroupsListItem (fields listed on the class)
     *
     * @param int $id users.id
     * @param int $groupId usergroups.id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getGroups(int $id, int $groupId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/groups/{groupId}',
            $params,
            ['id' => (string) $id, 'groupId' => (string) $groupId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /users/{id}/trinity
     *
     * Get Trinity User Doc
     * Call: $api->joomla->users->listTrinity($id)
     *
     * Response data: A Trinity user's profile, Prophet 21 role, groups, territory and role
     *
     * Errors:
     *   404: No user with this ID.
     *
     * GET https://joomla.augur-api.com/users/{id}/trinity
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1users~1{id}~1trinity/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: UsersTrinityListData (fields listed on the class)
     *
     * @param int $id users.id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listTrinity(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/trinity',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
