<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * itemFavorites resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 */
final class ItemFavoritesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /item-favorites/{usersId}/items
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listItems(int $usersId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersId}/items',
            $params,
            ['usersId' => (string) $usersId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /item-favorites/{usersId}/items
     *
     * @param list<int> $data
     * @return BaseResponse<mixed>
     */
    public function createItems(int $usersId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{usersId}/items',
            $data,
            ['usersId' => (string) $usersId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /item-favorites/{usersId}/items/{invMastUid}
     *
     * @return BaseResponse<mixed>
     */
    public function deleteItems(int $usersId, int $invMastUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{usersId}/items/{invMastUid}',
            ['usersId' => (string) $usersId, 'invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /item-favorites/{usersId}/items/{invMastUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getItems(int $usersId, int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersId}/items/{invMastUid}',
            $params,
            ['usersId' => (string) $usersId, 'invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /item-favorites/{usersId}/items/{invMastUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function updateItems(int $usersId, int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{usersId}/items/{invMastUid}',
            $data,
            ['usersId' => (string) $usersId, 'invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
