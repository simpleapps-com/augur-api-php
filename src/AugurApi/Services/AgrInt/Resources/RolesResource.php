<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * roles resource — generated from spec.
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
 * RolesListItem:
 * Returned by: $api->agrInt->roles->list()
 * Returned by: $api->agrInt->roles->create($data)
 * Returned by: $api->agrInt->roles->get($rolesUid)
 * Returned by: $api->agrInt->roles->update($rolesUid, $data)
 * Returned by: $api->agrInt->roles->delete($rolesUid)
 *   rolesUid: int — Role unique ID; 1-999 are system roles (1 = Full Access), custom roles start at
 *       1000
 *   roleId: string — Role slug, derived from role_name (caps + snake_case) (max 255 chars)
 *   roleName: string — Role display name (max 255 chars)
 *   description: string|null — Admin-facing description of the role (max 255 chars)
 *   systemFlag: string — Y = system role (not editable through the API), N = custom role (max 1
 *       chars)
 *   dateCreated: string — When the row was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the row was last modified (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code: 1185 = Import Complete, 704 = needs processing
 *   statusCd: int — Status code: 704 = Active, 705 = Inactive, 700 = Deleted
 *   processCd: int — Process code: 704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete
 *
 * RolesCreateBody: Create a custom role, or refresh the one whose derived role_id already exists
 * Request body of: $api->agrInt->roles->create($data)
 *   roleName: string — Role name; the role_id slug is derived from it (caps + snake_case)
 *   description?: string|null — Admin-facing description of the role
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted); defaults to
 *       704
 *   processCd?: int|null — Process code; defaults to 704 (Active)
 *   updateCd?: int|null — Update code; defaults to 1185 (Import Complete)
 *
 * RolesUpdateBody: Partial update of a custom role; an absent field keeps its current value
 * Request body of: $api->agrInt->roles->update($rolesUid, $data)
 *   roleName?: string|null — New role name; a non-blank value also re-derives role_id
 *   description?: string|null — New admin-facing description
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code
 *   updateCd?: int|null — Update code
 *
 * RolesBundlesListItem:
 * Returned by: $api->agrInt->roles->listBundles($rolesUid)
 * Returned by: $api->agrInt->roles->createBundles($rolesUid, $data)
 * Returned by: $api->agrInt->roles->getBundles($rolesUid, $rolesXBundlesUid)
 * Returned by: $api->agrInt->roles->updateBundles($rolesUid, $rolesXBundlesUid, $data)
 * Returned by: $api->agrInt->roles->deleteBundles($rolesUid, $rolesXBundlesUid)
 *   rolesXBundlesUid: int — Role-bundle membership unique ID
 *   rolesUid: int — Role that holds the bundle
 *   bundlesUid: int — Bundle assigned to the role
 *   dateCreated: string — When the row was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the row was last modified (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code: 1185 = Import Complete, 704 = needs processing
 *   statusCd: int — Status code: 704 = Active, 705 = Inactive, 700 = Deleted
 *   processCd: int — Process code: 704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete
 *
 * RolesBundlesCreateBody: Assign a bundle to the role in the path, or re-activate the existing
 * membership
 * Request body of: $api->agrInt->roles->createBundles($rolesUid, $data)
 *   bundlesUid: int — Bundle to assign; the role comes from the path
 *
 * RolesBundlesUpdateBody: Partial update of a role-bundle membership; a code outside the canonical
 * set is dropped
 * Request body of: $api->agrInt->roles->updateBundles($rolesUid, $rolesXBundlesUid, $data)
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code (704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete)
 *
 * @phpstan-type RolesListItem array{rolesUid: int, roleId: string, roleName: string, description: string|null, systemFlag: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type RolesCreateBody array{roleName: string, description?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type RolesUpdateBody array{roleName?: string|null, description?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type RolesBundlesListItem array{rolesXBundlesUid: int, rolesUid: int, bundlesUid: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type RolesBundlesCreateBody array{bundlesUid: int}
 * @phpstan-type RolesBundlesUpdateBody array{statusCd?: int|null, processCd?: int|null}
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
     * List roles
     * Call: $api->agrInt->roles->list()
     *
     * List roles with pagination and filtering
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   403: The bearer token does not belong to an admin user.
     *
     * GET https://agr-int.augur-api.com/roles
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1roles/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset for results (Default: 0)
     *   orderBy?: string — Order By (Default: roles_uid|ASC)
     *   roleId?: string — Filter by role_id slug
     *   roleName?: string — Filter by role_name
     *   statusCd?: int — Status Code (status_cd) [(704)|705|700]
     *   systemFlag?: string — Filter by system_flag [Y|N]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of RolesListItem (fields listed on the class)
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
     * POST /roles
     *
     * Create a role
     * Call: $api->agrInt->roles->create($data)
     *
     * Create or upsert a role (system_flag forced to N)
     *
     * Request body: Create a custom role, or refresh the one whose derived role_id already exists
     *
     * Errors:
     *   400: A required body field is missing or has the wrong type.
     *   403: The bearer token does not belong to an admin user.
     *
     * POST https://agr-int.augur-api.com/roles
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1roles/post
     *
     * Request body ($data): RolesCreateBody (fields listed on the class)
     *
     * Response data type: RolesListItem (fields listed on the class)
     *
     * @param RolesCreateBody $data
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
     * DELETE /roles/{rolesUid}
     *
     * Soft-delete a role
     * Call: $api->agrInt->roles->delete($rolesUid)
     *
     * Soft-delete a role by UID
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user. Or System roles (system_flag=Y)
     *       cannot be soft-deleted via this endpoint.
     *   404: No record with this ID.
     *
     * DELETE https://agr-int.augur-api.com/roles/{rolesUid}
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1roles~1{rolesUid}/delete
     *
     * Response data type: RolesListItem (fields listed on the class)
     *
     * @param int $rolesUid Unique ID of the role
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $rolesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{rolesUid}',
            ['rolesUid' => (string) $rolesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /roles/{rolesUid}
     *
     * Get a role
     * Call: $api->agrInt->roles->get($rolesUid)
     *
     * Get a role by UID
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *
     * GET https://agr-int.augur-api.com/roles/{rolesUid}
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1roles~1{rolesUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: RolesListItem (fields listed on the class)
     *
     * @param int $rolesUid Unique ID of the role
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /roles/{rolesUid}
     *
     * Update a role
     * Call: $api->agrInt->roles->update($rolesUid, $data)
     *
     * Update a role by UID with a partial JSON body
     *
     * Request body: Partial update of a custom role; an absent field keeps its current value
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user. Or System roles (system_flag=Y)
     *       cannot be updated via this endpoint.
     *   404: No record with this ID.
     *
     * PUT https://agr-int.augur-api.com/roles/{rolesUid}
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1roles~1{rolesUid}/put
     *
     * Request body ($data): RolesUpdateBody (fields listed on the class)
     *
     * Response data type: RolesListItem (fields listed on the class)
     *
     * @param int $rolesUid Unique ID of the role
     * @param RolesUpdateBody $data
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /roles/{rolesUid}/bundles
     *
     * List role-bundle memberships
     * Call: $api->agrInt->roles->listBundles($rolesUid)
     *
     * List a role's bundle memberships with pagination and filtering
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   403: The bearer token does not belong to an admin user.
     *
     * GET https://agr-int.augur-api.com/roles/{rolesUid}/bundles
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1roles~1{rolesUid}~1bundles/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset for results (Default: 0)
     *   orderBy?: string — Order By (Default: roles_x_bundles_uid|ASC)
     *   statusCd?: int — Status Code (status_cd) [(704)|705|700]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of RolesBundlesListItem (fields listed on the class)
     *
     * @param int $rolesUid Unique ID of the role
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listBundles(int $rolesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{rolesUid}/bundles',
            $params,
            ['rolesUid' => (string) $rolesUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /roles/{rolesUid}/bundles
     *
     * Assign or reactivate a role-bundle membership
     * Call: $api->agrInt->roles->createBundles($rolesUid, $data)
     *
     * Assign a bundle to a role, or reactivate a previously revoked membership. Body MUST include
     * bundlesUid.
     *
     * Request body: Assign a bundle to the role in the path, or re-activate the existing membership
     *
     * Errors:
     *   400: A required body field is missing or has the wrong type.
     *   403: The bearer token does not belong to an admin user.
     *
     * POST https://agr-int.augur-api.com/roles/{rolesUid}/bundles
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1roles~1{rolesUid}~1bundles/post
     *
     * Request body ($data): RolesBundlesCreateBody (fields listed on the class)
     *
     * Response data type: RolesBundlesListItem (fields listed on the class)
     *
     * @param int $rolesUid Unique ID of the role
     * @param RolesBundlesCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createBundles(int $rolesUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{rolesUid}/bundles',
            $data,
            ['rolesUid' => (string) $rolesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /roles/{rolesUid}/bundles/{rolesXBundlesUid}
     *
     * Revoke a role-bundle membership
     * Call: $api->agrInt->roles->deleteBundles($rolesUid, $rolesXBundlesUid)
     *
     * Soft-delete (revoke) a role-bundle membership
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *   404: No record with this ID. Or Membership not found for this role.
     *
     * DELETE https://agr-int.augur-api.com/roles/{rolesUid}/bundles/{rolesXBundlesUid}
     * Contract:
     * https://agr-int.augur-api.com/openapi.json#/paths/~1roles~1{rolesUid}~1bundles~1{rolesXBundlesUid}/delete
     *
     * Response data type: RolesBundlesListItem (fields listed on the class)
     *
     * @param int $rolesUid Unique ID of the role
     * @param int $rolesXBundlesUid Unique ID of the role-to-bundle assignment
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteBundles(int $rolesUid, int $rolesXBundlesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{rolesUid}/bundles/{rolesXBundlesUid}',
            ['rolesUid' => (string) $rolesUid, 'rolesXBundlesUid' => (string) $rolesXBundlesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /roles/{rolesUid}/bundles/{rolesXBundlesUid}
     *
     * Get a role-bundle membership
     * Call: $api->agrInt->roles->getBundles($rolesUid, $rolesXBundlesUid)
     *
     * Get a role-bundle membership by UID
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *   404: Membership not found for this role.
     *
     * GET https://agr-int.augur-api.com/roles/{rolesUid}/bundles/{rolesXBundlesUid}
     * Contract:
     * https://agr-int.augur-api.com/openapi.json#/paths/~1roles~1{rolesUid}~1bundles~1{rolesXBundlesUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: RolesBundlesListItem (fields listed on the class)
     *
     * @param int $rolesUid Unique ID of the role
     * @param int $rolesXBundlesUid Unique ID of the role-to-bundle assignment
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getBundles(int $rolesUid, int $rolesXBundlesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{rolesUid}/bundles/{rolesXBundlesUid}',
            $params,
            ['rolesUid' => (string) $rolesUid, 'rolesXBundlesUid' => (string) $rolesXBundlesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /roles/{rolesUid}/bundles/{rolesXBundlesUid}
     *
     * Update a role-bundle membership
     * Call: $api->agrInt->roles->updateBundles($rolesUid, $rolesXBundlesUid, $data)
     *
     * Update a role-bundle membership (statusCd / processCd only)
     *
     * Request body: Partial update of a role-bundle membership; a code outside the canonical set is
     * dropped
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *   404: No record with this ID. Or Membership not found for this role.
     *
     * PUT https://agr-int.augur-api.com/roles/{rolesUid}/bundles/{rolesXBundlesUid}
     * Contract:
     * https://agr-int.augur-api.com/openapi.json#/paths/~1roles~1{rolesUid}~1bundles~1{rolesXBundlesUid}/put
     *
     * Request body ($data): RolesBundlesUpdateBody (fields listed on the class)
     *
     * Response data type: RolesBundlesListItem (fields listed on the class)
     *
     * @param int $rolesUid Unique ID of the role
     * @param int $rolesXBundlesUid Unique ID of the role-to-bundle assignment
     * @param RolesBundlesUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateBundles(int $rolesUid, int $rolesXBundlesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{rolesUid}/bundles/{rolesXBundlesUid}',
            $data,
            ['rolesUid' => (string) $rolesUid, 'rolesXBundlesUid' => (string) $rolesXBundlesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
