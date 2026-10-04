<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * geoCodesPostalCodes resource — generated from spec.
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
 * GeoCodesPostalCodesListItem:
 * Returned by: $api->agrSite->geoCodesPostalCodes->list()
 * Returned by: $api->agrSite->geoCodesPostalCodes->get($geoCodesPostalCodesUid)
 *   geoCodesPostalCodesUid: int — Postal code geo record ID
 *   countryCode: string — ISO country code (max 2 chars)
 *   postalCode: string — Postal code (max 20 chars)
 *   placeName: string — Place name (max 180 chars)
 *   adminName1: string — First-level region name (state) (max 100 chars)
 *   adminCode1: string — First-level region code (state) (max 20 chars)
 *   adminName2: string|null — Second-level region name (county) (max 100 chars)
 *   adminCode2: string|null — Second-level region code (county) (max 20 chars)
 *   adminName3: string|null — Third-level region name (max 100 chars)
 *   adminCode3: string|null — Third-level region code (max 20 chars)
 *   latitude: float — Latitude
 *   longitude: float — Longitude
 *   accuracy: int|null — Accuracy of the coordinates (1 = estimated, 6 = centroid)
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * @phpstan-type GeoCodesPostalCodesListItem array{geoCodesPostalCodesUid: int, countryCode: string, postalCode: string, placeName: string, adminName1: string, adminCode1: string, adminName2: string|null, adminCode2: string|null, adminName3: string|null, adminCode3: string|null, latitude: float, longitude: float, accuracy: int|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 */
final class GeoCodesPostalCodesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /geo-codes-postal-codes
     *
     * List Postal Codes
     * Call: $api->agrSite->geoCodesPostalCodes->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a geo_codes_postal_codes column.
     *
     * GET https://agr-site.augur-api.com/geo-codes-postal-codes
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1geo-codes-postal-codes/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: geo_codes_postal_codes_uid|ASC)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of GeoCodesPostalCodesListItem (fields listed on the class)
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
     * GET /geo-codes-postal-codes/{geoCodesPostalCodesUid}
     *
     * Get Postal Code Details
     * Call: $api->agrSite->geoCodesPostalCodes->get($geoCodesPostalCodesUid)
     *
     * Errors:
     *   404: No postal code geo record with this ID.
     *
     * GET https://agr-site.augur-api.com/geo-codes-postal-codes/{geoCodesPostalCodesUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1geo-codes-postal-codes~1{geoCodesPostalCodesUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: GeoCodesPostalCodesListItem (fields listed on the class)
     *
     * @param int $geoCodesPostalCodesUid Postal Code UID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $geoCodesPostalCodesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{geoCodesPostalCodesUid}',
            $params,
            ['geoCodesPostalCodesUid' => (string) $geoCodesPostalCodesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
