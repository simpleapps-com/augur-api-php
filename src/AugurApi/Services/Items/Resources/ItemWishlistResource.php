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
    public function deleteHdr(int $usersId, int $itemWishlistHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}',
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getHdr(int $usersId, int $itemWishlistHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}',
            $params,
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createHdr(int $usersId, int $itemWishlistHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}',
            $data,
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateHdr(int $usersId, int $itemWishlistHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}',
            $data,
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteHdrLine(int $usersId, int $itemWishlistHdrUid, int $itemWishlistLineUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid}',
            ['usersId' => (string) $usersId, 'itemWishlistHdrUid' => (string) $itemWishlistHdrUid, 'itemWishlistLineUid' => (string) $itemWishlistLineUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
