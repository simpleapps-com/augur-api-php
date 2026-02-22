<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Variants resource.
 *
 * @fullPath api.items.variants
 * @service items
 * @domain inventory-management
 */
final class VariantsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List product variants.
     *
     * @fullPath api.items.variants.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/variants', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get product variant.
     *
     * @fullPath api.items.variants.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $itemVariantHdrUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}',
            [],
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create product variant.
     *
     * @fullPath api.items.variants.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/variants', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update product variant.
     *
     * @fullPath api.items.variants.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $itemVariantHdrUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}',
            $data,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete product variant.
     *
     * @fullPath api.items.variants.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $itemVariantHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}',
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get variant documents.
     *
     * @fullPath api.items.variants.doc.list
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $itemVariantHdrUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}/doc',
            [],
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get similar variants.
     *
     * @fullPath api.items.variants.similar.list
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getSimilar(int $itemVariantHdrUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}/similar',
            [],
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * List variant lines.
     *
     * @fullPath api.items.variants.lines.list
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listLines(int $itemVariantHdrUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}/lines',
            [],
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get variant line.
     *
     * @fullPath api.items.variants.lines.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLine(int $itemVariantHdrUid, int $itemVariantLineUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}',
            [],
            [
                'itemVariantHdrUid' => (string) $itemVariantHdrUid,
                'itemVariantLineUid' => (string) $itemVariantLineUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create variant line.
     *
     * @fullPath api.items.variants.lines.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createLine(int $itemVariantHdrUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}/lines',
            $data,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update variant line.
     *
     * @fullPath api.items.variants.lines.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateLine(int $itemVariantHdrUid, int $itemVariantLineUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}',
            $data,
            [
                'itemVariantHdrUid' => (string) $itemVariantHdrUid,
                'itemVariantLineUid' => (string) $itemVariantLineUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete variant line.
     *
     * @fullPath api.items.variants.lines.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteLine(int $itemVariantHdrUid, int $itemVariantLineUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}',
            [
                'itemVariantHdrUid' => (string) $itemVariantHdrUid,
                'itemVariantLineUid' => (string) $itemVariantLineUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * List variant attributes.
     *
     * @fullPath api.items.variants.attributes.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listAttributes(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}/attributes',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get variant attribute.
     *
     * @fullPath api.items.variants.attributes.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function getAttribute(int $itemVariantHdrUid, int $attributeUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}/attributes/{attributeUid}',
            [],
            [
                'itemVariantHdrUid' => (string) $itemVariantHdrUid,
                'attributeUid' => (string) $attributeUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create variant attribute.
     *
     * @fullPath api.items.variants.attributes.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttribute(int $itemVariantHdrUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}/attributes',
            $data,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update variant attribute.
     *
     * @fullPath api.items.variants.attributes.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateAttribute(int $itemVariantHdrUid, int $attributeUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}/attributes/{attributeUid}',
            $data,
            [
                'itemVariantHdrUid' => (string) $itemVariantHdrUid,
                'attributeUid' => (string) $attributeUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete variant attribute.
     *
     * @fullPath api.items.variants.attributes.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteAttribute(int $itemVariantHdrUid, int $attributeUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/variants/{itemVariantHdrUid}/attributes/{attributeUid}',
            [
                'itemVariantHdrUid' => (string) $itemVariantHdrUid,
                'attributeUid' => (string) $attributeUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
