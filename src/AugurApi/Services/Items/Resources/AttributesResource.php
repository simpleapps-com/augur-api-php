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
     * Known fields: attributeUid, attributeDesc, extendedDesc, attributeId, dataType, maxLength, noOfDecimal, rowStatusFlag, ... (18 total)
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
     * POST /attributes
     *
     * Response data type: object
     * Known fields: attributeUid, attributeDesc, extendedDesc, attributeId, dataType, maxLength, noOfDecimal, rowStatusFlag, ... (18 total)
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
     * DELETE /attributes/{attributeUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $attributeUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{attributeUid}',
            ['attributeUid' => (string) $attributeUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /attributes/{attributeUid}
     *
     * Response data type: object
     * Known fields: attributeUid, attributeDesc, extendedDesc, attributeId, dataType, maxLength, noOfDecimal, rowStatusFlag, ... (18 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /attributes/{attributeUid}
     *
     * Response data type: object
     * Known fields: attributeUid, attributeDesc, extendedDesc, attributeId, dataType, maxLength, noOfDecimal, rowStatusFlag, ... (18 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /attributes/{attributeUid}/values
     *
     * Response data type: array
     * Known fields: attributeValueUid, attributeUid, attributeValue, rowStatusFlag, dateCreated, createdBy, dateLastModified, lastMaintainedBy, ... (13 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listValues(int $attributeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{attributeUid}/values',
            $params,
            ['attributeUid' => (string) $attributeUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /attributes/{attributeUid}/values
     *
     * Response data type: object
     * Known fields: attributeValueUid, attributeUid, attributeValue, rowStatusFlag, dateCreated, createdBy, dateLastModified, lastMaintainedBy, ... (13 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createValues(int $attributeUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{attributeUid}/values',
            $data,
            ['attributeUid' => (string) $attributeUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /attributes/{attributeUid}/values/{attributeValueUid}
     *
     * Response data type: object
     * Known fields: attributeValueUid, attributeUid, attributeValue, rowStatusFlag, dateCreated, createdBy, dateLastModified, lastMaintainedBy, ... (13 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /attributes/{attributeUid}/values/{attributeValueUid}
     *
     * Response data type: object
     * Known fields: attributeValueUid, attributeUid, attributeValue, rowStatusFlag, dateCreated, createdBy, dateLastModified, lastMaintainedBy, ... (13 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /attributes/{attributeUid}/values/{attributeValueUid}
     *
     * Response data type: object
     * Known fields: attributeValueUid, attributeUid, attributeValue, rowStatusFlag, dateCreated, createdBy, dateLastModified, lastMaintainedBy, ... (13 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
