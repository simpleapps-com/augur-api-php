<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * workflows resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-info.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-info.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-info.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-info
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * WorkflowsListItem:
 * Returned by: $api->agrInfo->workflows->list()
 * Returned by: $api->agrInfo->workflows->create($data)
 * Returned by: $api->agrInfo->workflows->get($workflowsUid)
 * Returned by: $api->agrInfo->workflows->update($workflowsUid, $data)
 * Returned by: $api->agrInfo->workflows->delete($workflowsUid)
 *   workflowsUid: int — Workflow ID
 *   workflowsId: string — Workflow id (slug) (max 100 chars)
 *   title: string — Workflow title (max 255 chars)
 *   description: string|null — Workflow description (max 4294967295 chars)
 *   services: string — Services the workflow covers (max 255 chars)
 *   workflow: string — Workflow content (max 4294967295 chars)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * WorkflowsCreateBody: Create a workflow, or return the existing one with the same workflowsId
 * Request body of: $api->agrInfo->workflows->create($data)
 *   title: string — Workflow title
 *   workflow: string — Workflow content
 *   workflowsId?: string|null — Workflow id (slug); derived from the title when absent
 *   description?: string|null — Workflow description
 *   services?: string|null — Services the workflow covers; defaults to empty
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted); defaults to
 *       704
 *   processCd?: int|null — Process code; defaults to 704 (Active)
 *   updateCd?: int|null — Update code; defaults to 1185 (Import Complete)
 *
 * WorkflowsUpdateBody: Partial update of a workflow; an absent field keeps its current value
 * Request body of: $api->agrInfo->workflows->update($workflowsUid, $data)
 *   workflowsId?: string|null — Workflow id (slug)
 *   title?: string|null — Workflow title
 *   description?: string|null — Workflow description
 *   services?: string|null — Services the workflow covers
 *   workflow?: string|null — Workflow content
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code
 *   updateCd?: int|null — Update code
 *
 * @phpstan-type WorkflowsListItem array{workflowsUid: int, workflowsId: string, title: string, description: string|null, services: string, workflow: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type WorkflowsCreateBody array{title: string, workflow: string, workflowsId?: string|null, description?: string|null, services?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type WorkflowsUpdateBody array{workflowsId?: string|null, title?: string|null, description?: string|null, services?: string|null, workflow?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 */
final class WorkflowsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /workflows
     *
     * List Workflows
     * Call: $api->agrInfo->workflows->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a workflows column.
     *
     * GET https://agr-info.augur-api.com/workflows
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1workflows/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: workflows_uid|ASC)
     *   q?: string — Text to match in the workflow title
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of WorkflowsListItem (fields listed on the class)
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
     * POST /workflows
     *
     * Create Workflow
     * Call: $api->agrInfo->workflows->create($data)
     *
     * Request body: Create a workflow, or return the existing one with the same workflowsId
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or title or workflow is missing.
     *
     * POST https://agr-info.augur-api.com/workflows
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1workflows/post
     *
     * Request body ($data): WorkflowsCreateBody (fields listed on the class)
     *
     * Response data type: WorkflowsListItem (fields listed on the class)
     *
     * @param WorkflowsCreateBody $data
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
     * DELETE /workflows/{workflowsUid}
     *
     * Delete Workflow
     * Call: $api->agrInfo->workflows->delete($workflowsUid)
     *
     * Errors:
     *   404: No workflow with this ID.
     *
     * DELETE https://agr-info.augur-api.com/workflows/{workflowsUid}
     * Contract:
     * https://agr-info.augur-api.com/openapi.json#/paths/~1workflows~1{workflowsUid}/delete
     *
     * Response data type: WorkflowsListItem (fields listed on the class)
     *
     * @param int $workflowsUid Workflow ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $workflowsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{workflowsUid}',
            ['workflowsUid' => (string) $workflowsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /workflows/{workflowsUid}
     *
     * Get Workflow Details
     * Call: $api->agrInfo->workflows->get($workflowsUid)
     *
     * Errors:
     *   404: No workflow with this ID.
     *
     * GET https://agr-info.augur-api.com/workflows/{workflowsUid}
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1workflows~1{workflowsUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: WorkflowsListItem (fields listed on the class)
     *
     * @param int $workflowsUid Workflow ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $workflowsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{workflowsUid}',
            $params,
            ['workflowsUid' => (string) $workflowsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /workflows/{workflowsUid}
     *
     * Update Workflow
     * Call: $api->agrInfo->workflows->update($workflowsUid, $data)
     *
     * Request body: Partial update of a workflow; an absent field keeps its current value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No workflow with this ID.
     *
     * PUT https://agr-info.augur-api.com/workflows/{workflowsUid}
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1workflows~1{workflowsUid}/put
     *
     * Request body ($data): WorkflowsUpdateBody (fields listed on the class)
     *
     * Response data type: WorkflowsListItem (fields listed on the class)
     *
     * @param int $workflowsUid Workflow ID
     * @param WorkflowsUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $workflowsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{workflowsUid}',
            $data,
            ['workflowsUid' => (string) $workflowsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
