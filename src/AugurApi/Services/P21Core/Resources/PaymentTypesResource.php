<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * paymentTypes resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://p21-core.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://p21-core.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://p21-core.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-core
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * PaymentTypesListItem: A Prophet 21 payment type
 * Returned by: $api->p21Core->paymentTypes->list()
 *   paymentTypeId: float — Prophet 21 payment type ID
 *   paymentTypeDesc: string — Payment type description
 *   companyId: string — Prophet 21 company
 *   paymentMethodId: string — Prophet 21 payment method the type belongs to
 *   deleteFlag: string — Y when the payment type is deleted in Prophet 21
 *
 * @phpstan-type PaymentTypesListItem array{paymentTypeId: float, paymentTypeDesc: string, companyId: string, paymentMethodId: string, deleteFlag: string}
 */
final class PaymentTypesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /payment-types
     *
     * List Payment Types
     * Call: $api->p21Core->paymentTypes->list()
     *
     * Response data, each item: A Prophet 21 payment type
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a payment_types column.
     *
     * GET https://p21-core.augur-api.com/payment-types
     * Contract: https://p21-core.augur-api.com/openapi.json#/paths/~1payment-types/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: payment_type_id|ASC)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of PaymentTypesListItem (fields listed on the class)
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
