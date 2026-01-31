<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Cash drawer resource.
 *
 * @fullPath api.p21Core.cashDrawer
 * @service p21-core
 * @domain financial-and-pos-management
 */
final class CashDrawerResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List cash drawers with filtering.
     *
     * @fullPath api.p21Core.cashDrawer.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/cash_drawer', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get cash drawer details by UID.
     *
     * @fullPath api.p21Core.cashDrawer.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $cashDrawerUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/cash_drawer/{cashDrawerUid}',
            [],
            ['cashDrawerUid' => (string) $cashDrawerUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
