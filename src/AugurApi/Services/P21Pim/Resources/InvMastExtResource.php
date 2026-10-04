<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMastExt resource — generated from spec.
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
 * InvMastExtListItem:
 * Returned by: $api->p21Pim->invMastExt->list()
 * Returned by: $api->p21Pim->invMastExt->create($data)
 * Returned by: $api->p21Pim->invMastExt->get($invMastExtUid)
 * Returned by: $api->p21Pim->invMastExt->update($invMastExtUid, $data)
 * Returned by: $api->p21Pim->invMastExt->delete($invMastExtUid)
 *   invMastExtUid: int — Item extended content ID
 *   invMastUid: int — Item (inv_mast) the content belongs to
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   upcOrEan: string|null — Full UPC or EAN code (max 3 chars)
 *   upcOrEanId: string|null — UPC or EAN check identifier (max 15 chars)
 *   upcOrEanPrefix: string|null — UPC or EAN manufacturer prefix (max 9 chars)
 *   upcOrEanItem: string|null — UPC or EAN item reference (max 5 chars)
 *   attributeGroupUid: int|null — Attribute group the item belongs to
 *   brandName: string|null — Brand name (max 255 chars)
 *   manufacturerName: string|null — Manufacturer name (max 255 chars)
 *   partNumber: string|null — Manufacturer part number (max 255 chars)
 *   metaTitle: string|null — Page title for the item web page (max 255 chars)
 *   metaDescription: string|null — Meta description for the item web page (max 255 chars)
 *   metaKeywords: string|null — Meta keywords for the item web page (max 255 chars)
 *
 * InvMastExtCreateBody: Look up the inv_mast_ext row for an item
 * Request body of: $api->p21Pim->invMastExt->create($data)
 *   invMastUid: int — Item (inv_mast) whose extended row to return
 *
 * InvMastExtUpdateBody: Partial update of an item's extended content; an absent field keeps its
 * current value
 * Request body of: $api->p21Pim->invMastExt->update($invMastExtUid, $data)
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   upcOrEan?: string|null — Full UPC or EAN code
 *   upcOrEanId?: string|null — UPC or EAN check identifier
 *   upcOrEanPrefix?: string|null — UPC or EAN manufacturer prefix
 *   upcOrEanItem?: string|null — UPC or EAN item reference
 *   attributeGroupUid?: int|null — Attribute group the item belongs to
 *   brandName?: string|null — Brand name
 *   manufacturerName?: string|null — Manufacturer name
 *   partNumber?: string|null — Manufacturer part number
 *   metaTitle?: string|null — Page title for the item's web page
 *   metaDescription?: string|null — Meta description for the item's web page
 *   metaKeywords?: string|null — Meta keywords for the item's web page
 *
 * @phpstan-type InvMastExtListItem array{invMastExtUid: int, invMastUid: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, upcOrEan: string|null, upcOrEanId: string|null, upcOrEanPrefix: string|null, upcOrEanItem: string|null, attributeGroupUid: int|null, brandName: string|null, manufacturerName: string|null, partNumber: string|null, metaTitle: string|null, metaDescription: string|null, metaKeywords: string|null}
 * @phpstan-type InvMastExtCreateBody array{invMastUid: int}
 * @phpstan-type InvMastExtUpdateBody array{statusCd?: int|null, upcOrEan?: string|null, upcOrEanId?: string|null, upcOrEanPrefix?: string|null, upcOrEanItem?: string|null, attributeGroupUid?: int|null, brandName?: string|null, manufacturerName?: string|null, partNumber?: string|null, metaTitle?: string|null, metaDescription?: string|null, metaKeywords?: string|null}
 */
final class InvMastExtResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast-ext
     *
     * List Inv Mast Ext
     * Call: $api->p21Pim->invMastExt->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an inv_mast_ext column.
     *
     * GET https://p21-pim.augur-api.com/inv-mast-ext
     * Contract: https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-ext/get
     *
     * Query params ($params; `?` = optional):
     *   invMastUid?: int — Filter to one item (inv_mast)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: inv_mast_ext_uid|ASC)
     *   q?: string — Search Query
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastExtListItem (fields listed on the class)
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
     * POST /inv-mast-ext
     *
     * Create Inv Mast Ext
     * Call: $api->p21Pim->invMastExt->create($data)
     *
     * Request body: Look up the inv_mast_ext row for an item
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or invMastUid is missing.
     *
     * POST https://p21-pim.augur-api.com/inv-mast-ext
     * Contract: https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-ext/post
     *
     * Request body ($data): InvMastExtCreateBody (fields listed on the class)
     *
     * Response data type: InvMastExtListItem (fields listed on the class)
     *
     * @param InvMastExtCreateBody $data
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
     * DELETE /inv-mast-ext/{invMastExtUid}
     *
     * DELETE Inv Mast Ext
     * Call: $api->p21Pim->invMastExt->delete($invMastExtUid)
     *
     * Errors:
     *   404: No extended content with this ID.
     *
     * DELETE https://p21-pim.augur-api.com/inv-mast-ext/{invMastExtUid}
     * Contract:
     * https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-ext~1{invMastExtUid}/delete
     *
     * Response data type: InvMastExtListItem (fields listed on the class)
     *
     * @param int $invMastExtUid Item extended content ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $invMastExtUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastExtUid}',
            ['invMastExtUid' => (string) $invMastExtUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast-ext/{invMastExtUid}
     *
     * Get Inv Mast Ext Details
     * Call: $api->p21Pim->invMastExt->get($invMastExtUid)
     *
     * Errors:
     *   404: No extended content with this ID.
     *
     * GET https://p21-pim.augur-api.com/inv-mast-ext/{invMastExtUid}
     * Contract:
     * https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-ext~1{invMastExtUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: InvMastExtListItem (fields listed on the class)
     *
     * @param int $invMastExtUid Item extended content ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastExtUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastExtUid}',
            $params,
            ['invMastExtUid' => (string) $invMastExtUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-mast-ext/{invMastExtUid}
     *
     * Update Inv Mast Ext
     * Call: $api->p21Pim->invMastExt->update($invMastExtUid, $data)
     *
     * Request body: Partial update of an item's extended content; an absent field keeps its current
     * value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No extended content with this ID.
     *
     * PUT https://p21-pim.augur-api.com/inv-mast-ext/{invMastExtUid}
     * Contract:
     * https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-ext~1{invMastExtUid}/put
     *
     * Request body ($data): InvMastExtUpdateBody (fields listed on the class)
     *
     * Response data type: InvMastExtListItem (fields listed on the class)
     *
     * @param int $invMastExtUid Item extended content ID
     * @param InvMastExtUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invMastExtUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastExtUid}',
            $data,
            ['invMastExtUid' => (string) $invMastExtUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
