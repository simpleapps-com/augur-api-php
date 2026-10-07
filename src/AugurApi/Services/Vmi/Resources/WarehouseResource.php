<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * warehouse resource — generated from spec.
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
 * WarehouseListItem: A warehouse with its active assigned users
 * Returned by: $api->vmi->warehouse->list()
 * Returned by: $api->vmi->warehouse->get($warehouseUid)
 *   warehouseUid: int — Warehouse ID
 *   warehouseId: string — Warehouse key derived from the name
 *   warehouseName: string — Warehouse name
 *   warehouseDesc: string — Warehouse description
 *   dateCreated: string — When the warehouse was created (Y-m-d H:i:s)
 *   dateLastModified: string — When the warehouse last changed (Y-m-d H:i:s)
 *   updateCd: int — Update code
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code
 *   customerId: float — Prophet 21 customer the warehouse belongs to
 *   invProfileHdrUid: int — Inventory profile stocked in the warehouse; 0 when none
 *   users: list<WarehouseUsersListItem> — Active users assigned to the warehouse
 *     each item: WarehouseUsersListItem — A user assigned to a warehouse, with the user's Joomla
 *         name and Prophet 21 ids
 *   userCount: int — Number of entries in users
 *
 * WarehouseUsersListItem: A user assigned to a warehouse, with the user's Joomla name and Prophet
 * 21 ids
 * Returned by: $api->vmi->warehouse->listUsers($warehouseUid)
 * Returned by: $api->vmi->warehouse->getUsers($warehouseUid, $usersId)
 * Field `users` of WarehouseListItem
 *   warehouseXUsersUid: int — Assignment ID
 *   warehouseUid: int — Warehouse the user is assigned to
 *   usersId: int — joomla.users.id of the assigned user
 *   isValidUser: bool — false when no Joomla user has this ID; the name fields then read invalid
 *   username: string — Joomla username
 *   name: string — Joomla display name
 *   customerId: string — Prophet 21 customer ID from the user's profile
 *   contactId: string — Prophet 21 contact ID from the user's profile
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   dateCreated: string — When the assignment was created (Y-m-d H:i:s)
 *   dateLastModified: string — When the assignment last changed (Y-m-d H:i:s)
 *
 * WarehouseCreateData:
 * Returned by: $api->vmi->warehouse->create($data)
 * Returned by: $api->vmi->warehouse->update($warehouseUid, $data)
 * Returned by: $api->vmi->warehouse->delete($warehouseUid)
 *   warehouseUid: int — Warehouse ID
 *   warehouseId: string — Warehouse key derived from the name (max 255 chars)
 *   warehouseName: string — Warehouse name (max 255 chars)
 *   warehouseDesc: string — Warehouse description (max 255 chars)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   customerId: float — Prophet 21 customer the record belongs to
 *   invProfileHdrUid: int — Inventory profile stocked in the warehouse; 0 when none
 *
 * WarehouseCreateBody: Create a warehouse for a customer, or reactivate the one whose derived
 * warehouse_id already exists
 * Request body of: $api->vmi->warehouse->create($data)
 *   customerId: float|null — Prophet 21 customer the warehouse belongs to
 *   warehouseName: string|null — Warehouse name; warehouse_id is derived from it
 *   warehouseDesc: string|null — Warehouse description
 *   invProfileHdrUid?: int|null — Inventory profile stocked in the warehouse; defaults to 0 (none)
 *
 * WarehouseUpdateBody: Change a warehouse; an absent field keeps its current value
 * Request body of: $api->vmi->warehouse->update($warehouseUid, $data)
 *   warehouseName?: string|null — Warehouse name; warehouse_id is re-derived from it
 *   warehouseDesc?: string|null — Warehouse description
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   customerId?: float|null — Prophet 21 customer the warehouse belongs to
 *   invProfileHdrUid?: int|null — Inventory profile stocked in the warehouse
 *   updateCd?: int|null — Update code
 *
 * WarehouseAdjustCreateItem: One item whose on-hand count was set
 * Returned by: $api->vmi->warehouse->createAdjust($warehouseUid, $data)
 *   invMastUid: int — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item
 *   invProfileLineType: string — Item source: products or prophet21
 *   qtyAdjusted: float — New quantity on hand
 *   warehouseUid: int — Warehouse the count applies to
 *
 * WarehouseAdjustCreateBody: Set the on-hand count of items in the warehouse from the path
 * Request body of: $api->vmi->warehouse->createAdjust($warehouseUid, $data)
 *   items: list<WarehouseAdjustCreateBodyItemsItem> — Items to count; at least one is required
 *     each item: WarehouseAdjustCreateBodyItemsItem — One item count to set on hand; an item with
 *         no invMastUid, an unknown type, or a negative quantity is skipped
 *
 * WarehouseAdjustCreateBodyItemsItem: One item count to set on hand; an item with no invMastUid, an
 * unknown type, or a negative quantity is skipped
 * Field `items` of WarehouseAdjustCreateBody
 *   invMastUid: int|null — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item
 *   invProfileLineType: string|null — Item source: products or prophet21
 *   qtyAdjusted: float|null — New quantity on hand; replaces the current count
 *
 * WarehouseAvailabilityListData: On-hand quantities of a warehouse's profile items, grouped by
 * section
 * Returned by: $api->vmi->warehouse->listAvailability($warehouseUid)
 *   warehouseUid: int — Warehouse ID
 *   sections: array<string, WarehouseAvailabilityListDataSectionsValue> — Sections keyed by
 *       sectionsId; an empty list when the warehouse has no profile items
 *     map of WarehouseAvailabilityListDataSectionsValue — One warehouse section and the profile
 *         items stocked in it
 *   invProfileHdrUid: int — Inventory profile stocked in the warehouse
 *
 * WarehouseAvailabilityListDataSectionsValue: One warehouse section and the profile items stocked
 * in it
 * Field `sections` of WarehouseAvailabilityListData
 *   sectionsName: string — Section name, or Unknown for items with no section
 *   sectionsId: string — Section key, or Unknown for items with no section
 *   sectionsDesc: string — Section description, or Unknown for items with no section
 *   items: list<WarehouseAvailabilityListDataSectionsValueItemsItem> — Items stocked in the section
 *     each item: WarehouseAvailabilityListDataSectionsValueItemsItem — One profile item and its
 *         on-hand quantity in the warehouse
 *
 * WarehouseAvailabilityListDataSectionsValueItemsItem: One profile item and its on-hand quantity in
 * the warehouse
 * Field `items` of WarehouseAvailabilityListDataSectionsValue
 *   invMastUid: int — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item
 *   invProfileLineType: string — Item source: products or prophet21
 *   qtyOnHand: float — Quantity on hand in the warehouse
 *   itemId: string — Item ID, or Unknown when the item is not found
 *   itemDesc: string|null — Item description, or Unknown when the item is not found
 *
 * DistributorsEnableUpdateData: Outcome of an enable, disable, or delete request
 * Returned by: $api->vmi->warehouse->updateEnable($warehouseUid, $data)
 *   statusCd: int — Status applied: 704 (enable), 705 (disable), or 700 (delete)
 *   statusName: string — enable, disable, or delete, matching statusCd
 *   updated: bool — true when the record's status changed; false when it already had this status
 *   originalStatusCd: int — Status before the request
 *
 * DistributorsEnableUpdateBody: Enable, disable, or delete a record; with neither field the record
 * is enabled
 * Request body of: $api->vmi->warehouse->updateEnable($warehouseUid, $data)
 *   statusName?: string|null — enable, disable, or delete; used only when statusCd is absent
 *   statusCd?: int|null — 704 (enable), 705 (disable), or 700 (delete); any other value enables
 *
 * WarehouseReceiveCreateItem: One item received into a warehouse
 * Returned by: $api->vmi->warehouse->createReceive($warehouseUid, $data)
 *   invMastUid: int — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item
 *   invProfileLineType: string — Item source: products or prophet21
 *   qtyReceived: float — Quantity added to on hand
 *   warehouseUid: int — Warehouse that received the item
 *
 * WarehouseReceiveCreateBody: Receive items into the warehouse from the path
 * Request body of: $api->vmi->warehouse->createReceive($warehouseUid, $data)
 *   items: list<WarehouseReceiveCreateBodyItemsItem> — Items received; at least one is required
 *     each item: WarehouseReceiveCreateBodyItemsItem — One received item to add on hand; an item
 *         with no invMastUid, an unknown type, or a zero quantity is skipped
 *
 * WarehouseReceiveCreateBodyItemsItem: One received item to add on hand; an item with no
 * invMastUid, an unknown type, or a zero quantity is skipped
 * Field `items` of WarehouseReceiveCreateBody
 *   invMastUid: int|null — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item
 *   invProfileLineType: string|null — Item source: products or prophet21
 *   qtyReceived: float|null — Quantity received; added to the quantity on hand
 *
 * WarehouseReplenishListData: A warehouse's profile items with stock levels, for building a restock
 * request
 * Returned by: $api->vmi->warehouse->listReplenish($warehouseUid)
 *   warehouseUid: int — Warehouse ID
 *   distributorsUid: int — Distributor filter; -1 when every distributor is included
 *   warehouseName: string — Warehouse name
 *   invProfileHdrUid: int — Inventory profile stocked in the warehouse
 *   lines: list<WarehouseReplenishListDataLinesItem> — Profile items, limited to the distributor
 *       filter
 *     each item: WarehouseReplenishListDataLinesItem — One profile item with its stock levels and
 *         the distributor that supplies it
 *   params: WarehouseReplenishListDataParams — The filters the report was built with
 *
 * WarehouseReplenishListDataLinesItem: One profile item with its stock levels and the distributor
 * that supplies it
 * Field `lines` of WarehouseReplenishListData
 *   invMastUid: int — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item
 *   invProfileLineType: string — Item source: products or prophet21
 *   distributorsUid: int — Supplying distributor; 0 for a Prophet 21 item
 *   distributorName: string — Supplying distributor's name; Duncan Supply for a Prophet 21 item
 *   invProfileHdrUid: int — Inventory profile the item belongs to
 *   qtyOnHand: float — Quantity on hand in the warehouse
 *   minQty: float — Minimum quantity to keep on hand
 *   maxQty: float — Maximum quantity to keep on hand; -1 for no maximum
 *   reorderQty: float — Quantity to reorder
 *
 * WarehouseReplenishListDataParams: The filters the report was built with
 * Field `params` of WarehouseReplenishListData
 *   warehouseUid: int — Warehouse from the path
 *   distributorsUid: int — Distributor filter; -1 when every distributor was included
 *
 * WarehouseUsageCreateData: A recorded warehouse usage with its lines
 * Returned by: $api->vmi->warehouse->createUsage($warehouseUid, $data)
 *   department: string|null — Department the usage is charged to
 *   jobDescription: string — Job or purpose the items were used for
 *   usageHdrUid: int — Usage record ID
 *   usageItems: list<WarehouseUsageCreateDataUsageItemsItem> — Lines recorded; an item skipped for
 *       a missing invMastUid or quantity is absent
 *     each item: WarehouseUsageCreateDataUsageItemsItem — One item recorded as used, with the
 *         warehouse's remaining quantity
 *   warehouseUid: int — Warehouse the items were used from
 *
 * WarehouseUsageCreateDataUsageItemsItem: One item recorded as used, with the warehouse's remaining
 * quantity
 * Field `usageItems` of WarehouseUsageCreateData
 *   invMastUid: int — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item
 *   invProfileLineType: string — Item source: products or prophet21
 *   lineNo: int — Line number, starting at 1
 *   qtyOnHand: float — Quantity left on hand after the usage, never below zero
 *   qtyUsed: float — Quantity used
 *   usageHdrUid: int — Usage record the line belongs to
 *   usageLineUid: int — Usage line ID
 *   warranty?: WarehouseUsageCreateDataUsageItemsItemWarranty|null — Warranty claim; the key is
 *       absent when none was sent
 *
 * WarehouseUsageCreateDataUsageItemsItemWarranty: Warranty claim; the key is absent when none was
 * sent
 * Field `warranty` of WarehouseUsageCreateDataUsageItemsItem
 *   dateFailed: string|null — When the item failed (Y-m-d H:i:s)
 *   modelNo: string — Model number of the failed item
 *   notes: string|null — Warranty notes
 *   serialNo: string|null — Serial number of the failed item
 *   usageLineUid: int — Usage line the claim belongs to
 *   usageLineWarrantyUid: int — Warranty claim ID
 *   warrantyType: string|null — Warranty type
 *
 * WarehouseUsageCreateBody: Record items used from the warehouse in the path
 * Request body of: $api->vmi->warehouse->createUsage($warehouseUid, $data)
 *   jobDescription: string — Job or purpose the items were used for
 *   usageItems: list<WarehouseUsageCreateBodyUsageItemsItem> — Items used
 *     each item: WarehouseUsageCreateBodyUsageItemsItem — One item used from the warehouse; an item
 *         with no invMastUid or a quantity under 0.1 is skipped
 *   department?: string|null — Department the usage is charged to
 *
 * WarehouseUsageCreateBodyUsageItemsItem: One item used from the warehouse; an item with no
 * invMastUid or a quantity under 0.1 is skipped
 * Field `usageItems` of WarehouseUsageCreateBody
 *   invMastUid: int|null — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item
 *   qtyUsed: float|null — Quantity used; subtracted from on hand, never below zero
 *   invProfileLineType?: string|null — Item source: products or prophet21; defaults to prophet21
 *   warranty?: WarehouseUsageCreateBodyUsageItemsItemWarranty|null — Warranty claim for the item
 *
 * WarehouseUsageCreateBodyUsageItemsItemWarranty: Warranty claim for the item
 * Field `warranty` of WarehouseUsageCreateBodyUsageItemsItem
 *   modelNo: string|null — Model number of the failed item
 *   serialNo?: string|null — Serial number of the failed item
 *   warrantyType?: string|null — Warranty type
 *   dateFailed?: string|null — When the item failed (Y-m-d H:i:s)
 *   notes?: string|null — Warranty notes
 *
 * WarehouseUsersCreateData:
 * Returned by: $api->vmi->warehouse->createUsers($warehouseUid, $data)
 * Returned by: $api->vmi->warehouse->updateUsers($warehouseUid, $usersId, $data)
 * Returned by: $api->vmi->warehouse->deleteUsers($warehouseUid, $usersId)
 *   warehouseXUsersUid: int — Assignment ID
 *   warehouseUid: int — Warehouse the user is assigned to
 *   usersId: int — joomla.users.id
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * WarehouseUsersCreateBody: Assign a user to a warehouse, which comes from the path; an existing
 * assignment is kept
 * Request body of: $api->vmi->warehouse->createUsers($warehouseUid, $data)
 *   usersId: int|null — joomla.users.id to assign
 *   makePrimaryUser?: bool|null — true makes this the warehouse's only active user; when absent the
 *       makePrimaryUser=Y query param decides
 *
 * WarehouseUsersUpdateBody: Change a warehouse user assignment's codes; an absent field keeps its
 * value, an invalid code is ignored
 * Request body of: $api->vmi->warehouse->updateUsers($warehouseUid, $usersId, $data)
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code (700, 704, 705, or 1185)
 *
 * @phpstan-type WarehouseListItem array{warehouseUid: int, warehouseId: string, warehouseName: string, warehouseDesc: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, customerId: float, invProfileHdrUid: int, users: list<WarehouseUsersListItem>, userCount: int}
 * @phpstan-type WarehouseUsersListItem array{warehouseXUsersUid: int, warehouseUid: int, usersId: int, isValidUser: bool, username: string, name: string, customerId: string, contactId: string, statusCd: int, dateCreated: string, dateLastModified: string}
 * @phpstan-type WarehouseCreateData array{warehouseUid: int, warehouseId: string, warehouseName: string, warehouseDesc: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, customerId: float, invProfileHdrUid: int}
 * @phpstan-type WarehouseCreateBody array{customerId: float|null, warehouseName: string|null, warehouseDesc: string|null, invProfileHdrUid?: int|null}
 * @phpstan-type WarehouseUpdateBody array{warehouseName?: string|null, warehouseDesc?: string|null, statusCd?: int|null, customerId?: float|null, invProfileHdrUid?: int|null, updateCd?: int|null}
 * @phpstan-type WarehouseAdjustCreateItem array{invMastUid: int, invProfileLineType: string, qtyAdjusted: float, warehouseUid: int}
 * @phpstan-type WarehouseAdjustCreateBody array{items: list<WarehouseAdjustCreateBodyItemsItem>}
 * @phpstan-type WarehouseAdjustCreateBodyItemsItem array{invMastUid: int|null, invProfileLineType: string|null, qtyAdjusted: float|null}
 * @phpstan-type WarehouseAvailabilityListData array{warehouseUid: int, sections: array<string, WarehouseAvailabilityListDataSectionsValue>, invProfileHdrUid: int}
 * @phpstan-type WarehouseAvailabilityListDataSectionsValue array{sectionsName: string, sectionsId: string, sectionsDesc: string, items: list<WarehouseAvailabilityListDataSectionsValueItemsItem>}
 * @phpstan-type WarehouseAvailabilityListDataSectionsValueItemsItem array{invMastUid: int, invProfileLineType: string, qtyOnHand: float, itemId: string, itemDesc: string|null}
 * @phpstan-type DistributorsEnableUpdateData array{statusCd: int, statusName: string, updated: bool, originalStatusCd: int}
 * @phpstan-type DistributorsEnableUpdateBody array{statusName?: string|null, statusCd?: int|null}
 * @phpstan-type WarehouseReceiveCreateItem array{invMastUid: int, invProfileLineType: string, qtyReceived: float, warehouseUid: int}
 * @phpstan-type WarehouseReceiveCreateBody array{items: list<WarehouseReceiveCreateBodyItemsItem>}
 * @phpstan-type WarehouseReceiveCreateBodyItemsItem array{invMastUid: int|null, invProfileLineType: string|null, qtyReceived: float|null}
 * @phpstan-type WarehouseReplenishListData array{warehouseUid: int, distributorsUid: int, warehouseName: string, invProfileHdrUid: int, lines: list<WarehouseReplenishListDataLinesItem>, params: WarehouseReplenishListDataParams}
 * @phpstan-type WarehouseReplenishListDataLinesItem array{invMastUid: int, invProfileLineType: string, distributorsUid: int, distributorName: string, invProfileHdrUid: int, qtyOnHand: float, minQty: float, maxQty: float, reorderQty: float}
 * @phpstan-type WarehouseReplenishListDataParams array{warehouseUid: int, distributorsUid: int}
 * @phpstan-type WarehouseUsageCreateData array{department: string|null, jobDescription: string, usageHdrUid: int, usageItems: list<WarehouseUsageCreateDataUsageItemsItem>, warehouseUid: int}
 * @phpstan-type WarehouseUsageCreateDataUsageItemsItem array{invMastUid: int, invProfileLineType: string, lineNo: int, qtyOnHand: float, qtyUsed: float, usageHdrUid: int, usageLineUid: int, warranty?: WarehouseUsageCreateDataUsageItemsItemWarranty|null}
 * @phpstan-type WarehouseUsageCreateDataUsageItemsItemWarranty array{dateFailed: string|null, modelNo: string, notes: string|null, serialNo: string|null, usageLineUid: int, usageLineWarrantyUid: int, warrantyType: string|null}
 * @phpstan-type WarehouseUsageCreateBody array{jobDescription: string, usageItems: list<WarehouseUsageCreateBodyUsageItemsItem>, department?: string|null}
 * @phpstan-type WarehouseUsageCreateBodyUsageItemsItem array{invMastUid: int|null, qtyUsed: float|null, invProfileLineType?: string|null, warranty?: WarehouseUsageCreateBodyUsageItemsItemWarranty|null}
 * @phpstan-type WarehouseUsageCreateBodyUsageItemsItemWarranty array{modelNo: string|null, serialNo?: string|null, warrantyType?: string|null, dateFailed?: string|null, notes?: string|null}
 * @phpstan-type WarehouseUsersCreateData array{warehouseXUsersUid: int, warehouseUid: int, usersId: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type WarehouseUsersCreateBody array{usersId: int|null, makePrimaryUser?: bool|null}
 * @phpstan-type WarehouseUsersUpdateBody array{statusCd?: int|null, processCd?: int|null}
 */
final class WarehouseResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /warehouse
     *
     * List Warehouses
     * Call: $api->vmi->warehouse->list()
     *
     * Response data, each item: A warehouse with its active assigned users
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://vmi.augur-api.com/warehouse
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1warehouse/get
     *
     * Query params ($params; `?` = optional):
     *   customerId: int — Prophet 21 customer to filter by
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: warehouse_uid|ASC)
     *   q?: string — Search Query
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *   usersId?: int — joomla.users.id; lists only the warehouses this user is assigned to
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of WarehouseListItem (fields listed on the class)
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
     * POST /warehouse
     *
     * Create Warehouse
     * Call: $api->vmi->warehouse->create($data)
     *
     * Request body: Create a warehouse for a customer, or reactivate the one whose derived
     * warehouse_id already exists
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * POST https://vmi.augur-api.com/warehouse
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1warehouse/post
     *
     * Request body ($data): WarehouseCreateBody (fields listed on the class)
     *
     * Response data type: WarehouseCreateData (fields listed on the class)
     *
     * @param WarehouseCreateBody $data
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
     * DELETE /warehouse/{warehouseUid}
     *
     * DELETE Warehouse
     * Call: $api->vmi->warehouse->delete($warehouseUid)
     *
     * Errors:
     *   400: warehouseUid is below 1.
     *   404: No row exists with this ID.
     *
     * DELETE https://vmi.augur-api.com/warehouse/{warehouseUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}/delete
     *
     * Response data type: WarehouseCreateData (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $warehouseUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{warehouseUid}',
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /warehouse/{warehouseUid}
     *
     * Get Warehouse Details
     * Call: $api->vmi->warehouse->get($warehouseUid)
     *
     * Response data: A warehouse with its active assigned users
     *
     * Errors:
     *   400: warehouseUid is below 1.
     *   404: No warehouse with this warehouseUid.
     *
     * GET https://vmi.augur-api.com/warehouse/{warehouseUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: WarehouseListItem (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /warehouse/{warehouseUid}
     *
     * Update Warehouse
     * Call: $api->vmi->warehouse->update($warehouseUid, $data)
     *
     * Request body: Change a warehouse; an absent field keeps its current value
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No row exists with this ID.
     *
     * PUT https://vmi.augur-api.com/warehouse/{warehouseUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}/put
     *
     * Request body ($data): WarehouseUpdateBody (fields listed on the class)
     *
     * Response data type: WarehouseCreateData (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @param WarehouseUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{warehouseUid}',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /warehouse/{warehouseUid}/adjust
     *
     * Adjust Inventory
     * Call: $api->vmi->warehouse->createAdjust($warehouseUid, $data)
     *
     * Request body: Set the on-hand count of items in the warehouse from the path
     * Response data, each item: One item whose on-hand count was set
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No warehouse with this warehouseUid.
     *
     * POST https://vmi.augur-api.com/warehouse/{warehouseUid}/adjust
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}~1adjust/post
     *
     * Request body ($data): WarehouseAdjustCreateBody (fields listed on the class)
     *
     * Response data type: list of WarehouseAdjustCreateItem (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @param WarehouseAdjustCreateBody $data
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function createAdjust(int $warehouseUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/adjust',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /warehouse/{warehouseUid}/availability
     *
     * List inventory availability
     * Call: $api->vmi->warehouse->listAvailability($warehouseUid)
     *
     * Response data: On-hand quantities of a warehouse's profile items, grouped by section
     *
     * Errors:
     *   400: warehouseUid is below 1.
     *   404: No warehouse with this warehouseUid.
     *
     * GET https://vmi.augur-api.com/warehouse/{warehouseUid}/availability
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}~1availability/get
     *
     * Query params ($params; `?` = optional):
     *   q: string — search query
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: WarehouseAvailabilityListData (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAvailability(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}/availability',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /warehouse/{warehouseUid}/enable
     *
     * Enable/Disable/Delete Warehouse
     * Call: $api->vmi->warehouse->updateEnable($warehouseUid, $data)
     *
     * Request body: Enable, disable, or delete a record; with neither field the record is enabled
     * Response data: Outcome of an enable, disable, or delete request
     *
     * Errors:
     *   400: warehouseUid is below 1.
     *   404: No row exists with this ID.
     *
     * PUT https://vmi.augur-api.com/warehouse/{warehouseUid}/enable
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}~1enable/put
     *
     * Request body ($data): DistributorsEnableUpdateBody (fields listed on the class)
     *
     * Response data type: DistributorsEnableUpdateData (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @param DistributorsEnableUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateEnable(int $warehouseUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{warehouseUid}/enable',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /warehouse/{warehouseUid}/receive
     *
     * Receive Inventory
     * Call: $api->vmi->warehouse->createReceive($warehouseUid, $data)
     *
     * Request body: Receive items into the warehouse from the path
     * Response data, each item: One item received into a warehouse
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No warehouse with this warehouseUid.
     *
     * POST https://vmi.augur-api.com/warehouse/{warehouseUid}/receive
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}~1receive/post
     *
     * Request body ($data): WarehouseReceiveCreateBody (fields listed on the class)
     *
     * Response data type: list of WarehouseReceiveCreateItem (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @param WarehouseReceiveCreateBody $data
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function createReceive(int $warehouseUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/receive',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /warehouse/{warehouseUid}/replenish
     *
     * Get Replenish Information
     * Call: $api->vmi->warehouse->listReplenish($warehouseUid)
     *
     * Response data: A warehouse's profile items with stock levels, for building a restock request
     *
     * Errors:
     *   400: warehouseUid is below 1.
     *   404: No warehouse with this warehouseUid.
     *
     * GET https://vmi.augur-api.com/warehouse/{warehouseUid}/replenish
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}~1replenish/get
     *
     * Query params ($params; `?` = optional):
     *   distributorsUid?: int — Distributor to filter by; absent lists every distributor
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: WarehouseReplenishListData (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listReplenish(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}/replenish',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /warehouse/{warehouseUid}/usage
     *
     * Use Inventory
     * Call: $api->vmi->warehouse->createUsage($warehouseUid, $data)
     *
     * Request body: Record items used from the warehouse in the path
     * Response data: A recorded warehouse usage with its lines
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No warehouse with this warehouseUid.
     *
     * POST https://vmi.augur-api.com/warehouse/{warehouseUid}/usage
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}~1usage/post
     *
     * Request body ($data): WarehouseUsageCreateBody (fields listed on the class)
     *
     * Response data type: WarehouseUsageCreateData (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @param WarehouseUsageCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createUsage(int $warehouseUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/usage',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /warehouse/{warehouseUid}/users
     *
     * List Warehouses Users
     * Call: $api->vmi->warehouse->listUsers($warehouseUid)
     *
     * Response data, each item: A user assigned to a warehouse, with the user's Joomla name and
     * Prophet 21 ids
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No warehouse with this warehouseUid.
     *
     * GET https://vmi.augur-api.com/warehouse/{warehouseUid}/users
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}~1users/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: warehouse_x_users_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *   statusCdList?: string — Deprecated: use statusCd. CSV of status codes [700|704|705], read
     *       only when statusCd is absent
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of WarehouseUsersListItem (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listUsers(int $warehouseUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}/users',
            $params,
            ['warehouseUid' => (string) $warehouseUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /warehouse/{warehouseUid}/users
     *
     * Create/update Warehouse User
     * Call: $api->vmi->warehouse->createUsers($warehouseUid, $data)
     *
     * Create/Update Warehouse User
     *
     * Request body: Assign a user to a warehouse, which comes from the path; an existing assignment
     * is kept
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No warehouse with this warehouseUid.
     *
     * POST https://vmi.augur-api.com/warehouse/{warehouseUid}/users
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}~1users/post
     *
     * Request body ($data): WarehouseUsersCreateBody (fields listed on the class)
     *
     * Query params ($params; `?` = optional):
     *   makePrimaryUser?: string — make_primary_user (y|N)
     *
     * Response data type: WarehouseUsersCreateData (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @param WarehouseUsersCreateBody $data
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function createUsers(int $warehouseUid, array $data, array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{warehouseUid}/users',
            $data,
            ['warehouseUid' => (string) $warehouseUid],
            $params,
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /warehouse/{warehouseUid}/users/{usersId}
     *
     * Remove User from Warehouse
     * Call: $api->vmi->warehouse->deleteUsers($warehouseUid, $usersId)
     *
     * Remove User from Warehouse (sets status_cd to 700)
     *
     * Errors:
     *   400: warehouseUid or usersId is below 1.
     *   404: No row exists with this ID.
     *
     * DELETE https://vmi.augur-api.com/warehouse/{warehouseUid}/users/{usersId}
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}~1users~1{usersId}/delete
     *
     * Response data type: WarehouseUsersCreateData (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @param int $usersId User ID from joomla.users
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteUsers(int $warehouseUid, int $usersId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{warehouseUid}/users/{usersId}',
            ['warehouseUid' => (string) $warehouseUid, 'usersId' => (string) $usersId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /warehouse/{warehouseUid}/users/{usersId}
     *
     * Get Warehouse User Assignment
     * Call: $api->vmi->warehouse->getUsers($warehouseUid, $usersId)
     *
     * Response data: A user assigned to a warehouse, with the user's Joomla name and Prophet 21 ids
     *
     * Errors:
     *   404: No row exists with this ID.
     *
     * GET https://vmi.augur-api.com/warehouse/{warehouseUid}/users/{usersId}
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}~1users~1{usersId}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: WarehouseUsersListItem (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @param int $usersId User ID from joomla.users
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getUsers(int $warehouseUid, int $usersId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{warehouseUid}/users/{usersId}',
            $params,
            ['warehouseUid' => (string) $warehouseUid, 'usersId' => (string) $usersId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /warehouse/{warehouseUid}/users/{usersId}
     *
     * Update Warehouse User Assignment
     * Call: $api->vmi->warehouse->updateUsers($warehouseUid, $usersId, $data)
     *
     * Request body: Change a warehouse user assignment's codes; an absent field keeps its value, an
     * invalid code is ignored
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No row exists with this ID.
     *
     * PUT https://vmi.augur-api.com/warehouse/{warehouseUid}/users/{usersId}
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1warehouse~1{warehouseUid}~1users~1{usersId}/put
     *
     * Request body ($data): WarehouseUsersUpdateBody (fields listed on the class)
     *
     * Response data type: WarehouseUsersCreateData (fields listed on the class)
     *
     * @param int $warehouseUid Warehouse ID
     * @param int $usersId User ID from joomla.users
     * @param WarehouseUsersUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateUsers(int $warehouseUid, int $usersId, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{warehouseUid}/users/{usersId}',
            $data,
            ['warehouseUid' => (string) $warehouseUid, 'usersId' => (string) $usersId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
