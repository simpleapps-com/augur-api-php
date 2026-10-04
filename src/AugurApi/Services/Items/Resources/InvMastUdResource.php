<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMastUd resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://items.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://items.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://items.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * InvMastUdListItem: An item's Prophet 21 user-defined fields, each field name a top-level key
 * beside the fixed ones
 * Returned by: $api->items->invMastUd->list()
 *   invMastUdUid: int — Item user-defined row ID
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s)
 *   lastMaintainedBy: string — User who last changed the row
 *   createdBy: string|null — User who created the row
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   processCd: int — Process code: workflow state of the row
 *   dateLastProcessed: string — When the row was last processed (Y-m-d H:i:s)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   attribCd: int — Attribute code: 704 when the fields still need to be turned into item
 *       attributes
 *   dateLastChecked: string — When the row was last checked (Y-m-d H:i:s)
 *
 * @phpstan-type InvMastUdListItem array{invMastUdUid: int, invMastUid: int, dateCreated: string, dateLastModified: string, lastMaintainedBy: string, createdBy: string|null, updateCd: int, processCd: int, dateLastProcessed: string, statusCd: int, attribCd: int, dateLastChecked: string}
 */
final class InvMastUdResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast-ud
     *
     * List inv_mast_ud records with filtering and pagination
     * Call: $api->items->invMastUd->list()
     *
     * Response data, each item: An item's Prophet 21 user-defined fields, each field name a
     * top-level key beside the fixed ones
     *
     * Errors:
     *   400: Invalid statusCd: .... Must be a valid CodeP21 value; or invalid orderBy: MUST be one
     *       field|ASC or field|DESC, the field an inv_mast_ud column.
     *
     * GET https://items.augur-api.com/inv-mast-ud
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1inv-mast-ud/get
     *
     * Query params ($params; `?` = optional):
     *   createdSince?: string — Filter by date_created since date (YYYY-MM-DD HH:MM:SS)
     *   invMastUdUid?: int — Filter by inv_mast_ud_uid
     *   invMastUid?: int — Filter by inv_mast_uid
     *   limit?: int — Limit number of results (Default: 10)
     *   modifiedSince?: string — Filter by date_last_modified since date (YYYY-MM-DD HH:MM:SS)
     *   offset?: int — Number of records to skip
     *   orderBy?: string — Order by field and direction (e.g., inv_mast_ud_uid|DESC)
     *   statusCd?: int — Filter by status_cd
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastUdListItem (fields listed on the class)
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
}
