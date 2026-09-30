<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * rubrics resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-info
 */
final class RubricsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /rubrics
     *
     * Response data type: array
     *   rubricsUid: int
     *   title: string|null
     *   id: string|null
     *   content: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
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
     * POST /rubrics
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /rubrics/{rubricsUid}
     *
     * @return BaseResponse<mixed>
     */
    public function delete(int $rubricsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{rubricsUid}',
            ['rubricsUid' => (string) $rubricsUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /rubrics/{rubricsUid}
     *
     * Response data type: object
     *   rubricsUid: int
     *   title: string|null
     *   id: string|null
     *   content: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $rubricsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{rubricsUid}',
            $params,
            ['rubricsUid' => (string) $rubricsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /rubrics/{rubricsUid}
     *
     * Response data type: object
     *   rubricsUid: int
     *   title: string|null
     *   id: string|null
     *   content: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $rubricsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{rubricsUid}',
            $data,
            ['rubricsUid' => (string) $rubricsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
