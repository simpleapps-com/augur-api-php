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
     * POST /variants
     *
     * @param array{name: string, description?: string} $data
     * @return BaseResponse<mixed>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /variants/{itemVariantHdrUid}
     *
     * @return BaseResponse<mixed>
     */
    public function delete(int $itemVariantHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{itemVariantHdrUid}',
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /variants/{itemVariantHdrUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /variants/{itemVariantHdrUid}
     *
     * @param array{name?: string, description?: string, statusCd?: int} $data
     * @return BaseResponse<mixed>
     */
    public function update(int $itemVariantHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{itemVariantHdrUid}',
            $data,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /variants/{itemVariantHdrUid}/attributes
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listAttributes(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /variants/{itemVariantHdrUid}/attributes
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createAttributes(int $itemVariantHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes',
            $data,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /variants/{itemVariantHdrUid}/attributes/{attributeUid}
     *
     * @return BaseResponse<mixed>
     */
    public function deleteAttributes(int $itemVariantHdrUid, int $attributeUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes/{attributeUid}',
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid, 'attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /variants/{itemVariantHdrUid}/attributes/{attributeUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getAttributes(int $itemVariantHdrUid, int $attributeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes/{attributeUid}',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid, 'attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /variants/{itemVariantHdrUid}/attributes/{attributeUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function updateAttributes(int $itemVariantHdrUid, int $attributeUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{itemVariantHdrUid}/attributes/{attributeUid}',
            $data,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid, 'attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /variants/{itemVariantHdrUid}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listDoc(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/doc',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /variants/{itemVariantHdrUid}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getDoc(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        return $this->listDoc($itemVariantHdrUid, $params);
    }

    /**
     * GET /variants/{itemVariantHdrUid}/lines
     *
     * Response data type: array
     *   itemVariantLineUid: int
     *   itemVariantHdrUid: int
     *   invMastUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   primaryCd: int
     *   sequenceNo: int
     *
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
     * Response data type: object
     *   itemVariantLineUid: int
     *   itemVariantHdrUid: int
     *   invMastUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   primaryCd: int
     *   sequenceNo: int
     *
     * @param array{invMastUid: int, statusCd?: int, processCd?: int, updateCd?: int} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createLines(int $itemVariantHdrUid, array $data): BaseResponse
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
     * Response data type: object
     *   itemVariantLineUid: int
     *   itemVariantHdrUid: int
     *   invMastUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   primaryCd: int
     *   sequenceNo: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}
     *
     * Response data type: object
     *   itemVariantLineUid: int
     *   itemVariantHdrUid: int
     *   invMastUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   primaryCd: int
     *   sequenceNo: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /variants/{itemVariantHdrUid}/lines/{itemVariantLineUid}
     *
     * Response data type: object
     *   itemVariantLineUid: int
     *   itemVariantHdrUid: int
     *   invMastUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   primaryCd: int
     *   sequenceNo: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /variants/{itemVariantHdrUid}/similar
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listSimilar(int $itemVariantHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemVariantHdrUid}/similar',
            $params,
            ['itemVariantHdrUid' => (string) $itemVariantHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
