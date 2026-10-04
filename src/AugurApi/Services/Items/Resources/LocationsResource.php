<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * locations resource — generated from spec.
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
 * InvMastLocationsBinsListItem: One bin of an item at a location, as InvBinHelper::generateDoc
 * builds it
 * Returned by: $api->items->locations->listBins($locationId)
 * Returned by: $api->items->locations->getBins($locationId, $bin)
 *   invBinUid: int — Item bin ID
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   itemId: string — Item code (inv_mast.item_id)
 *   locationId: float — Prophet 21 location ID
 *   bin: string — Bin
 *   quantity: float — Quantity in the bin
 *   dateCreated: AttributeGroupsAttributesListItemDateCreated|null — When the row was created (raw
 *       PHP DateTime object)
 *   dateLastModified: AttributeGroupsAttributesListItemDateCreated|null — When the row last changed
 *       (raw PHP DateTime object)
 *   lastMaintainedBy: string — User who last changed the row
 *
 * AttributeGroupsAttributesListItemDateCreated: When the row was created (raw PHP DateTime object)
 * Field `dateCreated` of InvMastLocationsBinsListItem
 * Field `dateLastModified` of InvMastLocationsBinsListItem
 *   date: string — Date and time (Y-m-d H:i:s.u)
 *   timezone_type: int — PHP timezone type (3 = named timezone)
 *   timezone: string — Timezone name, e.g. UTC
 *
 * @phpstan-type InvMastLocationsBinsListItem array{invBinUid: int, invMastUid: int, itemId: string, locationId: float, bin: string, quantity: float, dateCreated: AttributeGroupsAttributesListItemDateCreated|null, dateLastModified: AttributeGroupsAttributesListItemDateCreated|null, lastMaintainedBy: string}
 * @phpstan-type AttributeGroupsAttributesListItemDateCreated array{date: string, timezone_type: int, timezone: string}
 */
final class LocationsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /locations/{locationId}/bins
     *
     * List all items in bins at a location
     * Call: $api->items->locations->listBins($locationId)
     *
     * Response data, each item: One bin of an item at a location, as InvBinHelper::generateDoc
     * builds it
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an inv_bin column.
     *
     * GET https://items.augur-api.com/locations/{locationId}/bins
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1locations~1{locationId}~1bins/get
     *
     * Query params ($params; `?` = optional):
     *   bin?: string — bin identifier to filter by
     *   excludeZero?: string — Exclude bins with zero quantity [Y|N], defaults to Y
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: inv_bin_uid|ASC)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastLocationsBinsListItem (fields listed on the class)
     *
     * @param int $locationId location.location_id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listBins(int $locationId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{locationId}/bins',
            $params,
            ['locationId' => (string) $locationId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /locations/{locationId}/bins/{bin}
     *
     * List all items in a specific bin
     * Call: $api->items->locations->getBins($locationId, $bin)
     *
     * Response data, each item: One bin of an item at a location, as InvBinHelper::generateDoc
     * builds it
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an inv_bin column.
     *
     * GET https://items.augur-api.com/locations/{locationId}/bins/{bin}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1locations~1{locationId}~1bins~1{bin}/get
     *
     * Query params ($params; `?` = optional):
     *   excludeZero?: string — Exclude bins with zero quantity [Y|N], defaults to Y
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: inv_bin_uid|ASC)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastLocationsBinsListItem (fields listed on the class)
     *
     * @param int $locationId location.location_id
     * @param string $bin bin identifier
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function getBins(int $locationId, string $bin, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{locationId}/bins/{bin}',
            $params,
            ['locationId' => (string) $locationId, 'bin' => (string) $bin],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
