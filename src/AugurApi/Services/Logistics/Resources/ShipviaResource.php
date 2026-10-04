<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * shipvia resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://logistics.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://logistics.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://logistics.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py logistics
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ShipviaRatesListItem: One carrier rate quoted by the ShipVia rate inquiry
 * Returned by: $api->logistics->shipvia->listRates()
 * Returned by: $api->logistics->shipvia->listRatesLtl()
 *   carrier: string — Carrier code as ShipVia reports it (UPS, FEDEX, FEDEX_FREIGHT); empty when
 *       ShipVia sent none
 *   service: string — Carrier service name; empty when ShipVia sent none
 *   serviceLevel: string — Service level (ground, express, overnight); empty when ShipVia sent none
 *   totalCost: float — Total quoted cost, 0 when ShipVia sent no numeric value
 *   transitDays: int — Days in transit, 0 when ShipVia sent no numeric value
 *   estimatedDeliveryDate: string — Estimated delivery date as ShipVia formats it; empty when
 *       ShipVia sent none
 *   currency: string — Currency of totalCost (Default: USD)
 *
 * @phpstan-type ShipviaRatesListItem array{carrier: string, service: string, serviceLevel: string, totalCost: float, transitDays: int, estimatedDeliveryDate: string, currency: string}
 */
final class ShipviaResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /shipvia/rates
     *
     * Get ShipVia multi-carrier shipping rates
     * Call: $api->logistics->shipvia->listRates()
     *
     * Get ShipVia shipping rates from multiple carriers
     *
     * Response data, each item: One carrier rate quoted by the ShipVia rate inquiry
     *
     * GET https://logistics.augur-api.com/shipvia/rates
     * Contract: https://logistics.augur-api.com/openapi.json#/paths/~1shipvia~1rates/get
     *
     * Query params ($params; `?` = optional):
     *   carriers?: string — (Optional) Carrier filter: "standard" for UPS/FedEx/USPS, "UPS,FEDEX"
     *       for specific carriers, or omit for all carriers
     *   dimensionUnit?: string — (Optional) Dimension unit (IN or CM)
     *   fromCity?: string — (Optional) Origin city
     *   fromCountry?: string — (Optional) Origin country code (2-letter, default: US)
     *   fromPostalCode: string — (Required) Origin postal/ZIP code
     *   fromState?: string — (Optional) Origin state/province (2-letter code)
     *   locationId: int — (Required) ShipVia location ID
     *   packageHeight?: float — (Optional) Package height
     *   packageLength?: float — (Optional) Package length
     *   packageWidth?: float — (Optional) Package width
     *   residential?: bool — (Optional) Residential delivery flag (default: true)
     *   serviceType?: string — (Optional) Service type filter: ground, express, or overnight
     *   toCity?: string — (Optional) Destination city
     *   toCountry?: string — (Optional) Destination country code (2-letter, default: US)
     *   toPostalCode: string — (Required) Destination postal/ZIP code
     *   toState?: string — (Optional) Destination state/province (2-letter code)
     *   totalWeight: float — (Required) Total package weight
     *   weightUnit: string — (Required) Weight unit (LBS or KG)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ShipviaRatesListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listRates(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/rates', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /shipvia/rates/ltl
     *
     * Get ShipVia LTL freight rates
     * Call: $api->logistics->shipvia->listRatesLtl()
     *
     * Get ShipVia LTL (Less-Than-Truckload) freight rates from multiple carriers
     *
     * Response data, each item: One carrier rate quoted by the ShipVia rate inquiry
     *
     * GET https://logistics.augur-api.com/shipvia/rates/ltl
     * Contract: https://logistics.augur-api.com/openapi.json#/paths/~1shipvia~1rates~1ltl/get
     *
     * Query params ($params; `?` = optional):
     *   carriers?: string — (Optional) Carrier filter: "standard" for major LTL carriers,
     *       "FEDEX_FREIGHT,UPS_FREIGHT" for specific carriers, or omit for all LTL carriers
     *   commodityClass: string — (Required) NMFC freight class: 50, 55, 60, 65, 70, 77.5, 85, 92.5,
     *       100, 110, 125, 150, 175, 200, 250, 300, 400, 500
     *   commodityDescription: string — (Required) Description of commodity being shipped
     *   deliveryInstructions?: string — (Optional) Special delivery instructions (liftgate, inside
     *       delivery, etc.)
     *   dimensionUnit?: string — (Optional) Dimension unit (IN or CM, default: IN)
     *   fromCity?: string — (Optional) Origin city
     *   fromCountry?: string — (Optional) Origin country code (2-letter, default: US)
     *   fromPostalCode: string — (Required) Origin postal/ZIP code
     *   fromState?: string — (Optional) Origin state/province (2-letter code)
     *   isHazMat?: bool — (Optional) Hazardous materials flag (default: false)
     *   locationId: int — (Required) ShipVia location ID
     *   packageHeight?: float — (Optional) Freight height
     *   packageLength?: float — (Optional) Freight length
     *   packageWidth?: float — (Optional) Freight width
     *   packagingType: string — (Required) Packaging type: PALLET, CRATE, CARTON, DRUM, BUNDLE,
     *       BAG, BOX, SKID
     *   pickupInstructions?: string — (Optional) Special pickup instructions (liftgate required,
     *       loading dock, etc.)
     *   quantity?: int — (Optional) Number of handling units (default: 1)
     *   toCity?: string — (Optional) Destination city
     *   toCountry?: string — (Optional) Destination country code (2-letter, default: US)
     *   toPostalCode: string — (Required) Destination postal/ZIP code
     *   toState?: string — (Optional) Destination state/province (2-letter code)
     *   totalWeight: float — (Required) Total freight weight (typically 150+ lbs)
     *   weightUnit: string — (Required) Weight unit (LBS or KG)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ShipviaRatesListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listRatesLtl(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/rates/ltl', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
