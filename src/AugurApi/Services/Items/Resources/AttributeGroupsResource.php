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
     * @return BaseResponse<mixed>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /attribute-groups
     *
     * Response data type: object
     *   attributeGroupUid: int
     *   attributeGroupId: string
     *   attributeGroupDesc: string|null
     *   rowStatusFlag: int
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   attributeGroupType: int
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   typeCd: int
     *   searchableCd: int
     *   itemCount: int
     *
     * @param array{attributeGroupDesc: string, attributeGroupType?: int, typeCd?: int, searchableCd?: int, statusCd?: int} $data
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
     * @return BaseResponse<mixed>
     */
    public function delete(int $attributeGroupUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{attributeGroupUid}',
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /attribute-groups/{attributeGroupUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $attributeGroupUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{attributeGroupUid}',
            $params,
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /attribute-groups/{attributeGroupUid}
     *
     * Response data type: object
     *   attributeGroupUid: int
     *   attributeGroupId: string
     *   attributeGroupDesc: string|null
     *   rowStatusFlag: int
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   attributeGroupType: int
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   typeCd: int
     *   searchableCd: int
     *   itemCount: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /attribute-groups/{attributeGroupUid}/attributes
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listAttributes(int $attributeGroupUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{attributeGroupUid}/attributes',
            $params,
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /attribute-groups/{attributeGroupUid}/attributes
     *
     * @param array{attributeUid: int, requiredFlag?: string, sequenceNo?: int} $data
     * @return BaseResponse<mixed>
     */
    public function createAttributes(int $attributeGroupUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{attributeGroupUid}/attributes',
            $data,
            ['attributeGroupUid' => (string) $attributeGroupUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}
     *
     * @return BaseResponse<mixed>
     */
    public function deleteAttributes(int $attributeGroupUid, int $attributeXAttributeGroupUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}',
            ['attributeGroupUid' => (string) $attributeGroupUid, 'attributeXAttributeGroupUid' => (string) $attributeXAttributeGroupUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getAttributes(int $attributeGroupUid, int $attributeXAttributeGroupUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}',
            $params,
            ['attributeGroupUid' => (string) $attributeGroupUid, 'attributeXAttributeGroupUid' => (string) $attributeXAttributeGroupUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid}
     *
     * Response data type: object
     *   attributeXAttributeGroupUid: int
     *   requiredFlag: string
     *   rowStatusFlag: int
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   attributeUid: int
     *   attributeGroupUid: int
     *   sequenceNo: int|null
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
