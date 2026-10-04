<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * codeP21 resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://p21-core.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://p21-core.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://p21-core.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-core
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * CodeP21ListItem:
 * Returned by: $api->p21Core->codeP21->list()
 * Returned by: $api->p21Core->codeP21->get($codeUid)
 *   codeUid: int — Unique Prophet 21 ID of the code record
 *   codeNo: int — Numeric code value (e.g. 704)
 *   languageId: string — Language of the code description (max 8 chars)
 *   codeDescription: string — Name of the code (e.g. Active) (max 255 chars)
 *   rowStatusFlag: string — Prophet 21 row status flag (max 1 chars)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   lastMaintainedBy: string — Prophet 21 user who last changed the record (max 30 chars)
 *   codeSubDescription: string|null — Secondary description of the code (max 255 chars)
 *   updateCd: int — Update code (704 = queued for refresh from Prophet 21, 1185 = current)
 *
 * @phpstan-type CodeP21ListItem array{codeUid: int, codeNo: int, languageId: string, codeDescription: string, rowStatusFlag: string, dateCreated: string, dateLastModified: string, lastMaintainedBy: string, codeSubDescription: string|null, updateCd: int}
 */
final class CodeP21Resource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /code-p21
     *
     * List P21 Codes
     * Call: $api->p21Core->codeP21->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a code_p21 column.
     *
     * GET https://p21-core.augur-api.com/code-p21
     * Contract: https://p21-core.augur-api.com/openapi.json#/paths/~1code-p21/get
     *
     * Query params ($params; `?` = optional):
     *   codeNoList?: string — CSV is code_nos to limit results
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: code_uid|ASC)
     *   q?: string — search query
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CodeP21ListItem (fields listed on the class)
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
     * GET /code-p21/{codeUid}
     *
     * Get P21 Code Details
     * Call: $api->p21Core->codeP21->get($codeUid)
     *
     * GET https://p21-core.augur-api.com/code-p21/{codeUid}
     * Contract: https://p21-core.augur-api.com/openapi.json#/paths/~1code-p21~1{codeUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CodeP21ListItem (fields listed on the class)
     *
     * @param int $codeUid Prophet 21 code ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $codeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{codeUid}',
            $params,
            ['codeUid' => (string) $codeUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
