<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Quotes resource.
 *
 * @fullPath api.customers.quotes
 * @service customers
 * @domain customer-management
 */
final class QuotesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List customer quotes.
     *
     * @fullPath api.customers.quotes.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(string $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/customer/{customerId}/quotes',
            $params,
            ['customerId' => $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get a customer quote.
     *
     * @fullPath api.customers.quotes.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $customerId, string $quoteNo): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/customer/{customerId}/quotes/{quoteNo}',
            [],
            ['customerId' => $customerId, 'quoteNo' => $quoteNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
