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
     * @return BaseResponse<array<string, mixed>>
     */
    public function listItems(int $usersId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersId}/items',
            $params,
            ['usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /item-favorites/{usersId}/items
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createItems(int $usersId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{usersId}/items',
            $data,
            ['usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /item-favorites/{usersId}/items/{invMastUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteItems(int $usersId, int $invMastUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{usersId}/items/{invMastUid}',
            ['usersId' => (string) $usersId, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /item-favorites/{usersId}/items/{invMastUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getItems(int $usersId, int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersId}/items/{invMastUid}',
            $params,
            ['usersId' => (string) $usersId, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /item-favorites/{usersId}/items/{invMastUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateItems(int $usersId, int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{usersId}/items/{invMastUid}',
            $data,
            ['usersId' => (string) $usersId, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
