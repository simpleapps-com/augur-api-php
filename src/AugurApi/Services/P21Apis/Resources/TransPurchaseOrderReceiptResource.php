<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * transPurchaseOrderReceipt resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-apis
 */
final class TransPurchaseOrderReceiptResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /trans-purchase-order-receipt/{poNo}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $poNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{poNo}',
            $params,
            ['poNo' => (string) $poNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /trans-purchase-order-receipt/{poNo}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(string $poNo, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{poNo}',
            $data,
            ['poNo' => (string) $poNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
