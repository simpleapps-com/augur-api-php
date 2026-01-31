<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Item Wishlist resource.
 *
 * @fullPath api.items.itemWishlist
 * @service items
 * @domain user-preferences
 */
final class ItemWishlistResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List user wishlists.
     *
     * @fullPath api.items.itemWishlist.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(int $usersId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/item-wishlist/{usersId}',
            $params,
            ['usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Create user wishlist.
     *
     * @fullPath api.items.itemWishlist.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(int $usersId, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/item-wishlist/{usersId}',
            $data,
            ['usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Get wishlist header (returns line items).
     *
     * @fullPath api.items.itemWishlist.hdr.get
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getHdr(int $usersId, int $itemWishlistHdrUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}',
            [],
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Create wishlist header.
     *
     * @fullPath api.items.itemWishlist.hdr.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createHdr(int $usersId, int $itemWishlistHdrUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}',
            $data,
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update wishlist header.
     *
     * @fullPath api.items.itemWishlist.hdr.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateHdr(int $usersId, int $itemWishlistHdrUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}',
            $data,
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete wishlist header.
     *
     * @fullPath api.items.itemWishlist.hdr.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteHdr(int $usersId, int $itemWishlistHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}',
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Delete wishlist line.
     *
     * @fullPath api.items.itemWishlist.hdr.line.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteLine(int $usersId, int $itemWishlistHdrUid, int $itemWishlistLineUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}',
            [
                'usersId' => (string) $usersId,
                'itemWishlistHdrUid' => (string) $itemWishlistHdrUid,
                'itemWishlistLineUid' => (string) $itemWishlistLineUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
