<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * jobPriceHdr resource — generated from spec.
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
 * JobPriceHdrListItem:
 * Returned by: $api->pricing->jobPriceHdr->list()
 * Returned by: $api->pricing->jobPriceHdr->get($jobPriceHdrUid)
 *   jobPriceHdrUid: int — Job price (contract) header unique ID
 *   jobNo: string — Job or contract number (max 8 chars)
 *   jobDescription: string|null — Job or contract description (max 255 chars)
 *   companyId: string — Prophet 21 company the contract belongs to (max 8 chars)
 *   customerId: float|null — Prophet 21 customer the contract prices for
 *   salesLocId: float|null — Sales location of the contract
 *   contractNo: string|null — Contract number (max 255 chars)
 *   contactId: string|null — Customer contact on the contract (max 16 chars)
 *   startDate: string — Date the contract starts pricing (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   endDate: string — Date the contract stops pricing (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   shipToId: float|null — Ship-to the contract is limited to, when set
 *   approved: string|null — Contract approved flag (Y or N) (max 1 chars)
 *   cancelled: string|null — Contract cancelled flag (Y or N) (max 1 chars)
 *   taker: string — User who entered the contract (max 30 chars)
 *   poNo: string|null — Customer purchase order number on the contract (max 50 chars)
 *   rowStatusFlag: int — Prophet 21 row status flag
 *   dateLastModified: string — When the row was last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateCreated: string — When the row was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   lastMaintainedBy: string — User who last changed the row in Prophet 21 (max 30 chars)
 *   corpAddressId: float|null — Corporate address (customer parent) the contract applies to
 *   salesrepId: string|null — Salesrep on the contract (max 16 chars)
 *   currencyLineUid: int|null — Currency line used for the contract
 *   currencyConversion: string — Currency conversion flag (Y or N) (max 1 chars)
 *   consignmentFlag: string — Consignment contract flag (Y or N) (max 1 chars)
 *   contractTypeCd: int — Prophet 21 contract type code
 *   extendedDesc: string|null — Extended contract description (max 255 chars)
 *   noOfPeriods: int|null — Number of periods the contract runs
 *   cadChaContractCd: int|null — Canadian chargeback contract code
 *   cadChaSupplierId: float|null — Canadian chargeback supplier
 *   cadChaQuoteNo: string|null — Canadian chargeback quote number (max 255 chars)
 *   cadChaLocationId: float|null — Canadian chargeback location
 *   anniversaryDate: string|null — Contract anniversary date (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   useTotesFlag: string|null — Use totes flag (Y or N) (max 1 chars)
 *   handHeldAddFlag: string|null — Added from a hand-held device flag (Y or N) (max 1 chars)
 *   updateCd: int — Update code
 *
 * JobPriceHdrLinesListItem:
 * Returned by: $api->pricing->jobPriceHdr->listLines($jobPriceHdrUid)
 * Returned by: $api->pricing->jobPriceHdr->getLines($jobPriceHdrUid, $jobPriceLineUid)
 *   jobPriceLineUid: int — Job price (contract) line unique ID
 *   jobPriceHdrUid: int — Job price header the line belongs to
 *   invMastUid: int|null — Item the line prices
 *   uom: string|null — Unit of measure the price is for (max 8 chars)
 *   unitSize: float|null — Number of base units in the unit of measure
 *   pricingMethod: int|null — Prophet 21 pricing method code (how price is applied)
 *   sourcePrice: int|null — Prophet 21 source price code (the base price a multiplier applies to)
 *   price: float|null — Contract price, or the value the pricing method applies
 *   qtyOrdered: float|null — Quantity ordered against the contract line
 *   qtyMaximum: float|null — Maximum quantity the contract line allows
 *   otherCostTypeCd: int|null — Other cost type code
 *   otherCostValue: float|null — Other cost value
 *   otherCostSourceCd: int|null — Other cost source code
 *   otherCostCalcMethodCd: int|null — Other cost calculation method code
 *   otherCostCalcValue: float|null — Other cost calculation value
 *   commissionCostTypeCd: int|null — Commission cost type code
 *   commissionCostValue: float|null — Commission cost value
 *   commissionCostSourceCd: int|null — Commission cost source code
 *   commissionCostCalcMethodCd: int|null — Commission cost calculation method code
 *   commissionCostCalcValue: float|null — Commission cost calculation value
 *   rowStatusFlag: int — Prophet 21 row status flag
 *   dateLastModified: string — When the row was last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateCreated: string — When the row was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   lastMaintainedBy: string — User who last changed the row in Prophet 21 (max 30 chars)
 *   multiplier: float|null — Multiplier applied to the source price
 *   lineNo: int — Line number within the contract
 *   sourceLocationId: float|null — Location the item is sourced from
 *   customerPartNo: string|null — Customer part number for the item (max 40 chars)
 *   expirationDate: string|null — Date the line stops pricing (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   vendorAuthNo: string|null — Vendor authorization number (max 255 chars)
 *   poCost: float|null — Purchase order cost
 *   currencyId: float|null — Currency of the line
 *   discountGroupId: string|null — Discount group of the line (max 8 chars)
 *   custPoNo: string|null — Customer purchase order number (max 255 chars)
 *   itemCategoryUid: int|null — Item category the line applies to
 *   subCategoryUid: int|null — Item sub-category the line applies to
 *   productGroupId: string|null — Product group the line applies to (max 8 chars)
 *   terminalId: float|null — Terminal ID
 *   contractLineCostPageUid: int|null — Price page that supplies the line cost
 *   contractLinePricePageUid: int|null — Price page that supplies the line price
 *   budgetCd: string|null — Budget code (max 255 chars)
 *   itemRevisionUid: int|null — Item revision the line applies to
 *   lineStartDate: string|null — Date the line starts pricing (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   initialCommitmentAmount: float|null — Initial commitment amount
 *   commitmentAmount: float|null — Commitment amount
 *   totalCommitmentAmount: float|null — Total commitment amount
 *   pickFee: float|null — Pick fee
 *   cadPurchaseCost: float|null — Canadian purchase cost
 *   startingVirtualInventoryQty: float|null — Starting virtual inventory quantity
 *   snapshotCost: float|null — Snapshot cost
 *   minimumMccCode: string|null — Minimum MCC code (max 255 chars)
 *   commissionClassId: string|null — Commission class (max 8 chars)
 *   commissionOverridePercent: float|null — Commission override percent
 *   updateCd: int — Update code
 *
 * @phpstan-type JobPriceHdrListItem array{jobPriceHdrUid: int, jobNo: string, jobDescription: string|null, companyId: string, customerId: float|null, salesLocId: float|null, contractNo: string|null, contactId: string|null, startDate: string, endDate: string, shipToId: float|null, approved: string|null, cancelled: string|null, taker: string, poNo: string|null, rowStatusFlag: int, dateLastModified: string, dateCreated: string, lastMaintainedBy: string, corpAddressId: float|null, salesrepId: string|null, currencyLineUid: int|null, currencyConversion: string, consignmentFlag: string, contractTypeCd: int, extendedDesc: string|null, noOfPeriods: int|null, cadChaContractCd: int|null, cadChaSupplierId: float|null, cadChaQuoteNo: string|null, cadChaLocationId: float|null, anniversaryDate: string|null, useTotesFlag: string|null, handHeldAddFlag: string|null, updateCd: int}
 * @phpstan-type JobPriceHdrLinesListItem array{jobPriceLineUid: int, jobPriceHdrUid: int, invMastUid: int|null, uom: string|null, unitSize: float|null, pricingMethod: int|null, sourcePrice: int|null, price: float|null, qtyOrdered: float|null, qtyMaximum: float|null, otherCostTypeCd: int|null, otherCostValue: float|null, otherCostSourceCd: int|null, otherCostCalcMethodCd: int|null, otherCostCalcValue: float|null, commissionCostTypeCd: int|null, commissionCostValue: float|null, commissionCostSourceCd: int|null, commissionCostCalcMethodCd: int|null, commissionCostCalcValue: float|null, rowStatusFlag: int, dateLastModified: string, dateCreated: string, lastMaintainedBy: string, multiplier: float|null, lineNo: int, sourceLocationId: float|null, customerPartNo: string|null, expirationDate: string|null, vendorAuthNo: string|null, poCost: float|null, currencyId: float|null, discountGroupId: string|null, custPoNo: string|null, itemCategoryUid: int|null, subCategoryUid: int|null, productGroupId: string|null, terminalId: float|null, contractLineCostPageUid: int|null, contractLinePricePageUid: int|null, budgetCd: string|null, itemRevisionUid: int|null, lineStartDate: string|null, initialCommitmentAmount: float|null, commitmentAmount: float|null, totalCommitmentAmount: float|null, pickFee: float|null, cadPurchaseCost: float|null, startingVirtualInventoryQty: float|null, snapshotCost: float|null, minimumMccCode: string|null, commissionClassId: string|null, commissionOverridePercent: float|null, updateCd: int}
 */
final class JobPriceHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /job-price-hdr
     *
     * List Job Price Hdrs
     * Call: $api->pricing->jobPriceHdr->list()
     *
     * List Job Price Headers
     *
     * Errors:
     *   400: Invalid orderBy: not one job price header column with ASC or DESC; message says which.
     *
     * GET https://pricing.augur-api.com/job-price-hdr
     * Contract: https://pricing.augur-api.com/openapi.json#/paths/~1job-price-hdr/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: job_price_hdr_uid|ASC)
     *   q?: string — Search Query
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of JobPriceHdrListItem (fields listed on the class)
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
     * GET /job-price-hdr/{jobPriceHdrUid}
     *
     * Get Job Price Header Details
     * Call: $api->pricing->jobPriceHdr->get($jobPriceHdrUid)
     *
     * Errors:
     *   404: No job price header with this ID.
     *
     * GET https://pricing.augur-api.com/job-price-hdr/{jobPriceHdrUid}
     * Contract:
     * https://pricing.augur-api.com/openapi.json#/paths/~1job-price-hdr~1{jobPriceHdrUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: JobPriceHdrListItem (fields listed on the class)
     *
     * @param int $jobPriceHdrUid Job price header unique ID to return
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $jobPriceHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{jobPriceHdrUid}',
            $params,
            ['jobPriceHdrUid' => (string) $jobPriceHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /job-price-hdr/{jobPriceHdrUid}/lines
     *
     * List Job Price Lines
     * Call: $api->pricing->jobPriceHdr->listLines($jobPriceHdrUid)
     *
     * Errors:
     *   400: Invalid orderBy: not one job price line column with ASC or DESC; message says which.
     *
     * GET https://pricing.augur-api.com/job-price-hdr/{jobPriceHdrUid}/lines
     * Contract:
     * https://pricing.augur-api.com/openapi.json#/paths/~1job-price-hdr~1{jobPriceHdrUid}~1lines/get
     *
     * Query params ($params; `?` = optional):
     *   invMastUid?: int — Inventory Master UID
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: job_price_line_uid|ASC)
     *   q?: string — Search Query
     *   statusCd?: int — Status Code (status_cd) [(704)|(705)|(700)]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of JobPriceHdrLinesListItem (fields listed on the class)
     *
     * @param int $jobPriceHdrUid Job Price Header UID
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listLines(int $jobPriceHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{jobPriceHdrUid}/lines',
            $params,
            ['jobPriceHdrUid' => (string) $jobPriceHdrUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /job-price-hdr/{jobPriceHdrUid}/lines/{jobPriceLineUid}
     *
     * Get Job Price Line Details
     * Call: $api->pricing->jobPriceHdr->getLines($jobPriceHdrUid, $jobPriceLineUid)
     *
     * Errors:
     *   404: No job price line with this ID under this job price header.
     *
     * GET https://pricing.augur-api.com/job-price-hdr/{jobPriceHdrUid}/lines/{jobPriceLineUid}
     * Contract:
     * https://pricing.augur-api.com/openapi.json#/paths/~1job-price-hdr~1{jobPriceHdrUid}~1lines~1{jobPriceLineUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: JobPriceHdrLinesListItem (fields listed on the class)
     *
     * @param int $jobPriceHdrUid Job price header the line belongs to
     * @param int $jobPriceLineUid Job price line unique ID to return
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLines(int $jobPriceHdrUid, int $jobPriceLineUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{jobPriceHdrUid}/lines/{jobPriceLineUid}',
            $params,
            ['jobPriceHdrUid' => (string) $jobPriceHdrUid, 'jobPriceLineUid' => (string) $jobPriceLineUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
