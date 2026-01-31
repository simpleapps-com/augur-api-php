<?php

declare(strict_types=1);

namespace AugurApi\Services\Nexus\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Bin transfer resource.
 *
 * @fullPath api.nexus.binTransfer
 * @service nexus
 * @domain warehouse
 */
final class BinTransferResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List bin transfers.
     *
     * @fullPath api.nexus.binTransfer.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/bin-transfer', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get bin transfer details.
     *
     * @fullPath api.nexus.binTransfer.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $binTransferHdrUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/bin-transfer/{binTransferHdrUid}',
            [],
            ['binTransferHdrUid' => (string) $binTransferHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get bin transfer status with lines.
     *
     * @fullPath api.nexus.binTransfer.getStatus
     * @return BaseResponse<array<string, mixed>>
     */
    public function getStatus(int $binTransferHdrUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/bin-transfer/{binTransferHdrUid}/status',
            [],
            ['binTransferHdrUid' => (string) $binTransferHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create bin transfer.
     *
     * @fullPath api.nexus.binTransfer.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/bin-transfer', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update bin transfer.
     *
     * @fullPath api.nexus.binTransfer.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $binTransferHdrUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/bin-transfer/{binTransferHdrUid}',
            $data,
            ['binTransferHdrUid' => (string) $binTransferHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete bin transfer.
     *
     * @fullPath api.nexus.binTransfer.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $binTransferHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/bin-transfer/{binTransferHdrUid}',
            ['binTransferHdrUid' => (string) $binTransferHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
