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
     * @return BaseResponse<mixed>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/lookup
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/address
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listAddress(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/address',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/addresses
     *
     * Response data type: array
     *   customerAddressUid: int
     *   customerId: float
     *   address1: string|null
     *   address2: string|null
     *   address3: string|null
     *   city: string|null
     *   state: string|null
     *   postalCode: string|null
     *   country: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   emailAddress: string|null
     *   name: string|null
     *   phoneNumberMain: string|null
     *   phoneNumberMobile: string|null
     *
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
     * Response data type: object
     *   customerAddressUid: int
     *   customerId: float
     *   address1: string|null
     *   address2: string|null
     *   address3: string|null
     *   city: string|null
     *   state: string|null
     *   postalCode: string|null
     *   country: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   emailAddress: string|null
     *   name: string|null
     *   phoneNumberMain: string|null
     *   phoneNumberMobile: string|null
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /customer/{customerId}/addresses/{customerAddressUid}
     *
     * Response data type: object
     *   customerAddressUid: int
     *   customerId: float
     *   address1: string|null
     *   address2: string|null
     *   address3: string|null
     *   city: string|null
     *   state: string|null
     *   postalCode: string|null
     *   country: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   emailAddress: string|null
     *   name: string|null
     *   phoneNumberMain: string|null
     *   phoneNumberMobile: string|null
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/addresses/{customerAddressUid}
     *
     * Response data type: object
     *   customerAddressUid: int
     *   customerId: float
     *   address1: string|null
     *   address2: string|null
     *   address3: string|null
     *   city: string|null
     *   state: string|null
     *   postalCode: string|null
     *   country: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   emailAddress: string|null
     *   name: string|null
     *   phoneNumberMain: string|null
     *   phoneNumberMobile: string|null
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /customer/{customerId}/addresses/{customerAddressUid}
     *
     * Response data type: object
     *   customerAddressUid: int
     *   customerId: float
     *   address1: string|null
     *   address2: string|null
     *   address3: string|null
     *   city: string|null
     *   state: string|null
     *   postalCode: string|null
     *   country: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   emailAddress: string|null
     *   name: string|null
     *   phoneNumberMain: string|null
     *   phoneNumberMobile: string|null
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/aging
     *
     * Response data type: object
     *   customerId: string
     *   asOf: string
     *   bucketKeys: list<string>
     *   invoiceCount: int
     *   totalBalance: float
     *   totals: list<array{key: string, balance: float, invoices: int}>
     *   data: list<array{invoiceNo: string, orderNo: string|null, poNo: string|null, ship2Name: string|null, invoiceDate: string, totalAmount: float, amountPaid: float, balance: float, ageDays: int, bucket: string}>
     *
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
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listContacts(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/contacts',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /customer/{customerId}/contacts
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createContacts(int $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/contacts',
            $data,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listDoc(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/doc',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /customer/{customerId}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getDoc(int $customerId, array $params = []): BaseResponse
    {
        return $this->listDoc($customerId, $params);
    }

    /**
     * GET /customer/{customerId}/invoices
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listInvoices(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/invoices',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/invoices/{invoiceNo}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getInvoices(int $customerId, int $invoiceNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/invoices/{invoiceNo}',
            $params,
            ['customerId' => (string) $customerId, 'invoiceNo' => (string) $invoiceNo],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/orders
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listOrders(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/orders',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/orders/{orderNo}
     *
     * Response data type: object
     *   orderNo: string
     *   customerId: float
     *   customerName: string|null
     *   jobName: string|null
     *   orderDate: string|null
     *   requestedDate: string|null
     *   cancelFlag: string|null
     *   completed: string|null
     *   deleteFlag: string
     *   poNo: string|null
     *   ship2Name: string|null
     *   ship2Add1: string|null
     *   ship2Add2: string|null
     *   ship2Add3: string|null
     *   ship2City: string|null
     *   ship2State: string|null
     *   ship2Zip: string|null
     *   ship2Country: string|null
     *   ship2EmailAddress: string|null
     *   shipToPhone: string|null
     *   deliveryInstructions: string|null
     *   class1Id: string|null
     *   class2Id: string|null
     *   class3Id: string|null
     *   class4Id: string|null
     *   class5Id: string|null
     *   contactId: string|null
     *   webReferenceNo: string|null
     *   orderStatus: string
     *   taker: string|null
     *   contactFirstName: string|null
     *   contactLastName: string|null
     *   carrierId: float|null
     *   carrierName: string
     *   lines: list<array{invMastUid: int, cancelFlag: string|null, complete: string|null, deleteFlag: string, disposition: string|null, itemDesc: string|null, displayDesc: string|null, itemId: string, shortCode: string|null, lineNo: float, orderNo: string, originalQtyOrdered: float|null, qtyAllocated: float|null, qtyCanceled: float|null, qtyInvoiced: float|null, qtyOnPickTickets: float|null, qtyOrdered: float|null, unitOfMeasure: string|null, unitQuantity: float, unitSize: float, unitPrice: float|null, extendedPrice: float|null, oeLineUid: int, parentOeLineUid: int, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}>
     *   pickTickets: list<array{pickTicketNo: float, trackingNo: string|null, orderNo: string, invoiceNo: float|null, shipDate: string|null, printedFlag: string|null, printDate: string|null, instructions: string|null, carrierId: float|null, carrierName: string, lines: list<array{lineNumber: float, shipQuantity: float|null, qtyRequested: float|null, invMastUid: int, itemId: string, itemDesc: string|null, displayDesc: string|null, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}>}>
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/purchased-items
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listPurchasedItems(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/purchased-items',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/quotes
     *
     * Response data type: array
     *   orderNo: string
     *   customerId: float
     *   customerName: string|null
     *   jobName: string|null
     *   orderDate: string|null
     *   requestedDate: string|null
     *   cancelFlag: string|null
     *   completed: string|null
     *   deleteFlag: string
     *   poNo: string|null
     *   ship2Name: string|null
     *   ship2Add1: string|null
     *   ship2Add2: string|null
     *   ship2Add3: string|null
     *   ship2City: string|null
     *   ship2State: string|null
     *   ship2Zip: string|null
     *   ship2Country: string|null
     *   ship2EmailAddress: string|null
     *   shipToPhone: string|null
     *   deliveryInstructions: string|null
     *   class1Id: string|null
     *   class2Id: string|null
     *   class3Id: string|null
     *   class4Id: string|null
     *   class5Id: string|null
     *   contactId: string|null
     *   webReferenceNo: string|null
     *   orderStatus: string
     *   taker: string|null
     *   contactFirstName: string|null
     *   contactLastName: string|null
     *   carrierId: float|null
     *   carrierName: string
     *   lines: list<array{invMastUid: int, cancelFlag: string|null, complete: string|null, deleteFlag: string, disposition: string|null, itemDesc: string|null, displayDesc: string|null, itemId: string, shortCode: string|null, lineNo: float, orderNo: string, originalQtyOrdered: float|null, qtyAllocated: float|null, qtyCanceled: float|null, qtyInvoiced: float|null, qtyOnPickTickets: float|null, qtyOrdered: float|null, unitOfMeasure: string|null, unitQuantity: float, unitSize: float, unitPrice: float|null, extendedPrice: float|null, oeLineUid: int, parentOeLineUid: int, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}>
     *   pickTickets: list<array{pickTicketNo: float, trackingNo: string|null, orderNo: string, invoiceNo: float|null, shipDate: string|null, printedFlag: string|null, printDate: string|null, instructions: string|null, carrierId: float|null, carrierName: string, lines: list<array{lineNumber: float, shipQuantity: float|null, qtyRequested: float|null, invMastUid: int, itemId: string, itemDesc: string|null, displayDesc: string|null, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}>}>
     *
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
     * Response data type: object
     *   orderNo: string
     *   customerId: float
     *   customerName: string|null
     *   jobName: string|null
     *   orderDate: string|null
     *   requestedDate: string|null
     *   cancelFlag: string|null
     *   completed: string|null
     *   deleteFlag: string
     *   poNo: string|null
     *   ship2Name: string|null
     *   ship2Add1: string|null
     *   ship2Add2: string|null
     *   ship2Add3: string|null
     *   ship2City: string|null
     *   ship2State: string|null
     *   ship2Zip: string|null
     *   ship2Country: string|null
     *   ship2EmailAddress: string|null
     *   shipToPhone: string|null
     *   deliveryInstructions: string|null
     *   class1Id: string|null
     *   class2Id: string|null
     *   class3Id: string|null
     *   class4Id: string|null
     *   class5Id: string|null
     *   contactId: string|null
     *   webReferenceNo: string|null
     *   orderStatus: string
     *   taker: string|null
     *   contactFirstName: string|null
     *   contactLastName: string|null
     *   carrierId: float|null
     *   carrierName: string
     *   lines: list<array{invMastUid: int, cancelFlag: string|null, complete: string|null, deleteFlag: string, disposition: string|null, itemDesc: string|null, displayDesc: string|null, itemId: string, shortCode: string|null, lineNo: float, orderNo: string, originalQtyOrdered: float|null, qtyAllocated: float|null, qtyCanceled: float|null, qtyInvoiced: float|null, qtyOnPickTickets: float|null, qtyOrdered: float|null, unitOfMeasure: string|null, unitQuantity: float, unitSize: float, unitPrice: float|null, extendedPrice: float|null, oeLineUid: int, parentOeLineUid: int, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}>
     *   pickTickets: list<array{pickTicketNo: float, trackingNo: string|null, orderNo: string, invoiceNo: float|null, shipDate: string|null, printedFlag: string|null, printDate: string|null, instructions: string|null, carrierId: float|null, carrierName: string, lines: list<array{lineNumber: float, shipQuantity: float|null, qtyRequested: float|null, invMastUid: int, itemId: string, itemDesc: string|null, displayDesc: string|null, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}>}>
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/rmas
     *
     * Response data type: array
     *   orderNo: string
     *   customerId: float
     *   customerName: string|null
     *   jobName: string|null
     *   orderDate: string|null
     *   requestedDate: string|null
     *   cancelFlag: string|null
     *   completed: string|null
     *   deleteFlag: string
     *   poNo: string|null
     *   ship2Name: string|null
     *   ship2Add1: string|null
     *   ship2Add2: string|null
     *   ship2Add3: string|null
     *   ship2City: string|null
     *   ship2State: string|null
     *   ship2Zip: string|null
     *   ship2Country: string|null
     *   ship2EmailAddress: string|null
     *   shipToPhone: string|null
     *   deliveryInstructions: string|null
     *   class1Id: string|null
     *   class2Id: string|null
     *   class3Id: string|null
     *   class4Id: string|null
     *   class5Id: string|null
     *   contactId: string|null
     *   webReferenceNo: string|null
     *   orderStatus: string
     *   taker: string|null
     *   contactFirstName: string|null
     *   contactLastName: string|null
     *   carrierId: float|null
     *   carrierName: string
     *   lines: list<array{invMastUid: int, cancelFlag: string|null, complete: string|null, deleteFlag: string, disposition: string|null, itemDesc: string|null, displayDesc: string|null, itemId: string, shortCode: string|null, lineNo: float, orderNo: string, originalQtyOrdered: float|null, qtyAllocated: float|null, qtyCanceled: float|null, qtyInvoiced: float|null, qtyOnPickTickets: float|null, qtyOrdered: float|null, unitOfMeasure: string|null, unitQuantity: float, unitSize: float, unitPrice: float|null, extendedPrice: float|null, oeLineUid: int, parentOeLineUid: int, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}>
     *   pickTickets: list<array{pickTicketNo: float, trackingNo: string|null, orderNo: string, invoiceNo: float|null, shipDate: string|null, printedFlag: string|null, printDate: string|null, instructions: string|null, carrierId: float|null, carrierName: string, lines: list<array{lineNumber: float, shipQuantity: float|null, qtyRequested: float|null, invMastUid: int, itemId: string, itemDesc: string|null, displayDesc: string|null, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}>}>
     *
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
     * Response data type: object
     *   orderNo: string
     *   customerId: float
     *   customerName: string|null
     *   jobName: string|null
     *   orderDate: string|null
     *   requestedDate: string|null
     *   cancelFlag: string|null
     *   completed: string|null
     *   deleteFlag: string
     *   poNo: string|null
     *   ship2Name: string|null
     *   ship2Add1: string|null
     *   ship2Add2: string|null
     *   ship2Add3: string|null
     *   ship2City: string|null
     *   ship2State: string|null
     *   ship2Zip: string|null
     *   ship2Country: string|null
     *   ship2EmailAddress: string|null
     *   shipToPhone: string|null
     *   deliveryInstructions: string|null
     *   class1Id: string|null
     *   class2Id: string|null
     *   class3Id: string|null
     *   class4Id: string|null
     *   class5Id: string|null
     *   contactId: string|null
     *   webReferenceNo: string|null
     *   orderStatus: string
     *   taker: string|null
     *   contactFirstName: string|null
     *   contactLastName: string|null
     *   carrierId: float|null
     *   carrierName: string
     *   lines: list<array{invMastUid: int, cancelFlag: string|null, complete: string|null, deleteFlag: string, disposition: string|null, itemDesc: string|null, displayDesc: string|null, itemId: string, shortCode: string|null, lineNo: float, orderNo: string, originalQtyOrdered: float|null, qtyAllocated: float|null, qtyCanceled: float|null, qtyInvoiced: float|null, qtyOnPickTickets: float|null, qtyOrdered: float|null, unitOfMeasure: string|null, unitQuantity: float, unitSize: float, unitPrice: float|null, extendedPrice: float|null, oeLineUid: int, parentOeLineUid: int, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}>
     *   pickTickets: list<array{pickTicketNo: float, trackingNo: string|null, orderNo: string, invoiceNo: float|null, shipDate: string|null, printedFlag: string|null, printDate: string|null, instructions: string|null, carrierId: float|null, carrierName: string, lines: list<array{lineNumber: float, shipQuantity: float|null, qtyRequested: float|null, invMastUid: int, itemId: string, itemDesc: string|null, displayDesc: string|null, trinityItemId: string|null, trinityItemDesc: string|null, agentItemId: string|null, agentItemDesc: string|null}>}>
     *
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
     * Response data type: object
     *   customerId: string
     *   invoicedFrom: string
     *   invoicedTo: string
     *   totalBy: string
     *   bucketKeys: list<string>
     *   invoiceCount: int
     *   linesFolded: int
     *   itemCount: int
     *   data: list<array{itemId: string, itemDesc: string, unitOfMeasure: string|null, salesUnitSize: float|null, pricingUnitSize: float|null, buckets: list<array{key: string, quantity: float, total: float, lines: int}>}>
     *
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
     * Response data type: array
     *   shipToId: float
     *   customerId: float
     *   companyId: string
     *   defaultBranch: string
     *   defaultCarrierId: float|null
     *   preferredLocationId: float|null
     *   deliveryInstructions: string|null
     *   shippingRouteUid: int|null
     *   routeCode: string|null
     *   routeDescription: string|null
     *   address: array{id: float, name: string, mailAddress1: string|null, mailAddress2: string|null, mailAddress3: string|null, mailCity: string|null, mailState: string|null, mailPostalCode: string|null, mailCountry: string|null, physAddress1: string|null, physAddress2: string|null, physAddress3: string|null, physCity: string|null, physState: string|null, physPostalCode: string|null, physCountry: string|null, class5Id: string|null, centralPhoneNumber: string|null, upsCode: string|null}
     *
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
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createShipTo(int $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/ship-to',
            $data,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/ship-to/lookup
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getShipToLookup(int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/ship-to/lookup',
            $params,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/ship-to/{shipToId}/freight-codes
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listShipToFreightCodes(int $customerId, int $shipToId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{customerId}/ship-to/{shipToId}/freight-codes',
            $params,
            ['customerId' => (string) $customerId, 'shipToId' => (string) $shipToId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/tags
     *
     * Response data type: array
     *   customerTagsUid: int
     *   customerId: float
     *   tag: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
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
     * Response data type: object
     *   customerTagsUid: int
     *   customerId: float
     *   tag: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /customer/{customerId}/tags/{customerTagsUid}
     *
     * Response data type: object
     *   customerTagsUid: int
     *   customerId: float
     *   tag: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /customer/{customerId}/tags/{customerTagsUid}
     *
     * Response data type: object
     *   customerTagsUid: int
     *   customerId: float
     *   tag: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /customer/{customerId}/tags/{customerTagsUid}
     *
     * Response data type: object
     *   customerTagsUid: int
     *   customerId: float
     *   tag: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
