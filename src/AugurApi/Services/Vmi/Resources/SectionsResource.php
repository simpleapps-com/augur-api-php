<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * sections resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
 */
final class SectionsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /sections
     *
     * Response data type: array
     *   sectionsUid: int
     *   customerId: float
     *   sectionsId: string
     *   sectionsName: string
     *   sectionsDesc: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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
     * POST /sections
     *
     * Response data type: object
     *   sectionsUid: int
     *   customerId: float
     *   sectionsId: string
     *   sectionsName: string
     *   sectionsDesc: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /sections/{sectionsUid}
     *
     * Response data type: object
     *   sectionsUid: int
     *   customerId: float
     *   sectionsId: string
     *   sectionsName: string
     *   sectionsDesc: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $sectionsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{sectionsUid}',
            ['sectionsUid' => (string) $sectionsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /sections/{sectionsUid}
     *
     * Response data type: object
     *   sectionsUid: int
     *   customerId: float
     *   sectionsId: string
     *   sectionsName: string
     *   sectionsDesc: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $sectionsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{sectionsUid}',
            $params,
            ['sectionsUid' => (string) $sectionsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /sections/{sectionsUid}
     *
     * Response data type: object
     *   sectionsUid: int
     *   customerId: float
     *   sectionsId: string
     *   sectionsName: string
     *   sectionsDesc: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $sectionsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{sectionsUid}',
            $data,
            ['sectionsUid' => (string) $sectionsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /sections/{sectionsUid}/enable
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function updateEnable(int $sectionsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{sectionsUid}/enable',
            $data,
            ['sectionsUid' => (string) $sectionsUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
