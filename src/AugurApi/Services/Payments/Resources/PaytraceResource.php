<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * paytrace resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://payments.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://payments.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://payments.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py payments
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * PaytraceAuthorizationCreateBody: Keyed PayTrace card authorization (pre-auth)
 * Request body of: $api->payments->paytrace->createAuthorization($data)
 *   amount: float|null — Dollar amount to authorize
 *   creditCard: PaytraceAuthorizationCreateBodyCreditCard — Card to authorize
 *   csc?: string|null — Card security code (3-4 digits)
 *   billingAddress?: PaytraceAuthorizationCreateBodyBillingAddress — Billing address sent with the
 *       authorization
 *   invoiceId?: string|null — Invoice identifier
 *   testMode?: bool|null — true (or the string "true" or "1") uses the PayTrace sandbox; default
 *       live
 *
 * PaytraceAuthorizationCreateBodyCreditCard: Card to authorize
 * Field `creditCard` of PaytraceAuthorizationCreateBody
 *   number: string|null — Card number
 *   expirationMonth: string|null — Expiration month
 *   expirationYear: string|null — Expiration year
 *
 * PaytraceAuthorizationCreateBodyBillingAddress: Billing address sent with the authorization
 * Field `billingAddress` of PaytraceAuthorizationCreateBody
 *   name?: string|null — Cardholder name
 *   streetAddress?: string|null — Street address
 *   city?: string|null — City
 *   state?: string|null — State code
 *   zip?: string|null — ZIP code
 *
 * @phpstan-type PaytraceAuthorizationCreateBody array{amount: float|null, creditCard: PaytraceAuthorizationCreateBodyCreditCard, csc?: string|null, billingAddress?: PaytraceAuthorizationCreateBodyBillingAddress, invoiceId?: string|null, testMode?: bool|null}
 * @phpstan-type PaytraceAuthorizationCreateBodyCreditCard array{number: string|null, expirationMonth: string|null, expirationYear: string|null}
 * @phpstan-type PaytraceAuthorizationCreateBodyBillingAddress array{name?: string|null, streetAddress?: string|null, city?: string|null, state?: string|null, zip?: string|null}
 */
final class PaytraceResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /paytrace/authorization
     *
     * Authorize a credit card transaction.
     * Call: $api->payments->paytrace->createAuthorization($data)
     *
     * Authorize a credit card transaction (pre-auth).
     *
     * Request body: Keyed PayTrace card authorization (pre-auth)
     *
     * Errors:
     *   400: Invalid request body. Or Missing required field: amount. Or Missing required field:
     *       creditCard. Or Invalid credit_card format. Or Missing required creditCard fields
     *       (number, expirationMonth, expirationYear).
     *
     * POST https://payments.augur-api.com/paytrace/authorization
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1paytrace~1authorization/post
     *
     * Request body ($data): PaytraceAuthorizationCreateBody (fields listed on the class)
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param PaytraceAuthorizationCreateBody $data
     * @return BaseResponse<mixed>
     */
    public function createAuthorization(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/authorization', $data);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paytrace/capture
     *
     * Capture an authorized transaction.
     * Call: $api->payments->paytrace->createCapture($data)
     *
     * Capture a previously authorized transaction.
     *
     * POST https://payments.augur-api.com/paytrace/capture
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1paytrace~1capture/post
     *
     * Query params ($params; `?` = optional):
     *   amount?: float
     *   testMode?: bool
     *   transactionId: string
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function createCapture(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/capture',
            $data,
            [],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paytrace/refund
     *
     * Refund a settled transaction.
     * Call: $api->payments->paytrace->createRefund($data)
     *
     * POST https://payments.augur-api.com/paytrace/refund
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1paytrace~1refund/post
     *
     * Query params ($params; `?` = optional):
     *   amount?: float
     *   testMode?: bool
     *   transactionId: string
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function createRefund(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/refund',
            $data,
            [],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paytrace/sale
     *
     * Process a sale transaction.
     * Call: $api->payments->paytrace->createSale($data)
     *
     * Process a sale transaction (authorize and capture).
     *
     * POST https://payments.augur-api.com/paytrace/sale
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1paytrace~1sale/post
     *
     * Query params ($params; `?` = optional):
     *   amount: float
     *   billingAddress?: string
     *   creditCard: string
     *   csc?: string
     *   invoiceId?: string
     *   testMode?: bool
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function createSale(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/sale',
            $data,
            [],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paytrace/void
     *
     * Void a pending transaction.
     * Call: $api->payments->paytrace->createVoid($data)
     *
     * POST https://payments.augur-api.com/paytrace/void
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1paytrace~1void/post
     *
     * Query params ($params; `?` = optional):
     *   testMode?: bool
     *   transactionId: string
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function createVoid(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/void',
            $data,
            [],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
