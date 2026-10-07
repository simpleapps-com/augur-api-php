<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * customer resource — generated from spec.
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
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ContactsCustomersListItem: A Prophet 21 customer with its terms and user-defined fields
 * Returned by: $api->customers->customer->list()
 * Returned by: $api->customers->customer->listDoc($customerId)
 *   customerId: float — Prophet 21 customer ID
 *   companyId: string — Prophet 21 company
 *   customerName: string|null — Customer name
 *   class1Id: string|null — Customer class 1
 *   class2Id: string|null — Customer class 2
 *   class3Id: string|null — Customer class 3
 *   class4Id: string|null — Customer class 4
 *   class5Id: string|null — Customer class 5
 *   webEnabledFlag: string — Y when the customer may order on the web
 *   deleteFlag: string — Y when the customer is deleted in Prophet 21
 *   salesRepId: string|null — Prophet 21 contact ID of the customer's salesrep
 *   poNoRequired: string — Y when orders require a purchase order number
 *   termsId: string|null — Prophet 21 payment terms
 *   termsDesc: string — Payment terms description; empty when the customer has no terms
 *   taxableFlag: string — Y when the customer is taxable
 *   statusCd: int — Augur status code
 *   jobPricing: string — Y when the customer uses job pricing
 *   userDefined: array<string, mixed>|array{} — Prophet 21 user-defined fields keyed by field name;
 *       [] when the customer has none ([] when empty)
 *
 * CustomerLookupGetItem: One customer in a customer lookup
 * Returned by: $api->customers->customer->getLookup()
 *   customerId: float — Prophet 21 customer ID
 *   customerName: string|null — Customer name
 *
 * CustomerAddressListItem: One shipping address in a customer's address lookup
 * Returned by: $api->customers->customer->listAddress($customerId)
 *   id: float — Prophet 21 address (ship-to) ID
 *   name: string — Address name
 *   mailAddress1: string — Mailing address line 1
 *   mailAddress2: string|null — Mailing address line 2
 *   mailCity: string|null — Mailing city
 *   mailState: string|null — Mailing state or province
 *   mailPostalCode: string|null — Mailing postal code
 *   mailCountry: string|null — Mailing country
 *
 * CustomerAddressesListItem:
 * Returned by: $api->customers->customer->listAddresses($customerId)
 * Returned by: $api->customers->customer->createAddresses($customerId, $data)
 * Returned by: $api->customers->customer->getAddresses($customerId, $customerAddressUid)
 * Returned by: $api->customers->customer->updateAddresses($customerId, $customerAddressUid, $data)
 * Returned by: $api->customers->customer->deleteAddresses($customerId, $customerAddressUid)
 *   customerAddressUid: int — Customer address ID
 *   customerId: float — Prophet 21 customer the address belongs to
 *   address1: string|null — Address line 1 (max 50 chars)
 *   address2: string|null — Address line 2 (max 50 chars)
 *   address3: string|null — Address line 3 (max 50 chars)
 *   city: string|null — City (max 50 chars)
 *   state: string|null — State or province (max 50 chars)
 *   postalCode: string|null — Postal code (max 10 chars)
 *   country: string|null — Country (max 50 chars)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   emailAddress: string|null — Email address (max 255 chars)
 *   name: string|null — Address name (max 255 chars)
 *   phoneNumberMain: string|null — Main phone number (max 20 chars)
 *   phoneNumberMobile: string|null — Mobile phone number (max 20 chars)
 *
 * CustomerAddressesCreateBody: Create a customer address; every field is optional
 * Request body of: $api->customers->customer->createAddresses($customerId, $data)
 *   address1?: string|null — Address line 1
 *   address2?: string|null — Address line 2
 *   address3?: string|null — Address line 3
 *   city?: string|null — City
 *   state?: string|null — State or province
 *   postalCode?: string|null — Postal code
 *   country?: string|null — Country
 *   emailAddress?: string|null — Email address
 *   name?: string|null — Address name
 *   phoneNumberMain?: string|null — Main phone number
 *   phoneNumberMobile?: string|null — Mobile phone number
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted); defaults to
 *       704
 *   processCd?: int|null — Process code; defaults to 704 (Active)
 *   updateCd?: int|null — Update code; defaults to 1185 (Import Complete)
 *
 * CustomerAddressesUpdateBody: Partial update of a customer address; an absent field keeps its
 * current value
 * Request body of:
 * $api->customers->customer->updateAddresses($customerId, $customerAddressUid, $data)
 *   address1?: string|null — Address line 1
 *   address2?: string|null — Address line 2
 *   address3?: string|null — Address line 3
 *   city?: string|null — City
 *   state?: string|null — State or province
 *   postalCode?: string|null — Postal code
 *   country?: string|null — Country
 *   emailAddress?: string|null — Email address
 *   name?: string|null — Address name
 *   phoneNumberMain?: string|null — Main phone number
 *   phoneNumberMobile?: string|null — Mobile phone number
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code
 *
 * CustomerAgingListData: A customer's outstanding invoice balances, aged into 30/60/90-day buckets.
 * Returned by: $api->customers->customer->listAging($customerId)
 *   customerId: string — Prophet 21 customer the report is for
 *   asOf: string — Date the ages are measured to (Y-m-d)
 *   bucketKeys: list<string> — Bucket keys in display order
 *   invoiceCount: int — Number of outstanding invoices across every bucket
 *   totalBalance: float — Outstanding balance across every bucket
 *   totals: list<CustomerAgingListDataTotalsItem> — Balance and invoice count per bucket, in
 *       bucketKeys order
 *     each item: CustomerAgingListDataTotalsItem — Outstanding balance and invoice count for one
 *         aging bucket.
 *   data: list<CustomerAgingListDataDataItem> — The requested page of outstanding invoices
 *     each item: CustomerAgingListDataDataItem — One outstanding invoice in the aging report.
 *
 * CustomerAgingListDataTotalsItem: Outstanding balance and invoice count for one aging bucket.
 * Field `totals` of CustomerAgingListData
 *   key: string — Bucket key, one of the response's bucketKeys
 *   balance: float — Outstanding balance of the invoices in the bucket
 *   invoices: int — Number of invoices in the bucket
 *
 * CustomerAgingListDataDataItem: One outstanding invoice in the aging report.
 * Field `data` of CustomerAgingListData
 *   invoiceNo: string — Prophet 21 invoice number
 *   orderNo: string|null — Order the invoice was raised for
 *   poNo: string|null — Customer purchase order number
 *   ship2Name: string|null — Ship-to name
 *   invoiceDate: string — Invoice date the age is measured from (Y-m-d)
 *   totalAmount: float — Invoice total
 *   amountPaid: float — Amount paid so far
 *   balance: float — Amount still owed: totalAmount - amountPaid
 *   ageDays: int — Whole days from invoiceDate to the as-of date
 *   bucket: string — Aging bucket key the invoice falls in
 *
 * CustomerContactsListItem: One contact in a customer's contact lookup
 * Returned by: $api->customers->customer->listContacts($customerId)
 *   id: string — Prophet 21 contact ID
 *   emailAddress: string|null — Email address
 *   firstName: string — First name
 *   lastName: string — Last name
 *   title: string|null — Job title
 *   phone: string|null — Direct phone number
 *   ext: string|null — Phone extension
 *   cellular: string|null — Mobile phone number
 *   addressId: float — Prophet 21 address the contact belongs to
 *   addressClass5Id: string|null — Class 5 of the contact's address
 *
 * CustomerContactsCreateBody: A new Prophet 21 contact, passed to the P21 Entity API as sent
 * Request body of: $api->customers->customer->createContacts($customerId, $data)
 *   contactLeadSources?: array<string, mixed>|array{}|null — P21 ContactLeadSource fields ([] when
 *       empty)
 *   contactLinks?: array<string, mixed>|array{}|null — P21 ContactLink fields ([] when empty)
 *   contactSalesreps?: array<string, mixed>|array{}|null — P21 ContactSalesrep fields ([] when
 *       empty)
 *   userDefinedFields?: array<string, mixed>|array{}|null — P21 user-defined fields keyed by field
 *       name ([] when empty)
 *
 * CustomerInvoicesListItem: A Prophet 21 invoice with its lines
 * Returned by: $api->customers->customer->listInvoices($customerId)
 * Returned by: $api->customers->customer->getInvoices($customerId, $invoiceNo)
 *   invoiceNo: string — Invoice number
 *   customerId: float — Prophet 21 customer invoiced
 *   customerName: string|null — Customer name
 *   orderNo: string|null — Order the invoice bills
 *   invoiceDate: string — Invoice date (Y-m-d)
 *   poNo: string|null — Customer purchase order number
 *   ship2Name: string|null — Ship-to name
 *   ship2Contact: string|null — Ship-to contact
 *   ship2Address1: string|null — Ship-to address line 1
 *   ship2Address2: string|null — Ship-to address line 2
 *   ship2Address3: string|null — Ship-to address line 3
 *   ship2City: string|null — Ship-to city
 *   ship2State: string|null — Ship-to state or province
 *   ship2PostalCode: string|null — Ship-to postal code
 *   ship2Country: string|null — Ship-to country
 *   ship2EmailAddress: string|null — Ship-to email address
 *   shipToPhone: string|null — Ship-to phone number
 *   bill2Name: string|null — Bill-to name
 *   bill2Contact: string|null — Bill-to contact
 *   bill2Address1: string|null — Bill-to address line 1
 *   bill2Address2: string|null — Bill-to address line 2
 *   bill2Address3: string|null — Bill-to address line 3
 *   bill2City: string|null — Bill-to city
 *   bill2State: string|null — Bill-to state or province
 *   bill2PostalCode: string|null — Bill-to postal code
 *   bill2Country: string|null — Bill-to country
 *   totalAmount: float — Invoice total
 *   amountPaid: float — Amount paid so far
 *   paidInFullFlag: string|null — Y when the invoice is paid in full
 *   taxAmount: float — Tax on the invoice
 *   taxAmountPaid: float — Tax paid so far
 *   shippingCost: float|null — Shipping cost
 *   freight: float|null — Freight charged
 *   datePaid: string|null — Date the invoice was paid (Y-m-d); null while unpaid
 *   lines: list<CustomerInvoicesListItemLinesItem> — Invoice lines
 *     each item: CustomerInvoicesListItemLinesItem — One line of an invoice, nested in
 *         `InvoiceDocResponse`
 *
 * CustomerInvoicesListItemLinesItem: One line of an invoice, nested in `InvoiceDocResponse`
 * Field `lines` of CustomerInvoicesListItem
 *   lineNo: float — Invoice line number
 *   invMastUid: int|null — Item (inv_mast) on the line; null for a non-stock line
 *   itemId: string|null — Item ID
 *   itemDesc: string — Item description
 *   shortCode: string|null — Item short code; null when the line has no item
 *   unitOfMeasure: string|null — Unit of measure
 *   unitPrice: float — Unit price
 *   extendedPrice: float — Extended price
 *   qtyRequested: float — Quantity requested
 *   qtyShipped: float — Quantity shipped
 *   oderNo: string|null — Order the line came from; misspelled duplicate of orderNo, kept for
 *       existing consumers
 *   orderNo: string|null — Order the line came from
 *   oeLineNumber: float|null — Order line number the invoice line came from
 *
 * CustomerOrdersGetData: One order, quote or RMA document: the `oe_hdr` header with its lines and
 * pick tickets.
 * Returned by: $api->customers->customer->listOrders($customerId)
 * Returned by: $api->customers->customer->getOrders($customerId, $orderNo)
 * Returned by: $api->customers->customer->listQuotes($customerId)
 * Returned by: $api->customers->customer->getQuotes($customerId, $quoteNo)
 * Returned by: $api->customers->customer->listRmas($customerId)
 * Returned by: $api->customers->customer->getRmas($customerId, $rmaNo)
 *   orderNo: string — Prophet 21 order number
 *   customerId: float — Prophet 21 customer the order belongs to
 *   customerName: string|null — Customer name
 *   jobName: string|null — Job name entered on the order
 *   orderDate: string|null — Date the order was placed (Y-m-d)
 *   requestedDate: string|null — Date the customer requested delivery (Y-m-d)
 *   cancelFlag: string|null — Y when the order is canceled
 *   completed: string|null — Y when the order is complete (fully shipped)
 *   deleteFlag: string — Y when the order is deleted in Prophet 21
 *   poNo: string|null — Customer purchase order number
 *   ship2Name: string|null — Ship-to name
 *   ship2Add1: string|null — Ship-to address line 1
 *   ship2Add2: string|null — Ship-to address line 2
 *   ship2Add3: string|null — Ship-to address line 3
 *   ship2City: string|null — Ship-to city
 *   ship2State: string|null — Ship-to state or province
 *   ship2Zip: string|null — Ship-to postal code
 *   ship2Country: string|null — Ship-to country
 *   ship2EmailAddress: string|null — Ship-to email address
 *   shipToPhone: string|null — Ship-to phone number
 *   deliveryInstructions: string|null — Delivery instructions for the carrier
 *   class1Id: string|null — Order class 1
 *   class2Id: string|null — Order class 2
 *   class3Id: string|null — Order class 3
 *   class4Id: string|null — Order class 4
 *   class5Id: string|null — Order class 5
 *   contactId: string|null — Prophet 21 contact who placed the order
 *   webReferenceNo: string|null — Web order reference number from the storefront
 *   orderStatus: string — PENDING, SUBMITTED, IN PROCESS, ON HOLD or SHIPPED, derived from the
 *       completed, approved, cancel and validation flags
 *   taker: string|null — User who entered the order
 *   contactFirstName: string|null — First name of the ordering contact; null when the order has no
 *       contact
 *   contactLastName: string|null — Last name of the ordering contact; null when the order has no
 *       contact
 *   carrierId: float|null — Prophet 21 address id of the order's carrier
 *   carrierName: string — Carrier name; empty when the order has no carrier
 *   lines: list<CustomerOrdersGetDataLinesItem> — Order lines, by line number
 *     each item: CustomerOrdersGetDataLinesItem — One `oe_line` row on an order document.
 *   pickTickets: list<CustomerOrdersGetDataPickTicketsItem> — Pick tickets issued for the order
 *     each item: CustomerOrdersGetDataPickTicketsItem — One `oe_pick_ticket` on an order document,
 *         with its shipped lines.
 *
 * CustomerOrdersGetDataLinesItem: One `oe_line` row on an order document.
 * Field `lines` of CustomerOrdersGetData
 *   invMastUid: int — Item (inv_mast) ordered on the line
 *   cancelFlag: string|null — Y when the line is canceled
 *   complete: string|null — Y when the line is complete
 *   deleteFlag: string — Y when the line is deleted in Prophet 21
 *   disposition: string|null — Prophet 21 disposition code for unallocated quantity (e.g. B =
 *       backorder)
 *   itemDesc: string|null — Item description
 *   displayDesc: string|null — Item description shown on the storefront
 *   itemId: string — Item ID
 *   shortCode: string|null — Item short code
 *   lineNo: float — Line number on the order
 *   orderNo: string — Order the line belongs to
 *   originalQtyOrdered: float|null — Quantity on the line when it was entered
 *   qtyAllocated: float|null — Quantity allocated from stock
 *   qtyCanceled: float|null — Quantity canceled
 *   qtyInvoiced: float|null — Quantity invoiced
 *   qtyOnPickTickets: float|null — Quantity on open pick tickets
 *   qtyOrdered: float|null — Quantity ordered
 *   unitOfMeasure: string|null — Unit of measure the line was sold in
 *   unitQuantity: float — Quantity in the line's unit of measure
 *   unitSize: float — Base units per unit of measure
 *   unitPrice: float|null — Price per unit of measure
 *   extendedPrice: float|null — Line total
 *   oeLineUid: int — Order line ID
 *   parentOeLineUid: int — Parent line's oeLineUid for an assembly component; 0 for a top-level
 *       line
 *   trinityItemId: string|null — Trinity private-label item ID (trinitysurfaces only)
 *   trinityItemDesc: string|null — Trinity private-label item description (trinitysurfaces only)
 *   agentItemId: string|null — Agent private-label item ID (trinitysurfaces only)
 *   agentItemDesc: string|null — Agent private-label item description (trinitysurfaces only)
 *
 * CustomerOrdersGetDataPickTicketsItem: One `oe_pick_ticket` on an order document, with its shipped
 * lines.
 * Field `pickTickets` of CustomerOrdersGetData
 *   pickTicketNo: float — Pick ticket number
 *   trackingNo: string|null — Carrier tracking number
 *   orderNo: string — Order the pick ticket belongs to
 *   invoiceNo: float|null — Invoice raised for the pick ticket; null until invoiced
 *   shipDate: string|null — Date the pick ticket shipped (Y-m-d)
 *   printedFlag: string|null — Y when the pick ticket has been printed
 *   printDate: string|null — Date the pick ticket was printed (Y-m-d)
 *   instructions: string|null — Picking or shipping instructions
 *   carrierId: float|null — Prophet 21 address id of the pick ticket's carrier
 *   carrierName: string — Carrier name; empty when the pick ticket has no carrier
 *   lines: list<CustomerOrdersGetDataPickTicketsItemLinesItem> — Lines on the pick ticket
 *     each item: CustomerOrdersGetDataPickTicketsItemLinesItem — One `oe_pick_ticket_detail` row on
 *         a pick ticket.
 *
 * CustomerOrdersGetDataPickTicketsItemLinesItem: One `oe_pick_ticket_detail` row on a pick ticket.
 * Field `lines` of CustomerOrdersGetDataPickTicketsItem
 *   lineNumber: float — Line number on the pick ticket
 *   shipQuantity: float|null — Quantity shipped
 *   qtyRequested: float|null — Quantity requested for picking
 *   invMastUid: int — Item (inv_mast) on the line
 *   itemId: string — Item ID
 *   itemDesc: string|null — Item description
 *   displayDesc: string|null — Item description shown on the storefront
 *   trinityItemId: string|null — Trinity private-label item ID (trinitysurfaces only)
 *   trinityItemDesc: string|null — Trinity private-label item description (trinitysurfaces only)
 *   agentItemId: string|null — Agent private-label item ID (trinitysurfaces only)
 *   agentItemDesc: string|null — Agent private-label item description (trinitysurfaces only)
 *
 * CustomerOrdersListDataItemOption2:
 * Returned by: $api->customers->customer->listOrders($customerId)
 *   orderNo: string — Prophet 21 order number (max 8 chars)
 *   oeHdrUid: int — Unique id of the order header
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   customerId: float — Prophet 21 customer the order is for
 *   orderDate: string|null — When the order was placed (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   poNo: string|null — Customer purchase order number (max 50 chars)
 *   completed: string|null — Y when the order is complete (max 1 chars)
 *   companyId: string|null — Prophet 21 company (max 8 chars)
 *   carrierId: float|null — Prophet 21 address id of the carrier
 *   dateLastChecked: string — When Augur last checked the order against Prophet 21 (mysql-datetime,
 *       e.g. 2025-07-30 15:50:49)
 *   updateCd: int — Update code (704 = queued for refresh from Prophet 21, 1185 = current)
 *   webReferenceNo: string|null — Web order reference number; null for orders not placed on the web
 *       (max 255 chars)
 *   ship2Name: string|null — Ship-to name (max 50 chars)
 *   ship2Add1: string|null — Ship-to address line 1 (max 50 chars)
 *   ship2Add2: string|null — Ship-to address line 2 (max 50 chars)
 *   ship2City: string|null — Ship-to city (max 50 chars)
 *   ship2State: string|null — Ship-to state or province (max 50 chars)
 *   ship2Zip: string|null — Ship-to postal code (max 10 chars)
 *   ship2Country: string|null — Ship-to country (max 50 chars)
 *   ship2EmailAddress: string|null — Ship-to email address (max 255 chars)
 *   ship2Add3: string|null — Ship-to address line 3 (max 50 chars)
 *   shipToPhone: string|null — Ship-to phone number (max 20 chars)
 *   locationId: float|null — Prophet 21 location the order ships from
 *   deliveryInstructions: string|null — Delivery instructions for the carrier (max 255 chars)
 *   cancelFlag: string|null — Y when the order is canceled (max 1 chars)
 *   taker: string|null — Prophet 21 user who took the order (max 30 chars)
 *   shippingRouteUid: int|null — Shipping route assigned to the order
 *   terms: string|null — Prophet 21 payment terms (max 2 chars)
 *   approved: string|null — Y when the order is approved (max 1 chars)
 *   class1id: string|null — Order class 1 (max 8 chars)
 *   class2id: string|null — Order class 2 (max 8 chars)
 *   class3id: string|null — Order class 3 (max 8 chars)
 *   class4id: string|null — Order class 4 (max 8 chars)
 *   class5id: string|null — Order class 5 (max 8 chars)
 *   contactId: string|null — Prophet 21 contact who placed the order (max 16 chars)
 *   projectedOrder: string|null — Y when the order is projected (not yet firm) (max 1 chars)
 *   sourceCodeNo: int — Prophet 21 source code of the order (706 = Order Entry)
 *   orderPriorityUid: int|null — Order priority
 *   freightOut: float — Outgoing freight charged on the order
 *   rmaFlag: string|null — Y when the order is an RMA (max 1 chars)
 *   dateOrderCompleted: string|null — When the order was completed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   jobName: string|null — Job name (max 40 chars)
 *   requestedDate: string|null — Date the customer requested the order (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   statusCd: int — Augur status code of the record
 *   requestedDownpayment: float|null — Down payment requested on the order
 *   downpaymentInvoiced: string|null — Y when the down payment has been invoiced (max 1 chars)
 *   validationStatus: string|null — Order validation status (max 8 chars)
 *   addressId: float|null — Prophet 21 address of the order
 *   deleteFlag: string — Y when the order is deleted (max 1 chars)
 *
 * CustomerOrdersListDataItemOption3:
 * Returned by: $api->customers->customer->listOrders($customerId)
 *   orderNo: string — Prophet 21 order number (max 8 chars)
 *   oeHdrUid: int — Unique id of the order header
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   customerId: float — Prophet 21 customer the order is for
 *   orderDate: string|null — When the order was placed (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   poNo: string|null — Customer purchase order number (max 50 chars)
 *   completed: string|null — Y when the order is complete (max 1 chars)
 *   companyId: string|null — Prophet 21 company (max 8 chars)
 *   carrierId: float|null — Prophet 21 address id of the carrier
 *   dateLastChecked: string — When Augur last checked the order against Prophet 21 (mysql-datetime,
 *       e.g. 2025-07-30 15:50:49)
 *   updateCd: int — Update code (704 = queued for refresh from Prophet 21, 1185 = current)
 *   webReferenceNo: string|null — Web order reference number; null for orders not placed on the web
 *       (max 255 chars)
 *   ship2Name: string|null — Ship-to name (max 50 chars)
 *   ship2Add1: string|null — Ship-to address line 1 (max 50 chars)
 *   ship2Add2: string|null — Ship-to address line 2 (max 50 chars)
 *   ship2City: string|null — Ship-to city (max 50 chars)
 *   ship2State: string|null — Ship-to state or province (max 50 chars)
 *   ship2Zip: string|null — Ship-to postal code (max 10 chars)
 *   ship2Country: string|null — Ship-to country (max 50 chars)
 *   ship2EmailAddress: string|null — Ship-to email address (max 255 chars)
 *   ship2Add3: string|null — Ship-to address line 3 (max 50 chars)
 *   shipToPhone: string|null — Ship-to phone number (max 20 chars)
 *   locationId: float|null — Prophet 21 location the order ships from
 *   deliveryInstructions: string|null — Delivery instructions for the carrier (max 255 chars)
 *   cancelFlag: string|null — Y when the order is canceled (max 1 chars)
 *   taker: string|null — Prophet 21 user who took the order (max 30 chars)
 *   shippingRouteUid: int|null — Shipping route assigned to the order
 *   terms: string|null — Prophet 21 payment terms (max 2 chars)
 *   approved: string|null — Y when the order is approved (max 1 chars)
 *   class1id: string|null — Order class 1 (max 8 chars)
 *   class2id: string|null — Order class 2 (max 8 chars)
 *   class3id: string|null — Order class 3 (max 8 chars)
 *   class4id: string|null — Order class 4 (max 8 chars)
 *   class5id: string|null — Order class 5 (max 8 chars)
 *   contactId: string|null — Prophet 21 contact who placed the order (max 16 chars)
 *   projectedOrder: string|null — Y when the order is projected (not yet firm) (max 1 chars)
 *   sourceCodeNo: int — Prophet 21 source code of the order (706 = Order Entry)
 *   orderPriorityUid: int|null — Order priority
 *   freightOut: float — Outgoing freight charged on the order
 *   rmaFlag: string|null — Y when the order is an RMA (max 1 chars)
 *   dateOrderCompleted: string|null — When the order was completed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   jobName: string|null — Job name (max 40 chars)
 *   requestedDate: string|null — Date the customer requested the order (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   statusCd: int — Augur status code of the record
 *   requestedDownpayment: float|null — Down payment requested on the order
 *   downpaymentInvoiced: string|null — Y when the down payment has been invoiced (max 1 chars)
 *   validationStatus: string|null — Order validation status (max 8 chars)
 *   addressId: float|null — Prophet 21 address of the order
 *   deleteFlag: string — Y when the order is deleted (max 1 chars)
 *   lines: list<CustomerOrdersListDataItemOption3LinesItem> — One order line in the light form
 *       orders list sends with fullDocument=L
 *     each item: CustomerOrdersListDataItemOption3LinesItem — One order line in the light form
 *         orders list sends with fullDocument=L
 *
 * CustomerOrdersListDataItemOption3LinesItem: One order line in the light form orders list sends
 * with fullDocument=L
 * Field `lines` of CustomerOrdersListDataItemOption3
 *   lineNo: float — Line number on the order
 *   itemId: string|null — Item ID; null when the item is not in inv_mast
 *   qtyOrdered: float|null — Quantity ordered
 *   unitPrice: float|null — Price per unit of measure
 *   oeLineUid: int — Order line ID
 *   parentOeLineUid: int — Parent line's oeLineUid for an assembly component; 0 for a top-level
 *       line
 *
 * CustomerPurchasedItemsListItem: One item a customer has bought, with how often and how recently
 * Returned by: $api->customers->customer->listPurchasedItems($customerId)
 *   customerId: float — Prophet 21 customer
 *   invMastUid: int — Item (inv_mast) purchased
 *   count: float — Total quantity purchased
 *   invoices: int — Number of invoices the item appeared on
 *   lastOrderNo: string|null — Most recent order the item was on
 *   dateLastPurchased: string|null — Date the item was last purchased (Y-m-d)
 *   itemId: string — Item ID
 *   itemDesc: string|null — Item description
 *   displayDesc: string|null — Item description shown on the storefront
 *
 * CustomerSalesUsageListData: Per-customer, per-item consumption folded from invoiced sales
 * history.
 * Returned by: $api->customers->customer->listSalesUsage($customerId)
 *   customerId: string — Prophet 21 customer the report is for
 *   invoicedFrom: string — Start of the invoice date range (Y-m-d)
 *   invoicedTo: string — End of the invoice date range (Y-m-d)
 *   totalBy: string — Period the buckets are folded by: week, month or year
 *   bucketKeys: list<string> — Period keys in display order
 *   invoiceCount: int — Number of invoices in the date range
 *   linesFolded: int — Number of invoice lines folded into the report
 *   itemCount: int — Number of items across the whole report
 *   data: list<CustomerSalesUsageListDataDataItem> — The requested page of items
 *     each item: CustomerSalesUsageListDataDataItem — One purchased item in the sales usage report,
 *         with its consumption per time period.
 *
 * CustomerSalesUsageListDataDataItem: One purchased item in the sales usage report, with its
 * consumption per time period.
 * Field `data` of CustomerSalesUsageListData
 *   itemId: string — Item ID
 *   itemDesc: string — Item description
 *   unitOfMeasure: string|null — Unit of measure the item was sold in
 *   salesUnitSize: float|null — Base units per sales unit
 *   pricingUnitSize: float|null — Base units per pricing unit
 *   buckets: list<CustomerSalesUsageListDataDataItemBucketsItem> — Consumption per period, in
 *       bucketKeys order
 *     each item: CustomerSalesUsageListDataDataItemBucketsItem — One time period of a sales usage
 *         item row.
 *
 * CustomerSalesUsageListDataDataItemBucketsItem: One time period of a sales usage item row.
 * Field `buckets` of CustomerSalesUsageListDataDataItem
 *   key: string — Period key, one of the response's bucketKeys
 *   quantity: float — Quantity invoiced in the period
 *   total: float — Sales total invoiced in the period
 *   lines: int — Number of invoice lines folded into the period
 *
 * CustomerShipToListItem: One ship-to doc, backing an entry of `GET
 * /api/customer/{customerId}/ship-to`.
 * Returned by: $api->customers->customer->listShipTo($customerId)
 *   shipToId: float — Prophet 21 ship-to ID (also its address ID)
 *   customerId: float — Prophet 21 customer the ship-to belongs to
 *   companyId: string — Prophet 21 company
 *   defaultBranch: string — Default branch for the ship-to
 *   defaultCarrierId: float|null — Prophet 21 address ID of the default carrier
 *   preferredLocationId: float|null — Prophet 21 location the ship-to prefers to ship from
 *   deliveryInstructions: string|null — Delivery instructions for the carrier
 *   shippingRouteUid: int|null — Shipping route assigned to the ship-to
 *   routeCode: string|null — Shipping route code
 *   routeDescription: string|null — Shipping route description
 *   address: CustomerShipToListItemAddress|null — The ship-to's address; null when no address row
 *       matches
 *
 * CustomerShipToListItemAddress: The ship-to's address; null when no address row matches
 * Field `address` of CustomerShipToListItem
 *   id: float — Prophet 21 address ID
 *   name: string — Address name
 *   mailAddress1: string|null — Mailing address line 1
 *   mailAddress2: string|null — Mailing address line 2
 *   mailAddress3: string|null — Mailing address line 3
 *   mailCity: string|null — Mailing city
 *   mailState: string|null — Mailing state or province
 *   mailPostalCode: string|null — Mailing postal code
 *   mailCountry: string|null — Mailing country
 *   physAddress1: string|null — Physical address line 1
 *   physAddress2: string|null — Physical address line 2
 *   physAddress3: string|null — Physical address line 3
 *   physCity: string|null — Physical city
 *   physState: string|null — Physical state or province
 *   physPostalCode: string|null — Physical postal code
 *   physCountry: string|null — Physical country
 *   class5Id: string|null — Address class 5
 *   centralPhoneNumber: string|null — Main phone number
 *   upsCode: string|null — UPS code for the address
 *
 * CustomerShipToCreateBody: A new Prophet 21 ship-to, passed to the P21 Entity API as sent
 * Request body of: $api->customers->customer->createShipTo($customerId, $data)
 *   shipToAddress?: array<string, mixed>|array{}|null — P21 ShipToAddress fields (name, mail and
 *       physical address, phone) ([] when empty)
 *
 * CustomerShipToLookupGetItem: One ship-to in a customer's ship-to lookup
 * Returned by: $api->customers->customer->getShipToLookup($customerId)
 *   id: float — Prophet 21 ship-to (address) ID
 *   name: string — Ship-to name
 *   mailAddress1: string — Mailing address line 1
 *   mailAddress2: string|null — Mailing address line 2
 *   mailAddress3: string|null — Mailing address line 3
 *   mailCity: string|null — Mailing city
 *   mailState: string|null — Mailing state or province
 *   mailPostalCode: string|null — Mailing postal code
 *   mailCountry: string|null — Mailing country
 *   physAddress1: string|null — Physical address line 1
 *   physAddress2: string|null — Physical address line 2
 *   physAddress3: string|null — Physical address line 3
 *   physCity: string|null — Physical city
 *   physState: string|null — Physical state or province
 *   physPostalCode: string|null — Physical postal code
 *   physCountry: string|null — Physical country
 *   class5Id: string|null — Address class 5
 *   preferredLocationId: float|null — Prophet 21 location the ship-to prefers to ship from
 *   defaultBranch: string — Default branch for the ship-to
 *
 * CustomerShipToFreightCodesListData:
 * Returned by: $api->customers->customer->listShipToFreightCodes($customerId, $shipToId)
 *   freightCodeUid: int — Unique Prophet 21 ID of the freight code
 *   companyId: string — Prophet 21 company the freight code belongs to (max 8 chars)
 *   freightCd: string — Freight code (max 30 chars)
 *   freightDesc: string — Freight code description (max 255 chars)
 *   incomingFreight: string — Y when the code applies to incoming freight (max 1 chars)
 *   outgoingFreight: string — Y when the code applies to outgoing freight (max 1 chars)
 *   incomingReduceCommission: string — Y when incoming freight reduces commission (max 1 chars)
 *   outgoingIncreaseCommission: string — Y when outgoing freight increases commission (max 1 chars)
 *   prorateMethodCodeNo: int — Prorate method (Prophet 21 code number)
 *   taxGroupId: string|null — Tax group for the freight charge (max 10 chars)
 *   revenueAccountNo: string — General ledger revenue account for the freight charge (max 32 chars)
 *   rowStatus: int — Prophet 21 row status code
 *   dateCreated: string|null — When the record was created (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string|null — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   lastMaintainedBy: string — Prophet 21 user who last changed the record (max 30 chars)
 *   freeFreightBasisCd: int|null — Basis for free freight (Prophet 21 code number)
 *   freeInFreightMin: float|null — Minimum for free incoming freight
 *   freeOutFreightMin: float|null — Minimum for free outgoing freight
 *   directShipFreeFreightFlag: string|null — Y when direct shipments get free freight (max 1 chars)
 *   freeInFreightMinWeb: float|null — Minimum for free incoming freight on web orders
 *   freeOutFreightMinWeb: float|null — Minimum for free outgoing freight on web orders
 *   handlingChargeOptionCd: int|null — Handling charge option (Prophet 21 code number)
 *   externalTaxProductCodeIn: string|null — External tax product code for incoming freight (max 255
 *       chars)
 *   externalTaxProductCodeOut: string|null — External tax product code for outgoing freight (max
 *       255 chars)
 *   incomingIncreaseCommission: string|null — Y when incoming freight increases commission (max 1
 *       chars)
 *   paySpecialFlag: string|null — Prophet 21 pay special flag (max 1 chars)
 *   skipFirstShipmentFlag: string|null — Prophet 21 skip-first-shipment flag (max 1 chars)
 *   excludeFromSalesMasterInquiry: string — Y when excluded from Sales Master Inquiry (max 1 chars)
 *   deductibleFlag: string|null — Y when the freight charge is deductible (max 1 chars)
 *   freeColdFreight: string — Y when cold freight is free (max 1 chars)
 *   freeHazmatFreight: string — Y when hazmat freight is free (max 1 chars)
 *   freeExpressFreight: string — Y when express freight is free (max 1 chars)
 *   freeBulkFreight: string — Y when bulk freight is free (max 1 chars)
 *   fedexPaymentMethod: int|null — FedEx payment method code
 *   excludeDiscountedFreight: string — Prophet 21 exclude-discounted-freight flag (max 1 chars)
 *   freeFreightDefaultFlag: string|null — Y when free freight applies by default (max 1 chars)
 *   outgoingAdjustCommissionByProfitFlag: string|null — Y when outgoing freight adjusts commission
 *       by profit (max 1 chars)
 *   updateCd: int — Update code (704 = queued for refresh from Prophet 21, 1185 = current)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code
 *
 * CustomerTagsListItem:
 * Returned by: $api->customers->customer->listTags($customerId)
 * Returned by: $api->customers->customer->createTags($customerId, $data)
 * Returned by: $api->customers->customer->getTags($customerId, $customerTagsUid)
 * Returned by: $api->customers->customer->updateTags($customerId, $customerTagsUid, $data)
 * Returned by: $api->customers->customer->deleteTags($customerId, $customerTagsUid)
 *   customerTagsUid: int — Customer tag ID
 *   customerId: float — Prophet 21 customer the tag belongs to
 *   tag: string|null — Tag text (max 255 chars)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *
 * CustomerTagsCreateBody: Create a customer tag, or restore the one with the same tag text
 * Request body of: $api->customers->customer->createTags($customerId, $data)
 *   tag: string — Tag text; an existing tag with the same text is refreshed in place
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted); defaults to
 *       704, and 704 restores a deleted tag
 *   processCd?: int|null — Process code; defaults to 704 (Active)
 *   updateCd?: int|null — Update code; defaults to 1185 (Import Complete)
 *
 * CustomerTagsUpdateBody: Partial update of a customer tag; an absent field keeps its current value
 * Request body of: $api->customers->customer->updateTags($customerId, $customerTagsUid, $data)
 *   tag?: string|null — New tag text; a blank value keeps the current text
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code
 *
 * @phpstan-type ContactsCustomersListItem array{customerId: float, companyId: string, customerName: string|null, class1Id: string|null, class2Id: string|null, class3Id: string|null, class4Id: string|null, class5Id: string|null, webEnabledFlag: string, deleteFlag: string, salesRepId: string|null, poNoRequired: string, termsId: string|null, termsDesc: string, taxableFlag: string, statusCd: int, jobPricing: string, userDefined: array<string, mixed>|array{}}
 * @phpstan-type CustomerLookupGetItem array{customerId: float, customerName: string|null}
 * @phpstan-type CustomerAddressListItem array{id: float, name: string, mailAddress1: string, mailAddress2: string|null, mailCity: string|null, mailState: string|null, mailPostalCode: string|null, mailCountry: string|null}
 * @phpstan-type CustomerAddressesListItem array{customerAddressUid: int, customerId: float, address1: string|null, address2: string|null, address3: string|null, city: string|null, state: string|null, postalCode: string|null, country: string|null, updateCd: int, statusCd: int, processCd: int, dateCreated: string, dateLastModified: string, emailAddress: string|null, name: string|null, phoneNumberMain: string|null, phoneNumberMobile: string|null}
 * @phpstan-type CustomerAddressesCreateBody array{address1?: string|null, address2?: string|null, address3?: string|null, city?: string|null, state?: string|null, postalCode?: string|null, country?: string|null, emailAddress?: string|null, name?: string|null, phoneNumberMain?: string|null, phoneNumberMobile?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type CustomerAddressesUpdateBody array{address1?: string|null, address2?: string|null, address3?: string|null, city?: string|null, state?: string|null, postalCode?: string|null, country?: string|null, emailAddress?: string|null, name?: string|null, phoneNumberMain?: string|null, phoneNumberMobile?: string|null, statusCd?: int|null, processCd?: int|null}
 * @phpstan-type CustomerAgingListData array{customerId: string, asOf: string, bucketKeys: list<string>, invoiceCount: int, totalBalance: float, totals: list<CustomerAgingListDataTotalsItem>, data: list<CustomerAgingListDataDataItem>}
 * @phpstan-type CustomerAgingListDataTotalsItem array{key: string, balance: float, invoices: int}
 * @phpstan-type CustomerAgingListDataDataItem array{invoiceNo: string, orderNo: string|null, poNo: string|null, ship2Name: string|null, invoiceDate: string, totalAmount: float, amountPaid: float, balance: float, ageDays: int, bucket: string}
 * @phpstan-type CustomerContactsListItem array{id: string, emailAddress: string|null, firstName: string, lastName: string, title: string|null, phone: string|null, ext: string|null, cellular: string|null, addressId: float, addressClass5Id: string|null}
 * @phpstan-type CustomerContactsCreateBody array{contactLeadSources?: array<string, mixed>|array{}|null, contactLinks?: array<string, mixed>|array{}|null, contactSalesreps?: array<string, mixed>|array{}|null, userDefinedFields?: array<string, mixed>|array{}|null}
 * @phpstan-type CustomerInvoicesListItem array{invoiceNo: string, customerId: float, customerName: string|null, orderNo: string|null, invoiceDate: string, poNo: string|null, ship2Name: string|null, ship2Contact: string|null, ship2Address1: string|null, ship2Address2: string|null, ship2Address3: string|null, ship2City: string|null, ship2State: string|null, ship2PostalCode: string|null, ship2Country: string|null, ship2EmailAddress: string|null, shipToPhone: string|null, bill2Name: string|null, bill2Contact: string|null, bill2Address1: string|null, bill2Address2: string|null, bill2Address3: string|null, bill2City: string|null, bill2State: string|null, bill2PostalCode: string|null, bill2Country: string|null, totalAmount: float, amountPaid: float, paidInFullFlag: string|null, taxAmount: float, taxAmountPaid: float, shippingCost: float|null, freight: float|null, datePaid: string|null, lines: list<CustomerInvoicesListItemLinesItem>}
 * @phpstan-type CustomerInvoicesListItemLinesItem array{lineNo: float, invMastUid: int|null, itemId: string|null, itemDesc: string, shortCode: string|null, unitOfMeasure: string|null, unitPrice: float, extendedPrice: float, qtyRequested: float, qtyShipped: float, oderNo: string|null, orderNo: string|null, oeLineNumber: float|null}
 * @phpstan-type CustomerOrdersGetData array{orderNo: string, customerId: float, customerName: string|null, jobName: string|null, orderDate: string|null, requestedDate: string|null, cancelFlag: string|null, completed: string|null, deleteFlag: string, poNo: string|null, ship2Name: string|null, ship2Add1: string|null, ship2Add2: string|null, ship2Add3: string|null, ship2City: string|null, ship2State: string|null, ship2Zip: string|null, ship2Country: string|null, ship2EmailAddress: string|null, shipToPhone: string|null, deliveryInstructions: string|null, class1Id: string|null, class2Id: string|null, class3Id: string|null, class4Id: string|null, class5Id: string|null, contactId: string|null, webReferenceNo: string|null, orderStatus: string, taker: string|null, contactFirstName: string|null, contactLastName: string|null, carrierId: float|null, carrierName: string, lines: list<CustomerOrdersGetDataLinesItem>, pickTickets: list<CustomerOrdersGetDataPickTicketsItem>}
 * @phpstan-type CustomerOrdersGetDataLinesItem array{invMastUid: int, cancelFlag: string|null, complete: string|null, deleteFlag: string, disposition: string|null, itemDesc: string|null, displayDesc: string|null, itemId: string, shortCode: string|null, lineNo: float, orderNo: string, originalQtyOrdered: float|null, qtyAllocated: float|null, qtyCanceled: float|null, qtyInvoiced: float|null, qtyOnPickTickets: float|null, qtyOrdered: float|null, unitOfMeasure: string|null, unitQuantity: float, unitSize: float, unitPrice: float|null, extendedPrice: float|null, oeLineUid: int, parentOeLineUid: int, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}
 * @phpstan-type CustomerOrdersGetDataPickTicketsItem array{pickTicketNo: float, trackingNo: string|null, orderNo: string, invoiceNo: float|null, shipDate: string|null, printedFlag: string|null, printDate: string|null, instructions: string|null, carrierId: float|null, carrierName: string, lines: list<CustomerOrdersGetDataPickTicketsItemLinesItem>}
 * @phpstan-type CustomerOrdersGetDataPickTicketsItemLinesItem array{lineNumber: float, shipQuantity: float|null, qtyRequested: float|null, invMastUid: int, itemId: string, itemDesc: string|null, displayDesc: string|null, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}
 * @phpstan-type CustomerOrdersListDataItemOption2 array{orderNo: string, oeHdrUid: int, dateCreated: string, dateLastModified: string, customerId: float, orderDate: string|null, poNo: string|null, completed: string|null, companyId: string|null, carrierId: float|null, dateLastChecked: string, updateCd: int, webReferenceNo: string|null, ship2Name: string|null, ship2Add1: string|null, ship2Add2: string|null, ship2City: string|null, ship2State: string|null, ship2Zip: string|null, ship2Country: string|null, ship2EmailAddress: string|null, ship2Add3: string|null, shipToPhone: string|null, locationId: float|null, deliveryInstructions: string|null, cancelFlag: string|null, taker: string|null, shippingRouteUid: int|null, terms: string|null, approved: string|null, class1id: string|null, class2id: string|null, class3id: string|null, class4id: string|null, class5id: string|null, contactId: string|null, projectedOrder: string|null, sourceCodeNo: int, orderPriorityUid: int|null, freightOut: float, rmaFlag: string|null, dateOrderCompleted: string|null, jobName: string|null, requestedDate: string|null, statusCd: int, requestedDownpayment: float|null, downpaymentInvoiced: string|null, validationStatus: string|null, addressId: float|null, deleteFlag: string}
 * @phpstan-type CustomerOrdersListDataItemOption3 array{orderNo: string, oeHdrUid: int, dateCreated: string, dateLastModified: string, customerId: float, orderDate: string|null, poNo: string|null, completed: string|null, companyId: string|null, carrierId: float|null, dateLastChecked: string, updateCd: int, webReferenceNo: string|null, ship2Name: string|null, ship2Add1: string|null, ship2Add2: string|null, ship2City: string|null, ship2State: string|null, ship2Zip: string|null, ship2Country: string|null, ship2EmailAddress: string|null, ship2Add3: string|null, shipToPhone: string|null, locationId: float|null, deliveryInstructions: string|null, cancelFlag: string|null, taker: string|null, shippingRouteUid: int|null, terms: string|null, approved: string|null, class1id: string|null, class2id: string|null, class3id: string|null, class4id: string|null, class5id: string|null, contactId: string|null, projectedOrder: string|null, sourceCodeNo: int, orderPriorityUid: int|null, freightOut: float, rmaFlag: string|null, dateOrderCompleted: string|null, jobName: string|null, requestedDate: string|null, statusCd: int, requestedDownpayment: float|null, downpaymentInvoiced: string|null, validationStatus: string|null, addressId: float|null, deleteFlag: string, lines: list<CustomerOrdersListDataItemOption3LinesItem>}
 * @phpstan-type CustomerOrdersListDataItemOption3LinesItem array{lineNo: float, itemId: string|null, qtyOrdered: float|null, unitPrice: float|null, oeLineUid: int, parentOeLineUid: int}
 * @phpstan-type CustomerPurchasedItemsListItem array{customerId: float, invMastUid: int, count: float, invoices: int, lastOrderNo: string|null, dateLastPurchased: string|null, itemId: string, itemDesc: string|null, displayDesc: string|null}
 * @phpstan-type CustomerSalesUsageListData array{customerId: string, invoicedFrom: string, invoicedTo: string, totalBy: string, bucketKeys: list<string>, invoiceCount: int, linesFolded: int, itemCount: int, data: list<CustomerSalesUsageListDataDataItem>}
 * @phpstan-type CustomerSalesUsageListDataDataItem array{itemId: string, itemDesc: string, unitOfMeasure: string|null, salesUnitSize: float|null, pricingUnitSize: float|null, buckets: list<CustomerSalesUsageListDataDataItemBucketsItem>}
 * @phpstan-type CustomerSalesUsageListDataDataItemBucketsItem array{key: string, quantity: float, total: float, lines: int}
 * @phpstan-type CustomerShipToListItem array{shipToId: float, customerId: float, companyId: string, defaultBranch: string, defaultCarrierId: float|null, preferredLocationId: float|null, deliveryInstructions: string|null, shippingRouteUid: int|null, routeCode: string|null, routeDescription: string|null, address: CustomerShipToListItemAddress|null}
 * @phpstan-type CustomerShipToListItemAddress array{id: float, name: string, mailAddress1: string|null, mailAddress2: string|null, mailAddress3: string|null, mailCity: string|null, mailState: string|null, mailPostalCode: string|null, mailCountry: string|null, physAddress1: string|null, physAddress2: string|null, physAddress3: string|null, physCity: string|null, physState: string|null, physPostalCode: string|null, physCountry: string|null, class5Id: string|null, centralPhoneNumber: string|null, upsCode: string|null}
 * @phpstan-type CustomerShipToCreateBody array{shipToAddress?: array<string, mixed>|array{}|null}
 * @phpstan-type CustomerShipToLookupGetItem array{id: float, name: string, mailAddress1: string, mailAddress2: string|null, mailAddress3: string|null, mailCity: string|null, mailState: string|null, mailPostalCode: string|null, mailCountry: string|null, physAddress1: string|null, physAddress2: string|null, physAddress3: string|null, physCity: string|null, physState: string|null, physPostalCode: string|null, physCountry: string|null, class5Id: string|null, preferredLocationId: float|null, defaultBranch: string}
 * @phpstan-type CustomerShipToFreightCodesListData array{freightCodeUid: int, companyId: string, freightCd: string, freightDesc: string, incomingFreight: string, outgoingFreight: string, incomingReduceCommission: string, outgoingIncreaseCommission: string, prorateMethodCodeNo: int, taxGroupId: string|null, revenueAccountNo: string, rowStatus: int, dateCreated: string|null, dateLastModified: string|null, lastMaintainedBy: string, freeFreightBasisCd: int|null, freeInFreightMin: float|null, freeOutFreightMin: float|null, directShipFreeFreightFlag: string|null, freeInFreightMinWeb: float|null, freeOutFreightMinWeb: float|null, handlingChargeOptionCd: int|null, externalTaxProductCodeIn: string|null, externalTaxProductCodeOut: string|null, incomingIncreaseCommission: string|null, paySpecialFlag: string|null, skipFirstShipmentFlag: string|null, excludeFromSalesMasterInquiry: string, deductibleFlag: string|null, freeColdFreight: string, freeHazmatFreight: string, freeExpressFreight: string, freeBulkFreight: string, fedexPaymentMethod: int|null, excludeDiscountedFreight: string, freeFreightDefaultFlag: string|null, outgoingAdjustCommissionByProfitFlag: string|null, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type CustomerTagsListItem array{customerTagsUid: int, customerId: float, tag: string|null, updateCd: int, statusCd: int, processCd: int, dateCreated: string, dateLastModified: string}
 * @phpstan-type CustomerTagsCreateBody array{tag: string, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 * @phpstan-type CustomerTagsUpdateBody array{tag?: string|null, statusCd?: int|null, processCd?: int|null}
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
     * list the customer documents
     * Call: $api->customers->customer->list()
     *
     * Response data, each item: A Prophet 21 customer with its terms and user-defined fields
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a customer column.
     *
     * GET https://customers.augur-api.com/customer
     * Contract: https://customers.augur-api.com/openapi.json#/paths/~1customer/get
     *
     * Query params ($params; `?` = optional):
     *   class5Id?: string — customer.class_5id (default: none)
     *   companyId?: string — customer.company_id (default: none)
     *   deleteFlag?: string — customer.delete_flag [Y|N] (default: none)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Offset number of results (Default: 0)
     *   orderBy?: string — Sort ordering: default (ordering|ASC)
     *   q?: string — Query string
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ContactsCustomersListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/lookup
     *
     * lookup Customer Summary
     * Call: $api->customers->customer->getLookup()
     *
     * Lookup Customer summary
     *
     * Response data, each item: One customer in a customer lookup
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a customer column.
     *
     * GET https://customers.augur-api.com/customer/lookup
     * Contract: https://customers.augur-api.com/openapi.json#/paths/~1customer~1lookup/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — limit (default 10)
     *   offset?: int — offset (default 0)
     *   orderBy?: string — Order By (Default: customer_id|ASC)
     *   q: string — search query
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CustomerLookupGetItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/address
     *
     * Lookup Customer Addresses
     * Call: $api->customers->customer->listAddress($customerId)
     *
     * Response data, each item: One shipping address in a customer's address lookup
     *
     * GET https://customers.augur-api.com/customer/{customerId}/address
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1address/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — limit (default 10)
     *   offset?: int — offset (default 0)
     *   q: string — search query
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CustomerAddressListItem (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listAddress(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/address',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/addresses
     *
     * List customer addresses
     * Call: $api->customers->customer->listAddresses($customerId)
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a customer_address column.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/addresses
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1addresses/get
     *
     * Query params ($params; `?` = optional):
     *   emailAddress?: string — Filter by email address
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: customer_address_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CustomerAddressesListItem (fields listed on the class)
     *
     * @param int $customerId Prophet 21 customer the address belongs to
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listAddresses(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/addresses',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /customer/{customerId}/addresses
     *
     * Create a new customer address
     * Call: $api->customers->customer->createAddresses($customerId, $data)
     *
     * Request body: Create a customer address; every field is optional
     *
     * POST https://customers.augur-api.com/customer/{customerId}/addresses
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1addresses/post
     *
     * Request body ($data): CustomerAddressesCreateBody (fields listed on the class)
     *
     * Response data type: CustomerAddressesListItem (fields listed on the class)
     *
     * @param int $customerId Prophet 21 customer the address belongs to
     * @param CustomerAddressesCreateBody $data
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /customer/{customerId}/addresses/{customerAddressUid}
     *
     * Soft-delete a customer address
     * Call: $api->customers->customer->deleteAddresses($customerId, $customerAddressUid)
     *
     * Errors:
     *   404: No address with this ID for this customer.
     *
     * DELETE https://customers.augur-api.com/customer/{customerId}/addresses/{customerAddressUid}
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1addresses~1{customerAddressUid}/delete
     *
     * Response data type: CustomerAddressesListItem (fields listed on the class)
     *
     * @param int $customerId Prophet 21 customer the address belongs to
     * @param int $customerAddressUid Customer address ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteAddresses(int $customerId, int $customerAddressUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{customerId}/addresses/{customerAddressUid}',
            ['customerId' => (string) $customerId, 'customerAddressUid' => (string) $customerAddressUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/addresses/{customerAddressUid}
     *
     * Get a customer address
     * Call: $api->customers->customer->getAddresses($customerId, $customerAddressUid)
     *
     * Get a customer address by UID
     *
     * Errors:
     *   404: No address with this ID for this customer.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/addresses/{customerAddressUid}
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1addresses~1{customerAddressUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CustomerAddressesListItem (fields listed on the class)
     *
     * @param int $customerId Prophet 21 customer the address belongs to
     * @param int $customerAddressUid Customer address ID
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /customer/{customerId}/addresses/{customerAddressUid}
     *
     * Update a customer address
     * Call: $api->customers->customer->updateAddresses($customerId, $customerAddressUid, $data)
     *
     * Request body: Partial update of a customer address; an absent field keeps its current value
     *
     * Errors:
     *   404: No address with this ID for this customer.
     *
     * PUT https://customers.augur-api.com/customer/{customerId}/addresses/{customerAddressUid}
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1addresses~1{customerAddressUid}/put
     *
     * Request body ($data): CustomerAddressesUpdateBody (fields listed on the class)
     *
     * Response data type: CustomerAddressesListItem (fields listed on the class)
     *
     * @param int $customerId Prophet 21 customer the address belongs to
     * @param int $customerAddressUid Customer address ID
     * @param CustomerAddressesUpdateBody $data
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/aging
     *
     * Customer Invoice Aging
     * Call: $api->customers->customer->listAging($customerId)
     *
     * Age outstanding customer invoice balances into current/30/60/90-day buckets
     *
     * Response data: A customer's outstanding invoice balances, aged into 30/60/90-day buckets.
     *
     * Errors:
     *   400: asOf is not a YYYY-MM-DD date, or orderBy is not column|ASC or column|DESC on an
     *       invoice_hdr column.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/aging
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1aging/get
     *
     * Query params ($params; `?` = optional):
     *   asOf?: string — age balances as of this date (YYYY-MM-DD); defaults to today
     *   limit?: int — limit (default 10)
     *   offset?: int — offset (default 0)
     *   orderBy?: string — orderBy (default invoice_date|ASC)
     *   shipToId?: int — invoice_hdr.ship_to_id
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CustomerAgingListData (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAging(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/aging',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/contacts
     *
     * Lookup Customer Contacts
     * Call: $api->customers->customer->listContacts($customerId)
     *
     * Response data, each item: One contact in a customer's contact lookup
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a contacts column.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/contacts
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1contacts/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — limit (default 10)
     *   offset?: int — offset (default 0)
     *   orderBy?: string — Order By (Default: email_address|ASC)
     *   q: string — search query
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CustomerContactsListItem (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listContacts(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/contacts',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /customer/{customerId}/contacts
     *
     * Create new contact for customer_id
     * Call: $api->customers->customer->createContacts($customerId, $data)
     *
     * Request body: A new Prophet 21 contact, passed to the P21 Entity API as sent
     *
     * POST https://customers.augur-api.com/customer/{customerId}/contacts
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1contacts/post
     *
     * Request body ($data): CustomerContactsCreateBody (fields listed on the class)
     *
     * Response data type: bool
     *
     * @param int $customerId customer.customer_id
     * @param CustomerContactsCreateBody $data
     * @return BaseResponse<bool>
     */
    public function createContacts(int $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/contacts',
            $data,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/doc
     *
     * get the customer document
     * Call: $api->customers->customer->listDoc($customerId)
     *
     * Response data: A Prophet 21 customer with its terms and user-defined fields
     *
     * Errors:
     *   404: No customer with this ID.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/doc
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1doc/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ContactsCustomersListItem (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /customer/{customerId}/doc
     * Call: $api->customers->customer->getDoc($customerId)
     *
     * @param int $customerId customer.customer_id
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
     * List Customer Invoices
     * Call: $api->customers->customer->listInvoices($customerId)
     *
     * Response data, each item: A Prophet 21 invoice with its lines
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an invoice_hdr column.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/invoices
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1invoices/get
     *
     * Query params ($params; `?` = optional):
     *   contactId?: string — filter by contact_id
     *   createdFrom?: string — filter by date_created from this date (YYYY-MM-DD); requires
     *       createdTo
     *   createdOn?: string — filter by date_created on a single day (YYYY-MM-DD)
     *   createdTo?: string — filter by date_created to this date (YYYY-MM-DD); requires createdFrom
     *   limit?: int — limit (default 10)
     *   offset?: int — offset (default 0)
     *   orderBy?: string — Sort as invoice_hdr column|ASC or column|DESC (default
     *       date_created|DESC)
     *   paidInFull?: string — filter by paid_in_full_flag (Y/N)
     *   q?: string — search query
     *   shipToId?: int — invoice_hdr.ship_to_id
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CustomerInvoicesListItem (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listInvoices(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/invoices',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/invoices/{invoiceNo}
     *
     * Get Customer Invoice
     * Call: $api->customers->customer->getInvoices($customerId, $invoiceNo)
     *
     * Response data: A Prophet 21 invoice with its lines
     *
     * Errors:
     *   404: No invoice with this number for this customer.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/invoices/{invoiceNo}
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1invoices~1{invoiceNo}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CustomerInvoicesListItem (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param int $invoiceNo invoice_hdr.invoice_no
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/orders
     *
     * List Customer Orders
     * Call: $api->customers->customer->listOrders($customerId)
     *
     * Errors:
     *   400: customerId is below 1, or orderBy is not column|ASC or column|DESC on an oe_hdr
     *       column.
     *   404: No customer with this customerId.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/orders
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1orders/get
     *
     * Query params ($params; `?` = optional):
     *   addressId?: int — oe_hdr.address_id
     *   cancelFlag?: string — cancel flag [N|Y|B] (default N; B = both)
     *   contactId?: string — filter by contact_id
     *   createdFrom?: string — filter by date_created from this date (YYYY-MM-DD); requires
     *       createdTo
     *   createdOn?: string — filter by date_created on a single day (YYYY-MM-DD)
     *   createdTo?: string — filter by date_created to this date (YYYY-MM-DD); requires createdFrom
     *   deleteFlag?: string — delete flag [N|Y|B] (default N; B = both)
     *   fullDocument?: string — Shape of each order [Y|N|L] (default Y = the full order document; N
     *       = the oe_hdr row; L = the oe_hdr row plus light lines, deleted and cancelled lines
     *       excluded)
     *   limit?: int — limit (default 10)
     *   offset?: int — offset (default 0)
     *   orderBy?: string — orderBy [date_created|DESC]
     *   q?: string — query
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type:
     * list<CustomerOrdersGetData|CustomerOrdersListDataItemOption2|CustomerOrdersListDataItemOption3>
     *   each item:
     *       CustomerOrdersGetData|CustomerOrdersListDataItemOption2|CustomerOrdersListDataItemOption3
     *     one of:
     *       CustomerOrdersGetData — One order, quote or RMA document: the `oe_hdr` header with its
     *           lines and pick tickets.
     *       CustomerOrdersListDataItemOption2
     *       CustomerOrdersListDataItemOption3
     *
     * @param int $customerId oe_hdr.customer_id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<CustomerOrdersGetData|CustomerOrdersListDataItemOption2|CustomerOrdersListDataItemOption3>>
     */
    public function listOrders(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/orders',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<list<CustomerOrdersGetData|CustomerOrdersListDataItemOption2|CustomerOrdersListDataItemOption3>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/orders/{orderNo}
     *
     * Get Customer Order
     * Call: $api->customers->customer->getOrders($customerId, $orderNo)
     *
     * Response data: One order, quote or RMA document: the `oe_hdr` header with its lines and pick
     * tickets.
     *
     * Errors:
     *   404: No order with this number for this customer.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/orders/{orderNo}
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1orders~1{orderNo}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CustomerOrdersGetData (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param string $orderNo oe_hdr.order_no
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getOrders(int $customerId, string $orderNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/orders/{orderNo}',
            $params,
            ['customerId' => (string) $customerId, 'orderNo' => (string) $orderNo],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/purchased-items
     *
     * List Customer Purchased Items
     * Call: $api->customers->customer->listPurchasedItems($customerId)
     *
     * Response data, each item: One item a customer has bought, with how often and how recently
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an items_x_customer column.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/purchased-items
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1purchased-items/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — limit (default 10)
     *   offset?: int — offset (default 0)
     *   orderBy?: string — orderBy [date_last_purchased|DESC]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CustomerPurchasedItemsListItem (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listPurchasedItems(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/purchased-items',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/quotes
     *
     * List Customer Quotes
     * Call: $api->customers->customer->listQuotes($customerId)
     *
     * Response data, each item: One order, quote or RMA document: the `oe_hdr` header with its
     * lines and pick tickets.
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an oe_hdr column.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/quotes
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1quotes/get
     *
     * Query params ($params; `?` = optional):
     *   addressId?: int — oe_hdr.address_id
     *   contactId?: string — filter by contact_id
     *   createdFrom?: string — filter by date_created from this date (YYYY-MM-DD); requires
     *       createdTo
     *   createdOn?: string — filter by date_created on a single day (YYYY-MM-DD)
     *   createdTo?: string — filter by date_created to this date (YYYY-MM-DD); requires createdFrom
     *   limit?: int — limit (default 10)
     *   offset?: int — offset (default 0)
     *   orderBy?: string — orderBy [date_created|DESC]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CustomerOrdersGetData (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listQuotes(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/quotes',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/quotes/{quoteNo}
     *
     * Get Customer Quote
     * Call: $api->customers->customer->getQuotes($customerId, $quoteNo)
     *
     * Response data: One order, quote or RMA document: the `oe_hdr` header with its lines and pick
     * tickets.
     *
     * Errors:
     *   404: No quote with this number for this customer.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/quotes/{quoteNo}
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1quotes~1{quoteNo}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CustomerOrdersGetData (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param int $quoteNo quotes.quote_no
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/rmas
     *
     * List Customer RMAs
     * Call: $api->customers->customer->listRmas($customerId)
     *
     * Response data, each item: One order, quote or RMA document: the `oe_hdr` header with its
     * lines and pick tickets.
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an oe_hdr column.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/rmas
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1rmas/get
     *
     * Query params ($params; `?` = optional):
     *   createdFrom?: string — filter by date_created from this date (YYYY-MM-DD); requires
     *       createdTo
     *   createdOn?: string — filter by date_created on a single day (YYYY-MM-DD)
     *   createdTo?: string — filter by date_created to this date (YYYY-MM-DD); requires createdFrom
     *   limit?: int — limit (default 10)
     *   offset?: int — offset (default 0)
     *   orderBy?: string — orderBy [date_created|DESC]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CustomerOrdersGetData (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listRmas(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/rmas',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/rmas/{rmaNo}
     *
     * Get Customer RMA
     * Call: $api->customers->customer->getRmas($customerId, $rmaNo)
     *
     * Response data: One order, quote or RMA document: the `oe_hdr` header with its lines and pick
     * tickets.
     *
     * Errors:
     *   404: No RMA with this number for this customer.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/rmas/{rmaNo}
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1rmas~1{rmaNo}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CustomerOrdersGetData (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param int $rmaNo rmas.rma_no
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getRmas(int $customerId, int $rmaNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/rmas/{rmaNo}',
            $params,
            ['customerId' => (string) $customerId, 'rmaNo' => (string) $rmaNo],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/sales-usage
     *
     * Customer Sales Usage Report
     * Call: $api->customers->customer->listSalesUsage($customerId)
     *
     * List per-item, per-period sales usage for one customer, folded from invoiced history
     *
     * Response data: Per-customer, per-item consumption folded from invoiced sales history.
     *
     * Errors:
     *   400: invoicedFrom or invoicedTo is not a YYYY-MM-DD date, invoicedFrom is later than
     *       invoicedTo, totalBy is not week, month or year, or orderBy is not item_id or item_desc
     *       with |ASC or |DESC.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/sales-usage
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1sales-usage/get
     *
     * Query params ($params; `?` = optional):
     *   invoicedFrom?: string — filter by invoice_date from this date (YYYY-MM-DD); defaults to 30
     *       days ago
     *   invoicedTo?: string — filter by invoice_date to this date (YYYY-MM-DD); defaults to today
     *   limit?: int — limit (default 10), applied to the folded item list
     *   offset?: int — offset (default 0), applied to the folded item list
     *   orderBy?: string — orderBy (default item_id|ASC)
     *   q?: string — search query
     *   shipToId?: int — invoice_hdr.ship_to_id
     *   supplierId?: int — invoice_line.supplier_id
     *   totalBy?: string — bucket granularity: week (default), month, or year
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CustomerSalesUsageListData (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listSalesUsage(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/sales-usage',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/ship-to
     *
     * List Customer Ship-To Addresses
     * Call: $api->customers->customer->listShipTo($customerId)
     *
     * Response data, each item: One ship-to doc, backing an entry of `GET
     * /api/customer/{customerId}/ship-to`.
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a ship_to column.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/ship-to
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1ship-to/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — limit (default 10)
     *   offset?: int — offset (default 0)
     *   orderBy?: string — orderBy [date_created|DESC]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CustomerShipToListItem (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listShipTo(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/ship-to',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /customer/{customerId}/ship-to
     *
     * Create new ship_to for customer_id
     * Call: $api->customers->customer->createShipTo($customerId, $data)
     *
     * Request body: A new Prophet 21 ship-to, passed to the P21 Entity API as sent
     *
     * POST https://customers.augur-api.com/customer/{customerId}/ship-to
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1ship-to/post
     *
     * Request body ($data): CustomerShipToCreateBody (fields listed on the class)
     *
     * Response data type: bool
     *
     * @param int $customerId customer.customer_id
     * @param CustomerShipToCreateBody $data
     * @return BaseResponse<bool>
     */
    public function createShipTo(int $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/ship-to',
            $data,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/ship-to/lookup
     *
     * Lookup Customer ShipTo
     * Call: $api->customers->customer->getShipToLookup($customerId)
     *
     * Response data, each item: One ship-to in a customer's ship-to lookup
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an address column.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/ship-to/lookup
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1ship-to~1lookup/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — limit (default 10)
     *   offset?: int — offset (default 0)
     *   orderBy?: string — Order By (Default: id|ASC)
     *   q?: string — search query (matches address name or mail_address1)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CustomerShipToLookupGetItem (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function getShipToLookup(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/ship-to/lookup',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/ship-to/{shipToId}/freight-codes
     *
     * Get Customer Ship-To Freight Code
     * Call: $api->customers->customer->listShipToFreightCodes($customerId, $shipToId)
     *
     * Get the freight code assigned to a customer ship-to
     *
     * Errors:
     *   404: The ship-to does not belong to this customer, or has no freight code.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/ship-to/{shipToId}/freight-codes
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1ship-to~1{shipToId}~1freight-codes/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CustomerShipToFreightCodesListData (fields listed on the class)
     *
     * @param int $customerId customer.customer_id
     * @param int $shipToId ship_to.ship_to_id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listShipToFreightCodes(int $customerId, int $shipToId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/ship-to/{shipToId}/freight-codes',
            $params,
            ['customerId' => (string) $customerId, 'shipToId' => (string) $shipToId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/tags
     *
     * List customer tags
     * Call: $api->customers->customer->listTags($customerId)
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a customer_tags column.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/tags
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1tags/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: customer_tags_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CustomerTagsListItem (fields listed on the class)
     *
     * @param int $customerId Prophet 21 customer the tag belongs to
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listTags(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/tags',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /customer/{customerId}/tags
     *
     * Create a new customer tag
     * Call: $api->customers->customer->createTags($customerId, $data)
     *
     * Request body: Create a customer tag, or restore the one with the same tag text
     *
     * Errors:
     *   400: The tag is missing or blank.
     *
     * POST https://customers.augur-api.com/customer/{customerId}/tags
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1tags/post
     *
     * Request body ($data): CustomerTagsCreateBody (fields listed on the class)
     *
     * Response data type: CustomerTagsListItem (fields listed on the class)
     *
     * @param int $customerId Prophet 21 customer the tag belongs to
     * @param CustomerTagsCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createTags(int $customerId, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/tags',
            $data,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /customer/{customerId}/tags/{customerTagsUid}
     *
     * Soft-delete a customer tag
     * Call: $api->customers->customer->deleteTags($customerId, $customerTagsUid)
     *
     * Errors:
     *   404: No tag with this ID for this customer.
     *
     * DELETE https://customers.augur-api.com/customer/{customerId}/tags/{customerTagsUid}
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1tags~1{customerTagsUid}/delete
     *
     * Response data type: CustomerTagsListItem (fields listed on the class)
     *
     * @param int $customerId Prophet 21 customer the tag belongs to
     * @param int $customerTagsUid Customer tag ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteTags(int $customerId, int $customerTagsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{customerId}/tags/{customerTagsUid}',
            ['customerId' => (string) $customerId, 'customerTagsUid' => (string) $customerTagsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/tags/{customerTagsUid}
     *
     * Get a customer tag
     * Call: $api->customers->customer->getTags($customerId, $customerTagsUid)
     *
     * Get a customer tag by UID
     *
     * Errors:
     *   404: No tag with this ID for this customer.
     *
     * GET https://customers.augur-api.com/customer/{customerId}/tags/{customerTagsUid}
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1tags~1{customerTagsUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CustomerTagsListItem (fields listed on the class)
     *
     * @param int $customerId Prophet 21 customer the tag belongs to
     * @param int $customerTagsUid Customer tag ID
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /customer/{customerId}/tags/{customerTagsUid}
     *
     * Update a customer tag
     * Call: $api->customers->customer->updateTags($customerId, $customerTagsUid, $data)
     *
     * Request body: Partial update of a customer tag; an absent field keeps its current value
     *
     * Errors:
     *   404: No tag with this ID for this customer.
     *
     * PUT https://customers.augur-api.com/customer/{customerId}/tags/{customerTagsUid}
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1customer~1{customerId}~1tags~1{customerTagsUid}/put
     *
     * Request body ($data): CustomerTagsUpdateBody (fields listed on the class)
     *
     * Response data type: CustomerTagsListItem (fields listed on the class)
     *
     * @param int $customerId Prophet 21 customer the tag belongs to
     * @param int $customerTagsUid Customer tag ID
     * @param CustomerTagsUpdateBody $data
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
