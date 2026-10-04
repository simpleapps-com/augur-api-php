<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * fedex resource — generated from spec.
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
 * FedexRatesListItem: One carrier service rate quoted by the FedEx or UPS rate API
 * Returned by: $api->logistics->fedex->listRates()
 *   serviceCode: string — Carrier service code (UPS `03`, FedEx `FEDEX_GROUND`); unique within one
 *       response
 *   serviceName: string — Carrier service display name
 *   billingWeight: float — Weight the carrier bills, in pounds
 *   transportationCharges: float — List base charge before service options
 *   serviceOptionsCharges: float — List charges for service options (surcharges), never below zero
 *   totalCharges: float — List total charge for the service
 *   negotiatedRates: float — Account (negotiated) total charge; 0 when the account has none
 *   transitDays?: int|null — Business days in transit, 0 when the carrier gave no estimate; the key
 *       is absent unless includeTransitTime=Y
 *   estimatedDeliveryDate?: string|null — Estimated delivery date (Y-m-d), empty when the carrier
 *       gave no estimate; the key is absent unless includeTransitTime=Y
 *   deliveryBy?: string|null — Estimated delivery time of day (H:i:s), empty when the carrier gave
 *       no estimate; the key is absent unless includeTransitTime=Y
 *
 * @phpstan-type FedexRatesListItem array{serviceCode: string, serviceName: string, billingWeight: float, transportationCharges: float, serviceOptionsCharges: float, totalCharges: float, negotiatedRates: float, transitDays?: int|null, estimatedDeliveryDate?: string|null, deliveryBy?: string|null}
 */
final class FedexResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /fedex/rates
     *
     * Get FedEx Shipping Rates
     * Call: $api->logistics->fedex->listRates()
     *
     * Response data, each item: One carrier service rate quoted by the FedEx or UPS rate API
     *
     * GET https://logistics.augur-api.com/fedex/rates
     * Contract: https://logistics.augur-api.com/openapi.json#/paths/~1fedex~1rates/get
     *
     * Query params ($params; `?` = optional):
     *   fromAddress1: string — From address line 1
     *   fromCity: string — Origin (ship-from) city name
     *   fromCountryCode?: string — From country code (default: US)
     *   fromPostalCode: string — Origin (ship-from) postal or ZIP code
     *   fromStateProvinceCode: string — Origin (ship-from) two-letter state or province code
     *   includeTransitTime?: string — Include transitDays, estimatedDeliveryDate and deliveryBy per
     *       service [Y|N] (Default: N)
     *   toAddress1: string — To address line 1
     *   toCity: string — Destination (ship-to) city name
     *   toCountryCode?: string — To country code (default: US)
     *   toPostalCode: string — Destination (ship-to) postal or ZIP code
     *   toResidential?: string — Residential destination flag: true or 1 marks the ship-to address
     *       residential; anything else, or absent, is commercial
     *   toStateProvinceCode: string — Destination (ship-to) two-letter state or province code
     *   weight: int — Package weight in pounds
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of FedexRatesListItem (fields listed on the class)
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
}
