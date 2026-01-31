<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Attributes resource.
 *
 * @fullPath api.items.attributes
 * @service items
 * @domain inventory-management
 */
final class AttributesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List all attributes.
     *
     * @fullPath api.items.attributes.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/attributes', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get attribute by ID.
     *
     * @fullPath api.items.attributes.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $attributeUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/attributes/{attributeUid}',
            [],
            ['attributeUid' => (string) $attributeUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create new attribute.
     *
     * @fullPath api.items.attributes.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/attributes', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update attribute.
     *
     * @fullPath api.items.attributes.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $attributeUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/attributes/{attributeUid}',
            $data,
            ['attributeUid' => (string) $attributeUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete attribute.
     *
     * @fullPath api.items.attributes.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $attributeUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/attributes/{attributeUid}',
            ['attributeUid' => (string) $attributeUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * List attribute values.
     *
     * @fullPath api.items.attributes.values.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listValues(int $attributeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/attributes/{attributeUid}/values',
            $params,
            ['attributeUid' => (string) $attributeUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get attribute value.
     *
     * @fullPath api.items.attributes.values.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function getValue(int $attributeUid, int $attributeValueUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/attributes/{attributeUid}/values/{attributeValueUid}',
            [],
            ['attributeUid' => (string) $attributeUid, 'attributeValueUid' => (string) $attributeValueUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create attribute value.
     *
     * @fullPath api.items.attributes.values.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createValue(int $attributeUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/attributes/{attributeUid}/values',
            $data,
            ['attributeUid' => (string) $attributeUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update attribute value.
     *
     * @fullPath api.items.attributes.values.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateValue(int $attributeUid, int $attributeValueUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/attributes/{attributeUid}/values/{attributeValueUid}',
            $data,
            ['attributeUid' => (string) $attributeUid, 'attributeValueUid' => (string) $attributeValueUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete attribute value.
     *
     * @fullPath api.items.attributes.values.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteValue(int $attributeUid, int $attributeValueUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/attributes/{attributeUid}/values/{attributeValueUid}',
            ['attributeUid' => (string) $attributeUid, 'attributeValueUid' => (string) $attributeValueUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
