<?php

declare(strict_types=1);

namespace AugurApi\Services\Ups\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * ratesShop resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://ups.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://ups.augur-api.com/openapi.json: the full contract: request and response bodies field by
 *       field, descriptions, formats and documented errors.
 *   https://ups.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py ups
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * RatesShopListItem:
 * Returned by: $api->ups->ratesShop->list()
 *   serviceCode: string — UPS service code, e.g. 03 for UPS Ground (max 255 chars)
 *   serviceName: string|null — UPS service display name (max 255 chars)
 *   billingWeight: float — Weight UPS billed on
 *   billingWeightUom: string|null — Unit of measure for billing_weight; not set by GET /rates-shop
 *       (max 255 chars)
 *   guaranteedDaysToDelivery: int|null — Guaranteed business days to delivery; not set by GET
 *       /rates-shop
 *   scheduledDeliveryTime: string|null — Scheduled delivery time; not set by GET /rates-shop (max
 *       255 chars)
 *   transportationCharges: float|null — Transportation charge; only rates above zero are returned
 *   serviceOptionsCharges: float|null — Charges for added service options
 *   totalCharges: float — Total published charge
 *   negotiatedRates: float|null — Total negotiated charge for the site's UPS account
 *
 * @phpstan-type RatesShopListItem array{serviceCode: string, serviceName: string|null, billingWeight: float, billingWeightUom: string|null, guaranteedDaysToDelivery: int|null, scheduledDeliveryTime: string|null, transportationCharges: float|null, serviceOptionsCharges: float|null, totalCharges: float, negotiatedRates: float|null}
 */
final class RatesShopResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /rates-shop
     *
     * Shop UPS Rates
     * Call: $api->ups->ratesShop->list()
     *
     * GET https://ups.augur-api.com/rates-shop
     * Contract: https://ups.augur-api.com/openapi.json#/paths/~1rates-shop/get
     *
     * Query params ($params; `?` = optional):
     *   fromAddress1?: string — From Address Line 1
     *   fromAddress2?: string — From Address Line 2
     *   fromAddress3?: string — From Address Line 3
     *   fromCity?: string — Ship-from city
     *   fromCountryCode?: string — Ship-from ISO country code, e.g. US
     *   fromPostalCode?: string — Ship-from postal code
     *   fromStateProvinceCode?: string — Ship-from state or province code, e.g. TX
     *   toAddress1?: string — To Address Line 1
     *   toAddress2?: string — To Address Line 2
     *   toAddress3?: string — To Address Line 3
     *   toCity?: string — Ship-to city
     *   toCountryCode?: string — Ship-to ISO country code, e.g. US
     *   toPostalCode?: string — Ship-to postal code
     *   toStateProvinceCode?: string — Ship-to state or province code, e.g. TX
     *   weight?: int — Package weight in whole pounds (fractions are truncated)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of RatesShopListItem (fields listed on the class)
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
}
