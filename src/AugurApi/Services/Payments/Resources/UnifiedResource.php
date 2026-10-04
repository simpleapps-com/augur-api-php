<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * unified resource — generated from spec.
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
 * UnifiedTransactionSetupListData: Hosted-payment page location and the transaction setup it is
 * bound to
 * Returned by: $api->payments->unified->listTransactionSetup()
 *   uiEndpoint: string — Element hosted-payment page URL for the mode
 *   transactionSetupId: string|null — Element TransactionSetupID to load in the hosted page; null
 *       when Element did not create one
 *
 * @phpstan-type UnifiedTransactionSetupListData array{uiEndpoint: string, transactionSetupId: string|null}
 */
final class UnifiedResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /unified/account-query
     *
     * Get account query with transaction setup id
     * Call: $api->payments->unified->listAccountQuery()
     *
     * GET https://payments.augur-api.com/unified/account-query
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1unified~1account-query/get
     *
     * Query params ($params; `?` = optional):
     *   customerId: string — Customer ID for the transaction
     *   mode?: string — API mode for the transaction(Default: live|dev)
     *   transactionSetupId: string — Element TransactionSetupID returned by
     *       /api/unified/transaction-setup
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listAccountQuery(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/account-query', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /unified/billing-update
     *
     * Update billing information with transaction setup id
     * Call: $api->payments->unified->listBillingUpdate()
     *
     * GET https://payments.augur-api.com/unified/billing-update
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1unified~1billing-update/get
     *
     * Query params ($params; `?` = optional):
     *   address1: string — Billing street address line 1
     *   address2?: string — Billing street address line 2
     *   city: string — Billing city
     *   customerId?: string — Customer ID for the transaction
     *   mode?: string — API mode for the transaction(Default: live|dev)
     *   state: string — Billing state code
     *   transactionSetupId: string — Element TransactionSetupID returned by
     *       /api/unified/transaction-setup
     *   zip: string — Billing ZIP code
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: bool
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<bool>
     */
    public function listBillingUpdate(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/billing-update', $params);

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /unified/card-info
     *
     * Get card information with transaction setup id
     * Call: $api->payments->unified->listCardInfo()
     *
     * GET https://payments.augur-api.com/unified/card-info
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1unified~1card-info/get
     *
     * Query params ($params; `?` = optional):
     *   customerId?: string — Customer ID for the transaction
     *   mode?: string — API mode for the transaction(Default: live|dev)
     *   transactionSetupId: string — Element TransactionSetupID returned by
     *       /api/unified/transaction-setup
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listCardInfo(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/card-info', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /unified/surcharge
     *
     * Get surcharge with payment account id
     * Call: $api->payments->unified->listSurcharge()
     *
     * GET https://payments.augur-api.com/unified/surcharge
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1unified~1surcharge/get
     *
     * Query params ($params; `?` = optional):
     *   amount: string — Transaction amount the surcharge is calculated on
     *   country: string — Country code of the transaction
     *   customerId: string — Customer ID for the transaction
     *   fromState: string — State code the order ships from
     *   mode?: string — API mode for the transaction(Default: live|dev)
     *   paymentAccountId: string — Element PaymentAccountID (card token) the surcharge applies to
     *   toState: string — State code the order ships to
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listSurcharge(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/surcharge', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /unified/transaction-response
     *
     * Capture Unified hosted-payment response
     * Call: $api->payments->unified->listTransactionResponse()
     *
     * Capture the Unified hosted-payment ReturnURL response and persist it by transaction setup id
     *
     * Auth: bearer token; spec scopes: none listed (most endpoints list `public`)
     *
     * GET https://payments.augur-api.com/unified/transaction-response
     * Contract:
     * https://payments.augur-api.com/openapi.json#/paths/~1unified~1transaction-response/get
     *
     * Query params ($params; `?` = optional):
     *   siteId?: string — siteId, passed in the query because Element redirects the browser here
     *       via a GET and cannot send the x-site-id header
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listTransactionResponse(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/transaction-response', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /unified/transaction-setup
     *
     * Create a transaction with customer and account information
     * Call: $api->payments->unified->listTransactionSetup()
     *
     * Response data: Hosted-payment page location and the transaction setup it is bound to
     *
     * GET https://payments.augur-api.com/unified/transaction-setup
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1unified~1transaction-setup/get
     *
     * Query params ($params; `?` = optional):
     *   customerId: string — Customer ID for the transaction
     *   mode?: string — API mode for the transaction(dev or live)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: UnifiedTransactionSetupListData (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listTransactionSetup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/transaction-setup', $params);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /unified/validate
     *
     * Validate a transaction with customer and account information
     * Call: $api->payments->unified->listValidate()
     *
     * GET https://payments.augur-api.com/unified/validate
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1unified~1validate/get
     *
     * Query params ($params; `?` = optional):
     *   customerId: string — Customer ID for the transaction
     *   mode?: string — API mode for the transaction(Default: live|dev)
     *   transactionSetupId: string — Element TransactionSetupID returned by
     *       /api/unified/transaction-setup
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: bool
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<bool>
     */
    public function listValidate(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/validate', $params);

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
