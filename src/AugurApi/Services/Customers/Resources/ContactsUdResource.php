<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Contacts User Defined resource.
 *
 * @fullPath api.customers.contactsUd
 * @service customers
 * @domain customer-management
 */
final class ContactsUdResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List user defined fields for a contact.
     *
     * @fullPath api.customers.contactsUd.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/contacts-ud/{id}',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
