<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMastFiles resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://p21-pim.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://p21-pim.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://p21-pim.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-pim
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * InvMastFilesListItem:
 * Returned by: $api->p21Pim->invMastFiles->list()
 * Returned by: $api->p21Pim->invMastFiles->create($data)
 * Returned by: $api->p21Pim->invMastFiles->get($invMastFilesUid)
 * Returned by: $api->p21Pim->invMastFiles->update($invMastFilesUid, $data)
 * Returned by: $api->p21Pim->invMastFiles->delete($invMastFilesUid)
 *   invMastFilesUid: int — Item file ID
 *   invMastUid: int — Item (inv_mast) the file belongs to
 *   fileName: string — File name shown to users (max 100 chars)
 *   filePath: string — Path of the file (max 255 chars)
 *   linkArea: int — Prophet 21 link area code
 *   rowStatusFlag: int — Prophet 21 row status flag
 *   sequenceNo: int — Display order among the item files
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   fileDesc: string — File description (max 100 chars)
 *
 * InvMastFilesCreateBody: Attach a file to an item, or return the existing row for the same item
 * and path
 * Request body of: $api->p21Pim->invMastFiles->create($data)
 *   invMastUid: int|null — Item (inv_mast) the file belongs to; required
 *   filePath: string|null — Path of the file; required
 *   fileName?: string|null — File name shown to users
 *   fileDesc?: string|null — File description
 *   linkArea?: int|null — Prophet 21 link area code
 *   rowStatusFlag?: int|null — Prophet 21 row status flag
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted); defaults to
 *       704
 *
 * InvMastFilesUpdateBody: Partial update of an item file; an absent field keeps its current value
 * Request body of: $api->p21Pim->invMastFiles->update($invMastFilesUid, $data)
 *   fileName?: string|null — File name shown to users; a blank value keeps the current name
 *   fileDesc?: string|null — File description
 *   linkArea?: int|null — Prophet 21 link area code
 *   rowStatusFlag?: int|null — Prophet 21 row status flag
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted); an invalid
 *       code is ignored
 *
 * @phpstan-type InvMastFilesListItem array{invMastFilesUid: int, invMastUid: int, fileName: string, filePath: string, linkArea: int, rowStatusFlag: int, sequenceNo: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, fileDesc: string}
 * @phpstan-type InvMastFilesCreateBody array{invMastUid: int|null, filePath: string|null, fileName?: string|null, fileDesc?: string|null, linkArea?: int|null, rowStatusFlag?: int|null, statusCd?: int|null}
 * @phpstan-type InvMastFilesUpdateBody array{fileName?: string|null, fileDesc?: string|null, linkArea?: int|null, rowStatusFlag?: int|null, statusCd?: int|null}
 */
final class InvMastFilesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast-files
     *
     * List Inv Mast Files
     * Call: $api->p21Pim->invMastFiles->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an inv_mast_files column.
     *
     * GET https://p21-pim.augur-api.com/inv-mast-files
     * Contract: https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-files/get
     *
     * Query params ($params; `?` = optional):
     *   invMastUid?: int — Filter to one item (inv_mast)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: inv_mast_files_uid|ASC)
     *   statusCd?: int — Status Code (status_cd) [(704)|(705)|(700)]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastFilesListItem (fields listed on the class)
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
     * POST /inv-mast-files
     *
     * Create Inv Mast Files
     * Call: $api->p21Pim->invMastFiles->create($data)
     *
     * Request body: Attach a file to an item, or return the existing row for the same item and path
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://p21-pim.augur-api.com/inv-mast-files
     * Contract: https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-files/post
     *
     * Request body ($data): InvMastFilesCreateBody (fields listed on the class)
     *
     * Response data type: InvMastFilesListItem (fields listed on the class)
     *
     * @param InvMastFilesCreateBody $data
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
     * DELETE /inv-mast-files/{invMastFilesUid}
     *
     * DELETE Inv Mast Files
     * Call: $api->p21Pim->invMastFiles->delete($invMastFilesUid)
     *
     * Errors:
     *   404: No item file with this ID.
     *
     * DELETE https://p21-pim.augur-api.com/inv-mast-files/{invMastFilesUid}
     * Contract:
     * https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-files~1{invMastFilesUid}/delete
     *
     * Response data type: InvMastFilesListItem (fields listed on the class)
     *
     * @param int $invMastFilesUid Item file ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $invMastFilesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastFilesUid}',
            ['invMastFilesUid' => (string) $invMastFilesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast-files/{invMastFilesUid}
     *
     * Get Inv Mast Files Details
     * Call: $api->p21Pim->invMastFiles->get($invMastFilesUid)
     *
     * Errors:
     *   404: No item file with this ID.
     *
     * GET https://p21-pim.augur-api.com/inv-mast-files/{invMastFilesUid}
     * Contract:
     * https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-files~1{invMastFilesUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: InvMastFilesListItem (fields listed on the class)
     *
     * @param int $invMastFilesUid Item file ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastFilesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastFilesUid}',
            $params,
            ['invMastFilesUid' => (string) $invMastFilesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-mast-files/{invMastFilesUid}
     *
     * Update Inv Mast Files
     * Call: $api->p21Pim->invMastFiles->update($invMastFilesUid, $data)
     *
     * Request body: Partial update of an item file; an absent field keeps its current value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No item file with this ID.
     *
     * PUT https://p21-pim.augur-api.com/inv-mast-files/{invMastFilesUid}
     * Contract:
     * https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-files~1{invMastFilesUid}/put
     *
     * Request body ($data): InvMastFilesUpdateBody (fields listed on the class)
     *
     * Response data type: InvMastFilesListItem (fields listed on the class)
     *
     * @param int $invMastFilesUid Item file ID
     * @param InvMastFilesUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invMastFilesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastFilesUid}',
            $data,
            ['invMastFilesUid' => (string) $invMastFilesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
