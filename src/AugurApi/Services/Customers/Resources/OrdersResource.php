<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Orders resource.
 *
 * @fullPath api.customers.orders
 * @service customers
 * @domain customer-management
 */
final class OrdersResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List customer orders.
     *
     * @fullPath api.customers.orders.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(string $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/customer/{customerId}/orders',
            $params,
            ['customerId' => $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get a customer order.
     *
     * @fullPath api.customers.orders.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $customerId, string $orderNo): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/customer/{customerId}/orders/{orderNo}',
            [],
            ['customerId' => $customerId, 'orderNo' => $orderNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
