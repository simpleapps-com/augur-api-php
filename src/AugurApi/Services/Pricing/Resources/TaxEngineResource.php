<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * taxEngine resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://pricing.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://pricing.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://pricing.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py pricing
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * TaxEngineCreateData: Sales tax estimate for a set of items shipped to one postal code
 * Returned by: $api->pricing->taxEngine->create($data)
 *   taxEstimate: float — Total estimated tax across all items
 *   customerId: int — P21 customer ID the items were priced for
 *   postalCode: string — Postal code the tax rate was looked up for, exactly as sent (leading zeros
 *       kept)
 *   taxRate: float — Tax rate applied, as a fraction (0.089 = 8.9%)
 *   items: list<TaxEngineCreateDataItemsItem> — Per-item tax estimates
 *     each item: TaxEngineCreateDataItemsItem — Tax estimate for one item
 *
 * TaxEngineCreateDataItemsItem: Tax estimate for one item
 * Field `items` of TaxEngineCreateData
 *   itemId: string — P21 item ID
 *   invMastUid: int — Inventory master UID, 0 when the item was not found
 *   quantity: float — Quantity taxed
 *   unitOfMeasure: string|null — Unit of measure the unit price is expressed in
 *   unitPrice: float|false — Unit price taxed, from the request or the price engine
 *   taxEstimate: float — Estimated tax for this item (quantity x unit price x tax rate)
 *
 * TaxEngineCreateBody: Items to estimate sales tax for, shipped to one postal code
 * Request body of: $api->pricing->taxEngine->create($data)
 *   customerId: int — P21 customer ID used to price items that carry no unitPrice
 *   postalCode: string — Destination postal code the tax rate is looked up by
 *   items: list<TaxEngineCreateBodyItemsItem> — Items to estimate tax for
 *     each item: TaxEngineCreateBodyItemsItem — One item to estimate tax for
 *
 * TaxEngineCreateBodyItemsItem: One item to estimate tax for
 * Field `items` of TaxEngineCreateBody
 *   itemId: string — P21 item ID
 *   quantity?: float — Quantity to tax, defaults to 1
 *   unitOfMeasure?: string|null — Unit of measure; defaults to the item's default selling unit
 *   unitPrice?: float|null — Unit price to tax; when absent or 0 the price engine prices the item
 *
 * @phpstan-type TaxEngineCreateData array{taxEstimate: float, customerId: int, postalCode: string, taxRate: float, items: list<TaxEngineCreateDataItemsItem>}
 * @phpstan-type TaxEngineCreateDataItemsItem array{itemId: string, invMastUid: int, quantity: float, unitOfMeasure: string|null, unitPrice: float|false, taxEstimate: float}
 * @phpstan-type TaxEngineCreateBody array{customerId: int, postalCode: string, items: list<TaxEngineCreateBodyItemsItem>}
 * @phpstan-type TaxEngineCreateBodyItemsItem array{itemId: string, quantity?: float, unitOfMeasure?: string|null, unitPrice?: float|null}
 */
final class TaxEngineResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /tax-engine
     *
     * Estimate Sales Tax
     * Call: $api->pricing->taxEngine->create($data)
     *
     * Estimate sales tax for a list of items shipped to one postal code; items without a unitPrice
     * are priced through the price engine for the customer
     *
     * Request body: Items to estimate sales tax for, shipped to one postal code
     * Response data: Sales tax estimate for a set of items shipped to one postal code
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or Request body is required with postalCode
     *       and items array. Or A required body field is missing or has the wrong type.
     *
     * POST https://pricing.augur-api.com/tax-engine
     * Contract: https://pricing.augur-api.com/openapi.json#/paths/~1tax-engine/post
     *
     * Request body ($data): TaxEngineCreateBody (fields listed on the class)
     *
     * Response data type: TaxEngineCreateData (fields listed on the class)
     *
     * @param TaxEngineCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
