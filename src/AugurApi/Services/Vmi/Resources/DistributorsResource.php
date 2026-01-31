<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Distributors resource.
 *
 * @fullPath api.vmi.distributors
 * @service vmi
 * @domain inventory
 */
final class DistributorsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List distributors.
     *
     * @fullPath api.vmi.distributors.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/distributors', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get distributor details.
     *
     * @fullPath api.vmi.distributors.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $distributorsUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/distributors/{distributorsUid}',
            [],
            ['distributorsUid' => (string) $distributorsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create distributor.
     *
     * @fullPath api.vmi.distributors.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/distributors', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update distributor.
     *
     * @fullPath api.vmi.distributors.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $distributorsUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/distributors/{distributorsUid}',
            $data,
            ['distributorsUid' => (string) $distributorsUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete distributor.
     *
     * @fullPath api.vmi.distributors.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $distributorsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/distributors/{distributorsUid}',
            ['distributorsUid' => (string) $distributorsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }

    /**
     * Enable/Disable/Delete distributor.
     *
     * @fullPath api.vmi.distributors.enable
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function enable(int $distributorsUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/distributors/{distributorsUid}/enable',
            $data,
            ['distributorsUid' => (string) $distributorsUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
