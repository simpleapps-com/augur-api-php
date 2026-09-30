<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * attributes resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
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
     * Response data type: array
     *   attributeUid: int
     *   attributeDesc: string|null
     *   extendedDesc: string|null
     *   attributeId: string
     *   dataType: int
     *   maxLength: int
     *   noOfDecimal: int|null
     *   rowStatusFlag: int
     *   validationRequiredFlag: string
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   cfdiAttributeType: int|null
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   typeCd: int
     *   activeValueCount: int
     *   inactiveValueCount: int
     *   deletedValueCount: int
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
     * Response data type: object
     *   attributeUid: int
     *   attributeDesc: string|null
     *   extendedDesc: string|null
     *   attributeId: string
     *   dataType: int
     *   maxLength: int
     *   noOfDecimal: int|null
     *   rowStatusFlag: int
     *   validationRequiredFlag: string
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   cfdiAttributeType: int|null
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   typeCd: int
     *
     * @param array{attributeDesc: string, extendedDesc?: string, dataType?: int, maxLength?: int, noOfDecimal?: int, validationRequiredFlag?: string, cfdiAttributeType?: int} $data
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
     * DELETE /attributes/{attributeUid}
     *
     * @return BaseResponse<mixed>
     */
    public function delete(int $attributeUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{attributeUid}',
            ['attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /attributes/{attributeUid}
     *
     * Response data type: object
     *   attributeUid: int
     *   attributeDesc: string|null
     *   extendedDesc: string|null
     *   attributeId: string
     *   dataType: int
     *   maxLength: int
     *   noOfDecimal: int|null
     *   rowStatusFlag: int
     *   validationRequiredFlag: string
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   cfdiAttributeType: int|null
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   typeCd: int
     *   activeValueCount: int
     *   inactiveValueCount: int
     *   deletedValueCount: int
     *
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
     * Response data type: object
     *   attributeUid: int
     *   attributeDesc: string|null
     *   extendedDesc: string|null
     *   attributeId: string
     *   dataType: int
     *   maxLength: int
     *   noOfDecimal: int|null
     *   rowStatusFlag: int
     *   validationRequiredFlag: string
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   cfdiAttributeType: int|null
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   typeCd: int
     *
     * @param array<string, mixed> $data
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
     * Response data type: array
     *   itemAttributeValueUid: int
     *   invMastUid: int
     *   attributeUid: int
     *   attributeValue: string|null
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   attributeValueUid: int
     *   onlineCd: int
     *   attributeDesc: string|null
     *   attributeId: string
     *   itemId: string
     *   itemDesc: string|null
     *
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
     * Response data type: array
     *   attributeValueUid: int
     *   attributeUid: int
     *   attributeValue: string
     *   rowStatusFlag: int
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   sequenceNo: int
     *   itemCount: int
     *
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
     * Response data type: object
     *   attributeValueUid: int
     *   attributeUid: int
     *   attributeValue: string
     *   rowStatusFlag: int
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   sequenceNo: int
     *   itemCount: int
     *
     * @param array{attributeValue: string, sequenceNo?: int} $data
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
     * Response data type: object
     *   attributeValueUid: int
     *   attributeUid: int
     *   attributeValue: string
     *   rowStatusFlag: int
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   sequenceNo: int
     *   itemCount: int
     *
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
     * Response data type: object
     *   attributeValueUid: int
     *   attributeUid: int
     *   attributeValue: string
     *   rowStatusFlag: int
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   sequenceNo: int
     *   itemCount: int
     *
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
     * Response data type: object
     *   attributeValueUid: int
     *   attributeUid: int
     *   attributeValue: string
     *   rowStatusFlag: int
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   sequenceNo: int
     *   itemCount: int
     *
     * @param array<string, mixed> $data
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
