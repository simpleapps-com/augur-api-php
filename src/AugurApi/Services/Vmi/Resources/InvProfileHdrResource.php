<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invProfileHdr resource — generated from spec.
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
 * InvProfileHdrListItem: An inventory profile with the active warehouses that stock it
 * Returned by: $api->vmi->invProfileHdr->list()
 * Returned by: $api->vmi->invProfileHdr->get($invProfileHdrUid)
 *   invProfileHdrUid: int — Inventory profile ID
 *   invProfileHdrId: string — Profile key derived from the description
 *   invProfileHdrDesc: string — Profile description
 *   customerId: float — Prophet 21 customer the profile belongs to
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   warehouses: list<WarehouseListItem> — Active warehouses of the same customer that stock this
 *       profile
 *     each item: WarehouseListItem — A warehouse with its active assigned users
 *   warehousesCount: int — Number of entries in warehouses
 *
 * WarehouseListItem: A warehouse with its active assigned users
 * Field `warehouses` of InvProfileHdrListItem
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
 * InvProfileHdrCreateData:
 * Returned by: $api->vmi->invProfileHdr->create($data)
 * Returned by: $api->vmi->invProfileHdr->update($invProfileHdrUid, $data)
 *   invProfileHdrUid: int — Inventory profile ID
 *   invProfileHdrId: string — Profile key derived from the description (max 255 chars)
 *   invProfileHdrDesc: string — Profile description (max 255 chars)
 *   customerId: float — Prophet 21 customer the record belongs to
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * InvProfileHdrCreateBody: Create an inventory profile for a customer, or return the one whose
 * derived inv_profile_hdr_id already exists
 * Request body of: $api->vmi->invProfileHdr->create($data)
 *   invProfileHdrDesc: string|null — Profile description; inv_profile_hdr_id is derived from it.
 *       Without it nothing is created
 *   customerId: float|null — Prophet 21 customer the profile belongs to; without it nothing is
 *       created
 *
 * InvProfileHdrUploadCreateData: Outcome of an inventory profile spreadsheet upload; the file
 * fields are null when the upload failed
 * Returned by: $api->vmi->invProfileHdr->createUpload($customerId, $data)
 *   success: bool — true when the file and its metadata were saved for processing
 *   customerId: int|null — Prophet 21 customer the profile is for
 *   fileName: string|null — Name the file was saved under (upload_{timestamp}.xlsx)
 *   filePath: string|null — Full path of the saved file
 *   metadataFile: string|null — Full path of the metadata JSON saved beside the file
 *   fileSize: int|null — Decoded file size in bytes
 *   message: string — Result message; says why when the upload failed
 *
 * InvProfileHdrUploadCreateBody: Upload an inventory profile spreadsheet for the customer in the
 * path; it is saved for processing later
 * Request body of: $api->vmi->invProfileHdr->createUpload($customerId, $data)
 *   fileData: string|null — Base64-encoded .xlsx file; a missing or empty value is rejected with
 *       400
 *   fileName?: string|null — Original file name, kept in the upload metadata
 *   invProfileHdrDesc?: string|null — Description for the inventory profile the file creates
 *
 * InvProfileHdrUpdateBody: Change an inventory profile; an absent field keeps its current value
 * Request body of: $api->vmi->invProfileHdr->update($invProfileHdrUid, $data)
 *   invProfileHdrDesc?: string|null — Profile description; inv_profile_hdr_id is re-derived from it
 *   updateCd?: int|null — Update code
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code
 *
 * InvProfileHdrInvProfileLineListItem:
 * Returned by: $api->vmi->invProfileHdr->listInvProfileLine($invProfileHdrUid)
 * Returned by: $api->vmi->invProfileHdr->createInvProfileLine($invProfileHdrUid, $data)
 * Returned by: $api->vmi->invProfileHdr->getInvProfileLine($invProfileHdrUid, $invProfileLineUid)
 *   invProfileLineUid: int — Inventory profile line ID
 *   invProfileHdrUid: int — Inventory profile the line belongs to
 *   invMastUid: int — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item
 *   invProfileLineType: string — Item source: products or prophet21 (max 255 chars)
 *   invProfileHdrMinQty: float — Minimum quantity to keep on hand
 *   invProfileHdrMaxQty: float — Maximum quantity to keep on hand; -1 for no maximum
 *   invProfileHdrReorderQty: float — Quantity to reorder
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   sectionsUid: int — Warehouse section the item is stocked in; 0 when none
 *   keywords: string|null — Item ID and description words, for searching profile lines (max 255
 *       chars)
 *
 * InvProfileHdrInvProfileLineCreateBodyItem: One line to add to an inventory profile, which comes
 * from the path; an existing line with the same item is returned
 * Request body of: $api->vmi->invProfileHdr->createInvProfileLine($invProfileHdrUid, $data)
 *   invMastUid: int|null — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item;
 *       without it the line is skipped
 *   invProfileLineType: string|null — Item source: products or prophet21; without it the line is
 *       skipped
 *   invProfileHdrMinQty?: float|null — Minimum quantity to keep on hand; defaults to 1
 *   invProfileHdrMaxQty?: float|null — Maximum quantity to keep on hand; defaults to -1 (no
 *       maximum)
 *   invProfileHdrReorderQty?: float|null — Quantity to reorder; defaults to 1
 *   sectionsUid?: int|null — Warehouse section the item is stocked in; defaults to 0 (none)
 *
 * InvProfileHdrInvProfileLineUpdateBody: Change an inventory profile line; an absent field keeps
 * its current value, and an invalid code is ignored
 * Request body of:
 * $api->vmi->invProfileHdr->updateInvProfileLine($invProfileHdrUid, $invProfileLineUid, $data)
 *   invProfileHdrUid?: int|null — Inventory profile the line belongs to
 *   invMastUid?: int|null — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item
 *   invProfileLineType?: string|null — Item source: products or prophet21
 *   invProfileHdrMinQty?: float|null — Minimum quantity to keep on hand
 *   invProfileHdrMaxQty?: float|null — Maximum quantity to keep on hand; -1 for no maximum
 *   invProfileHdrReorderQty?: float|null — Quantity to reorder
 *   sectionsUid?: int|null — Warehouse section the item is stocked in
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code
 *   updateCd?: int|null — Update code; defaults to 1185 (Import Complete)
 *
 * @phpstan-type InvProfileHdrListItem array{invProfileHdrUid: int, invProfileHdrId: string, invProfileHdrDesc: string, customerId: float, statusCd: int, warehouses: list<WarehouseListItem>, warehousesCount: int}
 * @phpstan-type WarehouseListItem array{warehouseUid: int, warehouseId: string, warehouseName: string, warehouseDesc: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, customerId: float, invProfileHdrUid: int, users: list<WarehouseUsersListItem>, userCount: int}
 * @phpstan-type WarehouseUsersListItem array{warehouseXUsersUid: int, warehouseUid: int, usersId: int, isValidUser: bool, username: string, name: string, customerId: string, contactId: string, statusCd: int, dateCreated: string, dateLastModified: string}
 * @phpstan-type InvProfileHdrCreateData array{invProfileHdrUid: int, invProfileHdrId: string, invProfileHdrDesc: string, customerId: float, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type InvProfileHdrCreateBody array{invProfileHdrDesc: string|null, customerId: float|null}
 * @phpstan-type InvProfileHdrUploadCreateData array{success: bool, customerId: int|null, fileName: string|null, filePath: string|null, metadataFile: string|null, fileSize: int|null, message: string}
 * @phpstan-type InvProfileHdrUploadCreateBody array{fileData: string|null, fileName?: string|null, invProfileHdrDesc?: string|null}
 * @phpstan-type InvProfileHdrUpdateBody array{invProfileHdrDesc?: string|null, updateCd?: int|null, statusCd?: int|null, processCd?: int|null}
 * @phpstan-type InvProfileHdrInvProfileLineListItem array{invProfileLineUid: int, invProfileHdrUid: int, invMastUid: int, invProfileLineType: string, invProfileHdrMinQty: float, invProfileHdrMaxQty: float, invProfileHdrReorderQty: float, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, sectionsUid: int, keywords: string|null}
 * @phpstan-type InvProfileHdrInvProfileLineCreateBodyItem array{invMastUid: int|null, invProfileLineType: string|null, invProfileHdrMinQty?: float|null, invProfileHdrMaxQty?: float|null, invProfileHdrReorderQty?: float|null, sectionsUid?: int|null}
 * @phpstan-type InvProfileHdrInvProfileLineUpdateBody array{invProfileHdrUid?: int|null, invMastUid?: int|null, invProfileLineType?: string|null, invProfileHdrMinQty?: float|null, invProfileHdrMaxQty?: float|null, invProfileHdrReorderQty?: float|null, sectionsUid?: int|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 */
final class InvProfileHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-profile-hdr
     *
     * List Inventory Profile Headers
     * Call: $api->vmi->invProfileHdr->list()
     *
     * Response data, each item: An inventory profile with the active warehouses that stock it
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://vmi.augur-api.com/inv-profile-hdr
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1inv-profile-hdr/get
     *
     * Query params ($params; `?` = optional):
     *   customerId: int — Prophet 21 customer to filter by
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: inv_profile_hdr_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvProfileHdrListItem (fields listed on the class)
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
     * POST /inv-profile-hdr
     *
     * Create Inventory Profile Header
     * Call: $api->vmi->invProfileHdr->create($data)
     *
     * Request body: Create an inventory profile for a customer, or return the one whose derived
     * inv_profile_hdr_id already exists
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * POST https://vmi.augur-api.com/inv-profile-hdr
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1inv-profile-hdr/post
     *
     * Request body ($data): InvProfileHdrCreateBody (fields listed on the class)
     *
     * Response data type: InvProfileHdrCreateData (fields listed on the class)
     *
     * @param InvProfileHdrCreateBody $data
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
     * POST /inv-profile-hdr/{customerId}/upload
     *
     * Upload Excel file to create inventory profile headers
     * Call: $api->vmi->invProfileHdr->createUpload($customerId, $data)
     *
     * Request body: Upload an inventory profile spreadsheet for the customer in the path; it is
     * saved for processing later
     * Response data: Outcome of an inventory profile spreadsheet upload; the file fields are null
     * when the upload failed
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No customer with this customerId.
     *
     * POST https://vmi.augur-api.com/inv-profile-hdr/{customerId}/upload
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1inv-profile-hdr~1{customerId}~1upload/post
     *
     * Request body ($data): InvProfileHdrUploadCreateBody (fields listed on the class)
     *
     * Response data type: InvProfileHdrUploadCreateData (fields listed on the class)
     *
     * @param int $customerId Prophet 21 customer the uploaded profile spreadsheet is for
     * @param InvProfileHdrUploadCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createUpload(int $customerId, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/upload',
            $data,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /inv-profile-hdr/{invProfileHdrUid}
     *
     * DELETE Inventory Profile Header
     * Call: $api->vmi->invProfileHdr->delete($invProfileHdrUid)
     *
     * Errors:
     *   400: invProfileHdrUid is below 1.
     *   404: No row exists with this ID.
     *
     * DELETE https://vmi.augur-api.com/inv-profile-hdr/{invProfileHdrUid}
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1inv-profile-hdr~1{invProfileHdrUid}/delete
     *
     * Response data type: bool
     *
     * @param int $invProfileHdrUid Inventory profile ID
     * @return BaseResponse<bool>
     */
    public function delete(int $invProfileHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invProfileHdrUid}',
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-profile-hdr/{invProfileHdrUid}
     *
     * Get Inventory Profile Header Details
     * Call: $api->vmi->invProfileHdr->get($invProfileHdrUid)
     *
     * Response data: An inventory profile with the active warehouses that stock it
     *
     * Errors:
     *   400: invProfileHdrUid is below 1.
     *   404: No inventory profile with this invProfileHdrUid.
     *
     * GET https://vmi.augur-api.com/inv-profile-hdr/{invProfileHdrUid}
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1inv-profile-hdr~1{invProfileHdrUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: InvProfileHdrListItem (fields listed on the class)
     *
     * @param int $invProfileHdrUid Inventory profile ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invProfileHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invProfileHdrUid}',
            $params,
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-profile-hdr/{invProfileHdrUid}
     *
     * Update Inventory Profile Header
     * Call: $api->vmi->invProfileHdr->update($invProfileHdrUid, $data)
     *
     * Request body: Change an inventory profile; an absent field keeps its current value
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No row exists with this ID.
     *
     * PUT https://vmi.augur-api.com/inv-profile-hdr/{invProfileHdrUid}
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1inv-profile-hdr~1{invProfileHdrUid}/put
     *
     * Request body ($data): InvProfileHdrUpdateBody (fields listed on the class)
     *
     * Response data type: InvProfileHdrCreateData (fields listed on the class)
     *
     * @param int $invProfileHdrUid Inventory profile ID
     * @param InvProfileHdrUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invProfileHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invProfileHdrUid}',
            $data,
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line
     *
     * List Inventory Profile Lines
     * Call: $api->vmi->invProfileHdr->listInvProfileLine($invProfileHdrUid)
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No inventory profile with this invProfileHdrUid.
     *
     * GET https://vmi.augur-api.com/inv-profile-hdr/{invProfileHdrUid}/inv-profile-line
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1inv-profile-hdr~1{invProfileHdrUid}~1inv-profile-line/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: inv_profile_line_uid|ASC)
     *   q?: string — Search keywords field
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704 and 705 (deleted lines
     *       excluded)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of InvProfileHdrInvProfileLineListItem (fields listed on the class)
     *
     * @param int $invProfileHdrUid Inventory profile ID
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listInvProfileLine(int $invProfileHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invProfileHdrUid}/inv-profile-line',
            $params,
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line
     *
     * Create Inventory Profile Lines
     * Call: $api->vmi->invProfileHdr->createInvProfileLine($invProfileHdrUid, $data)
     *
     * Request body, each item: One line to add to an inventory profile, which comes from the path;
     * an existing line with the same item is returned
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No inventory profile with this invProfileHdrUid.
     *
     * POST https://vmi.augur-api.com/inv-profile-hdr/{invProfileHdrUid}/inv-profile-line
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1inv-profile-hdr~1{invProfileHdrUid}~1inv-profile-line/post
     *
     * Request body ($data): list of InvProfileHdrInvProfileLineCreateBodyItem (fields listed on the
     * class)
     *
     * Response data type: list of InvProfileHdrInvProfileLineListItem (fields listed on the class)
     *
     * @param int $invProfileHdrUid Inventory profile ID
     * @param list<InvProfileHdrInvProfileLineCreateBodyItem> $data
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function createInvProfileLine(int $invProfileHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invProfileHdrUid}/inv-profile-line',
            $data,
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}
     *
     * DELETE Inventory Profile line
     * Call: $api->vmi->invProfileHdr->deleteInvProfileLine($invProfileHdrUid, $invProfileLineUid)
     *
     * DELETE Inventory Profile Line
     *
     * Errors:
     *   400: invProfileHdrUid or invProfileLineUid is below 1.
     *   404: No row exists with this ID.
     *
     * DELETE
     * https://vmi.augur-api.com/inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1inv-profile-hdr~1{invProfileHdrUid}~1inv-profile-line~1{invProfileLineUid}/delete
     *
     * Response data type: bool
     *
     * @param int $invProfileHdrUid Inventory profile ID
     * @param int $invProfileLineUid Inventory profile line ID
     * @return BaseResponse<bool>
     */
    public function deleteInvProfileLine(int $invProfileHdrUid, int $invProfileLineUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}',
            ['invProfileHdrUid' => (string) $invProfileHdrUid, 'invProfileLineUid' => (string) $invProfileLineUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}
     *
     * Get Inventory Profile line Details
     * Call: $api->vmi->invProfileHdr->getInvProfileLine($invProfileHdrUid, $invProfileLineUid)
     *
     * Errors:
     *   400: invProfileHdrUid or invProfileLineUid is below 1.
     *   404: No inventory profile with this invProfileHdrUid, or no line with this
     *       invProfileLineUid on that profile.
     *
     * GET
     * https://vmi.augur-api.com/inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1inv-profile-hdr~1{invProfileHdrUid}~1inv-profile-line~1{invProfileLineUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: InvProfileHdrInvProfileLineListItem (fields listed on the class)
     *
     * @param int $invProfileHdrUid Inventory profile ID
     * @param int $invProfileLineUid Inventory profile line ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getInvProfileLine(int $invProfileHdrUid, int $invProfileLineUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}',
            $params,
            ['invProfileHdrUid' => (string) $invProfileHdrUid, 'invProfileLineUid' => (string) $invProfileLineUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}
     *
     * Update Inventory Profile Line
     * Call:
     * $api->vmi->invProfileHdr->updateInvProfileLine($invProfileHdrUid, $invProfileLineUid, $data)
     *
     * Update Inventory Profile line
     *
     * Request body: Change an inventory profile line; an absent field keeps its current value, and
     * an invalid code is ignored
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No row exists with this ID.
     *
     * PUT
     * https://vmi.augur-api.com/inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1inv-profile-hdr~1{invProfileHdrUid}~1inv-profile-line~1{invProfileLineUid}/put
     *
     * Request body ($data): InvProfileHdrInvProfileLineUpdateBody (fields listed on the class)
     *
     * Response data type: bool
     *
     * @param int $invProfileHdrUid Inventory profile ID
     * @param int $invProfileLineUid Inventory profile line ID
     * @param InvProfileHdrInvProfileLineUpdateBody $data
     * @return BaseResponse<bool>
     */
    public function updateInvProfileLine(int $invProfileHdrUid, int $invProfileLineUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}',
            $data,
            ['invProfileHdrUid' => (string) $invProfileHdrUid, 'invProfileLineUid' => (string) $invProfileLineUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
