<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Inv Mast Web Desc resource.
 *
 * @fullPath api.legacy.invMastWebDesc
 * @service legacy
 * @domain augur
 */
final class InvMastWebDescResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List item Web Descriptions.
     *
     * @fullPath api.legacy.invMastWebDesc.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/web-desc',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get Item Web Description.
     *
     * @fullPath api.legacy.invMastWebDesc.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastUid, int $invMastWebDescUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/web-desc/{invMastWebDescUid}',
            [],
            ['invMastUid' => (string) $invMastUid, 'invMastWebDescUid' => (string) $invMastWebDescUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create Web Description for Item.
     *
     * @fullPath api.legacy.invMastWebDesc.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(int $invMastUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/web-desc',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update Item Web Description.
     *
     * @fullPath api.legacy.invMastWebDesc.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invMastUid, int $invMastWebDescUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/web-desc/{invMastWebDescUid}',
            $data,
            ['invMastUid' => (string) $invMastUid, 'invMastWebDescUid' => (string) $invMastWebDescUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete Item Web Description.
     *
     * @fullPath api.legacy.invMastWebDesc.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $invMastUid, int $invMastWebDescUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/web-desc/{invMastWebDescUid}',
            ['invMastUid' => (string) $invMastUid, 'invMastWebDescUid' => (string) $invMastWebDescUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
