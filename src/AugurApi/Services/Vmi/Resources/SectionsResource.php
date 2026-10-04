<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * sections resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://vmi.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://vmi.augur-api.com/openapi.json: the full contract: request and response bodies field by
 *       field, descriptions, formats and documented errors.
 *   https://vmi.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * SectionsListItem:
 * Returned by: $api->vmi->sections->list()
 * Returned by: $api->vmi->sections->create($data)
 * Returned by: $api->vmi->sections->get($sectionsUid)
 *   sectionsUid: int — unique identifier
 *   customerId: float — customer id from Prophet21
 *   sectionsId: string — section id normalized from section name (max 255 chars)
 *   sectionsName: string — Name of the section (max 255 chars)
 *   sectionsDesc: string — Description of the section, defaults to section name (max 255 chars)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * SectionsCreateBody: Create a warehouse section for a customer, or return the one whose derived
 * sections_id already exists
 * Request body of: $api->vmi->sections->create($data)
 *   sectionsName: string|null — Section name; sections_id is derived from it. Without it nothing is
 *       created
 *   customerId: float|null — Prophet 21 customer the section belongs to; without it nothing is
 *       created
 *   sectionsDesc?: string|null — Section description; defaults to the section name
 *
 * SectionsUpdateBody: Rename or redescribe a warehouse section; an absent field keeps its current
 * value
 * Request body of: $api->vmi->sections->update($sectionsUid, $data)
 *   sectionsName?: string|null — Section name; sections_id is re-derived from it
 *   sectionsDesc?: string|null — Section description
 *
 * DistributorsEnableUpdateData: Outcome of an enable, disable, or delete request
 * Returned by: $api->vmi->sections->updateEnable($sectionsUid, $data)
 *   statusCd: int — Status applied: 704 (enable), 705 (disable), or 700 (delete)
 *   statusName: string — enable, disable, or delete, matching statusCd
 *   updated: bool — true when the record's status changed; false when it already had this status
 *   originalStatusCd: int — Status before the request
 *
 * DistributorsEnableUpdateBody: Enable, disable, or delete a record; with neither field the record
 * is enabled
 * Request body of: $api->vmi->sections->updateEnable($sectionsUid, $data)
 *   statusName?: string|null — enable, disable, or delete; used only when statusCd is absent
 *   statusCd?: int|null — 704 (enable), 705 (disable), or 700 (delete); any other value enables
 *
 * @phpstan-type SectionsListItem array{sectionsUid: int, customerId: float, sectionsId: string, sectionsName: string, sectionsDesc: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type SectionsCreateBody array{sectionsName: string|null, customerId: float|null, sectionsDesc?: string|null}
 * @phpstan-type SectionsUpdateBody array{sectionsName?: string|null, sectionsDesc?: string|null}
 * @phpstan-type DistributorsEnableUpdateData array{statusCd: int, statusName: string, updated: bool, originalStatusCd: int}
 * @phpstan-type DistributorsEnableUpdateBody array{statusName?: string|null, statusCd?: int|null}
 */
final class SectionsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /sections
     *
     * List sections
     * Call: $api->vmi->sections->list()
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://vmi.augur-api.com/sections
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1sections/get
     *
     * Query params ($params; `?` = optional):
     *   customerId: int — Prophet 21 customer to filter by
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: sections_uid|ASC)
     *   statusCd?: int — Status Code (status_cd) [(704)|705|700]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of SectionsListItem (fields listed on the class)
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
     * POST /sections
     *
     * Create section
     * Call: $api->vmi->sections->create($data)
     *
     * Request body: Create a warehouse section for a customer, or return the one whose derived
     * sections_id already exists
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * POST https://vmi.augur-api.com/sections
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1sections/post
     *
     * Request body ($data): SectionsCreateBody (fields listed on the class)
     *
     * Response data type: SectionsListItem (fields listed on the class)
     *
     * @param SectionsCreateBody $data
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
     * DELETE /sections/{sectionsUid}
     *
     * DELETE section
     * Call: $api->vmi->sections->delete($sectionsUid)
     *
     * Errors:
     *   404: No row exists with this ID.
     *
     * DELETE https://vmi.augur-api.com/sections/{sectionsUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1sections~1{sectionsUid}/delete
     *
     * Response data type: bool
     *
     * @param int $sectionsUid Section ID
     * @return BaseResponse<bool>
     */
    public function delete(int $sectionsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{sectionsUid}',
            ['sectionsUid' => (string) $sectionsUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /sections/{sectionsUid}
     *
     * Get section Details
     * Call: $api->vmi->sections->get($sectionsUid)
     *
     * GET https://vmi.augur-api.com/sections/{sectionsUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1sections~1{sectionsUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: SectionsListItem (fields listed on the class)
     *
     * @param int $sectionsUid Section ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $sectionsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{sectionsUid}',
            $params,
            ['sectionsUid' => (string) $sectionsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /sections/{sectionsUid}
     *
     * Update section
     * Call: $api->vmi->sections->update($sectionsUid, $data)
     *
     * Request body: Rename or redescribe a warehouse section; an absent field keeps its current
     * value
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No row exists with this ID.
     *
     * PUT https://vmi.augur-api.com/sections/{sectionsUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1sections~1{sectionsUid}/put
     *
     * Request body ($data): SectionsUpdateBody (fields listed on the class)
     *
     * Response data type: bool
     *
     * @param int $sectionsUid Section ID
     * @param SectionsUpdateBody $data
     * @return BaseResponse<bool>
     */
    public function update(int $sectionsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{sectionsUid}',
            $data,
            ['sectionsUid' => (string) $sectionsUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /sections/{sectionsUid}/enable
     *
     * Enable/Disable/Delete section
     * Call: $api->vmi->sections->updateEnable($sectionsUid, $data)
     *
     * Request body: Enable, disable, or delete a record; with neither field the record is enabled
     * Response data: Outcome of an enable, disable, or delete request
     *
     * Errors:
     *   404: No row exists with this ID.
     *
     * PUT https://vmi.augur-api.com/sections/{sectionsUid}/enable
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1sections~1{sectionsUid}~1enable/put
     *
     * Request body ($data): DistributorsEnableUpdateBody (fields listed on the class)
     *
     * Response data type: DistributorsEnableUpdateData (fields listed on the class)
     *
     * @param int $sectionsUid Section ID
     * @param DistributorsEnableUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateEnable(int $sectionsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{sectionsUid}/enable',
            $data,
            ['sectionsUid' => (string) $sectionsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
