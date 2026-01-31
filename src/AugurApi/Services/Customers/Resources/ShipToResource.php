<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Ship-To resource.
 *
 * @fullPath api.customers.shipTo
 * @service customers
 * @domain customer-management
 */
final class ShipToResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List customer ship-to addresses.
     *
     * @fullPath api.customers.shipTo.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(string $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/customer/{customerId}/ship-to',
            $params,
            ['customerId' => $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Trigger a data refresh.
     *
     * @fullPath api.customers.shipTo.refresh
     * @return BaseResponse<array<string, mixed>>
     */
    public function refresh(): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/ship-to/refresh');

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
