<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Podcasts resource.
 *
 * @fullPath api.p21Pim.podcasts
 * @service p21-pim
 * @domain content-management
 */
final class PodcastsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List podcasts with filtering and search capabilities.
     *
     * @fullPath api.p21Pim.podcasts.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/podcasts', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get a specific podcast by UID.
     *
     * @fullPath api.p21Pim.podcasts.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $podcastsUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/podcasts/{podcastsUid}',
            [],
            ['podcastsUid' => (string) $podcastsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create a new podcast record.
     *
     * @fullPath api.p21Pim.podcasts.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/podcasts', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update an existing podcast record.
     *
     * @fullPath api.p21Pim.podcasts.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $podcastsUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/podcasts/{podcastsUid}',
            $data,
            ['podcastsUid' => (string) $podcastsUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Soft delete a podcast record.
     *
     * @fullPath api.p21Pim.podcasts.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $podcastsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/podcasts/{podcastsUid}',
            ['podcastsUid' => (string) $podcastsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
