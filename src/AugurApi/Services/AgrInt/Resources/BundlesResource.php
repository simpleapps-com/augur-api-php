<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * bundles resource — generated from spec.
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
 * BundlesListItem:
 * Returned by: $api->agrInt->bundles->list()
 * Returned by: $api->agrInt->bundles->create($data)
 * Returned by: $api->agrInt->bundles->get($bundlesUid)
 * Returned by: $api->agrInt->bundles->update($bundlesUid, $data)
 * Returned by: $api->agrInt->bundles->delete($bundlesUid)
 *   bundlesUid: int — Bundle unique ID; 1-999 are system (manifest) bundles, custom bundles start
 *       at 1000
 *   bundleId: string — Bundle slug, derived from bundle_name (caps + snake_case) or the manifest id
 *       (max 255 chars)
 *   bundleName: string — Bundle display name (max 255 chars)
 *   description: string|null — Admin-facing description of the bundle (max 255 chars)
 *   systemFlag: string — Y = system bundle seeded from the augur-graphql manifest (not editable
 *       through the API), N = custom bundle (max 1 chars)
 *   dateCreated: string — When the row was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the row was last modified (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code: 1185 = Import Complete, 704 = needs processing
 *   statusCd: int — Status code: 704 = Active, 705 = Inactive, 700 = Deleted
 *   processCd: int — Process code: 704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete
 *   menuGroup: int|null — Menu group from the augur-graphql RBAC manifest; null when the bundle has
 *       none
 *
 * BundlesCreateBody: Create a custom bundle, or refresh the one whose derived bundle_id already
 * exists
 * Request body of: $api->agrInt->bundles->create($data)
 *   bundleName: string — Bundle name; the bundle_id slug is derived from it (caps + snake_case)
 *   description?: string|null — Admin-facing description of the bundle
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted); defaults to
 *       704
 *   processCd?: int|null — Process code; defaults to 704 (Active)
 *   updateCd?: int|null — Update code; defaults to 1185 (Import Complete)
 *
 * BundlesUpdateBody: Partial update of a custom bundle; an absent field keeps its current value
 * Request body of: $api->agrInt->bundles->update($bundlesUid, $data)
 *   bundleName?: string|null — New bundle name; a non-blank value also re-derives bundle_id
 *   description?: string|null — New admin-facing description
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code
 *   updateCd?: int|null — Update code
 *
 * BundlesResourcesListItem:
 * Returned by: $api->agrInt->bundles->listResources($bundlesUid)
 * Returned by: $api->agrInt->bundles->createResources($bundlesUid, $data)
 * Returned by: $api->agrInt->bundles->getResources($bundlesUid, $bundlesXResourcesUid)
 * Returned by: $api->agrInt->bundles->updateResources($bundlesUid, $bundlesXResourcesUid, $data)
 * Returned by: $api->agrInt->bundles->deleteResources($bundlesUid, $bundlesXResourcesUid)
 *   bundlesXResourcesUid: int — Bundle-resource grant unique ID
 *   bundlesUid: int — Bundle that holds the grant
 *   resourcesUid: int — Resource the bundle is granted
 *   readCd: int — Read grant: 1390 = Allow All, 1391 = Allow None
 *   writeCd: int — Write grant: 1390 = Allow All, 1391 = Allow None
 *   executeCd: int — Execute grant: 1390 = Allow All, 1391 = Allow None
 *   dateCreated: string — When the row was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the row was last modified (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code: 1185 = Import Complete, 704 = needs processing
 *   statusCd: int — Status code: 704 = Active, 705 = Inactive, 700 = Deleted
 *   processCd: int — Process code: 704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete
 *
 * BundlesResourcesCreateBody: Grant a resource to the bundle in the path, or re-activate and
 * re-grant the existing edge
 * Request body of: $api->agrInt->bundles->createResources($bundlesUid, $data)
 *   resourcesUid: int — Resource to grant; the bundle comes from the path
 *   readCd?: int|null — Read grant: 1390 = Allow All, 1391 = Allow None; anything else becomes 1391
 *   writeCd?: int|null — Write grant: 1390 = Allow All, 1391 = Allow None; anything else becomes
 *       1391
 *   executeCd?: int|null — Execute grant: 1390 = Allow All, 1391 = Allow None; anything else
 *       becomes 1391
 *
 * BundlesResourcesUpdateBody: Partial update of a bundle-resource grant; an out-of-set code is
 * dropped
 * Request body of:
 * $api->agrInt->bundles->updateResources($bundlesUid, $bundlesXResourcesUid, $data)
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code (704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete)
 *   readCd?: int|null — Read grant: 1390 = Allow All, 1391 = Allow None
 *   writeCd?: int|null — Write grant: 1390 = Allow All, 1391 = Allow None
 *   executeCd?: int|null — Execute grant: 1390 = Allow All, 1391 = Allow None
 *
 * @phpstan-type BundlesListItem array{bundlesUid: int, bundleId: string, bundleName: string, description: string|null, systemFlag: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, menuGroup: int|null}
 * @phpstan-type BundlesCreateBody array{bundleName: string, description?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type BundlesUpdateBody array{bundleName?: string|null, description?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type BundlesResourcesListItem array{bundlesXResourcesUid: int, bundlesUid: int, resourcesUid: int, readCd: int, writeCd: int, executeCd: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type BundlesResourcesCreateBody array{resourcesUid: int, readCd?: int|null, writeCd?: int|null, executeCd?: int|null}
 * @phpstan-type BundlesResourcesUpdateBody array{statusCd?: int|null, processCd?: int|null, readCd?: int|null, writeCd?: int|null, executeCd?: int|null}
 */
final class BundlesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /bundles
     *
     * List bundles
     * Call: $api->agrInt->bundles->list()
     *
     * List bundles with pagination and filtering
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   403: The bearer token does not belong to an admin user.
     *
     * GET https://agr-int.augur-api.com/bundles
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1bundles/get
     *
     * Query params ($params; `?` = optional):
     *   bundleId?: string — Filter by bundle_id slug
     *   bundleName?: string — Filter by bundle_name
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset for results (Default: 0)
     *   orderBy?: string — Order By (Default: bundles_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *   systemFlag?: string — Filter by system_flag [Y|N]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of BundlesListItem (fields listed on the class)
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
     * POST /bundles
     *
     * Create a bundle
     * Call: $api->agrInt->bundles->create($data)
     *
     * Create or upsert a bundle (system_flag forced to N)
     *
     * Request body: Create a custom bundle, or refresh the one whose derived bundle_id already
     * exists
     *
     * Errors:
     *   400: A required body field is missing or has the wrong type.
     *   403: The bearer token does not belong to an admin user.
     *
     * POST https://agr-int.augur-api.com/bundles
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1bundles/post
     *
     * Request body ($data): BundlesCreateBody (fields listed on the class)
     *
     * Response data type: BundlesListItem (fields listed on the class)
     *
     * @param BundlesCreateBody $data
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
     * DELETE /bundles/{bundlesUid}
     *
     * Soft-delete a bundle
     * Call: $api->agrInt->bundles->delete($bundlesUid)
     *
     * Soft-delete a bundle by UID
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user. Or System bundles (system_flag=Y)
     *       cannot be soft-deleted via this endpoint.
     *   404: No record with this ID.
     *
     * DELETE https://agr-int.augur-api.com/bundles/{bundlesUid}
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1bundles~1{bundlesUid}/delete
     *
     * Response data type: BundlesListItem (fields listed on the class)
     *
     * @param int $bundlesUid Unique ID of the bundle
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $bundlesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{bundlesUid}',
            ['bundlesUid' => (string) $bundlesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /bundles/{bundlesUid}
     *
     * Get a bundle
     * Call: $api->agrInt->bundles->get($bundlesUid)
     *
     * Get a bundle by UID
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *
     * GET https://agr-int.augur-api.com/bundles/{bundlesUid}
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1bundles~1{bundlesUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: BundlesListItem (fields listed on the class)
     *
     * @param int $bundlesUid Unique ID of the bundle
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $bundlesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{bundlesUid}',
            $params,
            ['bundlesUid' => (string) $bundlesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /bundles/{bundlesUid}
     *
     * Update a bundle
     * Call: $api->agrInt->bundles->update($bundlesUid, $data)
     *
     * Update a bundle by UID with a partial JSON body
     *
     * Request body: Partial update of a custom bundle; an absent field keeps its current value
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user. Or System bundles (system_flag=Y)
     *       cannot be updated via this endpoint.
     *   404: No record with this ID.
     *
     * PUT https://agr-int.augur-api.com/bundles/{bundlesUid}
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1bundles~1{bundlesUid}/put
     *
     * Request body ($data): BundlesUpdateBody (fields listed on the class)
     *
     * Response data type: BundlesListItem (fields listed on the class)
     *
     * @param int $bundlesUid Unique ID of the bundle
     * @param BundlesUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $bundlesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{bundlesUid}',
            $data,
            ['bundlesUid' => (string) $bundlesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /bundles/{bundlesUid}/resources
     *
     * List bundle-resource grants
     * Call: $api->agrInt->bundles->listResources($bundlesUid)
     *
     * List a bundle's resource grants with pagination and filtering
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   403: The bearer token does not belong to an admin user.
     *
     * GET https://agr-int.augur-api.com/bundles/{bundlesUid}/resources
     * Contract:
     * https://agr-int.augur-api.com/openapi.json#/paths/~1bundles~1{bundlesUid}~1resources/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset for results (Default: 0)
     *   orderBy?: string — Order By (Default: bundles_x_resources_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of BundlesResourcesListItem (fields listed on the class)
     *
     * @param int $bundlesUid Unique ID of the bundle
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listResources(int $bundlesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{bundlesUid}/resources',
            $params,
            ['bundlesUid' => (string) $bundlesUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /bundles/{bundlesUid}/resources
     *
     * Grant or reactivate a bundle-resource grant
     * Call: $api->agrInt->bundles->createResources($bundlesUid, $data)
     *
     * Grant a resource to a bundle, or reactivate a previously revoked grant. Body MUST include
     * resourcesUid and MAY include readCd/writeCd/executeCd.
     *
     * Request body: Grant a resource to the bundle in the path, or re-activate and re-grant the
     * existing edge
     *
     * Errors:
     *   400: A required body field is missing or has the wrong type.
     *   403: The bearer token does not belong to an admin user.
     *
     * POST https://agr-int.augur-api.com/bundles/{bundlesUid}/resources
     * Contract:
     * https://agr-int.augur-api.com/openapi.json#/paths/~1bundles~1{bundlesUid}~1resources/post
     *
     * Request body ($data): BundlesResourcesCreateBody (fields listed on the class)
     *
     * Response data type: BundlesResourcesListItem (fields listed on the class)
     *
     * @param int $bundlesUid Unique ID of the bundle
     * @param BundlesResourcesCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createResources(int $bundlesUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{bundlesUid}/resources',
            $data,
            ['bundlesUid' => (string) $bundlesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /bundles/{bundlesUid}/resources/{bundlesXResourcesUid}
     *
     * Revoke a bundle-resource grant
     * Call: $api->agrInt->bundles->deleteResources($bundlesUid, $bundlesXResourcesUid)
     *
     * Soft-delete (revoke) a bundle-resource grant
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *   404: No record with this ID. Or Grant not found for this bundle.
     *
     * DELETE https://agr-int.augur-api.com/bundles/{bundlesUid}/resources/{bundlesXResourcesUid}
     * Contract:
     * https://agr-int.augur-api.com/openapi.json#/paths/~1bundles~1{bundlesUid}~1resources~1{bundlesXResourcesUid}/delete
     *
     * Response data type: BundlesResourcesListItem (fields listed on the class)
     *
     * @param int $bundlesUid Unique ID of the bundle
     * @param int $bundlesXResourcesUid Unique ID of the bundle-to-resource assignment
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteResources(int $bundlesUid, int $bundlesXResourcesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{bundlesUid}/resources/{bundlesXResourcesUid}',
            ['bundlesUid' => (string) $bundlesUid, 'bundlesXResourcesUid' => (string) $bundlesXResourcesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /bundles/{bundlesUid}/resources/{bundlesXResourcesUid}
     *
     * Get a bundle-resource grant
     * Call: $api->agrInt->bundles->getResources($bundlesUid, $bundlesXResourcesUid)
     *
     * Get a bundle-resource grant by UID
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *   404: Grant not found for this bundle.
     *
     * GET https://agr-int.augur-api.com/bundles/{bundlesUid}/resources/{bundlesXResourcesUid}
     * Contract:
     * https://agr-int.augur-api.com/openapi.json#/paths/~1bundles~1{bundlesUid}~1resources~1{bundlesXResourcesUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: BundlesResourcesListItem (fields listed on the class)
     *
     * @param int $bundlesUid Unique ID of the bundle
     * @param int $bundlesXResourcesUid Unique ID of the bundle-to-resource assignment
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getResources(int $bundlesUid, int $bundlesXResourcesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{bundlesUid}/resources/{bundlesXResourcesUid}',
            $params,
            ['bundlesUid' => (string) $bundlesUid, 'bundlesXResourcesUid' => (string) $bundlesXResourcesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /bundles/{bundlesUid}/resources/{bundlesXResourcesUid}
     *
     * Update a bundle-resource grant
     * Call: $api->agrInt->bundles->updateResources($bundlesUid, $bundlesXResourcesUid, $data)
     *
     * Update a bundle-resource grant (statusCd / processCd / readCd / writeCd / executeCd only)
     *
     * Request body: Partial update of a bundle-resource grant; an out-of-set code is dropped
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *   404: No record with this ID. Or Grant not found for this bundle.
     *
     * PUT https://agr-int.augur-api.com/bundles/{bundlesUid}/resources/{bundlesXResourcesUid}
     * Contract:
     * https://agr-int.augur-api.com/openapi.json#/paths/~1bundles~1{bundlesUid}~1resources~1{bundlesXResourcesUid}/put
     *
     * Request body ($data): BundlesResourcesUpdateBody (fields listed on the class)
     *
     * Response data type: BundlesResourcesListItem (fields listed on the class)
     *
     * @param int $bundlesUid Unique ID of the bundle
     * @param int $bundlesXResourcesUid Unique ID of the bundle-to-resource assignment
     * @param BundlesResourcesUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateResources(int $bundlesUid, int $bundlesXResourcesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{bundlesUid}/resources/{bundlesXResourcesUid}',
            $data,
            ['bundlesUid' => (string) $bundlesUid, 'bundlesXResourcesUid' => (string) $bundlesXResourcesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
