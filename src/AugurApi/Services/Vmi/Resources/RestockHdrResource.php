<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * RestockHdr resource.
 *
 * @fullPath api.vmi.restockHdr
 * @service vmi
 * @domain inventory
 */
final class RestockHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List restock headers.
     *
     * @fullPath api.vmi.restockHdr.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/restock-hdr', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get restock header details.
     *
     * @fullPath api.vmi.restockHdr.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $restockHdrUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/restock-hdr/{restockHdrUid}',
            [],
            ['restockHdrUid' => (string) $restockHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create restock header.
     *
     * @fullPath api.vmi.restockHdr.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/restock-hdr', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update restock header.
     *
     * @fullPath api.vmi.restockHdr.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $restockHdrUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/restock-hdr/{restockHdrUid}',
            $data,
            ['restockHdrUid' => (string) $restockHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete restock header.
     *
     * @fullPath api.vmi.restockHdr.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $restockHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/restock-hdr/{restockHdrUid}',
            ['restockHdrUid' => (string) $restockHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
