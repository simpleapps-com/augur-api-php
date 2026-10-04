<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Sism\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * import resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://p21-sism.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://p21-sism.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://p21-sism.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-sism
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ImportListItem:
 * Returned by: $api->p21Sism->import->list()
 * Returned by: $api->p21Sism->import->get($importUid)
 * Returned by: $api->p21Sism->import->update($importUid, $data)
 *   importUid: int — Import unique ID; also the pending_import set number
 *   scheduledImportMasterUid: int — Scheduled import master (P21 import definition) this import
 *       delivers through
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   sourceName: string|null — System that produced the import, e.g. commerce (max 25 chars)
 *   sourceId: int — Record ID in the source system, e.g. the commerce checkout uid
 *   importState: string — Import pipeline state (ProcessStates value), e.g. initial, delivered,
 *       imported, error (max 30 chars)
 *   jsonData: string|null — Order payload as a JSON string, stored and returned as-is (max 16777215
 *       chars)
 *   importStatusCd: int — Import status code: 704 = pending, 1185 = Import Complete
 *   importResults: string|null — Free-text result or failure cause recorded by the pipeline (max
 *       16777215 chars)
 *   referenceNo: string|null — Prophet 21 reference once imported, usually the order number (max
 *       255 chars)
 *
 * ImportDailySummaryListItem: Import counts for one day, total and per pipeline state
 * Returned by: $api->p21Sism->import->listDailySummary()
 *   date: string — Day counted (Y-m-d), by import creation date
 *   total: int — Imports created that day
 *   initial: int — Imports in state initial
 *   processing: int — Imports in state processing
 *   processingCoupon: int — Imports in state processing_coupon
 *   processCoupon: int — Imports in state process_coupon
 *   validate: int — Imports in state validate
 *   validating: int — Imports in state validating
 *   validated: int — Imports in state validated
 *   processed: int — Imports in state processed
 *   hold: int — Imports in state hold
 *   delivering: int — Imports in state delivering
 *   delivered: int — Imports in state delivered
 *   importing: int — Imports in state importing
 *   imported: int — Imports in state imported
 *   redelivered: int — Imports in state redelivered
 *   invalid: int — Imports in state invalid
 *   failed: int — Imports in state failed
 *   error: int — Imports in state error
 *   cancelled: int — Imports in state cancelled
 *   stopped: int — Imports in state stopped
 *   skipped: int — Imports in state skipped
 *
 * ImportRecentListItem: An import with its pipeline state and a health status derived from state
 * and age
 * Returned by: $api->p21Sism->import->listRecent()
 * Returned by: $api->p21Sism->import->listStuck()
 *   importUid: int — Import unique ID
 *   sourceId: int — Record ID in the source system, e.g. the commerce checkout uid
 *   referenceNo: string|null — Prophet 21 reference once imported, usually the order number
 *   importState: string — Import pipeline state (ProcessStates value), e.g. initial, delivered,
 *       imported
 *   dateCreated: ImportRecentListItemDateCreated — When the import was created
 *   dateLastModified: ImportRecentListItemDateCreated — When the import last changed
 *   status: string — Health status: success (imported), attention (hold), error (not imported after
 *       two hours), pending (initial), or another derived value
 *
 * ImportRecentListItemDateCreated: When the import was created
 * Field `dateCreated` of ImportRecentListItem
 * Field `dateLastModified` of ImportRecentListItem
 *   date: string — Date and time (Y-m-d H:i:s.u)
 *   timezone_type: int — PHP timezone type (3 = named timezone)
 *   timezone: string — Timezone name, e.g. UTC
 *
 * ImportDeleteData: Result of clearing an import's rows from Prophet 21's pending_import table; the
 * import row itself is unchanged
 * Returned by: $api->p21Sism->import->delete($importUid)
 *   importUid: int — Import unique ID; also the pending_import set number that was cleared
 *   importState: string — Import pipeline state (ProcessStates value), unchanged by the clean
 *   deletedCount: int — Number of pending_import rows deleted
 *
 * ImportUpdateBody: Update an import; import_state is the only field applied
 * Request body of: $api->p21Sism->import->update($importUid, $data)
 *   importState?: string|null — New pipeline state, any casing (ProcessStates value, e.g. initial,
 *       hold, cancelled); an unknown state is a 400, absent leaves the state unchanged
 *
 * ImportImpOeHdrListData:
 * Returned by: $api->p21Sism->import->listImpOeHdr($importUid)
 * Returned by: $api->p21Sism->import->updateImpOeHdr($importUid, $data)
 *   impOeHdrUid: int — Staged order header unique ID
 *   importUid: int — Import this order header belongs to
 *   dateCreated: string — When the row was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the row was last modified (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   customerId: float — Prophet 21 customer the order is for
 *   customerName: string|null — Customer name (max 50 chars)
 *   companyId: string — Prophet 21 company the order belongs to (max 8 chars)
 *   salesLocationId: float — Prophet 21 sales location for the order
 *   customerPoNo: string|null — Customer purchase order number (max 50 chars)
 *   contactId: string|null — Prophet 21 contact on the order (max 16 chars)
 *   contactName: string|null — Contact name (max 50 chars)
 *   taker: string — Order taker (max 30 chars)
 *   jobName: string|null — Job name (max 40 chars)
 *   orderDate: string|null — Order date (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   requestedDate: string|null — Date the customer requested the order (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   quote: string|null — Allowed Values: Y|N|Null (Default: Null) (max 1 chars)
 *   approved: string|null — Y when the order is approved (max 1 chars)
 *   shipToId: float|null — Prophet 21 ship-to address the order ships to
 *   shipToName: string|null — Ship-to name (max 50 chars)
 *   shipToAddress1: string|null — Ship-to address line 1 (max 50 chars)
 *   shipToAddress2: string|null — Ship-to address line 2 (max 50 chars)
 *   shipToCity: string|null — Ship-to city (max 50 chars)
 *   shipToState: string|null — Ship-to state (max 50 chars)
 *   shipToZipCode: string|null — Ship-to postal code (max 10 chars)
 *   shipToCountry: string|null — Ship-to country (max 50 chars)
 *   sourceLocationId: float|null — Prophet 21 location the order ships from
 *   carrierId: float|null — Prophet 21 carrier ID
 *   carrierName: string|null — Carrier name (max 50 chars)
 *   route: string|null — Delivery route (max 255 chars)
 *   packingBasis: string|null — Allowed Values: Partial, Item Complete, Order Complete, Item
 *       Partial, Partial/Order, Hold (max 16 chars)
 *   deliveryInstructions: string|null — Delivery instructions (max 255 chars)
 *   terms: string|null — Payment terms code (max 2 chars)
 *   termsDesc: string|null — Payment terms description (max 20 chars)
 *   willCall: string|null — Allowed Values: Y|N|Null (Default: Null) (max 1 chars)
 *   class1: string|null — Order class 1 (max 8 chars)
 *   class2: string|null — Order class 2 (max 8 chars)
 *   class3: string|null — Order class 3 (max 8 chars)
 *   class4: string|null — Order class 4 (max 8 chars)
 *   class5: string|null — Order class 5 (max 8 chars)
 *   rmaFlag: string|null — Allowed Values: Y|N|Null (Default: Null) (max 1 chars)
 *   freightCode: string|null — Freight code (max 30 chars)
 *   thirdPartyBillingFlagDesc: string|null — Third-party billing option description (max 40 chars)
 *   captureUsageDefault: string|null — Allowed Values: Y|N|Null (Default: Null) (max 1 chars)
 *   allocate: string|null — Allowed Values: Y|N|NULL (Default: Null) (max 1 chars)
 *   contractNumber: string|null — Customer contract number (max 255 chars)
 *   invoiceBatchNumber: int|null — Invoice batch number
 *   shipToEmailAddress: string|null — Ship-to email address (max 255 chars)
 *   setInvoiceExchangeRateSourceDesc: string|null — Invoice exchange rate source description (max
 *       40 chars)
 *   shipToPhone: string|null — Ship-to phone number (max 20 chars)
 *   currencyId: int|null — Prophet 21 currency ID
 *   applyBuilderAllowanceFlag: string|null — Allowed Values: Y|N|NULL (Default: Null) (max 1 chars)
 *   quoteExpirationDate: string|null — Date the quote expires (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   promiseDate: string|null — Date promised to the customer (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   importAsQuote: string|null — Allowed Values: Y|N|Null (Default: Null) (max 1 chars)
 *   quoteNumber: string|null — Quote number the order comes from (max 8 chars)
 *   webReferenceNumber: string|null — Web order reference; matched to oe_hdr.web_reference_no to
 *       resolve the P21 order (max 255 chars)
 *   createInvoice: string|null — Allowed Values: Y|N|NULL (Default: Null) (max 1 chars)
 *   strategicPricingLibraryId: string|null — Strategic pricing library ID (max 20 chars)
 *   merchandiseCredit: string|null — Allowed Values: Y|N|NULL (Default: Null) (max 1 chars)
 *   orderTypePriority: string|null — Order type priority (max 255 chars)
 *   upsCode: string|null — UPS code (max 40 chars)
 *   supplierOrderNo: string|null — Supplier order number (max 255 chars)
 *   supplierReleaseNo: string|null — Supplier release number (max 255 chars)
 *   placedByName: string|null — Name of the person who placed the order (max 255 chars)
 *   orderType830: int|null — Order type (830)
 *   shipToAddress3: string|null — Ship-to address line 3 (max 50 chars)
 *   properties: string|null — Extra import properties, stored and returned as text (max 16777215
 *       chars)
 *   userDefined: string|null — Prophet 21 user-defined fields, stored and returned as text (max
 *       16777215 chars)
 *
 * ImportImpOeHdrUpdateBody: Correct the order header staged for an import; only non-empty fields
 * are applied
 * Request body of: $api->p21Sism->import->updateImpOeHdr($importUid, $data)
 *   customerId?: float|null — Prophet 21 customer the order is for
 *   contactId?: string|null — Prophet 21 contact on the order
 *   companyId?: string|null — Prophet 21 company the order belongs to
 *   shipToId?: float|null — Prophet 21 ship-to address the order ships to
 *   customerPoNo?: string|null — Customer purchase order number
 *   contractNumber?: string|null — Customer contract number
 *   salesLocationId?: float|null — Prophet 21 sales location for the order
 *
 * ImportImpOeHdrSalesrepListData:
 * Returned by: $api->p21Sism->import->listImpOeHdrSalesrep($importUid)
 * Returned by: $api->p21Sism->import->updateImpOeHdrSalesrep($importUid, $data)
 *   impOeHdrSalesrepUid: int — Staged order salesrep unique ID
 *   importUid: int — Import this salesrep row belongs to
 *   salesrepId: string|null — Prophet 21 salesrep ID (max 16 chars)
 *   salesrepFirstName: string|null — Salesrep first name (max 15 chars)
 *   salesrepMi: string|null — Salesrep middle initial (max 2 chars)
 *   salesrepLastName: string|null — Salesrep last name (max 24 chars)
 *   primarySalesrep: string|null — Y when this is the primary salesrep on the order (max 1 chars)
 *   commissionSplit: float|null — Percentage of the commission this salesrep receives
 *   fullCommission: string|null — Y when the salesrep receives full commission (max 1 chars)
 *   properties: string|null — Extra import properties, stored and returned as text (max 16777215
 *       chars)
 *   userDefined: string|null — Prophet 21 user-defined fields, stored and returned as text (max
 *       16777215 chars)
 *
 * ImportImpOeHdrSalesrepUpdateBody: Correct the order salesrep staged for an import; only non-empty
 * fields are applied
 * Request body of: $api->p21Sism->import->updateImpOeHdrSalesrep($importUid, $data)
 *   salesrepId?: string|null — Prophet 21 salesrep ID
 *   salesrepFirstName?: string|null — Salesrep first name
 *   salesrepMi?: string|null — Salesrep middle initial
 *   salesrepLastName?: string|null — Salesrep last name
 *   primarySalesrep?: string|null — Y when this is the primary salesrep on the order
 *   commissionSplit?: float|null — Percentage of the commission this salesrep receives
 *   fullCommission?: string|null — Y when the salesrep receives full commission
 *
 * ImportImpOeHdrWebListData:
 * Returned by: $api->p21Sism->import->listImpOeHdrWeb($importUid)
 *   impOeHdrWebUid: int — Staged order web header unique ID
 *   importUid: int — Import this web header belongs to
 *   webShopperId: int|null — Web shopper ID that placed the order
 *   webShopperEmail: string|null — Web shopper email address (max 255 chars)
 *   unknown1: string|null — Unnamed field 1 of the Prophet 21 order web-header import layout (max
 *       255 chars)
 *   unknown2: string|null — Unnamed field 2 of the Prophet 21 order web-header import layout (max
 *       255 chars)
 *   unknown3: string|null — Unnamed field 3 of the Prophet 21 order web-header import layout (max
 *       255 chars)
 *   unknown4: string|null — Unnamed field 4 of the Prophet 21 order web-header import layout (max
 *       255 chars)
 *   properties: string|null — Extra import properties, stored and returned as text (max 16777215
 *       chars)
 *   userDefined: string|null — Prophet 21 user-defined fields, stored and returned as text (max
 *       16777215 chars)
 *   dateCreated: string — When the row was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the row was last modified (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *
 * @phpstan-type ImportListItem array{importUid: int, scheduledImportMasterUid: int, dateCreated: string, dateLastModified: string, sourceName: string|null, sourceId: int, importState: string, jsonData: string|null, importStatusCd: int, importResults: string|null, referenceNo: string|null}
 * @phpstan-type ImportDailySummaryListItem array{date: string, total: int, initial: int, processing: int, processingCoupon: int, processCoupon: int, validate: int, validating: int, validated: int, processed: int, hold: int, delivering: int, delivered: int, importing: int, imported: int, redelivered: int, invalid: int, failed: int, error: int, cancelled: int, stopped: int, skipped: int}
 * @phpstan-type ImportRecentListItem array{importUid: int, sourceId: int, referenceNo: string|null, importState: string, dateCreated: ImportRecentListItemDateCreated, dateLastModified: ImportRecentListItemDateCreated, status: string}
 * @phpstan-type ImportRecentListItemDateCreated array{date: string, timezone_type: int, timezone: string}
 * @phpstan-type ImportDeleteData array{importUid: int, importState: string, deletedCount: int}
 * @phpstan-type ImportUpdateBody array{importState?: string|null}
 * @phpstan-type ImportImpOeHdrListData array{impOeHdrUid: int, importUid: int, dateCreated: string, dateLastModified: string, customerId: float, customerName: string|null, companyId: string, salesLocationId: float, customerPoNo: string|null, contactId: string|null, contactName: string|null, taker: string, jobName: string|null, orderDate: string|null, requestedDate: string|null, quote: string|null, approved: string|null, shipToId: float|null, shipToName: string|null, shipToAddress1: string|null, shipToAddress2: string|null, shipToCity: string|null, shipToState: string|null, shipToZipCode: string|null, shipToCountry: string|null, sourceLocationId: float|null, carrierId: float|null, carrierName: string|null, route: string|null, packingBasis: string|null, deliveryInstructions: string|null, terms: string|null, termsDesc: string|null, willCall: string|null, class1: string|null, class2: string|null, class3: string|null, class4: string|null, class5: string|null, rmaFlag: string|null, freightCode: string|null, thirdPartyBillingFlagDesc: string|null, captureUsageDefault: string|null, allocate: string|null, contractNumber: string|null, invoiceBatchNumber: int|null, shipToEmailAddress: string|null, setInvoiceExchangeRateSourceDesc: string|null, shipToPhone: string|null, currencyId: int|null, applyBuilderAllowanceFlag: string|null, quoteExpirationDate: string|null, promiseDate: string|null, importAsQuote: string|null, quoteNumber: string|null, webReferenceNumber: string|null, createInvoice: string|null, strategicPricingLibraryId: string|null, merchandiseCredit: string|null, orderTypePriority: string|null, upsCode: string|null, supplierOrderNo: string|null, supplierReleaseNo: string|null, placedByName: string|null, orderType830: int|null, shipToAddress3: string|null, properties: string|null, userDefined: string|null}
 * @phpstan-type ImportImpOeHdrUpdateBody array{customerId?: float|null, contactId?: string|null, companyId?: string|null, shipToId?: float|null, customerPoNo?: string|null, contractNumber?: string|null, salesLocationId?: float|null}
 * @phpstan-type ImportImpOeHdrSalesrepListData array{impOeHdrSalesrepUid: int, importUid: int, salesrepId: string|null, salesrepFirstName: string|null, salesrepMi: string|null, salesrepLastName: string|null, primarySalesrep: string|null, commissionSplit: float|null, fullCommission: string|null, properties: string|null, userDefined: string|null}
 * @phpstan-type ImportImpOeHdrSalesrepUpdateBody array{salesrepId?: string|null, salesrepFirstName?: string|null, salesrepMi?: string|null, salesrepLastName?: string|null, primarySalesrep?: string|null, commissionSplit?: float|null, fullCommission?: string|null}
 * @phpstan-type ImportImpOeHdrWebListData array{impOeHdrWebUid: int, importUid: int, webShopperId: int|null, webShopperEmail: string|null, unknown1: string|null, unknown2: string|null, unknown3: string|null, unknown4: string|null, properties: string|null, userDefined: string|null, dateCreated: string, dateLastModified: string}
 */
final class ImportResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /import
     *
     * get a list of imports
     * Call: $api->p21Sism->import->list()
     *
     * Get a list of imports
     *
     * Errors:
     *   400: Bad request: orderBy is not one import column with |ASC or |DESC; message says which.
     *
     * GET https://p21-sism.augur-api.com/import
     * Contract: https://p21-sism.augur-api.com/openapi.json#/paths/~1import/get
     *
     * Query params ($params; `?` = optional):
     *   createdFrom?: string — Date range start (YYYY-MM-DD HH:MM:SS). Requires createdTo.
     *   createdOn?: string — Filter by single date (YYYY-MM-DD). Returns imports created on that
     *       day.
     *   createdTo?: string — Date range end (YYYY-MM-DD HH:MM:SS). Requires createdFrom.
     *   excludeState?: string — Exclude imports in these states (comma-separated). Ignored if
     *       importState is set.
     *   importState?: string — Import State filter, comma-separated (Default: initial). Use "all"
     *       to disable.
     *   limit?: int — limit number of results (Default: 10)
     *   offset?: int — offset (Default: 0)
     *   orderBy?: string — Order By field (Default: import_uid|DESC)
     *   q?: string — Search query to filter imports
     *   referenceNo?: string — Reference number for direct filtering (often P21 order number, but
     *       depends on import type)
     *   sourceId?: int — Filter by source ID
     *   sourceName?: string — Filter by source name (e.g. commerce)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ImportListItem (fields listed on the class)
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
     * GET /import/daily-summary
     *
     * Get daily import counts by state
     * Call: $api->p21Sism->import->listDailySummary()
     *
     * Response data, each item: Import counts for one day, total and per pipeline state
     *
     * GET https://p21-sism.augur-api.com/import/daily-summary
     * Contract: https://p21-sism.augur-api.com/openapi.json#/paths/~1import~1daily-summary/get
     *
     * Query params ($params; `?` = optional):
     *   days?: int — Number of days back from today (Default: 7)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ImportDailySummaryListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listDailySummary(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/daily-summary', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /import/recent
     *
     * get status of the most recent imports
     * Call: $api->p21Sism->import->listRecent()
     *
     * Get a list of the most recent imports
     *
     * Response data, each item: An import with its pipeline state and a health status derived from
     * state and age
     *
     * GET https://p21-sism.augur-api.com/import/recent
     * Contract: https://p21-sism.augur-api.com/openapi.json#/paths/~1import~1recent/get
     *
     * Query params ($params; `?` = optional):
     *   createdFrom?: string — Date range start (YYYY-MM-DD HH:MM:SS). Requires createdTo.
     *   createdOn?: string — Filter by single date (YYYY-MM-DD). Returns imports created on that
     *       day. Overrides hours param.
     *   createdTo?: string — Date range end (YYYY-MM-DD HH:MM:SS). Requires createdFrom.
     *   excludeState?: string — Exclude imports in these states (comma-separated). Ignored if
     *       importState is set.
     *   hours?: int — Hours since created (Default: 48)
     *   importState?: string — Import State filter, comma-separated. Use "all" to disable.
     *   limit?: int — limit number of results (Default: 10)
     *   offset?: int — offset (Default: 0)
     *   sourceId?: int — Filter by source ID
     *   sourceName?: string — Filter by source name (e.g. commerce)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ImportRecentListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listRecent(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/recent', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /import/stuck
     *
     * get status of stuck imports
     * Call: $api->p21Sism->import->listStuck()
     *
     * Get a list of stuck imports
     *
     * Response data, each item: An import with its pipeline state and a health status derived from
     * state and age
     *
     * GET https://p21-sism.augur-api.com/import/stuck
     * Contract: https://p21-sism.augur-api.com/openapi.json#/paths/~1import~1stuck/get
     *
     * Query params ($params; `?` = optional):
     *   hours?: int — Hours since stuck (Default: 48)
     *   limit?: int — limit number of results (Default: 10)
     *   offset?: int — offset (Default: 0)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ImportRecentListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listStuck(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/stuck', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /import/{importUid}
     *
     * clean pending_import for an import
     * Call: $api->p21Sism->import->delete($importUid)
     *
     * Response data: Result of clearing an import's rows from Prophet 21's pending_import table;
     * the import row itself is unchanged
     *
     * Errors:
     *   404: No record with this ID. Or Import not found. Or No pending imports found to delete.
     *
     * DELETE https://p21-sism.augur-api.com/import/{importUid}
     * Contract: https://p21-sism.augur-api.com/openapi.json#/paths/~1import~1{importUid}/delete
     *
     * Response data type: ImportDeleteData (fields listed on the class)
     *
     * @param string $importUid import.import_uid
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(string $importUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{importUid}',
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /import/{importUid}
     *
     * Get the details of an import
     * Call: $api->p21Sism->import->get($importUid)
     *
     * Errors:
     *   404: No import with this ID.
     *
     * GET https://p21-sism.augur-api.com/import/{importUid}
     * Contract: https://p21-sism.augur-api.com/openapi.json#/paths/~1import~1{importUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ImportListItem (fields listed on the class)
     *
     * @param string $importUid import.import_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $importUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{importUid}',
            $params,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /import/{importUid}
     *
     * Update an import
     * Call: $api->p21Sism->import->update($importUid, $data)
     *
     * Request body: Update an import; import_state is the only field applied
     *
     * Errors:
     *   400: Invalid import state.
     *   404: No record with this ID. Or Import not found.
     *
     * PUT https://p21-sism.augur-api.com/import/{importUid}
     * Contract: https://p21-sism.augur-api.com/openapi.json#/paths/~1import~1{importUid}/put
     *
     * Request body ($data): ImportUpdateBody (fields listed on the class)
     *
     * Response data type: ImportListItem (fields listed on the class)
     *
     * @param string $importUid import.import_uid
     * @param ImportUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(string $importUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{importUid}',
            $data,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /import/{importUid}/imp-oe-hdr
     *
     * Get the details from imp_oe_hdr table
     * Call: $api->p21Sism->import->listImpOeHdr($importUid)
     *
     * Errors:
     *   404: No order header staged for this import.
     *
     * GET https://p21-sism.augur-api.com/import/{importUid}/imp-oe-hdr
     * Contract:
     * https://p21-sism.augur-api.com/openapi.json#/paths/~1import~1{importUid}~1imp-oe-hdr/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ImportImpOeHdrListData (fields listed on the class)
     *
     * @param string $importUid import.import_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listImpOeHdr(string $importUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr',
            $params,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /import/{importUid}/imp-oe-hdr
     *
     * Update imp_oe_hdr table
     * Call: $api->p21Sism->import->updateImpOeHdr($importUid, $data)
     *
     * Request body: Correct the order header staged for an import; only non-empty fields are
     * applied
     *
     * Errors:
     *   404: No order header staged for this import (or importUid below 1); nothing is saved.
     *
     * PUT https://p21-sism.augur-api.com/import/{importUid}/imp-oe-hdr
     * Contract:
     * https://p21-sism.augur-api.com/openapi.json#/paths/~1import~1{importUid}~1imp-oe-hdr/put
     *
     * Request body ($data): ImportImpOeHdrUpdateBody (fields listed on the class)
     *
     * Response data type: ImportImpOeHdrListData (fields listed on the class)
     *
     * @param string $importUid import.import_uid
     * @param ImportImpOeHdrUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateImpOeHdr(string $importUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr',
            $data,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /import/{importUid}/imp-oe-hdr-salesrep
     *
     * Get the details from imp_oe_hdr_salesrep table
     * Call: $api->p21Sism->import->listImpOeHdrSalesrep($importUid)
     *
     * Errors:
     *   404: No order salesrep staged for this import.
     *
     * GET https://p21-sism.augur-api.com/import/{importUid}/imp-oe-hdr-salesrep
     * Contract:
     * https://p21-sism.augur-api.com/openapi.json#/paths/~1import~1{importUid}~1imp-oe-hdr-salesrep/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ImportImpOeHdrSalesrepListData (fields listed on the class)
     *
     * @param string $importUid import.import_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listImpOeHdrSalesrep(string $importUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr-salesrep',
            $params,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /import/{importUid}/imp-oe-hdr-salesrep
     *
     * Update imp_oe_hdr_salesrep table
     * Call: $api->p21Sism->import->updateImpOeHdrSalesrep($importUid, $data)
     *
     * Request body: Correct the order salesrep staged for an import; only non-empty fields are
     * applied
     *
     * Errors:
     *   404: No order salesrep staged for this import (or importUid below 1); nothing is saved.
     *
     * PUT https://p21-sism.augur-api.com/import/{importUid}/imp-oe-hdr-salesrep
     * Contract:
     * https://p21-sism.augur-api.com/openapi.json#/paths/~1import~1{importUid}~1imp-oe-hdr-salesrep/put
     *
     * Request body ($data): ImportImpOeHdrSalesrepUpdateBody (fields listed on the class)
     *
     * Response data type: ImportImpOeHdrSalesrepListData (fields listed on the class)
     *
     * @param string $importUid import.import_uid
     * @param ImportImpOeHdrSalesrepUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateImpOeHdrSalesrep(string $importUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr-salesrep',
            $data,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /import/{importUid}/imp-oe-hdr-web
     *
     * Get the details from imp_oe_hdr_web table
     * Call: $api->p21Sism->import->listImpOeHdrWeb($importUid)
     *
     * Errors:
     *   404: No order web header staged for this import.
     *
     * GET https://p21-sism.augur-api.com/import/{importUid}/imp-oe-hdr-web
     * Contract:
     * https://p21-sism.augur-api.com/openapi.json#/paths/~1import~1{importUid}~1imp-oe-hdr-web/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ImportImpOeHdrWebListData (fields listed on the class)
     *
     * @param string $importUid import.import_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listImpOeHdrWeb(string $importUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr-web',
            $params,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
