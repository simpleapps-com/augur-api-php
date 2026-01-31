<?php

declare(strict_types=1);

namespace AugurApi\Services\Nexus\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Purchase order receipt resource.
 *
 * @fullPath api.nexus.purchaseOrderReceipt
 * @service nexus
 * @domain warehouse
 */
final class PurchaseOrderReceiptResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List purchase order receipts.
     *
     * @fullPath api.nexus.purchaseOrderReceipt.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/purchase-order-receipt', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get purchase order receipt details.
     *
     * @fullPath api.nexus.purchaseOrderReceipt.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $purchaseOrderReceiptUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/purchase-order-receipt/{purchaseOrderReceiptUid}',
            [],
            ['purchaseOrderReceiptUid' => (string) $purchaseOrderReceiptUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create purchase order receipt.
     *
     * @fullPath api.nexus.purchaseOrderReceipt.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/purchase-order-receipt', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update purchase order receipt.
     *
     * @fullPath api.nexus.purchaseOrderReceipt.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $purchaseOrderReceiptUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/purchase-order-receipt/{purchaseOrderReceiptUid}',
            $data,
            ['purchaseOrderReceiptUid' => (string) $purchaseOrderReceiptUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete purchase order receipt.
     *
     * @fullPath api.nexus.purchaseOrderReceipt.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $purchaseOrderReceiptUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/purchase-order-receipt/{purchaseOrderReceiptUid}',
            ['purchaseOrderReceiptUid' => (string) $purchaseOrderReceiptUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
