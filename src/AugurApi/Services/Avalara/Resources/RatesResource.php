<?php

declare(strict_types=1);

namespace AugurApi\Services\Avalara\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * rates resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://avalara.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://avalara.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://avalara.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py avalara
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * RatesCreateBody: Tax estimate request: ship-to address plus order lines; snake_case keys are
 * still accepted
 * Request body of: $api->avalara->rates->create($data)
 *   address: RatesCreateBodyAddress|null — Ship-to address
 *   items: list<RatesCreateBodyItemsItem> — Order lines to tax
 *     each item: RatesCreateBodyItemsItem — One order line to tax
 *
 * RatesCreateBodyAddress: Ship-to address
 * Field `address` of RatesCreateBody
 *   line1: string|null — Ship-to street address line 1
 *   line2: string|null — Ship-to street address line 2 (empty string when unused)
 *   line3: string|null — Ship-to street address line 3 (empty string when unused)
 *   city: string|null — Ship-to city
 *   region: string|null — Ship-to state or province code, e.g. TX
 *   postalCode: string|null — Ship-to postal code
 *   countryCode: string|null — Ship-to ISO country code, e.g. US
 *
 * RatesCreateBodyItemsItem: One order line to tax
 * Field `items` of RatesCreateBody
 *   amount: float|null — Extended line total (unit price x quantity) sent to AvaTax
 *   quantity: float|null — Quantity ordered
 *   itemCode: string|null — Item identifier
 *   taxCode: string|null — AvaTax tax code (empty string for the default)
 *   unitPrice?: float|null — Accepted but ignored; tax is calculated from amount
 *
 * @phpstan-type RatesCreateBody array{address: RatesCreateBodyAddress|null, items: list<RatesCreateBodyItemsItem>}
 * @phpstan-type RatesCreateBodyAddress array{line1: string|null, line2: string|null, line3: string|null, city: string|null, region: string|null, postalCode: string|null, countryCode: string|null}
 * @phpstan-type RatesCreateBodyItemsItem array{amount: float|null, quantity: float|null, itemCode: string|null, taxCode: string|null, unitPrice?: float|null}
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
     * Call: $api->avalara->rates->create($data)
     *
     * Request body: Tax estimate request: ship-to address plus order lines; snake_case keys are
     * still accepted
     * Response data: Estimated total sales tax for the request
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://avalara.augur-api.com/rates
     * Contract: https://avalara.augur-api.com/openapi.json#/paths/~1rates/post
     *
     * Request body ($data): RatesCreateBody (fields listed on the class)
     *
     * Response data type: float
     *
     * @param RatesCreateBody $data
     * @return BaseResponse<float>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<float> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
