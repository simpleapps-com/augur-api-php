<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Item Favorites resource.
 *
 * @fullPath api.items.itemFavorites
 * @service items
 * @domain user-preferences
 */
final class ItemFavoritesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List user favorites.
     *
     * @fullPath api.items.itemFavorites.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(int $usersId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/item-favorites/{usersId}',
            $params,
            ['usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Create user favorite.
     *
     * @fullPath api.items.itemFavorites.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(int $usersId, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/item-favorites/{usersId}',
            $data,
            ['usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update user favorite.
     *
     * @fullPath api.items.itemFavorites.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $usersId, int $invMastUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/item-favorites/{usersId}/{invMastUid}',
            $data,
            ['usersId' => (string) $usersId, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete user favorite.
     *
     * @fullPath api.items.itemFavorites.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $usersId, int $invMastUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/item-favorites/{usersId}/{invMastUid}',
            ['usersId' => (string) $usersId, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
