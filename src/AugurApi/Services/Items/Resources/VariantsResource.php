<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * variants resource — generated from spec.
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
 * VariantsListItem:
 * Returned by: $api->items->variants->list()
 * Returned by: $api->items->variants->create($data)
 * Returned by: $api->items->variants->get($itemVariantHdrUid)
 * Returned by: $api->items->variants->update($itemVariantHdrUid, $data)
 * Returned by: $api->items->variants->delete($itemVariantHdrUid)
 *   itemVariantHdrUid: int — Variant group ID
 *   name: string — Variant group name (max 255 chars)
 *   id: string — Variant group code, derived from name (max 255 chars)
 *   description: string — Variant group description (max 255 chars)
 *   vector: string|null — The 1536 dimensional vector that represents the variant data (max
 *       4294967295 chars)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code: workflow state of the row
 *   contentHash: string|null — Hash of content; changes when the group content changes (max 64
 *       chars)
 *   content: string|null — Text built from the group items, used for the similarity vector (max
 *       4294967295 chars)
 *   vectorCd: int — Vector code: 704 when the similarity vector needs a rebuild
 *
 * VariantsCreateBody: Create a variant group, or return the existing one whose derived id matches
 * Request body of: $api->items->variants->create($data)
 *   name: string|null — Variant group name; its id is derived from it. Without it nothing is
 *       created and data is an empty object
 *   description?: string|null — Variant group description; defaults to name
 *
 * VariantsUpdateBody: Change a variant group; every field is optional and an absent field keeps its
 * value
 * Request body of: $api->items->variants->update($itemVariantHdrUid, $data)
 *   name?: string|null — Variant group name; also regenerates its id
 *   description?: string|null — Variant group description
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *
 * VariantsAttributesListItem:
 * Returned by: $api->items->variants->listAttributes($itemVariantHdrUid)
 * Returned by: $api->items->variants->createAttributes($itemVariantHdrUid, $data)
 * Returned by: $api->items->variants->getAttributes($itemVariantHdrUid, $attributeUid)
 * Returned by: $api->items->variants->updateAttributes($itemVariantHdrUid, $attributeUid, $data)
 * Returned by: $api->items->variants->deleteAttributes($itemVariantHdrUid, $attributeUid)
 *   itemVariantHdrXAttributeUid: int — Variant group attribute ID
 *   itemVariantHdrUid: int — Variant group ID (item_variant_hdr.item_variant_hdr_uid)
 *   attributeUid: int — Attribute ID (attribute.attribute_uid)
 *   sequenceNo: int — Order for multi-attribute variants (P21 standard)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code: workflow state of the row
 *
 * VariantsAttributesCreateBody: Add an attribute to a variant group (the group comes from the path)
 * Request body of: $api->items->variants->createAttributes($itemVariantHdrUid, $data)
 *   attributeUid: int|null — Attribute that distinguishes the variants (attribute.attribute_uid);
 *       required
 *   sequenceNo?: int|null — Display order of the attribute; defaults to 1
 *
 * VariantsAttributesUpdateBody: Change a variant group attribute; every field is optional and an
 * absent field keeps its value
 * Request body of:
 * $api->items->variants->updateAttributes($itemVariantHdrUid, $attributeUid, $data)
 *   sequenceNo?: int|null — Display order of the attribute
 *   updateCd?: int|null — Update code: set when the row has changes waiting to sync
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code: workflow state of the row
 *
 * VariantsDocListData: A variant group doc: the header, the attributes that differentiate its
 * items, the primary item and every item
 * Returned by: $api->items->variants->listDoc($itemVariantHdrUid)
 *   header: VariantsDocListDataHeader|null — The variant group
 *   attributes: list<VariantsDocListDataAttributesItem> — Attributes that differentiate the items,
 *       in sequence order
 *     each item: VariantsDocListDataAttributesItem — One attribute that differentiates the items of
 *         a variant group
 *   primary: VariantsDocListDataPrimary|null — The primary item; null when no line is primary
 *   lines: list<VariantsDocListDataLinesItem> — Every item in the group, in sequence order
 *     each item: VariantsDocListDataLinesItem — One item of a variant group doc, with its values
 *         for the group attributes and its images
 *   totalVariants: int — Number of entries in lines
 *
 * VariantsDocListDataHeader: The variant group
 * Field `header` of VariantsDocListData
 *   itemVariantHdrUid: int — Variant group ID
 *   name: string — Variant group name
 *   id: string — Variant group code, derived from name
 *   description: string — Variant group description
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *
 * VariantsDocListDataAttributesItem: One attribute that differentiates the items of a variant group
 * Field `attributes` of VariantsDocListData
 *   attributeUid: int — Attribute ID (attribute.attribute_uid)
 *   attributeName: string|null — Attribute name
 *   sequenceNo: int — Display order of the attribute in the variant selector
 *
 * VariantsDocListDataPrimary: The primary item; null when no line is primary
 * Field `primary` of VariantsDocListData
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   itemId: string — Item code
 *   itemDesc: string|null — Item description
 *   sequenceNo: int — Display order of the item in the group
 *
 * VariantsDocListDataLinesItem: One item of a variant group doc, with its values for the group
 * attributes and its images
 * Field `lines` of VariantsDocListData
 *   itemVariantLineUid: int — Variant line ID
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   itemId: string — Item code
 *   itemDesc: string|null — Item description
 *   displayDesc: string|null — First web-displayed category description for the item
 *   primaryCd: int — Primary code: 704 for the group's primary item
 *   sequenceNo: int — Display order of the item in the group
 *   attributeValues: list<VariantsDocListDataLinesItemAttributeValuesItem> — The item's values for
 *       the group attributes
 *     each item: VariantsDocListDataLinesItemAttributeValuesItem — One value a variant item has for
 *         one of the group attributes
 *   images: list<string> — Image URLs or paths
 *
 * VariantsDocListDataLinesItemAttributeValuesItem: One value a variant item has for one of the
 * group attributes
 * Field `attributeValues` of VariantsDocListDataLinesItem
 *   attributeUid: int — Attribute ID (attribute.attribute_uid)
 *   attributeName: string|null — Attribute name
 *   value: string|null — The item value for the attribute
 *
 * VariantsLinesListItem:
 * Returned by: $api->items->variants->listLines($itemVariantHdrUid)
 * Returned by: $api->items->variants->createLines($itemVariantHdrUid, $data)
 * Returned by: $api->items->variants->getLines($itemVariantHdrUid, $itemVariantLineUid)
 * Returned by: $api->items->variants->updateLines($itemVariantHdrUid, $itemVariantLineUid, $data)
 * Returned by: $api->items->variants->deleteLines($itemVariantHdrUid, $itemVariantLineUid)
 *   itemVariantLineUid: int — Variant line ID
 *   itemVariantHdrUid: int — Variant group ID (item_variant_hdr.item_variant_hdr_uid)
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   dateCreated: string — When the row was created (Y-m-d H:i:s) (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — When the row last changed (Y-m-d H:i:s) (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code: set when the row has changes waiting to sync
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code: workflow state of the row
 *   primaryCd: int — Primary code: 704 for the group's primary item
 *   sequenceNo: int — Display order of the item within the variant group
 *
 * VariantsLinesCreateBody: Add an item to a variant group (the group comes from the path)
 * Request body of: $api->items->variants->createLines($itemVariantHdrUid, $data)
 *   invMastUid?: int|null — Item to add (inv_mast.inv_mast_uid)
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code: workflow state of the row
 *   updateCd?: int|null — Update code: set when the row has changes waiting to sync
 *
 * VariantsLinesUpdateBody: Change a variant line; every field is optional and an absent field keeps
 * its value
 * Request body of:
 * $api->items->variants->updateLines($itemVariantHdrUid, $itemVariantLineUid, $data)
 *   itemVariantHdrUid?: int|null — Move the line to this variant group
 *       (item_variant_hdr.item_variant_hdr_uid)
 *   invMastUid?: int|null — Item ID (inv_mast.inv_mast_uid)
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code: workflow state of the row
 *   updateCd?: int|null — Update code: set when the row has changes waiting to sync
 *   primaryCd?: int|null — Primary code: 704 makes this the primary item and clears primary on the
 *       group's other lines
 *   sequenceNo?: int|null — Display order in the variant selector
 *
 * VariantsSimilarListItem: One item similar to a variant group and not already in it, ranked by
 * vector similarity
 * Returned by: $api->items->variants->listSimilar($itemVariantHdrUid)
 *   score: float — Cosine-similarity score from the akasha index
 *   invMastUid: int — Item ID (inv_mast.inv_mast_uid)
 *   zScore: float — Standard score of score among the returned items
 *   itemId: string — Item code
 *   itemDesc: string|null — Item description
 *   brandName: string|null — Brand name
 *   onlineCd: int — Online code: 704 when shown on the website
 *
 * @phpstan-type VariantsListItem array{itemVariantHdrUid: int, name: string, id: string, description: string, vector: string|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, contentHash: string|null, content: string|null, vectorCd: int}
 * @phpstan-type VariantsCreateBody array{name: string|null, description?: string|null}
 * @phpstan-type VariantsUpdateBody array{name?: string|null, description?: string|null, statusCd?: int|null}
 * @phpstan-type VariantsAttributesListItem array{itemVariantHdrXAttributeUid: int, itemVariantHdrUid: int, attributeUid: int, sequenceNo: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type VariantsAttributesCreateBody array{attributeUid: int|null, sequenceNo?: int|null}
 * @phpstan-type VariantsAttributesUpdateBody array{sequenceNo?: int|null, updateCd?: int|null, statusCd?: int|null, processCd?: int|null}
 * @phpstan-type VariantsDocListData array{header: VariantsDocListDataHeader|null, attributes: list<VariantsDocListDataAttributesItem>, primary: VariantsDocListDataPrimary|null, lines: list<VariantsDocListDataLinesItem>, totalVariants: int}
 * @phpstan-type VariantsDocListDataHeader array{itemVariantHdrUid: int, name: string, id: string, description: string, statusCd: int}
 * @phpstan-type VariantsDocListDataAttributesItem array{attributeUid: int, attributeName: string|null, sequenceNo: int}
 * @phpstan-type VariantsDocListDataPrimary array{invMastUid: int, itemId: string, itemDesc: string|null, sequenceNo: int}
 * @phpstan-type VariantsDocListDataLinesItem array{itemVariantLineUid: int, invMastUid: int, itemId: string, itemDesc: string|null, displayDesc: string|null, primaryCd: int, sequenceNo: int, attributeValues: list<VariantsDocListDataLinesItemAttributeValuesItem>, images: list<string>}
 * @phpstan-type VariantsDocListDataLinesItemAttributeValuesItem array{attributeUid: int, attributeName: string|null, value: string|null}
 * @phpstan-type VariantsLinesListItem array{itemVariantLineUid: int, itemVariantHdrUid: int, invMastUid: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, primaryCd: int, sequenceNo: int}
 * @phpstan-type VariantsLinesCreateBody array{invMastUid?: int|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type VariantsLinesUpdateBody array{itemVariantHdrUid?: int|null, invMastUid?: int|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null, primaryCd?: int|null, sequenceNo?: int|null}
 * @phpstan-type VariantsSimilarListItem array{score: float, invMastUid: int, zScore: float, itemId: string, itemDesc: string|null, brandName: string|null, onlineCd: int}
 */
final class VariantsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /variants
     *
     * List Item Variant Headers
     * Call: $api->items->variants->list()
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an item_variant_hdr
     *       column.
     *
     * GET https://items.augur-api.com/variants
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1variants/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: item_variant_hdr_uid|ASC)
     *   q?: string — Search query (matches variant id, name, description, or underlying item id)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of VariantsListItem (fields listed on the class)
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
     * POST /variants
     *
     * Create Item Variant Header
     * Call: $api->items->variants->create($data)
     *
     * Request body: Create a variant group, or return the existing one whose derived id matches
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://items.augur-api.com/variants
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1variants/post
     *
     * Request body ($data): VariantsCreateBody (fields listed on the class)
     *
     * Response data type: VariantsListItem (fields listed on the class)
     *
     * @param VariantsCreateBody $data
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
     * DELETE /variants/{itemVariantHdrUid}
     *
     * DELETE Item Variant Header
     * Call: $api->items->variants->delete($itemVariantHdrUid)
     *
     * Errors:
     *   404: No record with this ID.
     *
     * DELETE https://items.augur-api.com/variants/{itemVariantHdrUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}/delete
     *
     * Response data type: VariantsListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $itemVariantHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{itemVariantHdrUid}',
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /variants/{itemVariantHdrUid}
     *
     * Get Item Variant Header Details
     * Call: $api->items->variants->get($itemVariantHdrUid)
     *
     * Errors:
     *   404: Variant group not found.
     *
     * GET https://items.augur-api.com/variants/{itemVariantHdrUid}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: VariantsListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /variants/{itemVariantHdrUid}
     *
     * Update Item Variant Header
     * Call: $api->items->variants->update($itemVariantHdrUid, $data)
     *
     * Request body: Change a variant group; every field is optional and an absent field keeps its
     * value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No record with this ID.
     *
     * PUT https://items.augur-api.com/variants/{itemVariantHdrUid}
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}/put
     *
     * Request body ($data): VariantsUpdateBody (fields listed on the class)
     *
     * Response data type: VariantsListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @param VariantsUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $itemVariantHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{itemVariantHdrUid}',
            $data,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /variants/{itemVariantHdrUid}/attributes
     *
     * List variant attributes
     * Call: $api->items->variants->listAttributes($itemVariantHdrUid)
     *
     * List attributes for variant
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an
     *       item_variant_hdr_x_attribute column.
     *
     * GET https://items.augur-api.com/variants/{itemVariantHdrUid}/attributes
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}~1attributes/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: sequence_no|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of VariantsAttributesListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listAttributes(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /variants/{itemVariantHdrUid}/attributes
     *
     * Add attribute to variant
     * Call: $api->items->variants->createAttributes($itemVariantHdrUid, $data)
     *
     * Request body: Add an attribute to a variant group (the group comes from the path)
     *
     * Success status: 201 (not 200)
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://items.augur-api.com/variants/{itemVariantHdrUid}/attributes
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}~1attributes/post
     *
     * Request body ($data): VariantsAttributesCreateBody (fields listed on the class)
     *
     * Response data type: VariantsAttributesListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @param VariantsAttributesCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributes(int $itemVariantHdrUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes',
            $data,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /variants/{itemVariantHdrUid}/attributes/{attributeUid}
     *
     * Remove attribute from variant
     * Call: $api->items->variants->deleteAttributes($itemVariantHdrUid, $attributeUid)
     *
     * Errors:
     *   404: No record with this ID; or variant group attribute not found.
     *
     * DELETE https://items.augur-api.com/variants/{itemVariantHdrUid}/attributes/{attributeUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}~1attributes~1{attributeUid}/delete
     *
     * Response data type: VariantsAttributesListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @param int $attributeUid Attribute ID (attribute.attribute_uid)
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteAttributes(int $itemVariantHdrUid, int $attributeUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes/{attributeUid}',
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid, 'attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /variants/{itemVariantHdrUid}/attributes/{attributeUid}
     *
     * Get variant attribute link
     * Call: $api->items->variants->getAttributes($itemVariantHdrUid, $attributeUid)
     *
     * Get variant attribute link details
     *
     * Errors:
     *   404: Variant group attribute not found.
     *
     * GET https://items.augur-api.com/variants/{itemVariantHdrUid}/attributes/{attributeUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}~1attributes~1{attributeUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: VariantsAttributesListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @param int $attributeUid Attribute ID (attribute.attribute_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getAttributes(int $itemVariantHdrUid, int $attributeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes/{attributeUid}',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid, 'attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /variants/{itemVariantHdrUid}/attributes/{attributeUid}
     *
     * Update variant attribute link
     * Call: $api->items->variants->updateAttributes($itemVariantHdrUid, $attributeUid, $data)
     *
     * Request body: Change a variant group attribute; every field is optional and an absent field
     * keeps its value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No record with this ID; or variant group attribute not found.
     *
     * PUT https://items.augur-api.com/variants/{itemVariantHdrUid}/attributes/{attributeUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}~1attributes~1{attributeUid}/put
     *
     * Request body ($data): VariantsAttributesUpdateBody (fields listed on the class)
     *
     * Response data type: VariantsAttributesListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @param int $attributeUid Attribute ID (attribute.attribute_uid)
     * @param VariantsAttributesUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateAttributes(int $itemVariantHdrUid, int $attributeUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes/{attributeUid}',
            $data,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid, 'attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /variants/{itemVariantHdrUid}/doc
     *
     * Get Variant Doc
     * Call: $api->items->variants->listDoc($itemVariantHdrUid)
     *
     * Response data: A variant group doc: the header, the attributes that differentiate its items,
     * the primary item and every item
     *
     * Errors:
     *   400: itemId query parameter is required when itemVariantHdrUid is 0.
     *   404: Item not found. Or Item is not in a variant group; or variant group not found.
     *
     * GET https://items.augur-api.com/variants/{itemVariantHdrUid}/doc
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}~1doc/get
     *
     * Query params ($params; `?` = optional):
     *   itemId?: string — Item ID for lookup when itemVariantHdrUid is 0
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: VariantsDocListData (fields listed on the class)
     *
     * @param int $itemVariantHdrUid item_variant_hdr_uid (use 0 with itemId query param for lookup)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDoc(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/doc',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /variants/{itemVariantHdrUid}/doc
     * Call: $api->items->variants->getDoc($itemVariantHdrUid)
     *
     * @param int $itemVariantHdrUid item_variant_hdr_uid (use 0 with itemId query param for lookup)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        return $this->listDoc($itemVariantHdrUid, $params);
    }

    /**
     * GET /variants/{itemVariantHdrUid}/lines
     *
     * List Item Variant Lines
     * Call: $api->items->variants->listLines($itemVariantHdrUid)
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field an item_variant_line
     *       column.
     *
     * GET https://items.augur-api.com/variants/{itemVariantHdrUid}/lines
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}~1lines/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: item_variant_line_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of VariantsLinesListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listLines(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/lines',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /variants/{itemVariantHdrUid}/lines
     *
     * Create Item Variant Line
     * Call: $api->items->variants->createLines($itemVariantHdrUid, $data)
     *
     * Request body: Add an item to a variant group (the group comes from the path)
     *
     * Success status: 201 (not 200)
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://items.augur-api.com/variants/{itemVariantHdrUid}/lines
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}~1lines/post
     *
     * Request body ($data): VariantsLinesCreateBody (fields listed on the class)
     *
     * Response data type: VariantsLinesListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @param VariantsLinesCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createLines(int $itemVariantHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{itemVariantHdrUid}/lines',
            $data,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}
     *
     * DELETE Item Variant Line
     * Call: $api->items->variants->deleteLines($itemVariantHdrUid, $itemVariantLineUid)
     *
     * Errors:
     *   404: No record with this ID.
     *
     * DELETE https://items.augur-api.com/variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}~1lines~1{itemVariantLineUid}/delete
     *
     * Response data type: VariantsLinesListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @param int $itemVariantLineUid Variant line ID (item_variant_line.item_variant_line_uid)
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteLines(int $itemVariantHdrUid, int $itemVariantLineUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{itemVariantHdrUid}/lines/{itemVariantLineUid}',
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid, 'itemVariantLineUid' => (string) $itemVariantLineUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}
     *
     * Get Item Variant Line Details
     * Call: $api->items->variants->getLines($itemVariantHdrUid, $itemVariantLineUid)
     *
     * GET https://items.augur-api.com/variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}~1lines~1{itemVariantLineUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: VariantsLinesListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @param int $itemVariantLineUid Variant line ID (item_variant_line.item_variant_line_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLines(int $itemVariantHdrUid, int $itemVariantLineUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/lines/{itemVariantLineUid}',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid, 'itemVariantLineUid' => (string) $itemVariantLineUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}
     *
     * Update Item Variant Line
     * Call: $api->items->variants->updateLines($itemVariantHdrUid, $itemVariantLineUid, $data)
     *
     * Request body: Change a variant line; every field is optional and an absent field keeps its
     * value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No record with this ID.
     *
     * PUT https://items.augur-api.com/variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}~1lines~1{itemVariantLineUid}/put
     *
     * Request body ($data): VariantsLinesUpdateBody (fields listed on the class)
     *
     * Response data type: VariantsLinesListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @param int $itemVariantLineUid Variant line ID (item_variant_line.item_variant_line_uid)
     * @param VariantsLinesUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateLines(int $itemVariantHdrUid, int $itemVariantLineUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{itemVariantHdrUid}/lines/{itemVariantLineUid}',
            $data,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid, 'itemVariantLineUid' => (string) $itemVariantLineUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /variants/{itemVariantHdrUid}/similar
     *
     * Find Similar Items for Variant Header
     * Call: $api->items->variants->listSimilar($itemVariantHdrUid)
     *
     * Response data, each item: One item similar to a variant group and not already in it, ranked
     * by vector similarity
     *
     * GET https://items.augur-api.com/variants/{itemVariantHdrUid}/similar
     * Contract:
     * https://items.augur-api.com/openapi.json#/paths/~1variants~1{itemVariantHdrUid}~1similar/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of VariantsSimilarListItem (fields listed on the class)
     *
     * @param int $itemVariantHdrUid Variant group ID (item_variant_hdr.item_variant_hdr_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listSimilar(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/similar',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
