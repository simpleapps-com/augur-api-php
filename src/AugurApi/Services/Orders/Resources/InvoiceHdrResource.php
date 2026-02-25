<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;
use AugurApi\Core\Schemas\EdgeCache;

/**
 * Invoice header resource.
 *
 * @fullPath api.orders.invoiceHdr
 * @service orders
 * @domain order-management
 */
final class InvoiceHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Reprint an invoice.
     *
     * @fullPath api.orders.invoiceHdr.reprint
     * @return BaseResponse<array<string, mixed>>
     */
    public function reprint(string $invoiceNo, ?EdgeCache $edgeCache = null): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/invoice-hdr/{invoiceNo}/reprint',
            $edgeCache !== null ? ['edgeCache' => $edgeCache->value] : [],
            ['invoiceNo' => $invoiceNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
