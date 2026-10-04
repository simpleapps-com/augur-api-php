<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * restockHdr resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://vmi.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://vmi.augur-api.com/openapi.json: the full contract: request and response bodies field by
 *       field, descriptions, formats and documented errors.
 *   https://vmi.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * RestockHdrListItem:
 * Returned by: $api->vmi->restockHdr->list()
 * Returned by: $api->vmi->restockHdr->get($restockHdrUid)
 *   restockHdrUid: int — Restock request ID
 *   warehouseUid: int — Warehouse being restocked
 *   distributorsUid: int — Distributor ordered from
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   jsonData: string|null — The create request body, JSON-encoded (max 2147483647 chars)
 *   processState: string — Processing state of the restock order (max 30 chars)
 *   poNo: string|null — Customer purchase order number (max 50 chars)
 *   usersId: int — joomla.users.id
 *   customerId: float — Prophet 21 customer placing the restock
 *   contactId: string|null — Prophet 21 contact placing the restock (max 16 chars)
 *   deliveryInstructions: string|null — Delivery instructions for the order (max 255 chars)
 *
 * RestockHdrCreateData: A newly created restock request with its items
 * Returned by: $api->vmi->restockHdr->create($data)
 *   restockHdrUid: int — Restock request ID
 *   warehouseUid: int — Warehouse being restocked
 *   distributorsUid: int — Distributor ordered from
 *   dateCreated: string — When the request was created (Y-m-d H:i:s)
 *   dateLastModified: string — When the request last changed (Y-m-d H:i:s)
 *   updateCd: int — Update code
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = waiting for processing)
 *   jsonData: string|null — The create request body, JSON-encoded
 *   processState: string — Processing state
 *   poNo: string|null — Customer purchase order number
 *   usersId: int — joomla.users.id of the requester
 *   customerId: float — Prophet 21 customer placing the restock
 *   contactId: string|null — Prophet 21 contact placing the restock
 *   deliveryInstructions: string|null — Delivery instructions for the order
 *   restockItems: list<RestockHdrCreateDataRestockItemsItem> — Items on the request
 *     each item: RestockHdrCreateDataRestockItemsItem — One item on a restock request
 *
 * RestockHdrCreateDataRestockItemsItem: One item on a restock request
 * Field `restockItems` of RestockHdrCreateData
 *   restockLineUid: int — Restock line ID
 *   restockHdrUid: int — Restock request the line belongs to
 *   lineNo: int — Line number, starting at 1
 *   invMastUid: int — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item
 *   invProfileLineType: string — Item source: products or prophet21
 *   unitQty: float — Quantity to restock
 *   dateCreated: string — When the line was created (Y-m-d H:i:s)
 *   dateLastModified: string — When the line last changed (Y-m-d H:i:s)
 *   updateCd: int — Update code
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code
 *   distributorsUid: int|null — Distributor the item is ordered from; null until processing assigns
 *       it, -1 for a Prophet 21 item
 *
 * RestockHdrCreateBody: Create a restock request for a warehouse and distributor; a missing
 * required field creates nothing
 * Request body of: $api->vmi->restockHdr->create($data)
 *   warehouseUid: int|null — Warehouse to restock
 *   distributorsUid: int|null — Distributor to order from
 *   usersId: int|null — joomla.users.id of the requester
 *   customerId: float|null — Prophet 21 customer placing the restock
 *   contactId: string|null — Prophet 21 contact placing the restock
 *   restockItems: list<RestockHdrCreateBodyRestockItemsItem> — Items to restock; an empty list
 *       creates nothing
 *     each item: RestockHdrCreateBodyRestockItemsItem — One item on a restock request; a missing
 *         field cancels the whole restock
 *   poNo?: string|null — Customer purchase order number
 *   deliveryInstructions?: string|null — Delivery instructions for the order
 *
 * RestockHdrCreateBodyRestockItemsItem: One item on a restock request; a missing field cancels the
 * whole restock
 * Field `restockItems` of RestockHdrCreateBody
 *   invMastUid: int|null — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item
 *   invProfileLineType: string|null — Item source: products or prophet21
 *   unitQty: float|null — Quantity to restock
 *
 * RestockHdrUpdateBody: Change a restock request's codes or delivery instructions; an absent field
 * keeps its value, an invalid code is ignored
 * Request body of: $api->vmi->restockHdr->update($restockHdrUid, $data)
 *   updateCd?: int|null — Update code
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code
 *   deliveryInstructions?: string|null — Delivery instructions for the order
 *
 * @phpstan-type RestockHdrListItem array{restockHdrUid: int, warehouseUid: int, distributorsUid: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, jsonData: string|null, processState: string, poNo: string|null, usersId: int, customerId: float, contactId: string|null, deliveryInstructions: string|null}
 * @phpstan-type RestockHdrCreateData array{restockHdrUid: int, warehouseUid: int, distributorsUid: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, jsonData: string|null, processState: string, poNo: string|null, usersId: int, customerId: float, contactId: string|null, deliveryInstructions: string|null, restockItems: list<RestockHdrCreateDataRestockItemsItem>}
 * @phpstan-type RestockHdrCreateDataRestockItemsItem array{restockLineUid: int, restockHdrUid: int, lineNo: int, invMastUid: int, invProfileLineType: string, unitQty: float, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, distributorsUid: int|null}
 * @phpstan-type RestockHdrCreateBody array{warehouseUid: int|null, distributorsUid: int|null, usersId: int|null, customerId: float|null, contactId: string|null, restockItems: list<RestockHdrCreateBodyRestockItemsItem>, poNo?: string|null, deliveryInstructions?: string|null}
 * @phpstan-type RestockHdrCreateBodyRestockItemsItem array{invMastUid: int|null, invProfileLineType: string|null, unitQty: float|null}
 * @phpstan-type RestockHdrUpdateBody array{updateCd?: int|null, statusCd?: int|null, processCd?: int|null, deliveryInstructions?: string|null}
 */
final class RestockHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /restock-hdr
     *
     * List Restock Headers
     * Call: $api->vmi->restockHdr->list()
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://vmi.augur-api.com/restock-hdr
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1restock-hdr/get
     *
     * Query params ($params; `?` = optional):
     *   distributorsUid?: int — Filter by Distributor UID
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: restock_hdr_uid|ASC)
     *   warehouseUid?: int — Filter by Warehouse UID
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of RestockHdrListItem (fields listed on the class)
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
     * POST /restock-hdr
     *
     * Create Restock Header
     * Call: $api->vmi->restockHdr->create($data)
     *
     * Request body: Create a restock request for a warehouse and distributor; a missing required
     * field creates nothing
     * Response data: A newly created restock request with its items
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * POST https://vmi.augur-api.com/restock-hdr
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1restock-hdr/post
     *
     * Request body ($data): RestockHdrCreateBody (fields listed on the class)
     *
     * Response data type: RestockHdrCreateData (fields listed on the class)
     *
     * @param RestockHdrCreateBody $data
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
     * DELETE /restock-hdr/{restockHdrUid}
     *
     * DELETE Restock Header
     * Call: $api->vmi->restockHdr->delete($restockHdrUid)
     *
     * Errors:
     *   404: No row exists with this ID.
     *
     * DELETE https://vmi.augur-api.com/restock-hdr/{restockHdrUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1restock-hdr~1{restockHdrUid}/delete
     *
     * Response data type: bool
     *
     * @param int $restockHdrUid Restock request ID
     * @return BaseResponse<bool>
     */
    public function delete(int $restockHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{restockHdrUid}',
            ['restockHdrUid' => (string) $restockHdrUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /restock-hdr/{restockHdrUid}
     *
     * Get Restock Header Details
     * Call: $api->vmi->restockHdr->get($restockHdrUid)
     *
     * GET https://vmi.augur-api.com/restock-hdr/{restockHdrUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1restock-hdr~1{restockHdrUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: RestockHdrListItem (fields listed on the class)
     *
     * @param int $restockHdrUid Restock request ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $restockHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{restockHdrUid}',
            $params,
            ['restockHdrUid' => (string) $restockHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /restock-hdr/{restockHdrUid}
     *
     * Update Restock Header
     * Call: $api->vmi->restockHdr->update($restockHdrUid, $data)
     *
     * Request body: Change a restock request's codes or delivery instructions; an absent field
     * keeps its value, an invalid code is ignored
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No row exists with this ID.
     *
     * PUT https://vmi.augur-api.com/restock-hdr/{restockHdrUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1restock-hdr~1{restockHdrUid}/put
     *
     * Request body ($data): RestockHdrUpdateBody (fields listed on the class)
     *
     * Response data type: bool
     *
     * @param int $restockHdrUid Restock request ID
     * @param RestockHdrUpdateBody $data
     * @return BaseResponse<bool>
     */
    public function update(int $restockHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{restockHdrUid}',
            $data,
            ['restockHdrUid' => (string) $restockHdrUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
