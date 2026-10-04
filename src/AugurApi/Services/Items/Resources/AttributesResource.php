<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * attributes resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://items.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://items.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://items.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * AttributesListItem: Typed response for one attribute, as returned by `GET /api/attributes` and
 * Returned by: $api->items->attributes->list()
 * Returned by: $api->items->attributes->get($attributeUid)
 *   attributeUid: int — Attribute ID
 *   attributeDesc: string|null — Attribute name shown to shoppers
 *   extendedDesc: string|null — Longer attribute description
 *   attributeId: string — Attribute code
 *   dataType: int — Prophet 21 data type of the attribute values
 *   maxLength: int — Maximum length of a value
 *   noOfDecimal: int|null — Number of decimal places for numeric values
 *   rowStatusFlag: int — Prophet 21 row status flag (704 = Active, 705 = Inactive)
 *   validationRequiredFlag: string — Y when values must come from the attribute value list
 *   dateCreated: string — When the attribute was created (Y-m-d H:i:s)
 *   createdBy: string — User who created the attribute
 *   dateLastModified: string — When the attribute last changed (Y-m-d H:i:s)
 *   lastMaintainedBy: string — User who last changed the attribute
 *   cfdiAttributeType: int|null — Prophet 21 CFDI (Mexican e-invoice) attribute type
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   processCd: int — Process code: workflow state of the row
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   typeCd: int — Attribute kind: 1010 (Attribute) or 3085 (Property)
 *   activeValueCount: int — Number of active (704) values of this attribute
 *   inactiveValueCount: int — Number of inactive (705) values of this attribute
 *   deletedValueCount: int — Number of deleted (700) values of this attribute
 *
 * AttributesCreateData:
 * Returned by: $api->items->attributes->create($data)
 * Returned by: $api->items->attributes->update($attributeUid, $data)
 * Returned by: $api->items->attributes->delete($attributeUid)
 *   attributeUid: int — Attribute ID
 *   attributeDesc: string|null — Attribute name shown to shoppers (max 100 chars)
 *   extendedDesc: string|null — Longer attribute description (max 255 chars)
 *   attributeId: string — Attribute code (max 100 chars)
 *   dataType: int — Prophet 21 data type of the attribute values
 *   maxLength: int — Maximum length of a value
 *   noOfDecimal: int|null — Number of decimal places for numeric values
 *   rowStatusFlag: int — Prophet 21 row status flag (704 = Active, 705 = Inactive)
 *   validationRequiredFlag: string — Y when values must come from the attribute value list (max 1
 *       chars)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   createdBy: string — User who created the row (max 255 chars)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   lastMaintainedBy: string — User who last changed the row (max 255 chars)
 *   cfdiAttributeType: int|null — Prophet 21 CFDI (Mexican e-invoice) attribute type
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   processCd: int — Process code: workflow state of the row
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   typeCd: int — Attribute kind: 1010 (Attribute) or 3085 (Property)
 *
 * AttributesCreateBody: Create an attribute, or return the existing one whose derived attributeId
 * matches
 * Request body of: $api->items->attributes->create($data)
 *   attributeDesc?: string|null — Display name of the attribute; attributeId is derived from it
 *   extendedDesc?: string|null — Extended description; defaults to attributeDesc
 *   dataType?: int|null — Prophet 21 data type code; defaults to 2259 (String)
 *   maxLength?: int|null — Maximum length of a value; defaults to 255
 *   noOfDecimal?: int|null — Number of decimal places for numeric values
 *   validationRequiredFlag?: string|null — Y when values must come from the attribute value list;
 *       defaults to N
 *   cfdiAttributeType?: int|null — Prophet 21 CFDI (Mexican e-invoice) attribute type
 *
 * AttributesResolveCreateData: Attribute filters resolved in both forms; partial results still
 * return 200 with the failures in unresolved
 * Returned by: $api->items->attributes->createResolve($data)
 *   query: string — Readable filter query; the query sent, or the canonical form when filters were
 *       sent
 *   canonicalQuery: string — Canonical query built from the resolved filters (ATTRIBUTE_ID=value
 *       pairs)
 *   filters: list<list<int>> — Resolved [attributeUid, attributeValueUid] pairs
 *     each item: list<int>
 *   unresolved: list<AttributesResolveCreateDataUnresolvedItem> — Inputs that did not resolve, with
 *       the reason
 *     each item: AttributesResolveCreateDataUnresolvedItem — One input the resolver could not
 *         match; only the keys that apply to the reason are present
 *
 * AttributesResolveCreateDataUnresolvedItem: One input the resolver could not match; only the keys
 * that apply to the reason are present
 * Field `unresolved` of AttributesResolveCreateData
 *   reason: string — Why it did not resolve: unknown_attribute, unknown_value, reserved,
 *       malformed_value, malformed_filter, unknown_attribute_uid, unknown_value_uid,
 *       both_query_and_filters, neither_query_nor_filters
 *   key?: string|null — Query key that failed (query direction)
 *   value?: string|null — Query value that failed (query direction)
 *   filter?: list<int>|null — The [attributeUid, attributeValueUid] pair that failed (filters
 *       direction)
 *
 * AttributesResolveCreateBody: Resolve attribute filters in one direction: send query OR filters,
 * not both
 * Request body of: $api->items->attributes->createResolve($data)
 *   query?: string|null — Readable filter query to resolve to uids, e.g. "size=20x11&rim=20";
 *       duplicate or bracketed keys add values
 *   filters?: list<list<int>>|null — Pairs of [attributeUid, attributeValueUid] to resolve to a
 *       readable query
 *     each item: list<int>
 *
 * AttributesUpdateBody: Change an attribute; every field is optional and an absent field keeps its
 * value
 * Request body of: $api->items->attributes->update($attributeUid, $data)
 *   attributeDesc?: string|null — Display name; also regenerates attributeId
 *   extendedDesc?: string|null — Extended description
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code: workflow state of the row
 *   updateCd?: int|null — Update code: set when the row has changes waiting to sync
 *   typeCd?: int|null — Attribute kind: 1010 (Attribute, a storefront filter facet) or 3085
 *       (Property, descriptive only); any other value is ignored
 *
 * AttributesItemsListItem: Typed response for one item carrying an attribute.
 * Returned by: $api->items->attributes->listItems($attributeUid)
 *   itemAttributeValueUid: int — Item attribute value ID
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   attributeUid: int — Attribute ID (attribute.attribute_uid)
 *   attributeValue: string|null — The value text on this item
 *   dateCreated: string — When the row was created (Y-m-d H:i:s)
 *   createdBy: string — User who created the row
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s)
 *   lastMaintainedBy: string — User who last changed the row
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   processCd: int — Process code: workflow state of the row
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   attributeValueUid: int — Attribute value ID (attribute_value.attribute_value_uid); 0 when the
 *       value is free text
 *   onlineCd: int — Online code: 704 when shown on the website
 *   attributeDesc: string|null — Attribute name (attribute.attribute_desc)
 *   attributeId: string — Attribute code (attribute.attribute_id)
 *   itemId: string — Item ID (inv_mast.item_id)
 *   itemDesc: string|null — Item description (inv_mast.item_desc)
 *
 * AttributesValuesListItem:
 * Returned by: $api->items->attributes->listValues($attributeUid)
 * Returned by: $api->items->attributes->createValues($attributeUid, $data)
 * Returned by: $api->items->attributes->getValues($attributeUid, $attributeValueUid)
 * Returned by: $api->items->attributes->updateValues($attributeUid, $attributeValueUid, $data)
 * Returned by: $api->items->attributes->deleteValues($attributeUid, $attributeValueUid)
 *   attributeValueUid: int — Attribute value ID
 *   attributeUid: int — Attribute ID (attribute.attribute_uid)
 *   attributeValue: string — The value text (max 255 chars)
 *   rowStatusFlag: int — Prophet 21 row status flag (704 = Active, 705 = Inactive)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   createdBy: string — User who created the row (max 255 chars)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   lastMaintainedBy: string — User who last changed the row (max 255 chars)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   processCd: int — Process code: workflow state of the row
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   sequenceNo: int — Display order; lower sorts first
 *   itemCount: int — Number of items carrying this value
 *
 * AttributesValuesCreateBody: Add a value to an attribute (the attribute comes from the path)
 * Request body of: $api->items->attributes->createValues($attributeUid, $data)
 *   attributeValue: string|null — The value text (e.g. Red). Without it nothing is created
 *   sequenceNo?: int|null — Display order; defaults to 1
 *
 * AttributesValuesUpdateBody: Change an attribute value; every field is optional and an absent
 * field keeps its value
 * Request body of: $api->items->attributes->updateValues($attributeUid, $attributeValueUid, $data)
 *   sequenceNo?: int|null — Display order
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code: workflow state of the row
 *   updateCd?: int|null — Update code: set when the row has changes waiting to sync
 *
 * @phpstan-type AttributesListItem array{attributeUid: int, attributeDesc: string|null, extendedDesc: string|null, attributeId: string, dataType: int, maxLength: int, noOfDecimal: int|null, rowStatusFlag: int, validationRequiredFlag: string, dateCreated: string, createdBy: string, dateLastModified: string, lastMaintainedBy: string, cfdiAttributeType: int|null, updateCd: int, processCd: int, statusCd: int, typeCd: int, activeValueCount: int, inactiveValueCount: int, deletedValueCount: int}
 * @phpstan-type AttributesCreateData array{attributeUid: int, attributeDesc: string|null, extendedDesc: string|null, attributeId: string, dataType: int, maxLength: int, noOfDecimal: int|null, rowStatusFlag: int, validationRequiredFlag: string, dateCreated: string, createdBy: string, dateLastModified: string, lastMaintainedBy: string, cfdiAttributeType: int|null, updateCd: int, processCd: int, statusCd: int, typeCd: int}
 * @phpstan-type AttributesCreateBody array{attributeDesc?: string|null, extendedDesc?: string|null, dataType?: int|null, maxLength?: int|null, noOfDecimal?: int|null, validationRequiredFlag?: string|null, cfdiAttributeType?: int|null}
 * @phpstan-type AttributesResolveCreateData array{query: string, canonicalQuery: string, filters: list<list<int>>, unresolved: list<AttributesResolveCreateDataUnresolvedItem>}
 * @phpstan-type AttributesResolveCreateDataUnresolvedItem array{reason: string, key?: string|null, value?: string|null, filter?: list<int>|null}
 * @phpstan-type AttributesResolveCreateBody array{query?: string|null, filters?: list<list<int>>|null}
 * @phpstan-type AttributesUpdateBody array{attributeDesc?: string|null, extendedDesc?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null, typeCd?: int|null}
 * @phpstan-type AttributesItemsListItem array{itemAttributeValueUid: int, invMastUid: int, attributeUid: int, attributeValue: string|null, dateCreated: string, createdBy: string, dateLastModified: string, lastMaintainedBy: string, updateCd: int, processCd: int, statusCd: int, attributeValueUid: int, onlineCd: int, attributeDesc: string|null, attributeId: string, itemId: string, itemDesc: string|null}
 * @phpstan-type AttributesValuesListItem array{attributeValueUid: int, attributeUid: int, attributeValue: string, rowStatusFlag: int, dateCreated: string, createdBy: string, dateLastModified: string, lastMaintainedBy: string, updateCd: int, processCd: int, statusCd: int, sequenceNo: int, itemCount: int}
 * @phpstan-type AttributesValuesCreateBody array{attributeValue: string|null, sequenceNo?: int|null}
 * @phpstan-type AttributesValuesUpdateBody array{sequenceNo?: int|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 */
final class AttributesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /attributes
     *
     * List Attributes
     * Call: $api->items->attributes->list()
     *
     * Response data, each item: Typed response for one attribute, as returned by `GET
     * /api/attributes` and
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an attribute column.
     *
     * GET https://items.augur-api.com/attributes
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1attributes/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: attribute_uid|ASC)
     *   q?: string — Search Query
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of AttributesListItem (fields listed on the class)
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
     * POST /attributes
     *
     * Create Attribute
     * Call: $api->items->attributes->create($data)
     *
     * Request body: Create an attribute, or return the existing one whose derived attributeId
     * matches
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://items.augur-api.com/attributes
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1attributes/post
     *
     * Request body ($data): AttributesCreateBody (fields listed on the class)
     *
     * Response data type: AttributesCreateData (fields listed on the class)
     *
     * @param AttributesCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /attributes/resolve
     *
     * Resolve attribute filters
     * Call: $api->items->attributes->createResolve($data)
     *
     * Resolve attribute names and values (a query string or a filters list) into attribute and
     * value uids; unmatched inputs are returned in unresolved with a reason code
     *
     * Request body: Resolve attribute filters in one direction: send query OR filters, not both
     * Response data: Attribute filters resolved in both forms; partial results still return 200
     * with the failures in unresolved
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://items.augur-api.com/attributes/resolve
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1attributes~1resolve/post
     *
     * Request body ($data): AttributesResolveCreateBody (fields listed on the class)
     *
     * Response data type: AttributesResolveCreateData (fields listed on the class)
     *
     * @param AttributesResolveCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createResolve(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/resolve', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /attributes/{attributeUid}
     *
     * DELETE Attribute
     * Call: $api->items->attributes->delete($attributeUid)
     *
     * Errors:
     *   404: No record with this ID.
     *
     * DELETE https://items.augur-api.com/attributes/{attributeUid}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1attributes~1{attributeUid}/delete
     *
     * Response data type: AttributesCreateData (fields listed on the class)
     *
     * @param int $attributeUid Attribute ID (attribute.attribute_uid)
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $attributeUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{attributeUid}',
            ['attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /attributes/{attributeUid}
     *
     * Get Attribute Details
     * Call: $api->items->attributes->get($attributeUid)
     *
     * Get Attribute Group Details
     *
     * Response data: Typed response for one attribute, as returned by `GET /api/attributes` and
     *
     * GET https://items.augur-api.com/attributes/{attributeUid}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1attributes~1{attributeUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: AttributesListItem (fields listed on the class)
     *
     * @param int $attributeUid Attribute ID (attribute.attribute_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $attributeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{attributeUid}',
            $params,
            ['attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /attributes/{attributeUid}
     *
     * Update Attribute
     * Call: $api->items->attributes->update($attributeUid, $data)
     *
     * Request body: Change an attribute; every field is optional and an absent field keeps its
     * value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No record with this ID.
     *
     * PUT https://items.augur-api.com/attributes/{attributeUid}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1attributes~1{attributeUid}/put
     *
     * Request body ($data): AttributesUpdateBody (fields listed on the class)
     *
     * Response data type: AttributesCreateData (fields listed on the class)
     *
     * @param int $attributeUid Attribute ID (attribute.attribute_uid)
     * @param AttributesUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $attributeUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{attributeUid}',
            $data,
            ['attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /attributes/{attributeUid}/items
     *
     * List items carrying an attribute
     * Call: $api->items->attributes->listItems($attributeUid)
     *
     * Response data, each item: Typed response for one item carrying an attribute.
     *
     * Errors:
     *   400: Invalid orderBy '...': MUST be one field|ASC or field|DESC; sortable fields are
     *       item_id and the item_attribute_value columns; or invalid orderBy: MUST be one field|ASC
     *       or field|DESC; sortable fields are item_id and the item_attribute_value columns.
     *
     * GET https://items.augur-api.com/attributes/{attributeUid}/items
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attributes~1{attributeUid}~1items/get
     *
     * Query params ($params; `?` = optional):
     *   attributeValueUid?: int — Narrow to a single attribute value UID
     *   excludeValues?: string — Comma-separated attribute_value_uid set to exclude (NOT IN)
     *   includeValues?: string — Comma-separated attribute_value_uid set to include (IN)
     *   itemId?: string — Filter to the item with this exact Item ID
     *   itemIdSearch?: string — Filter to items whose Item ID contains this value (matches up to
     *       100 items)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — One field|DIR, DIR ASC or DESC (any case). Sortable: item_id or any
     *       item_attribute_value column (snake_case or camelCase). Anything else returns 400.
     *       (Default: item_attribute_value_uid|ASC)
     *   q?: string — Search query on attribute value
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of AttributesItemsListItem (fields listed on the class)
     *
     * @param int $attributeUid Attribute ID (attribute.attribute_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listItems(int $attributeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{attributeUid}/items',
            $params,
            ['attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /attributes/{attributeUid}/values
     *
     * List AttributeValues
     * Call: $api->items->attributes->listValues($attributeUid)
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an attribute_value
     *       column.
     *
     * GET https://items.augur-api.com/attributes/{attributeUid}/values
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attributes~1{attributeUid}~1values/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: attribute_value_uid|ASC)
     *   q?: string — Search Query
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of AttributesValuesListItem (fields listed on the class)
     *
     * @param int $attributeUid Attribute ID (attribute.attribute_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listValues(int $attributeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{attributeUid}/values',
            $params,
            ['attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /attributes/{attributeUid}/values
     *
     * Create AttributeValue
     * Call: $api->items->attributes->createValues($attributeUid, $data)
     *
     * Request body: Add a value to an attribute (the attribute comes from the path)
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://items.augur-api.com/attributes/{attributeUid}/values
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attributes~1{attributeUid}~1values/post
     *
     * Request body ($data): AttributesValuesCreateBody (fields listed on the class)
     *
     * Response data type: AttributesValuesListItem (fields listed on the class)
     *
     * @param int $attributeUid Attribute ID (attribute.attribute_uid)
     * @param AttributesValuesCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createValues(int $attributeUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{attributeUid}/values',
            $data,
            ['attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /attributes/{attributeUid}/values/{attributeValueUid}
     *
     * DELETE AttributeValue
     * Call: $api->items->attributes->deleteValues($attributeUid, $attributeValueUid)
     *
     * Errors:
     *   404: No record with this ID.
     *
     * DELETE https://items.augur-api.com/attributes/{attributeUid}/values/{attributeValueUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attributes~1{attributeUid}~1values~1{attributeValueUid}/delete
     *
     * Response data type: AttributesValuesListItem (fields listed on the class)
     *
     * @param int $attributeUid Attribute ID (attribute.attribute_uid)
     * @param int $attributeValueUid Attribute value ID (attribute_value.attribute_value_uid)
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteValues(int $attributeUid, int $attributeValueUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{attributeUid}/values/{attributeValueUid}',
            ['attributeUid' => (string) $attributeUid, 'attributeValueUid' => (string) $attributeValueUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /attributes/{attributeUid}/values/{attributeValueUid}
     *
     * Get AttributeValue Details
     * Call: $api->items->attributes->getValues($attributeUid, $attributeValueUid)
     *
     * GET https://items.augur-api.com/attributes/{attributeUid}/values/{attributeValueUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attributes~1{attributeUid}~1values~1{attributeValueUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: AttributesValuesListItem (fields listed on the class)
     *
     * @param int $attributeUid Attribute ID (attribute.attribute_uid)
     * @param int $attributeValueUid Attribute value ID (attribute_value.attribute_value_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getValues(int $attributeUid, int $attributeValueUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{attributeUid}/values/{attributeValueUid}',
            $params,
            ['attributeUid' => (string) $attributeUid, 'attributeValueUid' => (string) $attributeValueUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /attributes/{attributeUid}/values/{attributeValueUid}
     *
     * Update AttributeValue
     * Call: $api->items->attributes->updateValues($attributeUid, $attributeValueUid, $data)
     *
     * Request body: Change an attribute value; every field is optional and an absent field keeps
     * its value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No record with this ID.
     *
     * PUT https://items.augur-api.com/attributes/{attributeUid}/values/{attributeValueUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attributes~1{attributeUid}~1values~1{attributeValueUid}/put
     *
     * Request body ($data): AttributesValuesUpdateBody (fields listed on the class)
     *
     * Response data type: AttributesValuesListItem (fields listed on the class)
     *
     * @param int $attributeUid Attribute ID (attribute.attribute_uid)
     * @param int $attributeValueUid Attribute value ID (attribute_value.attribute_value_uid)
     * @param AttributesValuesUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateValues(int $attributeUid, int $attributeValueUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{attributeUid}/values/{attributeValueUid}',
            $data,
            ['attributeUid' => (string) $attributeUid, 'attributeValueUid' => (string) $attributeValueUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
