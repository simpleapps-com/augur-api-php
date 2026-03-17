<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * podcasts resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-pim
 */
final class PodcastsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /podcasts
     *
     * Response data type: array
     * Known fields: podcastsUid, title, path, transcript, dateCreated, dateLastModified, updateCd, statusCd, ... (9 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /podcasts
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /podcasts/{podcastsUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $podcasts_uid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{podcastsUid}',
            ['podcasts_uid' => (string) $podcasts_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /podcasts/{podcastsUid}
     *
     * Response data type: object
     * Known fields: podcastsUid, title, path, transcript, dateCreated, dateLastModified, updateCd, statusCd, ... (9 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $podcasts_uid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{podcastsUid}',
            $params,
            ['podcasts_uid' => (string) $podcasts_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /podcasts/{podcastsUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $podcasts_uid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{podcastsUid}',
            $data,
            ['podcasts_uid' => (string) $podcasts_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
