<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * attributeGroups resource — generated from spec.
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
 * AttributeGroupsListItem: One attribute group, as AttributeGroupHelper::generateDoc builds it
 * Returned by: $api->items->attributeGroups->list()
 * Returned by: $api->items->attributeGroups->get($attributeGroupUid)
 *   attributeGroupUid: int — Attribute group ID
 *   attributeGroupId: string — Attribute group code
 *   attributeGroupDesc: string|null — Attribute group name
 *   typeCd: int — Attribute group kind code (3526 = B2B Item Category)
 *   attributeGroupType: int — Prophet 21 attribute group type
 *
 * AttributeGroupsCreateData:
 * Returned by: $api->items->attributeGroups->create($data)
 * Returned by: $api->items->attributeGroups->update($attributeGroupUid, $data)
 * Returned by: $api->items->attributeGroups->delete($attributeGroupUid)
 *   attributeGroupUid: int — Attribute group ID
 *   attributeGroupId: string — Attribute group code (max 255 chars)
 *   attributeGroupDesc: string|null — Attribute group name (max 255 chars)
 *   rowStatusFlag: int — Prophet 21 row status flag (704 = Active, 705 = Inactive)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   createdBy: string — User who created the row (max 255 chars)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   lastMaintainedBy: string — User who last changed the row (max 255 chars)
 *   attributeGroupType: int — Prophet 21 attribute group type
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   processCd: int — Process code: workflow state of the row
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   typeCd: int — Attribute group kind code (3526 = B2B Item Category, the default on create)
 *   searchableCd: int — Searchable code: 704 when the group is used as a search facet
 *   itemCount: int — Number of items in the group
 *
 * AttributeGroupsCreateBody: Create an attribute group, or return the existing one whose derived
 * attributeGroupId matches
 * Request body of: $api->items->attributeGroups->create($data)
 *   attributeGroupDesc: string|null — Display name; attributeGroupId is derived from it. Without it
 *       nothing is created and data is an empty object
 *   attributeGroupType?: int|null — Prophet 21 attribute group type; defaults to 3526
 *   typeCd?: int|null — Attribute group kind code; defaults to 3526 (B2B Item Category)
 *   searchableCd?: int|null — Searchable code: 704 when the group is a search facet; defaults to
 *       704
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive); defaults to 704
 *
 * AttributeGroupsUpdateBody: Change an attribute group; every field is optional and an absent field
 * keeps its value
 * Request body of: $api->items->attributeGroups->update($attributeGroupUid, $data)
 *   attributeGroupDesc?: string|null — Display name
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   attributeGroupType?: int|null — Prophet 21 attribute group type
 *   typeCd?: int|null — Attribute group kind code
 *   searchableCd?: int|null — Searchable code: 704 when the group is a search facet
 *   processCd?: int|null — Process code: workflow state of the row
 *   updateCd?: int|null — Update code: set when the row has changes waiting to sync
 *
 * AttributeGroupsAttributesListItem: One attribute assigned to an attribute group, with the group
 * and attribute names
 * Returned by: $api->items->attributeGroups->listAttributes($attributeGroupUid)
 * Returned by:
 * $api->items->attributeGroups->getAttributes($attributeGroupUid, $attributeXAttributeGroupUid)
 *   attributeXAttributeGroupUid: int — Attribute-to-group assignment ID
 *   attributeGroupUid: int — Attribute group ID (attribute_group.attribute_group_uid)
 *   attributeGroupDesc: string|null — Attribute group name
 *   attributeGroupId: string — Attribute group code
 *   attributeUid: int — Attribute ID (attribute.attribute_uid)
 *   attributeDesc: string|null — Attribute name
 *   attributeId: string — Attribute code
 *   requiredFlag: string — Y when an item in the group must have this attribute
 *   sequenceNo: int|null — Display order of the attribute within the group
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   dateCreated: AttributeGroupsAttributesListItemDateCreated|null — When the assignment was
 *       created (raw PHP DateTime object)
 *   dateLastModified: AttributeGroupsAttributesListItemDateCreated|null — When the assignment last
 *       changed (raw PHP DateTime object)
 *
 * AttributeGroupsAttributesListItemDateCreated: When the assignment was created (raw PHP DateTime
 * object)
 * Field `dateCreated` of AttributeGroupsAttributesListItem
 * Field `dateLastModified` of AttributeGroupsAttributesListItem
 *   date: string — Date and time (Y-m-d H:i:s.u)
 *   timezone_type: int — PHP timezone type (3 = named timezone)
 *   timezone: string — Timezone name, e.g. UTC
 *
 * AttributeGroupsAttributesCreateData: The assignment AttributeXAttributeGroupHelper::create was
 * asked for; attributeXAttributeGroupUid is present only when a new row was created
 * Returned by: $api->items->attributeGroups->createAttributes($attributeGroupUid, $data)
 *   attributeGroupUid: int — Attribute group ID (attribute_group.attribute_group_uid)
 *   attributeUid: int — Attribute ID (attribute.attribute_uid)
 *   requiredFlag: string — Y when an item in the group must have this attribute
 *   sequenceNo: int|null — Display order within the group
 *   attributeXAttributeGroupUid?: int|null — ID of the new assignment; absent when the attribute
 *       was already in the group
 *
 * AttributeGroupsAttributesCreateBody: Assign an attribute to an attribute group (the group comes
 * from the path)
 * Request body of: $api->items->attributeGroups->createAttributes($attributeGroupUid, $data)
 *   attributeUid: int|null — Attribute to assign (attribute.attribute_uid); required
 *   requiredFlag?: string|null — Y when an item in the group must have this attribute
 *   sequenceNo?: int|null — Display order within the group; the next free number when omitted
 *
 * AttributeGroupsAttributesUpdateData:
 * Returned by:
 * $api->items->attributeGroups->updateAttributes($attributeGroupUid, $attributeXAttributeGroupUid, $data)
 * Returned by:
 * $api->items->attributeGroups->deleteAttributes($attributeGroupUid, $attributeXAttributeGroupUid)
 *   attributeXAttributeGroupUid: int — Attribute-to-group assignment ID
 *   requiredFlag: string — Y when an item in the group must have this attribute (max 1 chars)
 *   rowStatusFlag: int — Prophet 21 row status flag (704 = Active, 705 = Inactive)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   createdBy: string — User who created the row (max 255 chars)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   lastMaintainedBy: string — User who last changed the row (max 255 chars)
 *   attributeUid: int — Attribute ID (attribute.attribute_uid)
 *   attributeGroupUid: int — Attribute group ID (attribute_group.attribute_group_uid)
 *   sequenceNo: int|null — Display order of the attribute within the group
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   processCd: int — Process code: workflow state of the row
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *
 * AttributeGroupsAttributesUpdateBody: Change an attribute-to-group assignment; every field is
 * optional and an absent field keeps its value
 * Request body of:
 * $api->items->attributeGroups->updateAttributes($attributeGroupUid, $attributeXAttributeGroupUid, $data)
 *   requiredFlag?: string|null — Y when an item in the group must have this attribute
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   attributeUid?: int|null — Attribute ID (attribute.attribute_uid)
 *   sequenceNo?: int|null — Display order within the group
 *
 * @phpstan-type AttributeGroupsListItem array{attributeGroupUid: int, attributeGroupId: string, attributeGroupDesc: string|null, typeCd: int, attributeGroupType: int}
 * @phpstan-type AttributeGroupsCreateData array{attributeGroupUid: int, attributeGroupId: string, attributeGroupDesc: string|null, rowStatusFlag: int, dateCreated: string, createdBy: string, dateLastModified: string, lastMaintainedBy: string, attributeGroupType: int, updateCd: int, processCd: int, statusCd: int, typeCd: int, searchableCd: int, itemCount: int}
 * @phpstan-type AttributeGroupsCreateBody array{attributeGroupDesc: string|null, attributeGroupType?: int|null, typeCd?: int|null, searchableCd?: int|null, statusCd?: int|null}
 * @phpstan-type AttributeGroupsUpdateBody array{attributeGroupDesc?: string|null, statusCd?: int|null, attributeGroupType?: int|null, typeCd?: int|null, searchableCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type AttributeGroupsAttributesListItem array{attributeXAttributeGroupUid: int, attributeGroupUid: int, attributeGroupDesc: string|null, attributeGroupId: string, attributeUid: int, attributeDesc: string|null, attributeId: string, requiredFlag: string, sequenceNo: int|null, statusCd: int, dateCreated: AttributeGroupsAttributesListItemDateCreated|null, dateLastModified: AttributeGroupsAttributesListItemDateCreated|null}
 * @phpstan-type AttributeGroupsAttributesListItemDateCreated array{date: string, timezone_type: int, timezone: string}
 * @phpstan-type AttributeGroupsAttributesCreateData array{attributeGroupUid: int, attributeUid: int, requiredFlag: string, sequenceNo: int|null, attributeXAttributeGroupUid?: int|null}
 * @phpstan-type AttributeGroupsAttributesCreateBody array{attributeUid: int|null, requiredFlag?: string|null, sequenceNo?: int|null}
 * @phpstan-type AttributeGroupsAttributesUpdateData array{attributeXAttributeGroupUid: int, requiredFlag: string, rowStatusFlag: int, dateCreated: string, createdBy: string, dateLastModified: string, lastMaintainedBy: string, attributeUid: int, attributeGroupUid: int, sequenceNo: int|null, updateCd: int, processCd: int, statusCd: int}
 * @phpstan-type AttributeGroupsAttributesUpdateBody array{requiredFlag?: string|null, statusCd?: int|null, attributeUid?: int|null, sequenceNo?: int|null}
 */
final class AttributeGroupsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /attribute-groups
     *
     * List Attribute Groups
     * Call: $api->items->attributeGroups->list()
     *
     * Response data, each item: One attribute group, as AttributeGroupHelper::generateDoc builds it
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an attribute_group
     *       column.
     *
     * GET https://items.augur-api.com/attribute-groups
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1attribute-groups/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: attribute_group_uid|ASC)
     *   q?: string — Search Query
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of AttributeGroupsListItem (fields listed on the class)
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
     * POST /attribute-groups
     *
     * Create Attribute Group
     * Call: $api->items->attributeGroups->create($data)
     *
     * Request body: Create an attribute group, or return the existing one whose derived
     * attributeGroupId matches
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://items.augur-api.com/attribute-groups
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1attribute-groups/post
     *
     * Request body ($data): AttributeGroupsCreateBody (fields listed on the class)
     *
     * Response data type: AttributeGroupsCreateData (fields listed on the class)
     *
     * @param AttributeGroupsCreateBody $data
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
     * DELETE /attribute-groups/{attributeGroupUid}
     *
     * DELETE Attribute Group
     * Call: $api->items->attributeGroups->delete($attributeGroupUid)
     *
     * Errors:
     *   404: No record with this ID.
     *
     * DELETE https://items.augur-api.com/attribute-groups/{attributeGroupUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attribute-groups~1{attributeGroupUid}/delete
     *
     * Response data type: AttributeGroupsCreateData (fields listed on the class)
     *
     * @param int $attributeGroupUid Attribute group ID (attribute_group.attribute_group_uid)
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $attributeGroupUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{attributeGroupUid}',
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /attribute-groups/{attributeGroupUid}
     *
     * Get Attribute Group Details
     * Call: $api->items->attributeGroups->get($attributeGroupUid)
     *
     * Response data: One attribute group, as AttributeGroupHelper::generateDoc builds it
     *
     * Errors:
     *   404: Attribute group not found.
     *
     * GET https://items.augur-api.com/attribute-groups/{attributeGroupUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attribute-groups~1{attributeGroupUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: AttributeGroupsListItem (fields listed on the class)
     *
     * @param int $attributeGroupUid Attribute group ID (attribute_group.attribute_group_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $attributeGroupUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{attributeGroupUid}',
            $params,
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /attribute-groups/{attributeGroupUid}
     *
     * Update Attribute Group
     * Call: $api->items->attributeGroups->update($attributeGroupUid, $data)
     *
     * Request body: Change an attribute group; every field is optional and an absent field keeps
     * its value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No record with this ID.
     *
     * PUT https://items.augur-api.com/attribute-groups/{attributeGroupUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attribute-groups~1{attributeGroupUid}/put
     *
     * Request body ($data): AttributeGroupsUpdateBody (fields listed on the class)
     *
     * Response data type: AttributeGroupsCreateData (fields listed on the class)
     *
     * @param int $attributeGroupUid Attribute group ID (attribute_group.attribute_group_uid)
     * @param AttributeGroupsUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $attributeGroupUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{attributeGroupUid}',
            $data,
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /attribute-groups/{attributeGroupUid}/attributes
     *
     * List Attribute X Attribute Groups
     * Call: $api->items->attributeGroups->listAttributes($attributeGroupUid)
     *
     * Response data, each item: One attribute assigned to an attribute group, with the group and
     * attribute names
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an
     *       attribute_x_attribute_group column.
     *
     * GET https://items.augur-api.com/attribute-groups/{attributeGroupUid}/attributes
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attribute-groups~1{attributeGroupUid}~1attributes/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: attribute_x_attribute_group_uid|ASC)
     *   q?: string — Search Query
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of AttributeGroupsAttributesListItem (fields listed on the class)
     *
     * @param int $attributeGroupUid Attribute group ID (attribute_group.attribute_group_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listAttributes(int $attributeGroupUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{attributeGroupUid}/attributes',
            $params,
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /attribute-groups/{attributeGroupUid}/attributes
     *
     * Create Attribute X Attribute Group
     * Call: $api->items->attributeGroups->createAttributes($attributeGroupUid, $data)
     *
     * Request body: Assign an attribute to an attribute group (the group comes from the path)
     * Response data: The assignment AttributeXAttributeGroupHelper::create was asked for;
     * attributeXAttributeGroupUid is present only when a new row was created
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://items.augur-api.com/attribute-groups/{attributeGroupUid}/attributes
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attribute-groups~1{attributeGroupUid}~1attributes/post
     *
     * Request body ($data): AttributeGroupsAttributesCreateBody (fields listed on the class)
     *
     * Response data type: AttributeGroupsAttributesCreateData (fields listed on the class)
     *
     * @param int $attributeGroupUid Attribute group ID (attribute_group.attribute_group_uid)
     * @param AttributeGroupsAttributesCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributes(int $attributeGroupUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{attributeGroupUid}/attributes',
            $data,
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}
     *
     * DELETE Attribute X Attribute Group
     * Call:
     * $api->items->attributeGroups->deleteAttributes($attributeGroupUid, $attributeXAttributeGroupUid)
     *
     * Errors:
     *   404: No record with this ID.
     *
     * DELETE
     * https://items.augur-api.com/attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attribute-groups~1{attributeGroupUid}~1attributes~1{attributeXAttributeGroupUid}/delete
     *
     * Response data type: AttributeGroupsAttributesUpdateData (fields listed on the class)
     *
     * @param int $attributeGroupUid Attribute group ID (attribute_group.attribute_group_uid)
     * @param int $attributeXAttributeGroupUid Attribute-to-group assignment ID (attribute_x_attribute_group.attribute_x_attribute_group_uid)
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteAttributes(int $attributeGroupUid, int $attributeXAttributeGroupUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}',
            ['attributeGroupUid' => (string) $attributeGroupUid, 'attributeXAttributeGroupUid' => (string) $attributeXAttributeGroupUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}
     *
     * Get Attribute X Attribute Group Details
     * Call:
     * $api->items->attributeGroups->getAttributes($attributeGroupUid, $attributeXAttributeGroupUid)
     *
     * Response data: One attribute assigned to an attribute group, with the group and attribute
     * names
     *
     * Errors:
     *   404: Attribute group assignment not found.
     *
     * GET
     * https://items.augur-api.com/attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attribute-groups~1{attributeGroupUid}~1attributes~1{attributeXAttributeGroupUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: AttributeGroupsAttributesListItem (fields listed on the class)
     *
     * @param int $attributeGroupUid Attribute group ID (attribute_group.attribute_group_uid)
     * @param int $attributeXAttributeGroupUid Attribute-to-group assignment ID (attribute_x_attribute_group.attribute_x_attribute_group_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getAttributes(int $attributeGroupUid, int $attributeXAttributeGroupUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}',
            $params,
            ['attributeGroupUid' => (string) $attributeGroupUid, 'attributeXAttributeGroupUid' => (string) $attributeXAttributeGroupUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}
     *
     * Update Attribute X Attribute Group
     * Call:
     * $api->items->attributeGroups->updateAttributes($attributeGroupUid, $attributeXAttributeGroupUid, $data)
     *
     * Request body: Change an attribute-to-group assignment; every field is optional and an absent
     * field keeps its value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No record with this ID.
     *
     * PUT
     * https://items.augur-api.com/attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1attribute-groups~1{attributeGroupUid}~1attributes~1{attributeXAttributeGroupUid}/put
     *
     * Request body ($data): AttributeGroupsAttributesUpdateBody (fields listed on the class)
     *
     * Response data type: AttributeGroupsAttributesUpdateData (fields listed on the class)
     *
     * @param int $attributeGroupUid Attribute group ID (attribute_group.attribute_group_uid)
     * @param int $attributeXAttributeGroupUid Attribute-to-group assignment ID (attribute_x_attribute_group.attribute_x_attribute_group_uid)
     * @param AttributeGroupsAttributesUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateAttributes(int $attributeGroupUid, int $attributeXAttributeGroupUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}',
            $data,
            ['attributeGroupUid' => (string) $attributeGroupUid, 'attributeXAttributeGroupUid' => (string) $attributeXAttributeGroupUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
