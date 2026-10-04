<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMastLinks resource — generated from spec.
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
 * InvMastLinksGetItem:
 * Returned by: $api->items->invMastLinks->get($invMastUid)
 *   invMastLinksUid: int — Item link ID (inv_mast_links.inv_mast_links_uid)
 *   invMastUid: int — Item the link belongs to (inv_mast.inv_mast_uid)
 *   linkName: string — Display name of the link (max 30 chars)
 *   linkPath: string — URL or file path the link points to (max 255 chars)
 *   linkArea: int — Prophet 21 link area code
 *   rowStatusFlag: int — Prophet 21 row status code (a CodeP21 value, e.g. 704 = Active)
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   lastModifiedBy: string — Prophet 21 user who last changed the link (max 30 chars)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *
 * @phpstan-type InvMastLinksGetItem array{invMastLinksUid: int, invMastUid: int, linkName: string, linkPath: string, linkArea: int, rowStatusFlag: int, dateCreated: string, dateLastModified: string, lastModifiedBy: string, updateCd: int}
 */
final class InvMastLinksResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast-links/{invMastUid}
     *
     * List document links for an item
     * Call: $api->items->invMastLinks->get($invMastUid)
     *
     * GET https://items.augur-api.com/inv-mast-links/{invMastUid}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1inv-mast-links~1{invMastUid}/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastLinksGetItem (fields listed on the class)
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
