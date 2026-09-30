<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * todolists resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py basecamp2
 */
final class TodolistsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /todolists
     *
     * Response data type: array
     *   id: int
     *   name: string|null
     *   description: string|null
     *   updatedAt: string
     *   createdAt: string
     *   url: string|null
     *   appUrl: string|null
     *   completedFlag: string|null
     *   privateFlag: string|null
     *   trashedFlag: string|null
     *   completedCount: int|null
     *   remainingCount: int|null
     *   creatorId: int|null
     *   bucketId: int|null
     *   updateCd: int
     *   position: int
     *   statusCd: int
     *   processCd: int
     *   projectsId: int
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
     * GET /todolists/{id}
     *
     * Response data type: object
     *   id: int
     *   name: string|null
     *   description: string|null
     *   updatedAt: string
     *   createdAt: string
     *   url: string|null
     *   appUrl: string|null
     *   completedFlag: string|null
     *   privateFlag: string|null
     *   trashedFlag: string|null
     *   completedCount: int|null
     *   remainingCount: int|null
     *   creatorId: int|null
     *   bucketId: int|null
     *   updateCd: int
     *   position: int
     *   statusCd: int
     *   processCd: int
     *   projectsId: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
