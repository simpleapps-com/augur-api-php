<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * customers resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py legacy
 */
final class CustomersResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /customers/{customerId}/tags
     *
     * Response data type: array
     * Known fields: customerTagsUid, customerId, tag, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listTags(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/tags',
            $params,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /customers/{customerId}/tags
     *
     * Response data type: object
     * Known fields: customerTagsUid, customerId, tag, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createTags(string $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/tags',
            $data,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /customers/{customerId}/tags/{customerTagsUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteTags(int $customerId, int $customerTagsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{customerId}/tags/{customerTagsUid}',
            ['customerId' => (string) $customerId, 'customerTagsUid' => (string) $customerTagsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customers/{customerId}/tags/{customerTagsUid}
     *
     * Response data type: object
     * Known fields: customerTagsUid, customerId, tag, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getTags(int $customerId, int $customerTagsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/tags/{customerTagsUid}',
            $params,
            ['customerId' => (string) $customerId, 'customerTagsUid' => (string) $customerTagsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /customers/{customerId}/tags/{customerTagsUid}
     *
     * Response data type: object
     * Known fields: customerTagsUid, customerId, tag, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateTags(int $customerId, int $customerTagsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{customerId}/tags/{customerTagsUid}',
            $data,
            ['customerId' => (string) $customerId, 'customerTagsUid' => (string) $customerTagsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
