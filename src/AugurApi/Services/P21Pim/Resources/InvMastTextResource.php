<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMastText resource — generated from spec.
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
 * InvMastTextListItem:
 * Returned by: $api->p21Pim->invMastText->list()
 * Returned by: $api->p21Pim->invMastText->create($data)
 * Returned by: $api->p21Pim->invMastText->get($invMastTextUid)
 * Returned by: $api->p21Pim->invMastText->update($invMastTextUid, $data)
 * Returned by: $api->p21Pim->invMastText->delete($invMastTextUid)
 *   invMastTextUid: int — Item text ID
 *   invMastUid: int — Item (inv_mast) the text belongs to
 *   sequenceNo: int — Display order among the item texts
 *   textValue: string — The text (max 2147483647 chars)
 *   displayOnWebFlag: string — Y to show the text on the web (max 1 chars)
 *   webDisplayTypeUid: int — Web display type the text is shown as
 *   textTypeCd: int — Prophet 21 text type code (2296 = HTML Document Text)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * InvMastTextCreateBody: Set an item's text for one web display type
 * Request body of: $api->p21Pim->invMastText->create($data)
 *   invMastUid: int|null — Item (inv_mast) the text belongs to; required
 *   webDisplayTypeUid: int|null — Web display type the text is shown as; required
 *   textValue: string|null — The text; required and not blank
 *   displayOnWebFlag?: string|null — Y to show the text on the web; defaults to Y
 *   textTypeCd?: int|null — Prophet 21 text type code; defaults to 2296 (HTML Document Text)
 *
 * InvMastTextUpdateBody: Partial update of an item text; an absent field keeps its current value
 * Request body of: $api->p21Pim->invMastText->update($invMastTextUid, $data)
 *   textValue?: string|null — The text; a blank value keeps the current text
 *   displayOnWebFlag?: string|null — Y to show the text on the web
 *   textTypeCd?: int|null — Prophet 21 text type code
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted); an invalid
 *       code is ignored
 *
 * @phpstan-type InvMastTextListItem array{invMastTextUid: int, invMastUid: int, sequenceNo: int, textValue: string, displayOnWebFlag: string, webDisplayTypeUid: int, textTypeCd: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type InvMastTextCreateBody array{invMastUid: int|null, webDisplayTypeUid: int|null, textValue: string|null, displayOnWebFlag?: string|null, textTypeCd?: int|null}
 * @phpstan-type InvMastTextUpdateBody array{textValue?: string|null, displayOnWebFlag?: string|null, textTypeCd?: int|null, statusCd?: int|null}
 */
final class InvMastTextResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast-text
     *
     * List Inv Mast Text
     * Call: $api->p21Pim->invMastText->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an inv_mast_text column.
     *
     * GET https://p21-pim.augur-api.com/inv-mast-text
     * Contract: https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-text/get
     *
     * Query params ($params; `?` = optional):
     *   invMastUid?: int — Filter to one item (inv_mast)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: inv_mast_text_uid|ASC)
     *   statusCd?: int — Status Code (status_cd) [(704)|(705)|(700)]
     *   webDisplayTypeUid?: int — Filter to one web display type
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvMastTextListItem (fields listed on the class)
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
     * POST /inv-mast-text
     *
     * Create Inv Mast Text
     * Call: $api->p21Pim->invMastText->create($data)
     *
     * Request body: Set an item's text for one web display type
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://p21-pim.augur-api.com/inv-mast-text
     * Contract: https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-text/post
     *
     * Request body ($data): InvMastTextCreateBody (fields listed on the class)
     *
     * Response data type: InvMastTextListItem (fields listed on the class)
     *
     * @param InvMastTextCreateBody $data
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
     * DELETE /inv-mast-text/{invMastTextUid}
     *
     * DELETE Inv Mast Text
     * Call: $api->p21Pim->invMastText->delete($invMastTextUid)
     *
     * Errors:
     *   404: No item text with this ID.
     *
     * DELETE https://p21-pim.augur-api.com/inv-mast-text/{invMastTextUid}
     * Contract:
     * https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-text~1{invMastTextUid}/delete
     *
     * Response data type: InvMastTextListItem (fields listed on the class)
     *
     * @param int $invMastTextUid Item text ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $invMastTextUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastTextUid}',
            ['invMastTextUid' => (string) $invMastTextUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast-text/{invMastTextUid}
     *
     * Get Inv Mast Text Details
     * Call: $api->p21Pim->invMastText->get($invMastTextUid)
     *
     * Errors:
     *   404: No item text with this ID.
     *
     * GET https://p21-pim.augur-api.com/inv-mast-text/{invMastTextUid}
     * Contract:
     * https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-text~1{invMastTextUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: InvMastTextListItem (fields listed on the class)
     *
     * @param int $invMastTextUid Item text ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastTextUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastTextUid}',
            $params,
            ['invMastTextUid' => (string) $invMastTextUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-mast-text/{invMastTextUid}
     *
     * Update Inv Mast Text
     * Call: $api->p21Pim->invMastText->update($invMastTextUid, $data)
     *
     * Request body: Partial update of an item text; an absent field keeps its current value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No item text with this ID.
     *
     * PUT https://p21-pim.augur-api.com/inv-mast-text/{invMastTextUid}
     * Contract:
     * https://p21-pim.augur-api.com/openapi.json#/paths/~1inv-mast-text~1{invMastTextUid}/put
     *
     * Request body ($data): InvMastTextUpdateBody (fields listed on the class)
     *
     * Response data type: InvMastTextListItem (fields listed on the class)
     *
     * @param int $invMastTextUid Item text ID
     * @param InvMastTextUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invMastTextUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastTextUid}',
            $data,
            ['invMastTextUid' => (string) $invMastTextUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
