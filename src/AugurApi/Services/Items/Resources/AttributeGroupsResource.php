<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * attributeGroups resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
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
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /attribute-groups
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /attribute-groups/{attributeGroupUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $attributeGroupUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{attributeGroupUid}',
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /attribute-groups/{attributeGroupUid}
     *
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /attribute-groups/{attributeGroupUid}
     *
     * @param array<string, mixed> $data
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /attribute-groups/{attributeGroupUid}/attributes
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAttributes(int $attributeGroupUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{attributeGroupUid}/attributes',
            $params,
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /attribute-groups/{attributeGroupUid}/attributes
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributes(int $attributeGroupUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{attributeGroupUid}/attributes',
            $data,
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteAttributes(int $attributeGroupUid, int $attributeXAttributeGroupUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}',
            ['attributeGroupUid' => (string) $attributeGroupUid, 'attributeXAttributeGroupUid' => (string) $attributeXAttributeGroupUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}
     *
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}
     *
     * @param array<string, mixed> $data
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
