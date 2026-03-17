<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * itemWishlist resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 */
final class ItemWishlistResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /item-wishlist/{usersId}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $usersId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersId}',
            $params,
            ['usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /item-wishlist/{usersId}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(int $usersId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{usersId}',
            $data,
            ['usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteHdr(int $itemWishlistHdrUid, int $usersId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}',
            ['itemWishlistHdrUid' => (string) $itemWishlistHdrUid, 'usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getHdr(int $itemWishlistHdrUid, int $usersId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}',
            $params,
            ['itemWishlistHdrUid' => (string) $itemWishlistHdrUid, 'usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createHdr(int $itemWishlistHdrUid, int $usersId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}',
            $data,
            ['itemWishlistHdrUid' => (string) $itemWishlistHdrUid, 'usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateHdr(int $itemWishlistHdrUid, int $usersId, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}',
            $data,
            ['itemWishlistHdrUid' => (string) $itemWishlistHdrUid, 'usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteHdrLine(int $itemWishlistHdrUid, int $itemWishlistLineUid, int $usersId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}',
            ['itemWishlistHdrUid' => (string) $itemWishlistHdrUid, 'itemWishlistLineUid' => (string) $itemWishlistLineUid, 'usersId' => (string) $usersId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
