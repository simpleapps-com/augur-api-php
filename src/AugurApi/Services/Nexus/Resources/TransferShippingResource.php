<?php

declare(strict_types=1);

namespace AugurApi\Services\Nexus\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Transfer shipping resource.
 *
 * @fullPath api.nexus.transferShipping
 * @service nexus
 * @domain warehouse
 */
final class TransferShippingResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List transfer shippings.
     *
     * @fullPath api.nexus.transferShipping.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/transfer-shipping', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get transfer shipping details.
     *
     * @fullPath api.nexus.transferShipping.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $transferReceiptUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/transfer-shipping/{transferReceiptUid}',
            [],
            ['transferReceiptUid' => (string) $transferReceiptUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create transfer shipping.
     *
     * @fullPath api.nexus.transferShipping.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/transfer-shipping', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update transfer shipping.
     *
     * @fullPath api.nexus.transferShipping.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $transferReceiptUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/transfer-shipping/{transferReceiptUid}',
            $data,
            ['transferReceiptUid' => (string) $transferReceiptUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete transfer shipping.
     *
     * @fullPath api.nexus.transferShipping.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $transferReceiptUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/transfer-shipping/{transferReceiptUid}',
            ['transferReceiptUid' => (string) $transferReceiptUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
