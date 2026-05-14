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
     * GET /customer/{customerId}/addresses
     *
     * Response data type: array
     * Known fields: customerAddressUid, customerId, address1, address2, address3, city, state, postalCode, ... (14 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAddresses(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/addresses',
            $params,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /customer/{customerId}/addresses
     *
     * Response data type: object
     * Known fields: customerAddressUid, customerId, address1, address2, address3, city, state, postalCode, ... (14 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAddresses(int $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/addresses',
            $data,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /customer/{customerId}/addresses/{customerAddressUid}
     *
     * Response data type: object
     * Known fields: customerAddressUid, customerId, address1, address2, address3, city, state, postalCode, ... (14 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteAddresses(int $customerId, int $customerAddressUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{customerId}/addresses/{customerAddressUid}',
            ['customerId' => (string) $customerId, 'customerAddressUid' => (string) $customerAddressUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customer/{customerId}/addresses/{customerAddressUid}
     *
     * Response data type: object
     * Known fields: customerAddressUid, customerId, address1, address2, address3, city, state, postalCode, ... (14 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getAddresses(int $customerId, int $customerAddressUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/addresses/{customerAddressUid}',
            $params,
            ['customerId' => (string) $customerId, 'customerAddressUid' => (string) $customerAddressUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /customer/{customerId}/addresses/{customerAddressUid}
     *
     * Response data type: object
     * Known fields: customerAddressUid, customerId, address1, address2, address3, city, state, postalCode, ... (14 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateAddresses(int $customerId, int $customerAddressUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{customerId}/addresses/{customerAddressUid}',
            $data,
            ['customerId' => (string) $customerId, 'customerAddressUid' => (string) $customerAddressUid],
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

    /**
     * GET /customer/{customerId}/tags
     *
     * Response data type: array
     * Known fields: customerTagsUid, customerId, tag, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listTags(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/tags',
            $params,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /customer/{customerId}/tags
     *
     * Response data type: object
     * Known fields: customerTagsUid, customerId, tag, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createTags(int $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/tags',
            $data,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /customer/{customerId}/tags/{customerTagsUid}
     *
     * Response data type: object
     * Known fields: customerTagsUid, customerId, tag, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteTags(int $customerId, int $customerTagsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{customerId}/tags/{customerTagsUid}',
            ['customerId' => (string) $customerId, 'customerTagsUid' => (string) $customerTagsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /customer/{customerId}/tags/{customerTagsUid}
     *
     * Response data type: object
     * Known fields: customerTagsUid, customerId, tag, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getTags(int $customerId, int $customerTagsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/tags/{customerTagsUid}',
            $params,
            ['customerId' => (string) $customerId, 'customerTagsUid' => (string) $customerTagsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /customer/{customerId}/tags/{customerTagsUid}
     *
     * Response data type: object
     * Known fields: customerTagsUid, customerId, tag, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateTags(int $customerId, int $customerTagsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{customerId}/tags/{customerTagsUid}',
            $data,
            ['customerId' => (string) $customerId, 'customerTagsUid' => (string) $customerTagsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
