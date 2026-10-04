<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * webPricing resource — generated from spec.
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
 * WebPricingListItem:
 * Returned by: $api->pricing->webPricing->list()
 * Returned by: $api->pricing->webPricing->create($data)
 * Returned by: $api->pricing->webPricing->get($webPricingUid)
 * Returned by: $api->pricing->webPricing->update($webPricingUid, $data)
 * Returned by: $api->pricing->webPricing->delete($webPricingUid)
 *   webPricingUid: int — Web pricing rule unique ID
 *   name: string — Rule name shown to staff (max 255 chars)
 *   description: string|null — Optional free-text note about the rule (max 255 chars)
 *   dateCreated: string — When the rule was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the rule was last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted); only active rules
 *       apply
 *   updateCd: int — Update code
 *   processCd: int — Process code
 *   sequenceNo: int — Evaluation order, ascending; the first matching rule wins
 *   customerMode: string — Which customers the rule applies to: NONE or ALL (every customer), ONLY
 *       (listed customers), EXCEPT (everyone not listed) (max 255 chars)
 *   minQty: int|null — Minimum cart quantity for the rule to match; 0 or less means no lower bound
 *   maxQty: int|null — Maximum cart quantity for the rule to match; 0 or less means no upper bound
 *   discountPct: float — Percentage taken off the engine unit price (above 0, at most 100)
 *   effectiveDate: string|null — Start of the window the rule applies in (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   expirationDate: string|null — End of the window the rule applies in (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *
 * WebPricingCreateBody: Create a web pricing rule: a percentage discount off the price engine unit
 * price
 * Request body of: $api->pricing->webPricing->create($data)
 *   name: string|null — Rule name; required and MUST NOT be empty
 *   discountPct: float|null — Percentage taken off the engine unit price; required, above 0 and at
 *       most 100
 *   description?: string|null — Optional free-text note about the rule
 *   sequenceNo?: int|null — Evaluation order, ascending; the first matching rule wins (Default: 1)
 *   customerMode?: string|null — Which customers the rule applies to: NONE, ALL, ONLY or EXCEPT
 *       (Default: NONE)
 *   minQty?: int|null — Minimum cart quantity; 0 or less means no lower bound (Default: -1)
 *   maxQty?: int|null — Maximum cart quantity; 0 or less means no upper bound, and MUST NOT be
 *       below minQty (Default: -1)
 *   effectiveDate?: string|null — Start of the window the rule applies in (Default: now)
 *   expirationDate?: string|null — End of the window the rule applies in; MUST NOT be before
 *       effectiveDate (Default: 2049-12-31)
 *
 * WebPricingUpdateBody: Change a web pricing rule; only the fields sent are changed
 * Request body of: $api->pricing->webPricing->update($webPricingUid, $data)
 *   name?: string|null — Rule name; MUST NOT be empty when sent
 *   description?: string|null — Free-text note about the rule; sending null clears it
 *   sequenceNo?: int|null — Evaluation order, ascending; the first matching rule wins
 *   customerMode?: string|null — Which customers the rule applies to: NONE, ALL, ONLY or EXCEPT
 *   minQty?: int|null — Minimum cart quantity; 0 or less means no lower bound
 *   maxQty?: int|null — Maximum cart quantity; 0 or less means no upper bound, and MUST NOT be
 *       below minQty
 *   discountPct?: float|null — Percentage taken off the engine unit price; above 0 and at most 100
 *   effectiveDate?: string|null — Start of the window the rule applies in
 *   expirationDate?: string|null — End of the window the rule applies in; MUST NOT be before
 *       effectiveDate
 *   statusCd?: int|null — Status code: 704 (Active), 705 (Inactive) or 700 (Deleted)
 *
 * WebPricingCustomersListItem:
 * Returned by: $api->pricing->webPricing->listCustomers($webPricingUid)
 * Returned by: $api->pricing->webPricing->createCustomers($webPricingUid, $data)
 * Returned by: $api->pricing->webPricing->getCustomers($webPricingUid, $customerId)
 * Returned by: $api->pricing->webPricing->updateCustomers($webPricingUid, $customerId, $data)
 * Returned by: $api->pricing->webPricing->deleteCustomers($webPricingUid, $customerId)
 *   webPricingXCustomerUid: int — Customer assignment unique ID
 *   webPricingUid: int — Web pricing rule the customer is assigned to
 *   customerId: float — Prophet 21 customer assigned to the rule
 *   dateCreated: string — When the assignment was created (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — When the assignment was last changed (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted); only active
 *       assignments count
 *   updateCd: int — Update code
 *   processCd: int — Process code
 *
 * WebPricingCustomersCreateBody: Assign a customer to a web pricing rule whose customerMode is ONLY
 * or EXCEPT
 * Request body of: $api->pricing->webPricing->createCustomers($webPricingUid, $data)
 *   customerId: int|null — Prophet 21 customer to assign; required, a positive integer
 *
 * WebPricingCustomersUpdateBody: Change a customer assignment on a web pricing rule; the rule and
 * customer come from the path
 * Request body of: $api->pricing->webPricing->updateCustomers($webPricingUid, $customerId, $data)
 *   statusCd?: int|null — Status code: 704 (Active), 705 (Inactive) or 700 (Deleted); only active
 *       assignments count
 *
 * @phpstan-type WebPricingListItem array{webPricingUid: int, name: string, description: string|null, dateCreated: string, dateLastModified: string, statusCd: int, updateCd: int, processCd: int, sequenceNo: int, customerMode: string, minQty: int|null, maxQty: int|null, discountPct: float, effectiveDate: string|null, expirationDate: string|null}
 * @phpstan-type WebPricingCreateBody array{name: string|null, discountPct: float|null, description?: string|null, sequenceNo?: int|null, customerMode?: string|null, minQty?: int|null, maxQty?: int|null, effectiveDate?: string|null, expirationDate?: string|null}
 * @phpstan-type WebPricingUpdateBody array{name?: string|null, description?: string|null, sequenceNo?: int|null, customerMode?: string|null, minQty?: int|null, maxQty?: int|null, discountPct?: float|null, effectiveDate?: string|null, expirationDate?: string|null, statusCd?: int|null}
 * @phpstan-type WebPricingCustomersListItem array{webPricingXCustomerUid: int, webPricingUid: int, customerId: float, dateCreated: string, dateLastModified: string, statusCd: int, updateCd: int, processCd: int}
 * @phpstan-type WebPricingCustomersCreateBody array{customerId: int|null}
 * @phpstan-type WebPricingCustomersUpdateBody array{statusCd?: int|null}
 */
final class WebPricingResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /web-pricing
     *
     * List Web Pricing Rules
     * Call: $api->pricing->webPricing->list()
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field a web_pricing column.
     *
     * GET https://pricing.augur-api.com/web-pricing
     * Contract: https://pricing.augur-api.com/openapi.json#/paths/~1web-pricing/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: web_pricing_uid|ASC)
     *   statusCd?: int — Status Code (status_cd) [(704)|(705)|(700)]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of WebPricingListItem (fields listed on the class)
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
     * POST /web-pricing
     *
     * Create Web Pricing Rule
     * Call: $api->pricing->webPricing->create($data)
     *
     * Request body: Create a web pricing rule: a percentage discount off the price engine unit
     * price
     *
     * Success status: 201 (not 200)
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or The body failed validation; the message
     *       names the field.
     *
     * POST https://pricing.augur-api.com/web-pricing
     * Contract: https://pricing.augur-api.com/openapi.json#/paths/~1web-pricing/post
     *
     * Request body ($data): WebPricingCreateBody (fields listed on the class)
     *
     * Response data type: WebPricingListItem (fields listed on the class)
     *
     * @param WebPricingCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /web-pricing/{webPricingUid}
     *
     * Soft Delete Web Pricing Rule
     * Call: $api->pricing->webPricing->delete($webPricingUid)
     *
     * Errors:
     *   404: No record with this ID.
     *
     * DELETE https://pricing.augur-api.com/web-pricing/{webPricingUid}
     * Contract:
     * https://pricing.augur-api.com/openapi.json#/paths/~1web-pricing~1{webPricingUid}/delete
     *
     * Response data type: WebPricingListItem (fields listed on the class)
     *
     * @param int $webPricingUid Web pricing rule unique ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $webPricingUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{webPricingUid}',
            ['webPricingUid' => (string) $webPricingUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /web-pricing/{webPricingUid}
     *
     * Get Web Pricing Rule
     * Call: $api->pricing->webPricing->get($webPricingUid)
     *
     * Errors:
     *   404: No record with this ID.
     *
     * GET https://pricing.augur-api.com/web-pricing/{webPricingUid}
     * Contract:
     * https://pricing.augur-api.com/openapi.json#/paths/~1web-pricing~1{webPricingUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: WebPricingListItem (fields listed on the class)
     *
     * @param int $webPricingUid Web pricing rule unique ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $webPricingUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{webPricingUid}',
            $params,
            ['webPricingUid' => (string) $webPricingUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /web-pricing/{webPricingUid}
     *
     * Update Web Pricing Rule
     * Call: $api->pricing->webPricing->update($webPricingUid, $data)
     *
     * Request body: Change a web pricing rule; only the fields sent are changed
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or The body failed validation; the message
     *       names the field.
     *   404: No record with this ID.
     *
     * PUT https://pricing.augur-api.com/web-pricing/{webPricingUid}
     * Contract:
     * https://pricing.augur-api.com/openapi.json#/paths/~1web-pricing~1{webPricingUid}/put
     *
     * Request body ($data): WebPricingUpdateBody (fields listed on the class)
     *
     * Response data type: WebPricingListItem (fields listed on the class)
     *
     * @param int $webPricingUid Web pricing rule unique ID
     * @param WebPricingUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $webPricingUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{webPricingUid}',
            $data,
            ['webPricingUid' => (string) $webPricingUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /web-pricing/{webPricingUid}/customers
     *
     * List Web Pricing Customers
     * Call: $api->pricing->webPricing->listCustomers($webPricingUid)
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field a
     *       web_pricing_x_customer column.
     *   404: No record with this ID.
     *
     * GET https://pricing.augur-api.com/web-pricing/{webPricingUid}/customers
     * Contract:
     * https://pricing.augur-api.com/openapi.json#/paths/~1web-pricing~1{webPricingUid}~1customers/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: web_pricing_x_customer_uid|ASC)
     *   statusCd?: int — Status Code (status_cd) [(704)|(705)|(700)]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of WebPricingCustomersListItem (fields listed on the class)
     *
     * @param int $webPricingUid Web pricing rule whose customer assignments are addressed
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listCustomers(int $webPricingUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{webPricingUid}/customers',
            $params,
            ['webPricingUid' => (string) $webPricingUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /web-pricing/{webPricingUid}/customers
     *
     * Assign Web Pricing Customer
     * Call: $api->pricing->webPricing->createCustomers($webPricingUid, $data)
     *
     * Request body: Assign a customer to a web pricing rule whose customerMode is ONLY or EXCEPT
     *
     * Success status: 201 (not 200)
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or customerId is required and MUST be a
     *       positive integer. Or customer assignments apply only when the rule's customerMode is
     *       ONLY or EXCEPT.
     *   404: No record with this ID.
     *   409: customerId is already assigned to this web pricing rule.
     *
     * POST https://pricing.augur-api.com/web-pricing/{webPricingUid}/customers
     * Contract:
     * https://pricing.augur-api.com/openapi.json#/paths/~1web-pricing~1{webPricingUid}~1customers/post
     *
     * Request body ($data): WebPricingCustomersCreateBody (fields listed on the class)
     *
     * Response data type: WebPricingCustomersListItem (fields listed on the class)
     *
     * @param int $webPricingUid Web pricing rule whose customer assignments are addressed
     * @param WebPricingCustomersCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createCustomers(int $webPricingUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{webPricingUid}/customers',
            $data,
            ['webPricingUid' => (string) $webPricingUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /web-pricing/{webPricingUid}/customers/{customerId}
     *
     * Remove Web Pricing Customer
     * Call: $api->pricing->webPricing->deleteCustomers($webPricingUid, $customerId)
     *
     * Errors:
     *   404: No record with this ID.
     *
     * DELETE https://pricing.augur-api.com/web-pricing/{webPricingUid}/customers/{customerId}
     * Contract:
     * https://pricing.augur-api.com/openapi.json#/paths/~1web-pricing~1{webPricingUid}~1customers~1{customerId}/delete
     *
     * Response data type: WebPricingCustomersListItem (fields listed on the class)
     *
     * @param int $webPricingUid Web pricing rule whose customer assignments are addressed
     * @param int $customerId P21 customer ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteCustomers(int $webPricingUid, int $customerId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{webPricingUid}/customers/{customerId}',
            ['webPricingUid' => (string) $webPricingUid, 'customerId' => (string) $customerId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /web-pricing/{webPricingUid}/customers/{customerId}
     *
     * Get Web Pricing Customer
     * Call: $api->pricing->webPricing->getCustomers($webPricingUid, $customerId)
     *
     * Errors:
     *   404: No record with this ID.
     *
     * GET https://pricing.augur-api.com/web-pricing/{webPricingUid}/customers/{customerId}
     * Contract:
     * https://pricing.augur-api.com/openapi.json#/paths/~1web-pricing~1{webPricingUid}~1customers~1{customerId}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: WebPricingCustomersListItem (fields listed on the class)
     *
     * @param int $webPricingUid Web pricing rule whose customer assignments are addressed
     * @param int $customerId P21 customer ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getCustomers(int $webPricingUid, int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{webPricingUid}/customers/{customerId}',
            $params,
            ['webPricingUid' => (string) $webPricingUid, 'customerId' => (string) $customerId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /web-pricing/{webPricingUid}/customers/{customerId}
     *
     * Update Web Pricing Customer
     * Call: $api->pricing->webPricing->updateCustomers($webPricingUid, $customerId, $data)
     *
     * Request body: Change a customer assignment on a web pricing rule; the rule and customer come
     * from the path
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or The body failed validation; the message
     *       names the field.
     *   404: No record with this ID.
     *
     * PUT https://pricing.augur-api.com/web-pricing/{webPricingUid}/customers/{customerId}
     * Contract:
     * https://pricing.augur-api.com/openapi.json#/paths/~1web-pricing~1{webPricingUid}~1customers~1{customerId}/put
     *
     * Request body ($data): WebPricingCustomersUpdateBody (fields listed on the class)
     *
     * Response data type: WebPricingCustomersListItem (fields listed on the class)
     *
     * @param int $webPricingUid Web pricing rule whose customer assignments are addressed
     * @param int $customerId P21 customer ID
     * @param WebPricingCustomersUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateCustomers(int $webPricingUid, int $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{webPricingUid}/customers/{customerId}',
            $data,
            ['webPricingUid' => (string) $webPricingUid, 'customerId' => (string) $customerId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
