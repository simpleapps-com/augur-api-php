<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * company resource — generated from spec.
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
 * CompanyListItem:
 * Returned by: $api->p21Core->company->list()
 * Returned by: $api->p21Core->company->get($companyId)
 *   companyUid: int — Unique Prophet 21 ID of the company
 *   companyId: string — Prophet 21 company code (max 8 chars)
 *   companyName: string|null — Company name (max 40 chars)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   deleteFlag: string — Y when the company is deleted in Prophet 21 (max 1 chars)
 *   updateCd: int — Update code (704 = queued for refresh from Prophet 21, 1185 = current)
 *   lastMaintainedBy: string — Prophet 21 user who last changed the record (max 8 chars)
 *   addressId: float|null — Prophet 21 address ID of the company
 *   defaultSalesLocationId: float|null — Default sales location ID
 *   freightCodeUid: int|null — Default freight code of the company (freightCodeUid)
 *   upsAccountNo: string|null — UPS account number of the company (max 255 chars)
 *   defaultSourcePriceCd: int|null — Default source price (Prophet 21 code number)
 *   defaultMultiplier: float|null — Default pricing multiplier
 *
 * @phpstan-type CompanyListItem array{companyUid: int, companyId: string, companyName: string|null, dateCreated: string, dateLastModified: string, deleteFlag: string, updateCd: int, lastMaintainedBy: string, addressId: float|null, defaultSalesLocationId: float|null, freightCodeUid: int|null, upsAccountNo: string|null, defaultSourcePriceCd: int|null, defaultMultiplier: float|null}
 */
final class CompanyResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /company
     *
     * List Companies
     * Call: $api->p21Core->company->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a company column.
     *
     * GET https://p21-core.augur-api.com/company
     * Contract: https://p21-core.augur-api.com/openapi.json#/paths/~1company/get
     *
     * Query params ($params; `?` = optional):
     *   companyId?: string — Only this Prophet 21 company
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: company_uid|ASC)
     *   q?: string — Search Query
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CompanyListItem (fields listed on the class)
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
     * GET /company/{companyId}
     *
     * Get Company Details
     * Call: $api->p21Core->company->get($companyId)
     *
     * Errors:
     *   404: No company with this ID.
     *
     * GET https://p21-core.augur-api.com/company/{companyId}
     * Contract: https://p21-core.augur-api.com/openapi.json#/paths/~1company~1{companyId}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CompanyListItem (fields listed on the class)
     *
     * @param string $companyId Prophet 21 company ID (a string, e.g. AMPRO)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $companyId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{companyId}',
            $params,
            ['companyId' => (string) $companyId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
