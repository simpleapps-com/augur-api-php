<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * oeHdrSalesrep resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py orders
 */
final class OeHdrSalesrepResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /oe-hdr-salesrep/{salesrepId}/oe-hdr
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listOeHdr(string $salesrepId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{salesrepId}/oe-hdr',
            $params,
            ['salesrepId' => (string) $salesrepId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /oe-hdr-salesrep/{salesrepId}/oe-hdr/{orderNo}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listOeHdrDoc(string $salesrepId, int $orderNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{salesrepId}/oe-hdr/{orderNo}/doc',
            $params,
            ['salesrepId' => (string) $salesrepId, 'orderNo' => (string) $orderNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Alias for listOeHdrDoc — GET /oe-hdr-salesrep/{salesrepId}/oe-hdr/{orderNo}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getOeHdrDoc(string $salesrepId, int $orderNo, array $params = []): BaseResponse
    {
        return $this->listOeHdrDoc($salesrepId, $orderNo, $params);
    }
}
