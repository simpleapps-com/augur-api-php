<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * comments resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py basecamp2
 */
final class CommentsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /comments
     *
     * Response data type: array
     *   id: int
     *   content: string
     *   updatedAt: string
     *   createdAt: string
     *   creatorId: int|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   todosId: int|null
     *   vector: string|null
     *   vectorCd: int
     *   vectorFlag: string
     *   dateLastVector: string
     *   location: string|null
     *   contentLength: int
     *   tokenCount: int
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
     * GET /comments/{id}
     *
     * Response data type: object
     *   id: int
     *   content: string
     *   updatedAt: string
     *   createdAt: string
     *   creatorId: int|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   todosId: int|null
     *   vector: string|null
     *   vectorCd: int
     *   vectorFlag: string
     *   dateLastVector: string
     *   location: string|null
     *   contentLength: int
     *   tokenCount: int
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
