<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * postalCodesXShiptos resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-site.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-site.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-site.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * PostalCodesXShiptosListItem:
 * Returned by: $api->agrSite->postalCodesXShiptos->list()
 * Returned by: $api->agrSite->postalCodesXShiptos->create($data)
 * Returned by: $api->agrSite->postalCodesXShiptos->get($postalCodesXShiptosUid)
 * Returned by: $api->agrSite->postalCodesXShiptos->update($postalCodesXShiptosUid, $data)
 * Returned by: $api->agrSite->postalCodesXShiptos->delete($postalCodesXShiptosUid)
 *   postalCodesXShiptosUid: int — Postal code to ship-to link ID
 *   postalCode: string — Postal code (max 20 chars)
 *   shipToId: float — Prophet 21 ship-to ID
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * PostalCodesXShiptosCreateBody: Link a postal code to a Prophet 21 ship-to
 * Request body of: $api->agrSite->postalCodesXShiptos->create($data)
 *   postalCode?: string|null — Postal code
 *   shipToId?: float|null — Prophet 21 ship-to ID
 *
 * PostalCodesXShiptosUpdateBody: Partial update of a postal code to ship-to link; an absent or
 * empty field keeps its current value
 * Request body of: $api->agrSite->postalCodesXShiptos->update($postalCodesXShiptosUid, $data)
 *   postalCode?: string|null — Postal code
 *   shipToId?: float|null — Prophet 21 ship-to ID
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted); other values
 *       are ignored
 *   processCd?: int|null — Process code (704 = Active, 1185 = Import Complete); other values are
 *       ignored
 *   updateCd?: int|null — Update code (1185 = Import Complete); other values are ignored
 *
 * @phpstan-type PostalCodesXShiptosListItem array{postalCodesXShiptosUid: int, postalCode: string, shipToId: float, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type PostalCodesXShiptosCreateBody array{postalCode?: string|null, shipToId?: float|null}
 * @phpstan-type PostalCodesXShiptosUpdateBody array{postalCode?: string|null, shipToId?: float|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 */
final class PostalCodesXShiptosResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /postal-codes-x-shiptos
     *
     * List Postal Codes X Ship Tos
     * Call: $api->agrSite->postalCodesXShiptos->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a postal_codes_x_shiptos column.
     *
     * GET https://agr-site.augur-api.com/postal-codes-x-shiptos
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1postal-codes-x-shiptos/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: postal_codes_x_shiptos_uid|ASC)
     *   q?: string — Search by postal code
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of PostalCodesXShiptosListItem (fields listed on the class)
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
     * POST /postal-codes-x-shiptos
     *
     * Create Postal Code X Ship To
     * Call: $api->agrSite->postalCodesXShiptos->create($data)
     *
     * Request body: Link a postal code to a Prophet 21 ship-to
     *
     * Success status: 201 (not 200)
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://agr-site.augur-api.com/postal-codes-x-shiptos
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1postal-codes-x-shiptos/post
     *
     * Request body ($data): PostalCodesXShiptosCreateBody (fields listed on the class)
     *
     * Response data type: PostalCodesXShiptosListItem (fields listed on the class)
     *
     * @param PostalCodesXShiptosCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /postal-codes-x-shiptos/{postalCodesXShiptosUid}
     *
     * Soft Delete Postal Code X Ship To
     * Call: $api->agrSite->postalCodesXShiptos->delete($postalCodesXShiptosUid)
     *
     * Errors:
     *   404: No postal code ship-to link with this ID.
     *
     * DELETE https://agr-site.augur-api.com/postal-codes-x-shiptos/{postalCodesXShiptosUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1postal-codes-x-shiptos~1{postalCodesXShiptosUid}/delete
     *
     * Response data type: PostalCodesXShiptosListItem (fields listed on the class)
     *
     * @param int $postalCodesXShiptosUid Postal code to ship-to link ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $postalCodesXShiptosUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{postalCodesXShiptosUid}',
            ['postalCodesXShiptosUid' => (string) $postalCodesXShiptosUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /postal-codes-x-shiptos/{postalCodesXShiptosUid}
     *
     * Get Postal Code X Ship To Details
     * Call: $api->agrSite->postalCodesXShiptos->get($postalCodesXShiptosUid)
     *
     * Errors:
     *   404: No postal code ship-to link with this ID.
     *
     * GET https://agr-site.augur-api.com/postal-codes-x-shiptos/{postalCodesXShiptosUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1postal-codes-x-shiptos~1{postalCodesXShiptosUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: PostalCodesXShiptosListItem (fields listed on the class)
     *
     * @param int $postalCodesXShiptosUid Postal code to ship-to link ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $postalCodesXShiptosUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{postalCodesXShiptosUid}',
            $params,
            ['postalCodesXShiptosUid' => (string) $postalCodesXShiptosUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /postal-codes-x-shiptos/{postalCodesXShiptosUid}
     *
     * Update Postal Code X Ship To
     * Call: $api->agrSite->postalCodesXShiptos->update($postalCodesXShiptosUid, $data)
     *
     * Request body: Partial update of a postal code to ship-to link; an absent or empty field keeps
     * its current value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No postal code ship-to link with this ID.
     *
     * PUT https://agr-site.augur-api.com/postal-codes-x-shiptos/{postalCodesXShiptosUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1postal-codes-x-shiptos~1{postalCodesXShiptosUid}/put
     *
     * Request body ($data): PostalCodesXShiptosUpdateBody (fields listed on the class)
     *
     * Response data type: PostalCodesXShiptosListItem (fields listed on the class)
     *
     * @param int $postalCodesXShiptosUid Postal code to ship-to link ID
     * @param PostalCodesXShiptosUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $postalCodesXShiptosUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{postalCodesXShiptosUid}',
            $data,
            ['postalCodesXShiptosUid' => (string) $postalCodesXShiptosUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
