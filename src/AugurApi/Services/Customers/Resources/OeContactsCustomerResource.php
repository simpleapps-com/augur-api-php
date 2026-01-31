<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * OE Contacts Customer resource.
 *
 * @fullPath api.customers.oeContactsCustomer
 * @service customers
 * @domain customer-management
 */
final class OeContactsCustomerResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Trigger a data refresh.
     *
     * @fullPath api.customers.oeContactsCustomer.refresh
     * @return BaseResponse<array<string, mixed>>
     */
    public function refresh(): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/oe-contacts-customer/refresh',
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
