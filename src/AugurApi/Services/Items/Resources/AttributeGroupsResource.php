<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Attribute Groups resource.
 *
 * @fullPath api.items.attributeGroups
 * @service items
 * @domain inventory-management
 */
final class AttributeGroupsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List all attribute groups.
     *
     * @fullPath api.items.attributeGroups.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/attribute-groups', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get attribute group by ID.
     *
     * @fullPath api.items.attributeGroups.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $attributeGroupUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/attribute-groups/{attributeGroupUid}',
            [],
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create new attribute group.
     *
     * @fullPath api.items.attributeGroups.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/attribute-groups', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update attribute group.
     *
     * @fullPath api.items.attributeGroups.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $attributeGroupUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/attribute-groups/{attributeGroupUid}',
            $data,
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete attribute group.
     *
     * @fullPath api.items.attributeGroups.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $attributeGroupUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/attribute-groups/{attributeGroupUid}',
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * List attributes in attribute group.
     *
     * @fullPath api.items.attributeGroups.attributes.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listAttributes(int $attributeGroupUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/attribute-groups/{attributeGroupUid}/attributes',
            $params,
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get attribute group attribute association.
     *
     * @fullPath api.items.attributeGroups.attributes.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function getAttribute(int $attributeGroupUid, int $attributeXAttributeGroupUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}',
            [],
            [
                'attributeGroupUid' => (string) $attributeGroupUid,
                'attributeXAttributeGroupUid' => (string) $attributeXAttributeGroupUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Add attribute to attribute group.
     *
     * @fullPath api.items.attributeGroups.attributes.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttribute(int $attributeGroupUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/attribute-groups/{attributeGroupUid}/attributes',
            $data,
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update attribute group attribute association.
     *
     * @fullPath api.items.attributeGroups.attributes.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateAttribute(int $attributeGroupUid, int $attributeXAttributeGroupUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}',
            $data,
            [
                'attributeGroupUid' => (string) $attributeGroupUid,
                'attributeXAttributeGroupUid' => (string) $attributeXAttributeGroupUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Remove attribute from attribute group.
     *
     * @fullPath api.items.attributeGroups.attributes.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteAttribute(int $attributeGroupUid, int $attributeXAttributeGroupUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}',
            [
                'attributeGroupUid' => (string) $attributeGroupUid,
                'attributeXAttributeGroupUid' => (string) $attributeXAttributeGroupUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
