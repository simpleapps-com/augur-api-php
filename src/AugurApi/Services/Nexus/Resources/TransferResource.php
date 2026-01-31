<?php

declare(strict_types=1);

namespace AugurApi\Services\Nexus\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Transfer resource.
 *
 * @fullPath api.nexus.transfer
 * @service nexus
 * @domain warehouse
 */
final class TransferResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List transfers.
     *
     * @fullPath api.nexus.transfer.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/transfer', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get transfer details.
     *
     * @fullPath api.nexus.transfer.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $transferUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/transfer/{transferUid}',
            [],
            ['transferUid' => (string) $transferUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create transfer.
     *
     * @fullPath api.nexus.transfer.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/transfer', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update transfer.
     *
     * @fullPath api.nexus.transfer.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $transferUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/transfer/{transferUid}',
            $data,
            ['transferUid' => (string) $transferUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete transfer.
     *
     * @fullPath api.nexus.transfer.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $transferUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/transfer/{transferUid}',
            ['transferUid' => (string) $transferUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
