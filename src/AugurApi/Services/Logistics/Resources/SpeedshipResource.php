<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * speedship resource — generated from spec.
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
 */
final class SpeedshipResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /speedship/freight
     *
     * Get Speedship Freight
     * Call: $api->logistics->speedship->listFreight()
     *
     * GET https://logistics.augur-api.com/speedship/freight
     * Contract: https://logistics.augur-api.com/openapi.json#/paths/~1speedship~1freight/get
     *
     * Query params ($params; `?` = optional):
     *   commodityClass?: string — (Optional, LTL only) NMFC freight class of the shipped items
     *       (Default: 55)
     *   commodityDescription?: string — (Optional, LTL only) Description of the shipped items
     *       (Default: General Merchandise)
     *   deliveryInstructions?: string — (Optional) Special instructions for delivery(LTL only)
     *   dimensionUnit: string — (Required) Dimension unit (IN)
     *   fromAddressLine: string — (Required) From address line
     *   fromCity: string — (Required) From city
     *   fromCompanyName: string — (Required) From company name
     *   fromCountryCode: string — (Required) From country code
     *   fromFirstName: string — (Required) From first name
     *   fromLastName: string — (Required) From last name
     *   fromPhone: string — (Required) From phone
     *   fromPostalCode: string — (Required) From postal code
     *   fromState: string — (Required) From state
     *   handlingCharge?: float — (Optional) Handling charge amount
     *   handlingChargeUnit?: string — (Optional) Handling charge unit (PERCENT|AMOUNT)
     *   international?: bool — (Optional) International flag
     *   isHazMat?: string — (Optional, LTL only) Hazardous materials flag: any non-empty value
     *       other than 0 marks the shipment hazardous (Default: not hazardous)
     *   maxPalletWeight?: int — Max weight per pallet in pounds; splits the shipment into multiple
     *       handling units when set (omit for a single pallet)
     *   packageHeight?: float — (Optional) Package height (IN)
     *   packageLength: float — (Required) Package length (IN)
     *   packageWidth: float — (Required) Package width (IN)
     *   packagingType?: string — (Optional) Handling unit packaging type code (Default: PLT for
     *       LTL, 02 for SMALLPACK)
     *   pickupInstructions?: string — (Optional) Special instructions for pickup(LTL only)
     *   productType: string — (Required) Product type (Default: LTL) | SMALLPACK
     *   quantity: float — (Required) Packaging handling unit (Default: 1)
     *   responseFormat: string — (Required) Response format (summary | detailed | cheapest |
     *       vendor)
     *   toAddressLine: string — (Required) To address line
     *   toCity: string — (Required) To city
     *   toCompanyName: string — (Required) To company name
     *   toCountryCode: string — (Required) To country code
     *   toFirstName: string — (Required) To first name
     *   toLastName: string — (Required) To last name
     *   toPhone: string — (Required) To phone
     *   toPostalCode: string — (Required) To postal code
     *   toState?: string — Destination state or province code, sent to Speedship as the destination
     *       region
     *   totalWeight: float — (Required) Total weight of the shipment (LB)
     *   vendorId?: string — Speedship vendor (carrier) id to return; used only with
     *       responseFormat=vendor and productType=LTL
     *   weightUnit: string — (Required) Weight unit (LB)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listFreight(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/freight', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
