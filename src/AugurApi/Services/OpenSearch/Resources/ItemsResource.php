<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * items resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py open-search
 */
final class ItemsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /items
     *
     * Response data type: array
     *   invMastUid: int
     *   itemId: string|null
     *   online: string
     *   updateCd: int
     *   doc: string|null
     *   indexCd: int
     *   statusCd: int
     *   processCd: int
     *   indexStatusCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   classId5: string|null
     *   dateLastChecked: string
     *   embeddingCd: int
     *   docHash: string|null
     *   indexHash: string|null
     *   location: string|null
     *   uuid: string|null
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
     * PUT /items/refresh
     *
     * Response data type: boolean
     *
     * @param array{updateCd?: bool, indexCd?: bool, processCd?: bool} $data
     * @return BaseResponse<bool>
     */
    public function updateRefresh(array $data = []): BaseResponse
    {
        $response = $this->client->put($this->baseUrl, '/refresh', $data);

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /items/{invMastUid}
     *
     * Response data type: object
     *   invMastUid: int
     *   itemId: string|null
     *   online: string
     *   updateCd: int
     *   doc: string|null
     *   indexCd: int
     *   statusCd: int
     *   processCd: int
     *   indexStatusCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   classId5: string|null
     *   dateLastChecked: string
     *   embeddingCd: int
     *   docHash: string|null
     *   indexHash: string|null
     *   location: string|null
     *   uuid: string|null
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /items/{invMastUid}
     *
     * Response data type: object
     *   invMastUid: int
     *   itemId: string|null
     *   online: string
     *   updateCd: int
     *   doc: string|null
     *   indexCd: int
     *   statusCd: int
     *   processCd: int
     *   indexStatusCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   classId5: string|null
     *   dateLastChecked: string
     *   embeddingCd: int
     *   docHash: string|null
     *   indexHash: string|null
     *   location: string|null
     *   uuid: string|null
     *
     * @param array{statusCd?: int|null, processCd?: int|null} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /items/{invMastUid}/refresh
     *
     * Response data type: object
     *   invMastUid: int
     *   itemId: string|null
     *   online: string
     *   updateCd: int
     *   doc: string|null
     *   indexCd: int
     *   statusCd: int
     *   processCd: int
     *   indexStatusCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   classId5: string|null
     *   dateLastChecked: string
     *   embeddingCd: int
     *   docHash: string|null
     *   indexHash: string|null
     *   location: string|null
     *   uuid: string|null
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getRefresh(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/refresh',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
