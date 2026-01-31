<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Purchased Items resource.
 *
 * @fullPath api.customers.purchasedItems
 * @service customers
 * @domain customer-management
 */
final class PurchasedItemsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List Customer Purchased Items.
     *
     * @fullPath api.customers.purchasedItems.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/customer/{customerId}/purchased-items',
            $params,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
