<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Rubrics resource.
 *
 * @fullPath api.agrInfo.rubrics
 * @service agr_info
 * @domain augur
 */
final class RubricsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List rubrics.
     *
     * @fullPath api.agrInfo.rubrics.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/rubrics', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get rubric details.
     *
     * @fullPath api.agrInfo.rubrics.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $rubricsUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/rubrics/{rubricsUid}',
            [],
            ['rubricsUid' => (string) $rubricsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create rubric.
     *
     * @fullPath api.agrInfo.rubrics.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/rubrics', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update rubric.
     *
     * @fullPath api.agrInfo.rubrics.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $rubricsUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/rubrics/{rubricsUid}',
            $data,
            ['rubricsUid' => (string) $rubricsUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete rubric.
     *
     * @fullPath api.agrInfo.rubrics.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $rubricsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/rubrics/{rubricsUid}',
            ['rubricsUid' => (string) $rubricsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
