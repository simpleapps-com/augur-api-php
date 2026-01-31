<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Inv Mast Tags resource.
 *
 * @fullPath api.legacy.invMastTags
 * @service legacy
 * @domain augur
 */
final class InvMastTagsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List Inv Mast Tags.
     *
     * @fullPath api.legacy.invMastTags.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/tags',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get Inv Mast Tag Details.
     *
     * @fullPath api.legacy.invMastTags.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastUid, int $invMastTagsUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/tags/{invMastTagsUid}',
            [],
            ['invMastUid' => (string) $invMastUid, 'invMastTagsUid' => (string) $invMastTagsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create Inv Mast Tag.
     *
     * @fullPath api.legacy.invMastTags.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(int $invMastUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/tags',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update Inv Mast Tag.
     *
     * @fullPath api.legacy.invMastTags.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invMastUid, int $invMastTagsUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/tags/{invMastTagsUid}',
            $data,
            ['invMastUid' => (string) $invMastUid, 'invMastTagsUid' => (string) $invMastTagsUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete Inv Mast Tag.
     *
     * @fullPath api.legacy.invMastTags.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $invMastUid, int $invMastTagsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/tags/{invMastTagsUid}',
            ['invMastUid' => (string) $invMastUid, 'invMastTagsUid' => (string) $invMastTagsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
