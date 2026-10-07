<?php

declare(strict_types=1);

namespace AugurApi\Services\SmartyStreets\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * us resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://smarty-streets.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path,
 *       path params and query params, each with type and required flag. Grep it for a path; for a
 *       GET that line is all you need. Bodies are not in it.
 *   https://smarty-streets.augur-api.com/openapi.json: the full contract: request and response
 *       bodies field by field, descriptions, formats and documented errors.
 *   https://smarty-streets.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py smarty-streets
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * UsLookupGetData: Best US street match for the queried address; fields Smarty does not return are
 * null
 * Returned by: $api->smartyStreets->us->getLookup()
 *   addressee: string|null — Recipient or firm name on the matched address
 *   buildingDefaultIndicator: string|null — Y when the match defaulted to the building rather than
 *       a unit
 *   carrierRoute: string|null — USPS carrier route code
 *   cityName: string|null — USPS preferred city name
 *   congressionalDistrict: string|null — Congressional district number
 *   defaultCityName: string|null — USPS default city name for the ZIP code
 *   deliveryLine1: string|null — Standardized first delivery line
 *   deliveryLine2: string|null — Standardized second delivery line
 *   deliveryPoint: string|null — Two-digit USPS delivery point
 *   deliveryPointBarcode: string|null — Full USPS delivery point barcode
 *   deliveryPointCheckDigit: string|null — Delivery point check digit
 *   elotSequence: string|null — eLOT sequence number
 *   elotSort: string|null — eLOT sort: A (ascending) or D (descending)
 *   extraSecondaryDesignator: string|null — Extra secondary designator, e.g. Ste
 *   extraSecondaryNumber: string|null — Extra secondary number
 *   inputId: string|null — Caller-supplied input ID echoed back
 *   isEwsMatch: bool|null — True when the address is on the USPS Early Warning System list
 *   lastLine: string|null — Standardized city, state and ZIP line
 *   latitude: float|null — Latitude of the matched address
 *   longitude: float|null — Longitude of the matched address
 *   obeyDst: bool|null — True when the address observes daylight saving time
 *   plus4Code: string|null — ZIP+4 add-on code
 *   pmbDesignator: string|null — Private mailbox designator
 *   pmbNumber: string|null — Private mailbox number
 *   precision: string|null — Geocode precision, e.g. Zip9
 *   primaryNumber: string|null — House or building number
 *   rdi: string|null — Residential Delivery Indicator: Residential or Commercial
 *   recordType: string|null — USPS record type, e.g. S (street) or H (highrise)
 *   secondaryDesignator: string|null — Secondary unit designator, e.g. Apt
 *   secondaryNumber: string|null — Secondary unit number
 *   stateAbbreviation: string|null — Two-letter state abbreviation
 *   streetName: string|null — Street name
 *   streetPostDirection: string|null — Street post-direction, e.g. N
 *   streetPreDirection: string|null — Street pre-direction, e.g. N
 *   streetSuffix: string|null — Street suffix, e.g. St
 *   timeZone: string|null — Time zone name, e.g. Eastern
 *   urbanization: string|null — Puerto Rico urbanization name
 *   utcOffset: float|null — Hours offset from UTC
 *   zipCode: string|null — Five-digit ZIP code
 *   zipType: string|null — ZIP code type, e.g. Standard or POBox
 *
 * @phpstan-type UsLookupGetData array{addressee: string|null, buildingDefaultIndicator: string|null, carrierRoute: string|null, cityName: string|null, congressionalDistrict: string|null, defaultCityName: string|null, deliveryLine1: string|null, deliveryLine2: string|null, deliveryPoint: string|null, deliveryPointBarcode: string|null, deliveryPointCheckDigit: string|null, elotSequence: string|null, elotSort: string|null, extraSecondaryDesignator: string|null, extraSecondaryNumber: string|null, inputId: string|null, isEwsMatch: bool|null, lastLine: string|null, latitude: float|null, longitude: float|null, obeyDst: bool|null, plus4Code: string|null, pmbDesignator: string|null, pmbNumber: string|null, precision: string|null, primaryNumber: string|null, rdi: string|null, recordType: string|null, secondaryDesignator: string|null, secondaryNumber: string|null, stateAbbreviation: string|null, streetName: string|null, streetPostDirection: string|null, streetPreDirection: string|null, streetSuffix: string|null, timeZone: string|null, urbanization: string|null, utcOffset: float|null, zipCode: string|null, zipType: string|null}
 */
final class UsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /us/lookup
     *
     * Lookup US Address
     * Call: $api->smartyStreets->us->getLookup()
     *
     * Response data: Best US street match for the queried address; fields Smarty does not return
     * are null
     *
     * Errors:
     *   404: No US address matched the lookup.
     *
     * GET https://smarty-streets.augur-api.com/us/lookup
     * Contract: https://smarty-streets.augur-api.com/openapi.json#/paths/~1us~1lookup/get
     *
     * Query params ($params; `?` = optional):
     *   address1?: string — Street address line 1 to verify (sent to Smarty as street)
     *   address2?: string — Street address line 2, e.g. suite or unit (sent to Smarty as street2)
     *   city?: string — City name of the address to verify
     *   postalCode?: string — ZIP code of the address to verify (sent to Smarty as zipCode)
     *   state?: string — State name or two-letter abbreviation of the address to verify
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: UsLookupGetData (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
