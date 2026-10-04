<?php

declare(strict_types=1);

namespace AugurApi\Services\Shipping\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * rates resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://shipping.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://shipping.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://shipping.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py shipping
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * RatesCreateItem:
 * Returned by: $api->shipping->rates->create($data)
 *   shipperName: string — Carrier the rate came from, e.g. fedex or ups (max 255 chars)
 *   serviceType: string — Carrier service code, e.g. FEDEX_GROUND (max 255 chars)
 *   serviceName: string|null — Carrier service display name (max 255 chars)
 *   billingWeight: float — Weight the carrier billed on; not set by POST /rates (always 0)
 *   listAmount: float — Published list rate
 *   accountAmount: float|null — Rate for the site's own carrier account
 *
 * RatesCreateBody: Rate a package across one or more carriers
 * Request body of: $api->shipping->rates->create($data)
 *   shippers: list<string> — Carrier names to rate (e.g. fedex, ups); each needs a config file for
 *       the site
 *   fromAddress: RatesCreateBodyFromAddress — Ship-from address
 *   toAddress: RatesCreateBodyFromAddress — Ship-to address
 *   package: RatesCreateBodyPackage — Package being rated
 *
 * RatesCreateBodyFromAddress: Ship-from address
 * Field `fromAddress` of RatesCreateBody
 * Field `toAddress` of RatesCreateBody
 *   address1?: string — Street address line 1
 *   address2?: string — Street address line 2
 *   address3?: string — Street address line 3
 *   city?: string — City
 *   stateProvinceCode?: string — State or province code, e.g. OH
 *   postalCode?: string — Postal or ZIP code
 *   countryCode?: string — ISO country code; defaults to US
 *   residential?: bool — True for a residential delivery address
 *
 * RatesCreateBodyPackage: Package being rated
 * Field `package` of RatesCreateBody
 *   weight?: int — Package weight in whole pounds
 *
 * @phpstan-type RatesCreateItem array{shipperName: string, serviceType: string, serviceName: string|null, billingWeight: float, listAmount: float, accountAmount: float|null}
 * @phpstan-type RatesCreateBody array{shippers: list<string>, fromAddress: RatesCreateBodyFromAddress, toAddress: RatesCreateBodyFromAddress, package: RatesCreateBodyPackage}
 * @phpstan-type RatesCreateBodyFromAddress array{address1?: string, address2?: string, address3?: string, city?: string, stateProvinceCode?: string, postalCode?: string, countryCode?: string, residential?: bool}
 * @phpstan-type RatesCreateBodyPackage array{weight?: int}
 */
final class RatesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /rates
     *
     * Get Rates from POST
     * Call: $api->shipping->rates->create($data)
     *
     * Request body: Rate a package across one or more carriers
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://shipping.augur-api.com/rates
     * Contract: https://shipping.augur-api.com/openapi.json#/paths/~1rates/post
     *
     * Request body ($data): RatesCreateBody (fields listed on the class)
     *
     * Response data type: list of RatesCreateItem (fields listed on the class)
     *
     * @param RatesCreateBody $data
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
