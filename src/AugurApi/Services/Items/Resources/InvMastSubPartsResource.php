<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMastSubParts resource — generated from spec.
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
 * InvMastSubPartsGetItem:
 * Returned by: $api->items->invMastSubParts->get($invMastUid)
 *   invMastSubPartsUid: int — Sub-part row ID (inv_mast_sub_parts.inv_mast_sub_parts_uid)
 *   invMastUid: int — Parent item (inv_mast.inv_mast_uid)
 *   subPartInvMastUid: int — Sub-part item (inv_mast.inv_mast_uid)
 *   sequenceNo: int — Display order of the sub-part under the parent item
 *   deleteFlag: string — Prophet 21 delete flag (Y = deleted, N = active) (max 1 chars)
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   invMastLinksUid: int — Item link this sub-part comes from (inv_mast_links.inv_mast_links_uid);
 *       0 when none
 *
 * @phpstan-type InvMastSubPartsGetItem array{invMastSubPartsUid: int, invMastUid: int, subPartInvMastUid: int, sequenceNo: int, deleteFlag: string, dateCreated: string, dateLastModified: string, updateCd: int, invMastLinksUid: int}
 */
final class InvMastSubPartsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast-sub-parts/{invMastUid}
     *
     * List sub parts for an item
     * Call: $api->items->invMastSubParts->get($invMastUid)
     *
     * GET https://items.augur-api.com/inv-mast-sub-parts/{invMastUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1inv-mast-sub-parts~1{invMastUid}/get
     *
     * Query params ($params; `?` = optional):
     *   invMastLinksUid?: int — inv_mast_link.inv_mast_links_uid
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastSubPartsGetItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function get(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
