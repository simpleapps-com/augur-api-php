<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * moneris resource — generated from spec.
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
 * MonerisPreAuthListData: Moneris receipt for a pre-authorization or its completion; a field
 * Moneris did not return is ""
 * Returned by: $api->payments->moneris->listPreAuth()
 * Returned by: $api->payments->moneris->listPreAuthComplete()
 *   cardType: string — Card type code
 *   transAmount: string — Transaction amount
 *   txnNumber: string — Moneris transaction number; pass it to pre-auth-complete
 *   receiptId: string — Receipt id (the order id sent)
 *   transType: string — Transaction type code
 *   referenceNum: string — Moneris reference number
 *   responseCode: string — Moneris response code
 *   message: string — Moneris response message
 *   authCode: string — Issuer authorization code
 *   complete: string — Moneris completion flag
 *   transDate: string — Transaction date
 *   transTime: string — Transaction time
 *
 * @phpstan-type MonerisPreAuthListData array{cardType: string, transAmount: string, txnNumber: string, receiptId: string, transType: string, referenceNum: string, responseCode: string, message: string, authCode: string, complete: string, transDate: string, transTime: string}
 */
final class MonerisResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /moneris/pre-auth
     *
     * Pre-authorizes a transaction.
     * Call: $api->payments->moneris->listPreAuth()
     *
     * Response data: Moneris receipt for a pre-authorization or its completion; a field Moneris did
     * not return is ""
     *
     * GET https://payments.augur-api.com/moneris/pre-auth
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1moneris~1pre-auth/get
     *
     * Query params ($params; `?` = optional):
     *   amount: float — Amount of the transaction
     *   ccNumber: string — credit card number
     *   expDate: string — expiration date of the credit card(YYMM)
     *   orderId: string — Order ID for the transaction
     *   testMode?: bool — Test mode for the transaction(Default: false)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: MonerisPreAuthListData (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listPreAuth(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/pre-auth', $params);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /moneris/pre-auth-complete
     *
     * Completes a pre-authorization transaction.
     * Call: $api->payments->moneris->listPreAuthComplete()
     *
     * Response data: Moneris receipt for a pre-authorization or its completion; a field Moneris did
     * not return is ""
     *
     * GET https://payments.augur-api.com/moneris/pre-auth-complete
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1moneris~1pre-auth-complete/get
     *
     * Query params ($params; `?` = optional):
     *   amount: float — Amount of the transaction
     *   orderId: string — Order ID for the transaction
     *   testMode?: bool — API mode for the transaction(Default: true)
     *   txnNumber: string — Transaction number
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: MonerisPreAuthListData (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listPreAuthComplete(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/pre-auth-complete', $params);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
