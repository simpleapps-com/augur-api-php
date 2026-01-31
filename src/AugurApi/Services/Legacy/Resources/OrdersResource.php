<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Orders resource.
 *
 * @fullPath api.legacy.orders
 * @service legacy
 * @domain augur
 */
final class OrdersResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Reset orders for processing by id.
     *
     * @fullPath api.legacy.orders.reset
     * @return BaseResponse<array<string, mixed>>
     */
    public function reset(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/orders/{id}/reset',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
