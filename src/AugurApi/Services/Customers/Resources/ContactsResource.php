<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;
use AugurApi\Core\Schemas\EdgeCache;

/**
 * Contacts resource.
 *
 * @fullPath api.customers.contacts
 * @service customers
 * @domain customer-management
 */
final class ContactsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List salesrep customers for a contact.
     *
     * @fullPath api.customers.contacts.getCustomers
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getCustomers(int $id, ?EdgeCache $edgeCache = null): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/contacts/{id}/customers',
            $edgeCache !== null ? ['edgeCache' => $edgeCache->value] : [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get the contact document.
     *
     * @fullPath api.customers.contacts.getDoc
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $id, ?EdgeCache $edgeCache = null): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/contacts/{id}/doc',
            $edgeCache !== null ? ['edgeCache' => $edgeCache->value] : [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get the web allowance for a contact.
     *
     * @fullPath api.customers.contacts.getWebAllowance
     * @return BaseResponse<array<string, mixed>>
     */
    public function getWebAllowance(int $id, ?EdgeCache $edgeCache = null): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/contacts/{id}/web-allowance',
            $edgeCache !== null ? ['edgeCache' => $edgeCache->value] : [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Trigger a data refresh.
     *
     * @fullPath api.customers.contacts.refresh
     * @return BaseResponse<array<string, mixed>>
     */
    public function refresh(): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/contacts/refresh');

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
