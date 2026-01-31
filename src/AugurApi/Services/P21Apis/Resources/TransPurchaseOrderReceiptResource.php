<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Transaction purchase order receipt resource.
 *
 * @fullPath api.p21Apis.transPurchaseOrderReceipt
 * @service p21-apis
 * @domain purchase-order-management
 */
final class TransPurchaseOrderReceiptResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get purchase order receipt details by PO number.
     *
     * @fullPath api.p21Apis.transPurchaseOrderReceipt.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $poNo): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/trans-purchase-order-receipt/{poNo}',
            [],
            ['poNo' => $poNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Update purchase order receipt by PO number.
     *
     * @fullPath api.p21Apis.transPurchaseOrderReceipt.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(string $poNo, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/trans-purchase-order-receipt/{poNo}',
            $data,
            ['poNo' => $poNo],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
