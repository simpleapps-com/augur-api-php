<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * contacts resource — generated from spec.
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
 * Returned by: $api->customers->contacts->listCustomers($id)
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
 * ContactsDocListData: A Prophet 21 contact with the address it belongs to
 * Returned by: $api->customers->contacts->listDoc($id)
 *   id: string — Prophet 21 contact ID
 *   firstName: string — First name
 *   lastName: string — Last name
 *   emailAddress: string|null — Email address
 *   directPhone: string|null — Direct phone number
 *   contactRoleUid: int|null — Contact role
 *   class1Id: string|null — Contact class 1
 *   class2Id: string|null — Contact class 2
 *   class3Id: string|null — Contact class 3
 *   class4Id: string|null — Contact class 4
 *   class5Id: string|null — Contact class 5
 *   addressId: float — Prophet 21 address the contact belongs to
 *   salesrepDefaultLocationId: float|null — Default location when the contact is a salesrep
 *   address: ContactsDocListDataAddress — The contact's address
 *
 * ContactsDocListDataAddress: The contact's address
 * Field `address` of ContactsDocListData
 *   id: float — Prophet 21 address ID
 *   physAddress1: string|null — Physical address line 1
 *   physAddress2: string|null — Physical address line 2
 *   physCity: string|null — Physical city
 *   physState: string|null — Physical state or province
 *   physPostalCode: string|null — Physical postal code
 *   physCountry: string|null — Physical country
 *   mailAddress1: string|null — Mailing address line 1
 *   mailAddress2: string|null — Mailing address line 2
 *   mailCity: string|null — Mailing city
 *   mailState: string|null — Mailing state or province
 *   mailPostalCode: string|null — Mailing postal code
 *   mailCountry: string|null — Mailing country
 *
 * ContactsWebAllowanceListData: How much a contact may still order on the web in the customer's
 * current allowance period
 * Returned by: $api->customers->contacts->listWebAllowance($id)
 *   webAllowance: float — Allowance left in the period; 0 when the customer has no allowance period
 *       (orderStartDate null)
 *   orderStartDate: string|null — Start of the allowance period (Y-m-d), from the customer's class
 *       5 fiscal-month code; null when it has none
 *   id: string — Prophet 21 contact ID
 *   customerId: float — Prophet 21 customer the contact orders for
 *
 * @phpstan-type ContactsCustomersListItem array{customerId: float, companyId: string, customerName: string|null, class1Id: string|null, class2Id: string|null, class3Id: string|null, class4Id: string|null, class5Id: string|null, webEnabledFlag: string, deleteFlag: string, salesRepId: string|null, poNoRequired: string, termsId: string|null, termsDesc: string, taxableFlag: string, statusCd: int, jobPricing: string, userDefined: array<string, mixed>|array{}}
 * @phpstan-type ContactsDocListData array{id: string, firstName: string, lastName: string, emailAddress: string|null, directPhone: string|null, contactRoleUid: int|null, class1Id: string|null, class2Id: string|null, class3Id: string|null, class4Id: string|null, class5Id: string|null, addressId: float, salesrepDefaultLocationId: float|null, address: ContactsDocListDataAddress}
 * @phpstan-type ContactsDocListDataAddress array{id: float, physAddress1: string|null, physAddress2: string|null, physCity: string|null, physState: string|null, physPostalCode: string|null, physCountry: string|null, mailAddress1: string|null, mailAddress2: string|null, mailCity: string|null, mailState: string|null, mailPostalCode: string|null, mailCountry: string|null}
 * @phpstan-type ContactsWebAllowanceListData array{webAllowance: float, orderStartDate: string|null, id: string, customerId: float}
 */
final class ContactsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /contacts/{id}/customers
     *
     * List Salesrep Customers
     * Call: $api->customers->contacts->listCustomers($id)
     *
     * Response data, each item: A Prophet 21 customer with its terms and user-defined fields
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a customer column.
     *
     * GET https://customers.augur-api.com/contacts/{id}/customers
     * Contract: https://customers.augur-api.com/openapi.json#/paths/~1contacts~1{id}~1customers/get
     *
     * Query params ($params; `?` = optional):
     *   class5Id?: string — customer.class_5id (default: none)
     *   limit?: int — limit (default 10)
     *   offset?: int — offset (default 0)
     *   orderBy?: string — Order By (Default: customer_id|ASC)
     *   q?: string — query
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ContactsCustomersListItem (fields listed on the class)
     *
     * @param int $id contacts.id
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listCustomers(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/customers',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /contacts/{id}/doc
     *
     * get the contact document
     * Call: $api->customers->contacts->listDoc($id)
     *
     * Response data: A Prophet 21 contact with the address it belongs to
     *
     * Errors:
     *   404: No contact with this ID.
     *
     * GET https://customers.augur-api.com/contacts/{id}/doc
     * Contract: https://customers.augur-api.com/openapi.json#/paths/~1contacts~1{id}~1doc/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ContactsDocListData (fields listed on the class)
     *
     * @param int $id contacts.id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDoc(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/doc',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /contacts/{id}/doc
     * Call: $api->customers->contacts->getDoc($id)
     *
     * @param int $id contacts.id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $id, array $params = []): BaseResponse
    {
        return $this->listDoc($id, $params);
    }

    /**
     * GET /contacts/{id}/web-allowance
     *
     * Get the web allowance for a contact_id (USCCO)
     * Call: $api->customers->contacts->listWebAllowance($id)
     *
     * Response data: How much a contact may still order on the web in the customer's current
     * allowance period
     *
     * Errors:
     *   404: No contact with this ID on any customer.
     *
     * GET https://customers.augur-api.com/contacts/{id}/web-allowance
     * Contract:
     * https://customers.augur-api.com/openapi.json#/paths/~1contacts~1{id}~1web-allowance/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ContactsWebAllowanceListData (fields listed on the class)
     *
     * @param int $id contacts.id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listWebAllowance(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/web-allowance',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
