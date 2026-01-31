<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Inventory master extension resource.
 *
 * @fullPath api.p21Pim.invMastExt
 * @service p21-pim
 * @domain inventory-management
 */
final class InvMastExtResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List inventory master extensions with filtering and pagination.
     *
     * @fullPath api.p21Pim.invMastExt.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/inv-mast-ext', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get a specific inventory master extension by UID.
     *
     * @fullPath api.p21Pim.invMastExt.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastExtUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast-ext/{invMastExtUid}',
            [],
            ['invMastExtUid' => (string) $invMastExtUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create a new inventory master extension record.
     *
     * @fullPath api.p21Pim.invMastExt.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/inv-mast-ext', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update an existing inventory master extension.
     *
     * @fullPath api.p21Pim.invMastExt.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invMastExtUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/inv-mast-ext/{invMastExtUid}',
            $data,
            ['invMastExtUid' => (string) $invMastExtUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Soft delete an inventory master extension (sets status_cd to 700).
     *
     * @fullPath api.p21Pim.invMastExt.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $invMastExtUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/inv-mast-ext/{invMastExtUid}',
            ['invMastExtUid' => (string) $invMastExtUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
