<?php

declare(strict_types=1);

namespace AugurApi\Services\Nexus\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Receiving resource.
 *
 * @fullPath api.nexus.receiving
 * @service nexus
 * @domain warehouse
 */
final class ReceivingResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List receiving records.
     *
     * @fullPath api.nexus.receiving.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/receiving', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get receiving details.
     *
     * @fullPath api.nexus.receiving.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $receivingUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/receiving/{receivingUid}',
            [],
            ['receivingUid' => (string) $receivingUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create receiving.
     *
     * @fullPath api.nexus.receiving.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/receiving', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update receiving.
     *
     * @fullPath api.nexus.receiving.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $receivingUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/receiving/{receivingUid}',
            $data,
            ['receivingUid' => (string) $receivingUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete receiving.
     *
     * @fullPath api.nexus.receiving.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $receivingUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/receiving/{receivingUid}',
            ['receivingUid' => (string) $receivingUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
