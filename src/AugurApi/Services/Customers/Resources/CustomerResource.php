<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;
use AugurApi\Services\Customers\Schemas\Customer;
use AugurApi\Services\Customers\Schemas\CustomerListParams;

/**
 * Customer resource.
 *
 * @fullPath api.customers.customer
 * @service customers
 * @domain customer-management
 */
final class CustomerResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List customer documents.
     *
     * @fullPath api.customers.customer.list
     * @param CustomerListParams|array<string, mixed>|null $params
     * @return BaseResponse<array<Customer>>
     */
    public function list(CustomerListParams|array|null $params = null): BaseResponse
    {
        $queryParams = match (true) {
            $params instanceof CustomerListParams => $params->toArray(),
            is_array($params) => $params,
            default => [],
        };

        $response = $this->client->get($this->baseUrl, '/customer', $queryParams);

        return BaseResponse::fromArray($response, static function ($data): array {
            if (!is_array($data)) {
                return [];
            }
            return array_map(static fn ($item) => Customer::fromArray($item), $data);
        });
    }

    /**
     * Lookup customer summary.
     *
     * @fullPath api.customers.customer.lookup
     * @param array<string, mixed> $params
     * @return BaseResponse<array<Customer>>
     */
    public function lookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/customer/lookup', $params);

        return BaseResponse::fromArray($response, static function ($data): array {
            if (!is_array($data)) {
                return [];
            }
            return array_map(static fn ($item) => Customer::fromArray($item), $data);
        });
    }

    /**
     * Get customer document.
     *
     * @fullPath api.customers.customer.getDoc
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(string $customerId): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/customer/{customerId}/doc',
            [],
            ['customerId' => $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get customer addresses.
     *
     * @fullPath api.customers.customer.getAddresses
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getAddresses(string $customerId): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/customer/{customerId}/address',
            [],
            ['customerId' => $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get customer contacts.
     *
     * @fullPath api.customers.customer.getContacts
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getContacts(string $customerId): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/customer/{customerId}/contacts',
            [],
            ['customerId' => $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Create a contact for a customer.
     *
     * @fullPath api.customers.customer.createContact
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createContact(string $customerId, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/customer/{customerId}/contacts',
            $data,
            ['customerId' => $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Get customer ship-to addresses.
     *
     * @fullPath api.customers.customer.getShipTo
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getShipTo(string $customerId): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/customer/{customerId}/ship-to',
            [],
            ['customerId' => $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Create a ship-to address for a customer.
     *
     * @fullPath api.customers.customer.createShipTo
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createShipTo(string $customerId, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/customer/{customerId}/ship-to',
            $data,
            ['customerId' => $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
