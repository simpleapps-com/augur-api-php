<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * freightCode resource — generated from spec.
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
 * FreightCodeListItem:
 * Returned by: $api->p21Core->freightCode->list()
 * Returned by: $api->p21Core->freightCode->get($freightCodeUid)
 *   freightCodeUid: int — Unique Prophet 21 ID of the freight code
 *   companyId: string — Prophet 21 company the freight code belongs to (max 8 chars)
 *   freightCd: string — Freight code (max 30 chars)
 *   freightDesc: string — Freight code description (max 255 chars)
 *   incomingFreight: string — Y when the code applies to incoming freight (max 1 chars)
 *   outgoingFreight: string — Y when the code applies to outgoing freight (max 1 chars)
 *   incomingReduceCommission: string — Y when incoming freight reduces commission (max 1 chars)
 *   outgoingIncreaseCommission: string — Y when outgoing freight increases commission (max 1 chars)
 *   prorateMethodCodeNo: int — Prorate method (Prophet 21 code number)
 *   taxGroupId: string|null — Tax group for the freight charge (max 10 chars)
 *   revenueAccountNo: string — General ledger revenue account for the freight charge (max 32 chars)
 *   rowStatus: int — Prophet 21 row status code
 *   dateCreated: string|null — When the record was created (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string|null — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   lastMaintainedBy: string — Prophet 21 user who last changed the record (max 30 chars)
 *   freeFreightBasisCd: int|null — Basis for free freight (Prophet 21 code number)
 *   freeInFreightMin: float|null — Minimum for free incoming freight
 *   freeOutFreightMin: float|null — Minimum for free outgoing freight
 *   directShipFreeFreightFlag: string|null — Y when direct shipments get free freight (max 1 chars)
 *   freeInFreightMinWeb: float|null — Minimum for free incoming freight on web orders
 *   freeOutFreightMinWeb: float|null — Minimum for free outgoing freight on web orders
 *   handlingChargeOptionCd: int|null — Handling charge option (Prophet 21 code number)
 *   externalTaxProductCodeIn: string|null — External tax product code for incoming freight (max 255
 *       chars)
 *   externalTaxProductCodeOut: string|null — External tax product code for outgoing freight (max
 *       255 chars)
 *   incomingIncreaseCommission: string|null — Y when incoming freight increases commission (max 1
 *       chars)
 *   paySpecialFlag: string|null — Prophet 21 pay special flag (max 1 chars)
 *   skipFirstShipmentFlag: string|null — Prophet 21 skip-first-shipment flag (max 1 chars)
 *   excludeFromSalesMasterInquiry: string — Y when excluded from Sales Master Inquiry (max 1 chars)
 *   deductibleFlag: string|null — Y when the freight charge is deductible (max 1 chars)
 *   freeColdFreight: string — Y when cold freight is free (max 1 chars)
 *   freeHazmatFreight: string — Y when hazmat freight is free (max 1 chars)
 *   freeExpressFreight: string — Y when express freight is free (max 1 chars)
 *   freeBulkFreight: string — Y when bulk freight is free (max 1 chars)
 *   fedexPaymentMethod: int|null — FedEx payment method code
 *   excludeDiscountedFreight: string — Prophet 21 exclude-discounted-freight flag (max 1 chars)
 *   freeFreightDefaultFlag: string|null — Y when free freight applies by default (max 1 chars)
 *   outgoingAdjustCommissionByProfitFlag: string|null — Y when outgoing freight adjusts commission
 *       by profit (max 1 chars)
 *   updateCd: int — Update code (704 = queued for refresh from Prophet 21, 1185 = current)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code
 *
 * @phpstan-type FreightCodeListItem array{freightCodeUid: int, companyId: string, freightCd: string, freightDesc: string, incomingFreight: string, outgoingFreight: string, incomingReduceCommission: string, outgoingIncreaseCommission: string, prorateMethodCodeNo: int, taxGroupId: string|null, revenueAccountNo: string, rowStatus: int, dateCreated: string|null, dateLastModified: string|null, lastMaintainedBy: string, freeFreightBasisCd: int|null, freeInFreightMin: float|null, freeOutFreightMin: float|null, directShipFreeFreightFlag: string|null, freeInFreightMinWeb: float|null, freeOutFreightMinWeb: float|null, handlingChargeOptionCd: int|null, externalTaxProductCodeIn: string|null, externalTaxProductCodeOut: string|null, incomingIncreaseCommission: string|null, paySpecialFlag: string|null, skipFirstShipmentFlag: string|null, excludeFromSalesMasterInquiry: string, deductibleFlag: string|null, freeColdFreight: string, freeHazmatFreight: string, freeExpressFreight: string, freeBulkFreight: string, fedexPaymentMethod: int|null, excludeDiscountedFreight: string, freeFreightDefaultFlag: string|null, outgoingAdjustCommissionByProfitFlag: string|null, updateCd: int, statusCd: int, processCd: int}
 */
final class FreightCodeResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /freight-code
     *
     * List Freight Codes
     * Call: $api->p21Core->freightCode->list()
     *
     * List freight codes
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a freight_code column.
     *
     * GET https://p21-core.augur-api.com/freight-code
     * Contract: https://p21-core.augur-api.com/openapi.json#/paths/~1freight-code/get
     *
     * Query params ($params; `?` = optional):
     *   companyId?: string — Filter by company ID
     *   freightCodeId?: string — Filter by freight code (freight_cd)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order by column, optionally with |DESC (Default: freight_code_uid|ASC)
     *   statusCd?: int — Filter by status code
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of FreightCodeListItem (fields listed on the class)
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
     * GET /freight-code/{freightCodeUid}
     *
     * Get Freight Code
     * Call: $api->p21Core->freightCode->get($freightCodeUid)
     *
     * Get a freight code by UID, or by code when the UID is zero
     *
     * Errors:
     *   404: No freight code with this ID.
     *
     * GET https://p21-core.augur-api.com/freight-code/{freightCodeUid}
     * Contract:
     * https://p21-core.augur-api.com/openapi.json#/paths/~1freight-code~1{freightCodeUid}/get
     *
     * Query params ($params; `?` = optional):
     *   freightCodeId?: string — freightCodeId (freight_cd). Used for lookup if freightCodeUid is
     *       zero
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: FreightCodeListItem (fields listed on the class)
     *
     * @param int $freightCodeUid freight_code.freight_code_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $freightCodeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{freightCodeUid}',
            $params,
            ['freightCodeUid' => (string) $freightCodeUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
