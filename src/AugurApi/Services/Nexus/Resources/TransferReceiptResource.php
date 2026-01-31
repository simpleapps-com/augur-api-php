<?php

declare(strict_types=1);

namespace AugurApi\Services\Nexus\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Transfer receipt resource.
 *
 * @fullPath api.nexus.transferReceipt
 * @service nexus
 * @domain warehouse
 */
final class TransferReceiptResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List transfer receipts.
     *
     * @fullPath api.nexus.transferReceipt.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/transfer-receipt', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get transfer receipt details.
     *
     * @fullPath api.nexus.transferReceipt.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $transferReceiptUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/transfer-receipt/{transferReceiptUid}',
            [],
            ['transferReceiptUid' => (string) $transferReceiptUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create transfer receipt.
     *
     * @fullPath api.nexus.transferReceipt.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/transfer-receipt', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update transfer receipt.
     *
     * @fullPath api.nexus.transferReceipt.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $transferReceiptUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/transfer-receipt/{transferReceiptUid}',
            $data,
            ['transferReceiptUid' => (string) $transferReceiptUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete transfer receipt.
     *
     * @fullPath api.nexus.transferReceipt.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $transferReceiptUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/transfer-receipt/{transferReceiptUid}',
            ['transferReceiptUid' => (string) $transferReceiptUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
