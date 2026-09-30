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
     *   customerTagsUid: int
     *   customerId: float
     *   tag: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listTags(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/tags',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /customers/{customerId}/tags
     *
     * Response data type: object
     *   customerTagsUid: int
     *   customerId: float
     *   tag: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createTags(int $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/tags',
            $data,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /customers/{customerId}/tags/{customerTagsUid}
     *
     * @return BaseResponse<mixed>
     */
    public function deleteTags(int $customerId, int $customerTagsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{customerId}/tags/{customerTagsUid}',
            ['customerId' => (string) $customerId, 'customerTagsUid' => (string) $customerTagsUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customers/{customerId}/tags/{customerTagsUid}
     *
     * Response data type: object
     *   customerTagsUid: int
     *   customerId: float
     *   tag: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /customers/{customerId}/tags/{customerTagsUid}
     *
     * Response data type: object
     *   customerTagsUid: int
     *   customerId: float
     *   tag: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
