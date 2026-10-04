<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * rubrics resource — generated from spec.
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
 * RubricsListItem:
 * Returned by: $api->agrInfo->rubrics->list()
 * Returned by: $api->agrInfo->rubrics->create($data)
 * Returned by: $api->agrInfo->rubrics->get($rubricsUid)
 * Returned by: $api->agrInfo->rubrics->update($rubricsUid, $data)
 * Returned by: $api->agrInfo->rubrics->delete($rubricsUid)
 *   rubricsUid: int — Rubric ID
 *   title: string|null — Rubric title (max 255 chars)
 *   id: string|null — Rubric id (slug) callers look the rubric up by (max 255 chars)
 *   content: string|null — Prompt template text (max 4294967295 chars)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *
 * RubricsCreateBody: Create a rubric (an LLM prompt template), or keep the existing one with the
 * same id
 * Request body of: $api->agrInfo->rubrics->create($data)
 *   title: string — Rubric title
 *   id: string — Rubric id (slug) callers look the rubric up by
 *   content: string — Prompt template text
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted); defaults to
 *       704
 *   processCd?: int|null — Process code; defaults to 704 (Active)
 *   updateCd?: int|null — Update code; defaults to 1185 (Import Complete)
 *
 * RubricsUpdateBody: Partial update of a rubric; an absent field keeps its current value
 * Request body of: $api->agrInfo->rubrics->update($rubricsUid, $data)
 *   title?: string|null — Rubric title
 *   id?: string|null — Rubric id (slug) callers look the rubric up by
 *   content?: string|null — Prompt template text
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code
 *
 * @phpstan-type RubricsListItem array{rubricsUid: int, title: string|null, id: string|null, content: string|null, updateCd: int, statusCd: int, processCd: int, dateCreated: string, dateLastModified: string}
 * @phpstan-type RubricsCreateBody array{title: string, id: string, content: string, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type RubricsUpdateBody array{title?: string|null, id?: string|null, content?: string|null, statusCd?: int|null, processCd?: int|null}
 */
final class RubricsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /rubrics
     *
     * List Rubrics
     * Call: $api->agrInfo->rubrics->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a rubrics column.
     *
     * GET https://agr-info.augur-api.com/rubrics
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1rubrics/get
     *
     * Query params ($params; `?` = optional):
     *   id?: string — Filter to the rubric with this id (slug)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: rubrics_uid|ASC)
     *   statusCd?: string — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of RubricsListItem (fields listed on the class)
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
     * POST /rubrics
     *
     * Create Rubric
     * Call: $api->agrInfo->rubrics->create($data)
     *
     * Request body: Create a rubric (an LLM prompt template), or keep the existing one with the
     * same id
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or title, id or content is missing.
     *
     * POST https://agr-info.augur-api.com/rubrics
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1rubrics/post
     *
     * Request body ($data): RubricsCreateBody (fields listed on the class)
     *
     * Response data type: RubricsListItem (fields listed on the class)
     *
     * @param RubricsCreateBody $data
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
     * DELETE /rubrics/{rubricsUid}
     *
     * Delete Rubric
     * Call: $api->agrInfo->rubrics->delete($rubricsUid)
     *
     * Errors:
     *   404: No rubric with this ID.
     *
     * DELETE https://agr-info.augur-api.com/rubrics/{rubricsUid}
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1rubrics~1{rubricsUid}/delete
     *
     * Response data type: RubricsListItem (fields listed on the class)
     *
     * @param int $rubricsUid Rubric ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $rubricsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{rubricsUid}',
            ['rubricsUid' => (string) $rubricsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /rubrics/{rubricsUid}
     *
     * Get Rubric Details
     * Call: $api->agrInfo->rubrics->get($rubricsUid)
     *
     * Errors:
     *   404: No rubric with this ID.
     *
     * GET https://agr-info.augur-api.com/rubrics/{rubricsUid}
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1rubrics~1{rubricsUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: RubricsListItem (fields listed on the class)
     *
     * @param int $rubricsUid Rubric ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $rubricsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{rubricsUid}',
            $params,
            ['rubricsUid' => (string) $rubricsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /rubrics/{rubricsUid}
     *
     * Update Rubric
     * Call: $api->agrInfo->rubrics->update($rubricsUid, $data)
     *
     * Request body: Partial update of a rubric; an absent field keeps its current value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No rubric with this ID.
     *
     * PUT https://agr-info.augur-api.com/rubrics/{rubricsUid}
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1rubrics~1{rubricsUid}/put
     *
     * Request body ($data): RubricsUpdateBody (fields listed on the class)
     *
     * Response data type: RubricsListItem (fields listed on the class)
     *
     * @param int $rubricsUid Rubric ID
     * @param RubricsUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $rubricsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{rubricsUid}',
            $data,
            ['rubricsUid' => (string) $rubricsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
