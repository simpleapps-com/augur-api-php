<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * cashDrawer resource — generated from spec.
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
 * CashDrawerListItem:
 * Returned by: $api->p21Core->cashDrawer->list()
 * Returned by: $api->p21Core->cashDrawer->get($cashDrawerUid)
 *   cashDrawerId: string — Prophet 21 cash drawer code (max 8 chars)
 *   companyId: string — Prophet 21 company the cash drawer belongs to (max 8 chars)
 *   cashDrawerDescription: string — Cash drawer name (max 30 chars)
 *   currentSequenceNo: float — Current sequence number of the drawer
 *   openingBalance: float|null — Balance when the drawer was opened
 *   withdrawals: float|null — Total withdrawals from the drawer
 *   deposits: float|null — Total deposits into the drawer
 *   currentBalance: float — Current drawer balance
 *   drawerOpen: string — Y when the drawer is open (max 1 chars)
 *   bankNo: float|null — Prophet 21 bank number for the drawer
 *   cashOnHandAccountNumber: string — General ledger account for cash on hand (max 32 chars)
 *   deleteFlag: string — Y when the cash drawer is deleted in Prophet 21 (max 1 chars)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   lastMaintainedBy: string — Prophet 21 user who last changed the record (max 30 chars)
 *   cashCardLoad: float|null — Cash card load amount
 *   cashDrawerUid: int — Unique Prophet 21 ID of the cash drawer
 *   locIdForBranchConflict: float|null — Location ID used for branch conflicts
 *   defaultCloseBranchId: string|null — Default branch used when closing the drawer (max 8 chars)
 *   updateCd: int — Update code (704 = queued for refresh from Prophet 21, 1185 = current)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code
 *
 * @phpstan-type CashDrawerListItem array{cashDrawerId: string, companyId: string, cashDrawerDescription: string, currentSequenceNo: float, openingBalance: float|null, withdrawals: float|null, deposits: float|null, currentBalance: float, drawerOpen: string, bankNo: float|null, cashOnHandAccountNumber: string, deleteFlag: string, dateCreated: string, dateLastModified: string, lastMaintainedBy: string, cashCardLoad: float|null, cashDrawerUid: int, locIdForBranchConflict: float|null, defaultCloseBranchId: string|null, updateCd: int, statusCd: int, processCd: int}
 */
final class CashDrawerResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /cash-drawer
     *
     * List Cash Drawers
     * Call: $api->p21Core->cashDrawer->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a cash_drawer column.
     *
     * GET https://p21-core.augur-api.com/cash-drawer
     * Contract: https://p21-core.augur-api.com/openapi.json#/paths/~1cash-drawer/get
     *
     * Query params ($params; `?` = optional):
     *   companyId?: string — Only cash drawers for this Prophet 21 company
     *   drawerOpen?: string — Filter by drawer open status (Y or N)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: cash_drawer_uid|ASC)
     *   q?: string — Search Query
     *   statusCd?: int — Status Code (Default: 704, Options: 704, 705, 700, -1)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CashDrawerListItem (fields listed on the class)
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
     * GET /cash-drawer/{cashDrawerUid}
     *
     * Get Cash Drawer Details
     * Call: $api->p21Core->cashDrawer->get($cashDrawerUid)
     *
     * GET https://p21-core.augur-api.com/cash-drawer/{cashDrawerUid}
     * Contract:
     * https://p21-core.augur-api.com/openapi.json#/paths/~1cash-drawer~1{cashDrawerUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CashDrawerListItem (fields listed on the class)
     *
     * @param int $cashDrawerUid Cash drawer ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $cashDrawerUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{cashDrawerUid}',
            $params,
            ['cashDrawerUid' => (string) $cashDrawerUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
