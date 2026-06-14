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
     * Known fields: resourcesUid, resourceId, resourceName, resourceType, resourcePath, description, dateCreated, dateLastModified, ... (11 total)
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
     * POST /resources
     *
     * Response data type: object
     * Known fields: resourcesUid, resourceId, resourceName, resourceType, resourcePath, description, dateCreated, dateLastModified, ... (11 total)
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
     * DELETE /resources/{resourcesUid}
     *
     * Response data type: object
     * Known fields: resourcesUid, resourceId, resourceName, resourceType, resourcePath, description, dateCreated, dateLastModified, ... (11 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /resources/{resourcesUid}
     *
     * Response data type: object
     * Known fields: resourcesUid, resourceId, resourceName, resourceType, resourcePath, description, dateCreated, dateLastModified, ... (11 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /resources/{resourcesUid}
     *
     * Response data type: object
     * Known fields: resourcesUid, resourceId, resourceName, resourceType, resourcePath, description, dateCreated, dateLastModified, ... (11 total)
     *
     * @param array<string, mixed> $data
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
