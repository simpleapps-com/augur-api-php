<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Invoices resource.
 *
 * @fullPath api.customers.invoices
 * @service customers
 * @domain customer-management
 */
final class InvoicesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List customer invoices.
     *
     * @fullPath api.customers.invoices.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(string $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/customer/{customerId}/invoices',
            $params,
            ['customerId' => $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get a customer invoice.
     *
     * @fullPath api.customers.invoices.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $customerId, string $invoiceNo): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/customer/{customerId}/invoices/{invoiceNo}',
            [],
            ['customerId' => $customerId, 'invoiceNo' => $invoiceNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
