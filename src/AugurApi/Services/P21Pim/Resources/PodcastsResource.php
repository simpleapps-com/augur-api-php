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
     *   podcastsUid: int
     *   title: string|null
     *   path: string|null
     *   transcript: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /podcasts
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /podcasts/{podcastsUid}
     *
     * @return BaseResponse<mixed>
     */
    public function delete(int $podcastsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{podcastsUid}',
            ['podcastsUid' => (string) $podcastsUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /podcasts/{podcastsUid}
     *
     * Response data type: object
     *   podcastsUid: int
     *   title: string|null
     *   path: string|null
     *   transcript: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $podcastsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{podcastsUid}',
            $params,
            ['podcastsUid' => (string) $podcastsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /podcasts/{podcastsUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function update(int $podcastsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{podcastsUid}',
            $data,
            ['podcastsUid' => (string) $podcastsUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
