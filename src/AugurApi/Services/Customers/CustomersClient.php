<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Customers\Resources\ContactsResource;
use AugurApi\Services\Customers\Resources\ContactsUdResource;
use AugurApi\Services\Customers\Resources\CustomerResource;
use AugurApi\Services\Customers\Resources\OeContactsCustomerResource;
use AugurApi\Services\Customers\Resources\ShipToResource;

/**
 * Customers service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py customers
 */
final class CustomersClient extends BaseServiceClient
{
    public readonly ContactsResource $contacts;
    public readonly ContactsUdResource $contactsUd;
    public readonly CustomerResource $customer;
    public readonly OeContactsCustomerResource $oeContactsCustomer;
    public readonly ShipToResource $shipTo;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->contacts = new ContactsResource($client, $this->baseUrl . '/contacts');
        $this->contactsUd = new ContactsUdResource($client, $this->baseUrl . '/contacts-ud');
        $this->customer = new CustomerResource($client, $this->baseUrl . '/customer');
        $this->oeContactsCustomer = new OeContactsCustomerResource($client, $this->baseUrl . '/oe-contacts-customer');
        $this->shipTo = new ShipToResource($client, $this->baseUrl . '/ship-to');
    }

    protected function getServiceName(): string
    {
        return 'customers';
    }
}
