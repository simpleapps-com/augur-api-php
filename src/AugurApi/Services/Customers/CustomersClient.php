<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Customers\Resources\ContactsResource;
use AugurApi\Services\Customers\Resources\ContactsUdResource;
use AugurApi\Services\Customers\Resources\CustomerResource;

/**
 * Customers service client — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://customers.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://customers.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://customers.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py customers
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /contacts-ud/{id} → $api->customers->contactsUd->get($id) → ContactsUdGetData
 *   GET /contacts/{id}/customers → $api->customers->contacts->listCustomers($id) →
 *       list of ContactsCustomersListItem
 *   GET /contacts/{id}/doc → $api->customers->contacts->listDoc($id) → ContactsDocListData
 *   GET /contacts/{id}/web-allowance → $api->customers->contacts->listWebAllowance($id) →
 *       ContactsWebAllowanceListData
 *   GET /customer → $api->customers->customer->list() → list of ContactsCustomersListItem
 *   GET /customer/lookup → $api->customers->customer->getLookup() → list of CustomerLookupGetItem
 *   GET /customer/{customerId}/address → $api->customers->customer->listAddress($customerId) →
 *       list of CustomerAddressListItem
 *   GET /customer/{customerId}/addresses → $api->customers->customer->listAddresses($customerId) →
 *       list of CustomerAddressesListItem
 *   POST /customer/{customerId}/addresses →
 *       $api->customers->customer->createAddresses($customerId, $data) → CustomerAddressesListItem
 *   GET /customer/{customerId}/addresses/{customerAddressUid} →
 *       $api->customers->customer->getAddresses($customerId, $customerAddressUid) →
 *       CustomerAddressesListItem
 *   PUT /customer/{customerId}/addresses/{customerAddressUid} →
 *       $api->customers->customer->updateAddresses($customerId, $customerAddressUid, $data) →
 *       CustomerAddressesListItem
 *   DELETE /customer/{customerId}/addresses/{customerAddressUid} →
 *       $api->customers->customer->deleteAddresses($customerId, $customerAddressUid) →
 *       CustomerAddressesListItem
 *   GET /customer/{customerId}/aging → $api->customers->customer->listAging($customerId) →
 *       CustomerAgingListData
 *   GET /customer/{customerId}/contacts → $api->customers->customer->listContacts($customerId) →
 *       list of CustomerContactsListItem
 *   POST /customer/{customerId}/contacts →
 *       $api->customers->customer->createContacts($customerId, $data) → bool
 *   GET /customer/{customerId}/doc → $api->customers->customer->listDoc($customerId) →
 *       ContactsCustomersListItem
 *   GET /customer/{customerId}/invoices → $api->customers->customer->listInvoices($customerId) →
 *       list of CustomerInvoicesListItem
 *   GET /customer/{customerId}/invoices/{invoiceNo} →
 *       $api->customers->customer->getInvoices($customerId, $invoiceNo) → CustomerInvoicesListItem
 *   GET /customer/{customerId}/orders → $api->customers->customer->listOrders($customerId) →
 *       list<CustomerOrdersGetData|CustomerOrdersListDataItemOption2|CustomerOrdersListDataItemOption3>
 *   GET /customer/{customerId}/orders/{orderNo} →
 *       $api->customers->customer->getOrders($customerId, $orderNo) → CustomerOrdersGetData
 *   GET /customer/{customerId}/purchased-items →
 *       $api->customers->customer->listPurchasedItems($customerId) →
 *       list of CustomerPurchasedItemsListItem
 *   GET /customer/{customerId}/quotes → $api->customers->customer->listQuotes($customerId) →
 *       list of CustomerOrdersGetData
 *   GET /customer/{customerId}/quotes/{quoteNo} →
 *       $api->customers->customer->getQuotes($customerId, $quoteNo) → CustomerOrdersGetData
 *   GET /customer/{customerId}/rmas → $api->customers->customer->listRmas($customerId) →
 *       list of CustomerOrdersGetData
 *   GET /customer/{customerId}/rmas/{rmaNo} →
 *       $api->customers->customer->getRmas($customerId, $rmaNo) → CustomerOrdersGetData
 *   GET /customer/{customerId}/sales-usage →
 *       $api->customers->customer->listSalesUsage($customerId) → CustomerSalesUsageListData
 *   POST /customer/{customerId}/ship-to →
 *       $api->customers->customer->createShipTo($customerId, $data) → bool
 *   GET /customer/{customerId}/ship-to → $api->customers->customer->listShipTo($customerId) →
 *       list of CustomerShipToListItem
 *   GET /customer/{customerId}/ship-to/lookup →
 *       $api->customers->customer->getShipToLookup($customerId) →
 *       list of CustomerShipToLookupGetItem
 *   GET /customer/{customerId}/ship-to/{shipToId}/freight-codes →
 *       $api->customers->customer->listShipToFreightCodes($customerId, $shipToId) →
 *       CustomerShipToFreightCodesListData
 *   GET /customer/{customerId}/tags → $api->customers->customer->listTags($customerId) →
 *       list of CustomerTagsListItem
 *   POST /customer/{customerId}/tags → $api->customers->customer->createTags($customerId, $data) →
 *       CustomerTagsListItem
 *   GET /customer/{customerId}/tags/{customerTagsUid} →
 *       $api->customers->customer->getTags($customerId, $customerTagsUid) → CustomerTagsListItem
 *   PUT /customer/{customerId}/tags/{customerTagsUid} →
 *       $api->customers->customer->updateTags($customerId, $customerTagsUid, $data) →
 *       CustomerTagsListItem
 *   DELETE /customer/{customerId}/tags/{customerTagsUid} →
 *       $api->customers->customer->deleteTags($customerId, $customerTagsUid) → CustomerTagsListItem
 */
final class CustomersClient extends BaseServiceClient
{
    public readonly ContactsResource $contacts;
    public readonly ContactsUdResource $contactsUd;
    public readonly CustomerResource $customer;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->contacts = new ContactsResource($this->client, $this->baseUrl . '/contacts');
        $this->contactsUd = new ContactsUdResource($this->client, $this->baseUrl . '/contacts-ud');
        $this->customer = new CustomerResource($this->client, $this->baseUrl . '/customer');
    }

    protected function getServiceName(): string
    {
        return 'customers';
    }
}
