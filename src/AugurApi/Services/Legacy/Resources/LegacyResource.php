<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * legacy resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://legacy.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://legacy.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://legacy.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py legacy
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * LegacyStateListItem:
 * Returned by: $api->legacy->legacy->listState()
 * Returned by: $api->legacy->legacy->createState($data)
 * Returned by: $api->legacy->legacy->getState($stateUid)
 * Returned by: $api->legacy->legacy->updateState($stateUid, $data)
 * Returned by: $api->legacy->legacy->deleteState($stateUid)
 *   stateUid: int — Unique identifier of the state
 *   countryUid: int|null — Country the state belongs to
 *   twoLetterCode: string|null — Two-letter state code (max 2 chars)
 *   stateName: string|null — State name (max 255 chars)
 *   dateCreated: string|null — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   createdBy: string|null — User who created the record (max 255 chars)
 *   dateLastModified: string|null — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime,
 *       e.g. 2025-07-30 15:50:49)
 *   lastMaintainedBy: string|null — User who last changed the record (max 255 chars)
 *   combinedFederalState1099No: int|null — Combined Federal/State 1099 program number
 *   telecheckStateCode: int|null — TeleCheck state code
 *   updateCd: int — Update code (1185 = Import Complete)
 *   active: int|null — 1 when the state is active
 *   taxRate: float|null — Tax rate
 *   dateLastChecked: string|null — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   taxShipping: int|null — 1 when shipping is taxed
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * LegacyStateCreateBody: Create a state, or return the existing one with the same two-letter code
 * and name
 * Request body of: $api->legacy->legacy->createState($data)
 *   stateName: string — State name
 *   twoLetterCode: string — Two-letter state code
 *   countryUid?: int|null — Country the state belongs to
 *   createdBy?: string|null — User who created the state; defaults to empty
 *   combinedFederalState1099No?: int|null — Combined Federal/State 1099 program number
 *   telecheckStateCode?: int|null — TeleCheck state code
 *   active?: int|null — 1 when the state is active; defaults to 0
 *   taxRate?: float|null — Tax rate; defaults to 0
 *   taxShipping?: int|null — 1 when shipping is taxed; defaults to 0
 *
 * LegacyStateUpdateBody: Partial update of a state; an absent field keeps its current value
 * Request body of: $api->legacy->legacy->updateState($stateUid, $data)
 *   active?: int|null — 1 when the state is active
 *   taxRate?: float|null — Tax rate
 *   taxShipping?: int|null — 1 when shipping is taxed
 *
 * @phpstan-type LegacyStateListItem array{stateUid: int, countryUid: int|null, twoLetterCode: string|null, stateName: string|null, dateCreated: string|null, createdBy: string|null, dateLastModified: string|null, lastMaintainedBy: string|null, combinedFederalState1099No: int|null, telecheckStateCode: int|null, updateCd: int, active: int|null, taxRate: float|null, dateLastChecked: string|null, taxShipping: int|null, statusCd: int, processCd: int}
 * @phpstan-type LegacyStateCreateBody array{stateName: string, twoLetterCode: string, countryUid?: int|null, createdBy?: string|null, combinedFederalState1099No?: int|null, telecheckStateCode?: int|null, active?: int|null, taxRate?: float|null, taxShipping?: int|null}
 * @phpstan-type LegacyStateUpdateBody array{active?: int|null, taxRate?: float|null, taxShipping?: int|null}
 */
final class LegacyResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /legacy/state
     *
     * List States
     * Call: $api->legacy->legacy->listState()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a state column.
     *
     * GET https://legacy.augur-api.com/legacy/state
     * Contract: https://legacy.augur-api.com/openapi.json#/paths/~1legacy~1state/get
     *
     * Query params ($params; `?` = optional):
     *   active?: int — Filter by active flag (1 = active, 0 = inactive)
     *   countryUid?: int — Filter by country
     *   limit?: int — Maximum rows to return (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: state_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *   twoLetterCode?: string — State Abbreviation
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of LegacyStateListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listState(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/state', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /legacy/state
     *
     * Create State
     * Call: $api->legacy->legacy->createState($data)
     *
     * Request body: Create a state, or return the existing one with the same two-letter code and
     * name
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or stateName or twoLetterCode is missing.
     *
     * POST https://legacy.augur-api.com/legacy/state
     * Contract: https://legacy.augur-api.com/openapi.json#/paths/~1legacy~1state/post
     *
     * Request body ($data): LegacyStateCreateBody (fields listed on the class)
     *
     * Response data type: LegacyStateListItem (fields listed on the class)
     *
     * @param LegacyStateCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createState(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/state', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /legacy/state/{stateUid}
     *
     * DELETE State
     * Call: $api->legacy->legacy->deleteState($stateUid)
     *
     * Errors:
     *   404: No state with this ID.
     *
     * DELETE https://legacy.augur-api.com/legacy/state/{stateUid}
     * Contract: https://legacy.augur-api.com/openapi.json#/paths/~1legacy~1state~1{stateUid}/delete
     *
     * Response data type: LegacyStateListItem (fields listed on the class)
     *
     * @param int $stateUid Unique identifier of the state
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteState(int $stateUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/state/{stateUid}',
            ['stateUid' => (string) $stateUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /legacy/state/{stateUid}
     *
     * Get State Details
     * Call: $api->legacy->legacy->getState($stateUid)
     *
     * Errors:
     *   404: No state with this ID (or, for ID 0, with this twoLetterCode).
     *
     * GET https://legacy.augur-api.com/legacy/state/{stateUid}
     * Contract: https://legacy.augur-api.com/openapi.json#/paths/~1legacy~1state~1{stateUid}/get
     *
     * Query params ($params; `?` = optional):
     *   twoLetterCode?: string — State Abbreviation
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: LegacyStateListItem (fields listed on the class)
     *
     * @param int $stateUid Unique identifier of the state; 0 looks the state up by twoLetterCode
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getState(int $stateUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/state/{stateUid}',
            $params,
            ['stateUid' => (string) $stateUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /legacy/state/{stateUid}
     *
     * Update State
     * Call: $api->legacy->legacy->updateState($stateUid, $data)
     *
     * Request body: Partial update of a state; an absent field keeps its current value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No state with this ID.
     *
     * PUT https://legacy.augur-api.com/legacy/state/{stateUid}
     * Contract: https://legacy.augur-api.com/openapi.json#/paths/~1legacy~1state~1{stateUid}/put
     *
     * Request body ($data): LegacyStateUpdateBody (fields listed on the class)
     *
     * Response data type: LegacyStateListItem (fields listed on the class)
     *
     * @param int $stateUid Unique identifier of the state
     * @param LegacyStateUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateState(int $stateUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/state/{stateUid}',
            $data,
            ['stateUid' => (string) $stateUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
