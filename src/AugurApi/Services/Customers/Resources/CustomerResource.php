<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * customer resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py customers
 */
final class CustomerResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /customer
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customer/lookup
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customer/{customerId}/address
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAddress(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/address',
            $params,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customer/{customerId}/contacts
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listContacts(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/contacts',
            $params,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /customer/{customerId}/contacts
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createContacts(int $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/contacts',
            $data,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customer/{customerId}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDoc(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/doc',
            $params,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Alias for listDoc — GET /customer/{customerId}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $customerId, array $params = []): BaseResponse
    {
        return $this->listDoc($customerId, $params);
    }

    /**
     * GET /customer/{customerId}/invoices
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listInvoices(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/invoices',
            $params,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customer/{customerId}/invoices/{invoiceNo}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getInvoices(int $customerId, int $invoiceNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/invoices/{invoiceNo}',
            $params,
            ['customerId' => (string) $customerId, 'invoiceNo' => (string) $invoiceNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customer/{customerId}/orders
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listOrders(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/orders',
            $params,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customer/{customerId}/orders/{orderNo}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getOrders(int $customerId, int $orderNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/orders/{orderNo}',
            $params,
            ['customerId' => (string) $customerId, 'orderNo' => (string) $orderNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customer/{customerId}/purchased-items
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listPurchasedItems(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/purchased-items',
            $params,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customer/{customerId}/quotes
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listQuotes(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/quotes',
            $params,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customer/{customerId}/quotes/{quoteNo}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getQuotes(int $customerId, int $quoteNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/quotes/{quoteNo}',
            $params,
            ['customerId' => (string) $customerId, 'quoteNo' => (string) $quoteNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customer/{customerId}/ship-to
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listShipTo(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/ship-to',
            $params,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /customer/{customerId}/ship-to
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createShipTo(int $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/ship-to',
            $data,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
