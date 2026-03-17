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
     * GET /oe-hdr-salesrep/{salesrep-id}/oe-hdr
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listOeHdr(int $salesRepId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{salesrep-id}/oe-hdr',
            $params,
            ['salesRepId' => (string) $salesRepId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /oe-hdr-salesrep/{salesrep_id}/oe-hdr/{orderNo}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listOeHdrDoc(int $orderNo, int $salesRepId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{salesrep_id}/oe-hdr/{orderNo}/doc',
            $params,
            ['orderNo' => (string) $orderNo, 'salesRepId' => (string) $salesRepId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Alias for listOeHdrDoc — GET /oe-hdr-salesrep/{salesrep_id}/oe-hdr/{orderNo}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getOeHdrDoc(int $orderNo, int $salesRepId, array $params = []): BaseResponse
    {
        return $this->listOeHdrDoc($orderNo, $salesRepId, $params);
    }
}
