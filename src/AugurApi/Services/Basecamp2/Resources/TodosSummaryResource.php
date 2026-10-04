<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * todosSummary resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://basecamp2.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://basecamp2.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://basecamp2.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py basecamp2
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * TodosSummaryListItem:
 * Returned by: $api->basecamp2->todosSummary->list()
 * Returned by: $api->basecamp2->todosSummary->get($id)
 *   id: int — Primary key - same value as todos.id, enforced in code
 *   summary: string|null — AI-generated summary of ticket and comments (max 65535 chars)
 *   summaryTokens: int — Token estimate for summary size
 *   context: string|null — Full context blob in YAML format for knowledge base (max 4294967295
 *       chars)
 *   contextTokens: int — Token estimate for context size
 *   modelName: string|null — AI model used for generation (max 100 chars)
 *   vector: string|null — Base64 encoded 768-dim float32 vector (max 4200 chars)
 *   vectorCd: int — Vector processing code
 *   statusCd: int — Record status code
 *   processCd: int — Processing status code
 *   updateCd: int — Update tracking code
 *   dateCreated: string — Creation timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — Last update timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   akashaCd: int — Akasha sync status code (704=needs sync, 1185=synced)
 *   complexityScore: int|null — AI-assessed complexity score (1=trivial, 2=simple, 3=moderate,
 *       4=complex, 5=major)
 *   complexityReason: string|null — Brief explanation of complexity score (max 255 chars)
 *   estimatedMinutes: int|null — AI-estimated time to complete in minutes
 *   requiredServices: string|null — Comma-separated list of services/datatypes involved (max 255
 *       chars)
 *   worthinessReason: string|null — Explanation of training worthiness assessment (max 255 chars)
 *
 * @phpstan-type TodosSummaryListItem array{id: int, summary: string|null, summaryTokens: int, context: string|null, contextTokens: int, modelName: string|null, vector: string|null, vectorCd: int, statusCd: int, processCd: int, updateCd: int, dateCreated: string, dateLastModified: string, akashaCd: int, complexityScore: int|null, complexityReason: string|null, estimatedMinutes: int|null, requiredServices: string|null, worthinessReason: string|null}
 */
final class TodosSummaryResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /todos-summary
     *
     * List Todo Summaries
     * Call: $api->basecamp2->todosSummary->list()
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://basecamp2.augur-api.com/todos-summary
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1todos-summary/get
     *
     * Query params ($params; `?` = optional):
     *   akashaCd?: int — Filter by akasha sync status
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Sort as field|ASC or field|DESC on a todos_summary column (Default:
     *       id|asc)
     *   processCd?: int — Filter by process code
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of TodosSummaryListItem (fields listed on the class)
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
     * GET /todos-summary/{id}
     *
     * Get Todo Summary Details
     * Call: $api->basecamp2->todosSummary->get($id)
     *
     * GET https://basecamp2.augur-api.com/todos-summary/{id}
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1todos-summary~1{id}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: TodosSummaryListItem (fields listed on the class)
     *
     * @param int $id Todo Summary ID
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
}
