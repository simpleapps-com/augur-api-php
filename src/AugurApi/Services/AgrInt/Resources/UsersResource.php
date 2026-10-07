<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * users resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-int.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-int.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-int.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-int
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * UsersListItem:
 * Returned by: $api->agrInt->users->list()
 * Returned by: $api->agrInt->users->create($data)
 * Returned by: $api->agrInt->users->get($usersUid)
 * Returned by: $api->agrInt->users->update($usersUid, $data)
 * Returned by: $api->agrInt->users->delete($usersUid)
 *   usersUid: int — User unique ID
 *   username: string — Login name, unique per site (max 255 chars)
 *   name: string|null — Display name (max 255 chars)
 *   email: string — Email address, unique per site (max 255 chars)
 *   phoneNumber: string|null — Contact phone number (max 20 chars)
 *   dateCreated: string — When the row was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the row was last modified (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code: 1185 = Import Complete, 704 = needs processing
 *   statusCd: int — Status code: 704 = Active, 705 = Inactive, 700 = Deleted
 *   processCd: int — Process code: 704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete
 *
 * UsersCreateBody: Create an agr_int user; the password is hashed with Argon2id and never returned
 * Request body of: $api->agrInt->users->create($data)
 *   username: string — Login name, unique per site
 *   password: string — Plaintext password; hashed before it is stored
 *   email: string — Email address, unique per site
 *   name?: string|null — Display name
 *   phoneNumber?: string|null — Contact phone number
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted); defaults to
 *       704
 *   processCd?: int|null — Process code; defaults to 704 (Active)
 *   updateCd?: int|null — Update code; defaults to 1185 (Import Complete)
 *
 * UsersRotateCreateData: Minimal identity returned by POST /api/users/verify on a successful
 * Returned by: $api->agrInt->users->createRotate($data)
 * Returned by: $api->agrInt->users->createVerify($data)
 *   usersUid: int — agr_int user unique ID; 0 means verification failed
 *   username: string — Username; '' on failure
 *   token: string — Signed access JWT (scope agr-int-user) to present as a bearer; '' on failure
 *
 * UsersRotateCreateBody: Exchange a current, still-valid agr_int user token for a fresh one
 * Request body of: $api->agrInt->users->createRotate($data)
 *   token?: string — The current agr_int user JWT to exchange; its client_id claim selects the
 *       site, and a missing token is rejected as invalid
 *
 * UsersValidateCreateData: Result of validating a presented agr_int user token.
 * Returned by: $api->agrInt->users->createValidate($data)
 *   valid: bool — True only when the token verifies, has scope agr-int-user, and its user is ACTIVE
 *   scope: string — Token scope; consumers MUST authorize on this, not on userId
 *   userId: int — agr_int user unique ID (users_uid)
 *   username: string — Username, refreshed from the user row
 *   email: string — Email address, refreshed from the user row
 *   name: string — Display name, refreshed from the user row
 *   roles: list<string> — Active role ids the user holds
 *   bundles: list<string> — Active bundle ids granted through those roles
 *   resources: list<string> — P21 table set (resources.resource_path) the user may query
 *
 * UsersValidateCreateBody: Introspect an agr_int user access token
 * Request body of: $api->agrInt->users->createValidate($data)
 *   token: string — The agr_int user JWT to introspect; a missing token introspects as invalid
 *
 * UsersVerifyCreateBody: Verify a user's username and password on a target site
 * Request body of: $api->agrInt->users->createVerify($data)
 *   siteId?: string — Target site; blank or augur_info targets augur_info itself
 *   username?: string — The user's username
 *   password?: string — The user's cleartext password, verified against the stored Argon2id hash;
 *       never logged, never echoed back
 *
 * UsersUpdateBody: Partial update of an agr_int user; an absent field keeps its current value
 * Request body of: $api->agrInt->users->update($usersUid, $data)
 *   username?: string|null — New login name; blank is ignored
 *   password?: string|null — New plaintext password, re-hashed with Argon2id; blank is ignored
 *   name?: string|null — New display name; blank clears it
 *   email?: string|null — New email address; blank is ignored
 *   phoneNumber?: string|null — New phone number; blank clears it
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code
 *   updateCd?: int|null — Update code
 *
 * UsersRolesListItem:
 * Returned by: $api->agrInt->users->listRoles($usersUid)
 * Returned by: $api->agrInt->users->createRoles($usersUid, $data)
 * Returned by: $api->agrInt->users->getRoles($usersUid, $usersXRolesUid)
 * Returned by: $api->agrInt->users->updateRoles($usersUid, $usersXRolesUid, $data)
 * Returned by: $api->agrInt->users->deleteRoles($usersUid, $usersXRolesUid)
 *   usersXRolesUid: int — User-role membership unique ID
 *   usersUid: int — User that holds the role
 *   rolesUid: int — Role assigned to the user
 *   dateCreated: string — When the row was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the row was last modified (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code: 1185 = Import Complete, 704 = needs processing
 *   statusCd: int — Status code: 704 = Active, 705 = Inactive, 700 = Deleted
 *   processCd: int — Process code: 704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete
 *
 * UsersRolesCreateBody: Assign a role to the user in the path, or re-activate the existing
 * membership
 * Request body of: $api->agrInt->users->createRoles($usersUid, $data)
 *   rolesUid: int — Role to assign; the user comes from the path
 *
 * RolesBundlesUpdateBody: Partial update of a user-role membership; a code outside the canonical
 * set is dropped
 * Request body of: $api->agrInt->users->updateRoles($usersUid, $usersXRolesUid, $data)
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code (704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete)
 *
 * @phpstan-type UsersListItem array{usersUid: int, username: string, name: string|null, email: string, phoneNumber: string|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type UsersCreateBody array{username: string, password: string, email: string, name?: string|null, phoneNumber?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type UsersRotateCreateData array{usersUid: int, username: string, token: string}
 * @phpstan-type UsersRotateCreateBody array{token?: string}
 * @phpstan-type UsersValidateCreateData array{valid: bool, scope: string, userId: int, username: string, email: string, name: string, roles: list<string>, bundles: list<string>, resources: list<string>}
 * @phpstan-type UsersValidateCreateBody array{token: string}
 * @phpstan-type UsersVerifyCreateBody array{siteId?: string, username?: string, password?: string}
 * @phpstan-type UsersUpdateBody array{username?: string|null, password?: string|null, name?: string|null, email?: string|null, phoneNumber?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type UsersRolesListItem array{usersXRolesUid: int, usersUid: int, rolesUid: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type UsersRolesCreateBody array{rolesUid: int}
 * @phpstan-type RolesBundlesUpdateBody array{statusCd?: int|null, processCd?: int|null}
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
     * List users
     * Call: $api->agrInt->users->list()
     *
     * List users with pagination and filtering
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   403: The bearer token does not belong to an admin user.
     *
     * GET https://agr-int.augur-api.com/users
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1users/get
     *
     * Query params ($params; `?` = optional):
     *   email?: string — Filter by email
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset for results (Default: 0)
     *   orderBy?: string — Order By (Default: users_uid|ASC)
     *   phoneNumber?: string — Filter by phone_number
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *   username?: string — Filter by username
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
     * Call: $api->agrInt->users->create($data)
     *
     * Create a new user. Hashes password with Argon2id.
     *
     * Request body: Create an agr_int user; the password is hashed with Argon2id and never returned
     *
     * Errors:
     *   400: A required body field is missing or has the wrong type. Or The user could not be
     *       created. The username or email may already be in use.
     *   403: The bearer token does not belong to an admin user.
     *
     * POST https://agr-int.augur-api.com/users
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1users/post
     *
     * Request body ($data): UsersCreateBody (fields listed on the class)
     *
     * Response data type: UsersListItem (fields listed on the class)
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
     * POST /users/rotate
     *
     * Rotate a user token
     * Call: $api->agrInt->users->createRotate($data)
     *
     * Exchange a current, still-valid agr_int user token for a fresh one. Reads {token} from the
     * body. Returns {usersUid, username, token} on success, 401 for an
     * invalid/expired/wrong-scope/revoked token.
     *
     * Request body: Exchange a current, still-valid agr_int user token for a fresh one
     * Response data: Minimal identity returned by POST /api/users/verify on a successful
     *
     * Errors:
     *   403: Only the augur_info site may call this endpoint.
     *
     * POST https://agr-int.augur-api.com/users/rotate
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1users~1rotate/post
     *
     * Request body ($data): UsersRotateCreateBody (fields listed on the class)
     *
     * Response data type: UsersRotateCreateData (fields listed on the class)
     *
     * @param UsersRotateCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createRotate(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/rotate', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /users/validate
     *
     * Validate a user token
     * Call: $api->agrInt->users->createValidate($data)
     *
     * Introspect a presented agr_int user token. Reads {token} from the body. Always 200; returns
     * {valid, scope, userId, username, email, name, roles, bundles, resources}. valid is false for
     * an invalid/expired/wrong-scope/revoked token. resources is the P21 table set the user may
     * query (roles/bundles are display/audit context).
     *
     * Request body: Introspect an agr_int user access token
     * Response data: Result of validating a presented agr_int user token.
     *
     * Errors:
     *   403: Only the augur_info site may call this endpoint.
     *
     * POST https://agr-int.augur-api.com/users/validate
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1users~1validate/post
     *
     * Request body ($data): UsersValidateCreateBody (fields listed on the class)
     *
     * Response data type: UsersValidateCreateData (fields listed on the class)
     *
     * @param UsersValidateCreateBody $data
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
     * Verify user credentials
     * Call: $api->agrInt->users->createVerify($data)
     *
     * Verify a user's credentials against the stored Argon2id hash. Returns a minimal identity
     * object {usersUid, username} on match, 401 otherwise.
     *
     * Request body: Verify a user's username and password on a target site
     * Response data: Minimal identity returned by POST /api/users/verify on a successful
     *
     * Errors:
     *   403: Only the augur_info site may call this endpoint.
     *
     * POST https://agr-int.augur-api.com/users/verify
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1users~1verify/post
     *
     * Request body ($data): UsersVerifyCreateBody (fields listed on the class)
     *
     * Response data type: UsersRotateCreateData (fields listed on the class)
     *
     * @param UsersVerifyCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createVerify(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/verify', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /users/{usersUid}
     *
     * Soft-delete a user
     * Call: $api->agrInt->users->delete($usersUid)
     *
     * Soft-delete a user by UID
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *   404: No record with this ID.
     *
     * DELETE https://agr-int.augur-api.com/users/{usersUid}
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1users~1{usersUid}/delete
     *
     * Response data type: UsersListItem (fields listed on the class)
     *
     * @param int $usersUid Unique ID of the user
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
     * Get a user
     * Call: $api->agrInt->users->get($usersUid)
     *
     * Get a user by UID
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *
     * GET https://agr-int.augur-api.com/users/{usersUid}
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1users~1{usersUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: UsersListItem (fields listed on the class)
     *
     * @param int $usersUid Unique ID of the user
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
     * Update a user
     * Call: $api->agrInt->users->update($usersUid, $data)
     *
     * Update a user by UID with a partial JSON body
     *
     * Request body: Partial update of an agr_int user; an absent field keeps its current value
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *   404: No record with this ID.
     *
     * PUT https://agr-int.augur-api.com/users/{usersUid}
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1users~1{usersUid}/put
     *
     * Request body ($data): UsersUpdateBody (fields listed on the class)
     *
     * Response data type: UsersListItem (fields listed on the class)
     *
     * @param int $usersUid Unique ID of the user
     * @param UsersUpdateBody $data
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
     * List user-role memberships
     * Call: $api->agrInt->users->listRoles($usersUid)
     *
     * List a user's role memberships with pagination and filtering
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   403: The bearer token does not belong to an admin user.
     *
     * GET https://agr-int.augur-api.com/users/{usersUid}/roles
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1users~1{usersUid}~1roles/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset for results (Default: 0)
     *   orderBy?: string — Order By (Default: users_x_roles_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of UsersRolesListItem (fields listed on the class)
     *
     * @param int $usersUid Unique ID of the user
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
     * Assign or reactivate a user-role membership
     * Call: $api->agrInt->users->createRoles($usersUid, $data)
     *
     * Assign a role to a user, or reactivate a previously revoked membership. Body MUST include
     * rolesUid.
     *
     * Request body: Assign a role to the user in the path, or re-activate the existing membership
     *
     * Errors:
     *   400: A required body field is missing or has the wrong type.
     *   403: The bearer token does not belong to an admin user.
     *
     * POST https://agr-int.augur-api.com/users/{usersUid}/roles
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1users~1{usersUid}~1roles/post
     *
     * Request body ($data): UsersRolesCreateBody (fields listed on the class)
     *
     * Response data type: UsersRolesListItem (fields listed on the class)
     *
     * @param int $usersUid Unique ID of the user
     * @param UsersRolesCreateBody $data
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
     * Revoke a user-role membership
     * Call: $api->agrInt->users->deleteRoles($usersUid, $usersXRolesUid)
     *
     * Soft-delete (revoke) a user-role membership
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *   404: No record with this ID. Or Membership not found for this user.
     *
     * DELETE https://agr-int.augur-api.com/users/{usersUid}/roles/{usersXRolesUid}
     * Contract:
     * https://agr-int.augur-api.com/openapi.json#/paths/~1users~1{usersUid}~1roles~1{usersXRolesUid}/delete
     *
     * Response data type: UsersRolesListItem (fields listed on the class)
     *
     * @param int $usersUid Unique ID of the user
     * @param int $usersXRolesUid Unique ID of the user-to-role assignment
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
     * Get a user-role membership
     * Call: $api->agrInt->users->getRoles($usersUid, $usersXRolesUid)
     *
     * Get a user-role membership by UID
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *   404: Membership not found for this user.
     *
     * GET https://agr-int.augur-api.com/users/{usersUid}/roles/{usersXRolesUid}
     * Contract:
     * https://agr-int.augur-api.com/openapi.json#/paths/~1users~1{usersUid}~1roles~1{usersXRolesUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: UsersRolesListItem (fields listed on the class)
     *
     * @param int $usersUid Unique ID of the user
     * @param int $usersXRolesUid Unique ID of the user-to-role assignment
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
     * Update a user-role membership
     * Call: $api->agrInt->users->updateRoles($usersUid, $usersXRolesUid, $data)
     *
     * Update a user-role membership (statusCd / processCd only)
     *
     * Request body: Partial update of a user-role membership; a code outside the canonical set is
     * dropped
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *   404: No record with this ID. Or Membership not found for this user.
     *
     * PUT https://agr-int.augur-api.com/users/{usersUid}/roles/{usersXRolesUid}
     * Contract:
     * https://agr-int.augur-api.com/openapi.json#/paths/~1users~1{usersUid}~1roles~1{usersXRolesUid}/put
     *
     * Request body ($data): RolesBundlesUpdateBody (fields listed on the class)
     *
     * Response data type: UsersRolesListItem (fields listed on the class)
     *
     * @param int $usersUid Unique ID of the user
     * @param int $usersXRolesUid Unique ID of the user-to-role assignment
     * @param RolesBundlesUpdateBody $data
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
