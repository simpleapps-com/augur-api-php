<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * resources resource — generated from spec.
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
 * ResourcesListItem:
 * Returned by: $api->agrInt->resources->list()
 * Returned by: $api->agrInt->resources->get($resourcesUid)
 *   resourcesUid: int — Resource unique ID
 *   resourceId: string — Resource slug (caps + snake_case), derived from the manifest table name
 *       (max 255 chars)
 *   resourceName: string — Resource display name (max 255 chars)
 *   resourceType: string — Kind of resource; currently always table (max 255 chars)
 *   resourcePath: string — What the resource grants access to; for a table, the P21 table name (max
 *       255 chars)
 *   description: string|null — Admin-facing description of the resource (max 255 chars)
 *   dateCreated: string — When the row was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the row was last modified (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code: 1185 = Import Complete, 704 = needs processing
 *   statusCd: int — Status code: 704 = Active, 705 = Inactive, 700 = Deleted
 *   processCd: int — Process code: 704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete
 *
 * @phpstan-type ResourcesListItem array{resourcesUid: int, resourceId: string, resourceName: string, resourceType: string, resourcePath: string, description: string|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 */
final class ResourcesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /resources
     *
     * List resources
     * Call: $api->agrInt->resources->list()
     *
     * List resources with pagination and filtering
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   403: The bearer token does not belong to an admin user.
     *
     * GET https://agr-int.augur-api.com/resources
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1resources/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset for results (Default: 0)
     *   orderBy?: string — Order By (Default: resources_uid|ASC)
     *   resourceId?: string — Filter by resource_id slug
     *   resourceName?: string — Filter by resource_name
     *   resourcePath?: string — Filter by resource_path
     *   resourceType?: string — Filter by resource_type
     *   statusCd?: int — Status Code (status_cd) [(704)|705|700]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ResourcesListItem (fields listed on the class)
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
     * GET /resources/{resourcesUid}
     *
     * Get a resource
     * Call: $api->agrInt->resources->get($resourcesUid)
     *
     * Get a resource by UID
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *
     * GET https://agr-int.augur-api.com/resources/{resourcesUid}
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1resources~1{resourcesUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ResourcesListItem (fields listed on the class)
     *
     * @param int $resourcesUid Unique ID of the resource
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $resourcesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{resourcesUid}',
            $params,
            ['resourcesUid' => (string) $resourcesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
