<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Customers\Resources\ContactsResource;
use AugurApi\Services\Customers\Resources\ContactsUdResource;
use AugurApi\Services\Customers\Resources\CustomerResource;
use AugurApi\Services\Customers\Resources\InvoicesResource;
use AugurApi\Services\Customers\Resources\OeContactsCustomerResource;
use AugurApi\Services\Customers\Resources\OrdersResource;
use AugurApi\Services\Customers\Resources\PurchasedItemsResource;
use AugurApi\Services\Customers\Resources\QuotesResource;
use AugurApi\Services\Customers\Resources\ShipToResource;

/**
 * Customers service client.
 *
 * @fullPath api.customers
 * @service customers
 * @domain customer-management
 */
final class CustomersClient extends BaseServiceClient
{
    public readonly ContactsResource $contacts;
    public readonly ContactsUdResource $contactsUd;
    public readonly CustomerResource $customer;
    public readonly InvoicesResource $invoices;
    public readonly OeContactsCustomerResource $oeContactsCustomer;
    public readonly OrdersResource $orders;
    public readonly PurchasedItemsResource $purchasedItems;
    public readonly QuotesResource $quotes;
    public readonly ShipToResource $shipTo;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->contacts = new ContactsResource($client, $this->baseUrl);
        $this->contactsUd = new ContactsUdResource($client, $this->baseUrl);
        $this->customer = new CustomerResource($client, $this->baseUrl);
        $this->invoices = new InvoicesResource($client, $this->baseUrl);
        $this->oeContactsCustomer = new OeContactsCustomerResource($client, $this->baseUrl);
        $this->orders = new OrdersResource($client, $this->baseUrl);
        $this->purchasedItems = new PurchasedItemsResource($client, $this->baseUrl);
        $this->quotes = new QuotesResource($client, $this->baseUrl);
        $this->shipTo = new ShipToResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'customers';
    }
}
