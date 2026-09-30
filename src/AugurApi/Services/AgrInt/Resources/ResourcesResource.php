<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * resources resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-int
 */
final class ResourcesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /resources
     *
     * Response data type: array
     *   resourcesUid: int
     *   resourceId: string
     *   resourceName: string
     *   resourceType: string
     *   resourcePath: string
     *   description: string|null
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
     * POST /resources
     *
     * Response data type: object
     *   resourcesUid: int
     *   resourceId: string
     *   resourceName: string
     *   resourceType: string
     *   resourcePath: string
     *   description: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{resourceName: string, resourceType: string, resourcePath: string, description?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null} $data
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
     * DELETE /resources/{resourcesUid}
     *
     * Response data type: object
     *   resourcesUid: int
     *   resourceId: string
     *   resourceName: string
     *   resourceType: string
     *   resourcePath: string
     *   description: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $resourcesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{resourcesUid}',
            ['resourcesUid' => (string) $resourcesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /resources/{resourcesUid}
     *
     * Response data type: object
     *   resourcesUid: int
     *   resourceId: string
     *   resourceName: string
     *   resourceType: string
     *   resourcePath: string
     *   description: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $resourcesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{resourcesUid}',
            $params,
            ['resourcesUid' => (string) $resourcesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /resources/{resourcesUid}
     *
     * Response data type: object
     *   resourcesUid: int
     *   resourceId: string
     *   resourceName: string
     *   resourceType: string
     *   resourcePath: string
     *   description: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{resourceName?: string|null, resourceType?: string|null, resourcePath?: string|null, description?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $resourcesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{resourcesUid}',
            $data,
            ['resourcesUid' => (string) $resourcesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
