<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * State resource.
 *
 * @fullPath api.legacy.state
 * @service legacy
 * @domain augur
 */
final class StateResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List States.
     *
     * @fullPath api.legacy.state.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/legacy/state', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get State Details.
     *
     * @fullPath api.legacy.state.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $stateUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/legacy/state/{stateUid}',
            [],
            ['stateUid' => (string) $stateUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create State.
     *
     * @fullPath api.legacy.state.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/legacy/state',
            $data,
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update State.
     *
     * @fullPath api.legacy.state.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $stateUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/legacy/state/{stateUid}',
            $data,
            ['stateUid' => (string) $stateUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete State.
     *
     * @fullPath api.legacy.state.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $stateUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/legacy/state/{stateUid}',
            ['stateUid' => (string) $stateUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
