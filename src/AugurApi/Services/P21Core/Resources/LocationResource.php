<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * location resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://p21-core.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://p21-core.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://p21-core.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-core
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * LocationListItem: A Prophet 21 location, with its address when the caller asks for it
 * Returned by: $api->p21Core->location->list()
 * Returned by: $api->p21Core->location->get($locationId)
 *   locationId: float — Prophet 21 location ID (also its address ID)
 *   companyId: string — Prophet 21 company
 *   defaultBranchId: string|null — Default branch for the location
 *   deleteFlag: string — Y when the location is deleted in Prophet 21
 *   dateCreated: string — When the record was created (Y-m-d H:i:s)
 *   dateLastModified: string — When the record last changed (Y-m-d H:i:s)
 *   lastMaintainedBy: string — Prophet 21 user who last changed the record
 *   locationName: string|null — Location name
 *   lotBinIntegration: string|null — Y when lots are tracked by bin at the location
 *   fedexLocAcctNo: string|null — FedEx account number for the location
 *   fedexMeterNo: string|null — FedEx meter number for the location
 *   upsAccountNo: string|null — UPS account number for the location
 *   upsPickupTypeCd: int|null — Prophet 21 code for the UPS pickup type
 *   upsCustomerTypeCd: int|null — Prophet 21 code for the UPS customer type
 *   upsOltAccessKey: string|null — UPS OnLine Tools access key, as Prophet 21 stores it
 *   upsOltPassword: string|null — UPS OnLine Tools password, as Prophet 21 stores it
 *   upsOltUserId: string|null — UPS OnLine Tools user ID, as Prophet 21 stores it
 *   distributionCenter: string — Y when the location is a distribution center
 *   updateCd: int — Update code (704 = queued for refresh from Prophet 21, 1185 = current)
 *   address?: AddressListItem|null — The location's address; the key is absent unless
 *       includeAddress=Y
 *
 * AddressListItem: The location's address; the key is absent unless includeAddress=Y
 * Field `address` of LocationListItem
 *   id: float — Prophet 21 address ID
 *   name: string — Address name
 *   mailAddress1: string|null — Mailing address line 1
 *   mailAddress2: string|null — Mailing address line 2
 *   mailCity: string|null — Mailing city
 *   mailState: string|null — Mailing state or province
 *   mailPostalCode: string|null — Mailing postal code
 *   mailCountry: string|null — Mailing country
 *   physAddress1: string|null — Physical address line 1
 *   physAddress2: string|null — Physical address line 2
 *   physCity: string|null — Physical city
 *   physState: string|null — Physical state or province
 *   physPostalCode: string|null — Physical postal code
 *   physCountry: string|null — Physical country
 *   carrierFlag: string|null — Y when the address is a carrier
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code
 *   enabledCd: int — 704 when the address is enabled for the site, 705 when not
 *   defaultCd: int — 704 for the site's default address, 705 otherwise
 *
 * @phpstan-type LocationListItem array{locationId: float, companyId: string, defaultBranchId: string|null, deleteFlag: string, dateCreated: string, dateLastModified: string, lastMaintainedBy: string, locationName: string|null, lotBinIntegration: string|null, fedexLocAcctNo: string|null, fedexMeterNo: string|null, upsAccountNo: string|null, upsPickupTypeCd: int|null, upsCustomerTypeCd: int|null, upsOltAccessKey: string|null, upsOltPassword: string|null, upsOltUserId: string|null, distributionCenter: string, updateCd: int, address?: AddressListItem|null}
 * @phpstan-type AddressListItem array{id: float, name: string, mailAddress1: string|null, mailAddress2: string|null, mailCity: string|null, mailState: string|null, mailPostalCode: string|null, mailCountry: string|null, physAddress1: string|null, physAddress2: string|null, physCity: string|null, physState: string|null, physPostalCode: string|null, physCountry: string|null, carrierFlag: string|null, statusCd: int, processCd: int, enabledCd: int, defaultCd: int}
 */
final class LocationResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /location
     *
     * List Locations
     * Call: $api->p21Core->location->list()
     *
     * Response data, each item: A Prophet 21 location, with its address when the caller asks for it
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a location column.
     *
     * GET https://p21-core.augur-api.com/location
     * Contract: https://p21-core.augur-api.com/openapi.json#/paths/~1location/get
     *
     * Query params ($params; `?` = optional):
     *   deleteFlag?: string — Y for deleted locations, N for live ones
     *   includeAddress?: string — Y adds each location's address as an address key
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: location_id|ASC)
     *   q?: string — Search Query
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of LocationListItem (fields listed on the class)
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
     * GET /location/{locationId}
     *
     * Get Location Details
     * Call: $api->p21Core->location->get($locationId)
     *
     * Response data: A Prophet 21 location, with its address when the caller asks for it
     *
     * GET https://p21-core.augur-api.com/location/{locationId}
     * Contract: https://p21-core.augur-api.com/openapi.json#/paths/~1location~1{locationId}/get
     *
     * Query params ($params; `?` = optional):
     *   includeAddress?: string — Y adds the location's address as an address key
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: LocationListItem (fields listed on the class)
     *
     * @param float $locationId Prophet 21 location ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(float $locationId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{locationId}',
            $params,
            ['locationId' => (string) $locationId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
