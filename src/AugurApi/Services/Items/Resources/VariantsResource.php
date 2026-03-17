<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * variants resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
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
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /variants
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
     * DELETE /variants/{itemVariantHdrUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $itemVariantHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{itemVariantHdrUid}',
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /variants/{itemVariantHdrUid}
     *
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /variants/{itemVariantHdrUid}
     *
     * @param array<string, mixed> $data
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /variants/{itemVariantHdrUid}/attributes
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAttributes(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /variants/{itemVariantHdrUid}/attributes
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributes(int $itemVariantHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes',
            $data,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /variants/{itemVariantHdrUid}/attributes/{attributeUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteAttributes(int $attributeUid, int $itemVariantHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes/{attributeUid}',
            ['attributeUid' => (string) $attributeUid, 'itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /variants/{itemVariantHdrUid}/attributes/{attributeUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getAttributes(int $attributeUid, int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes/{attributeUid}',
            $params,
            ['attributeUid' => (string) $attributeUid, 'itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /variants/{itemVariantHdrUid}/attributes/{attributeUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateAttributes(int $attributeUid, int $itemVariantHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes/{attributeUid}',
            $data,
            ['attributeUid' => (string) $attributeUid, 'itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /variants/{itemVariantHdrUid}/doc
     *
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Alias for listDoc — GET /variants/{itemVariantHdrUid}/doc
     *
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
     * Response data type: array
     * Known fields: itemVariantLineUid, itemVariantHdrUid, invMastUid, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (10 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listLines(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/lines',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /variants/{itemVariantHdrUid}/lines
     *
     * Response data type: object
     * Known fields: itemVariantLineUid, itemVariantHdrUid, invMastUid, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (10 total)
     *
     * @param array<string, mixed> $data
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}
     *
     * Response data type: object
     * Known fields: itemVariantLineUid, itemVariantHdrUid, invMastUid, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (10 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteLines(int $itemVariantHdrUid, int $itemVariantLineUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{itemVariantHdrUid}/lines/{itemVariantLineUid}',
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid, 'itemVariantLineUid' => (string) $itemVariantLineUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}
     *
     * Response data type: object
     * Known fields: itemVariantLineUid, itemVariantHdrUid, invMastUid, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (10 total)
     *
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}
     *
     * Response data type: object
     * Known fields: itemVariantLineUid, itemVariantHdrUid, invMastUid, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (10 total)
     *
     * @param array<string, mixed> $data
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /variants/{itemVariantHdrUid}/similar
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listSimilar(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/similar',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
