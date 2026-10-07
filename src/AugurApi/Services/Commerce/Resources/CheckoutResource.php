<?php

declare(strict_types=1);

namespace AugurApi\Services\Commerce\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * checkout resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://commerce.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://commerce.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://commerce.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py commerce
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * CheckoutCreateData: A new checkout with the order payload it stored
 * Returned by: $api->commerce->checkout->create($data)
 *   checkoutUid: int — Checkout ID
 *   checkoutUuid: string — Checkout UUID
 *   statusCd: int — Status code (704 = Active)
 *   body: array<string, mixed>|array{} — The order payload as stored, echoed back; an empty string
 *       when the posted body was empty ([] when empty)
 *
 * CheckoutCreateBody: An order to check out; stored exactly as sent and converted to a P21 import
 * when processed
 * Request body of: $api->commerce->checkout->create($data)
 *   oeHdr?: array<string, mixed>|array{}|null — Order header fields (customerId, shipTo*,
 *       customerPoNo, shippingEstimate, userEmail, userId, ...) ([] when empty)
 *   header?: array<string, mixed>|array{}|null — Alias of oeHdr ([] when empty)
 *   oeLine?: list<array<string, mixed>>|null — Order lines (itemId, invMastUid, unitQuantity or
 *       qty, unitOfMeasure or uom, unitPrice, manualPriceOverride, willCall, lineNote or note, key,
 *       ...)
 *   lines?: list<array<string, mixed>>|null — Alias of oeLine
 *   notes?: CheckoutCreateBodyNotes|null — Order-level note
 *   oeHdrNotepad?: mixed — Order notepad entries, passed through to the import as sent
 *   headerNote?: mixed — Alias of oeHdrNotepad
 *   oeHdrSalesrep?: mixed — Order salesreps, passed through to the import as sent
 *   salesRep?: mixed — Alias of oeHdrSalesrep
 *   arPaymentDetails?: mixed — AR payment details, passed through to the import as sent
 *   creditcardPaymentDetails?: mixed — Credit card payment details, passed through to the import as
 *       sent
 *   web?: array<string, mixed>|array{}|null — Web shopper fields for the import's oe_hdr_web (built
 *       from oeHdr userEmail/userId when omitted) ([] when empty)
 *   payments?: array<string, mixed>|array{}|null — Payment fields (paymentAccountId, processor,
 *       lastFour, ...) ([] when empty)
 *
 * CheckoutCreateBodyNotes: Order-level note
 * Field `notes` of CheckoutCreateBody
 *   note?: string|null — Note text
 *   topic?: string|null — Note topic (Import Note when omitted)
 *
 * CheckoutGetData:
 * Returned by: $api->commerce->checkout->get($checkoutUid)
 *   checkoutUid: int — Checkout ID
 *   checkoutUuid: string — Checkout UUID (max 255 chars)
 *   statusCd: int — Status code (704 = Active, 1267 = Pending after validate, 2556 = Process
 *       Import, 1185 = Import Complete, 1183 = Import Error)
 *   checkoutType: string|null — Checkout type (prophet21) (max 255 chars)
 *   dateCreated: string — Date the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — Date the record was last modified (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   properties: string|null — Checkout properties as a JSON string (max 16777215 chars)
 *   checkoutProcessor: string|null — Checkout processor name; not set by the commerce service today
 *       (max 255 chars)
 *   jsonData: string|null — Storefront checkout payload as a JSON string, stored verbatim (max
 *       16777215 chars)
 *   sourceName: string|null — Source system name for a checkout brought in from another service
 *       (legacy) (max 255 chars)
 *   sourceId: string|null — Record ID in the source system (max 255 chars)
 *   cartHdrUid: int — Cart ID (cart_hdr_uid) the checkout came from
 *
 * CheckoutActivateUpdateData: A checkout's id and status after a status change
 * Returned by: $api->commerce->checkout->updateActivate($checkoutUid, $data)
 * Returned by: $api->commerce->checkout->updateValidate($checkoutUid, $data)
 *   checkoutUid: int — Checkout ID
 *   checkoutUuid: string — Checkout UUID
 *   statusCd: int — Status code (704 = Active, 1267 = Pending after validate, 2556 = Process
 *       Import, 1185 = Import Complete, 1183 = Import Error)
 *
 * CheckoutDocListData: A checkout row with its properties column decoded from JSON
 * Returned by: $api->commerce->checkout->listDoc($checkoutUid)
 *   checkoutUid: int — Checkout ID
 *   checkoutUuid: string — Checkout UUID
 *   statusCd: int — Status code (704 = Active, 1267 = Pending after validate, 2556 = Process
 *       Import, 1185 = Import Complete, 1183 = Import Error)
 *   checkoutType: string|null — Checkout type
 *   dateCreated: string — Date created (Y-m-d H:i:s)
 *   dateLastModified: string — Date last modified (Y-m-d H:i:s)
 *   properties: array<string, mixed>|array{}|null — Checkout properties decoded from JSON; null
 *       when none are stored ([] when empty)
 *   checkoutProcessor: string|null — Payment processor that handled the checkout
 *   jsonData: string|null — The order payload as the stored JSON string
 *   sourceName: string|null — System that created the checkout
 *   sourceId: string|null — Record ID in the source system
 *   cartHdrUid: int — Cart the checkout was created from
 *
 * @phpstan-type CheckoutCreateData array{checkoutUid: int, checkoutUuid: string, statusCd: int, body: array<string, mixed>|array{}}
 * @phpstan-type CheckoutCreateBody array{oeHdr?: array<string, mixed>|array{}|null, header?: array<string, mixed>|array{}|null, oeLine?: list<array<string, mixed>>|null, lines?: list<array<string, mixed>>|null, notes?: CheckoutCreateBodyNotes|null, oeHdrNotepad?: mixed, headerNote?: mixed, oeHdrSalesrep?: mixed, salesRep?: mixed, arPaymentDetails?: mixed, creditcardPaymentDetails?: mixed, web?: array<string, mixed>|array{}|null, payments?: array<string, mixed>|array{}|null}
 * @phpstan-type CheckoutCreateBodyNotes array{note?: string|null, topic?: string|null}
 * @phpstan-type CheckoutGetData array{checkoutUid: int, checkoutUuid: string, statusCd: int, checkoutType: string|null, dateCreated: string, dateLastModified: string, properties: string|null, checkoutProcessor: string|null, jsonData: string|null, sourceName: string|null, sourceId: string|null, cartHdrUid: int}
 * @phpstan-type CheckoutActivateUpdateData array{checkoutUid: int, checkoutUuid: string, statusCd: int}
 * @phpstan-type CheckoutDocListData array{checkoutUid: int, checkoutUuid: string, statusCd: int, checkoutType: string|null, dateCreated: string, dateLastModified: string, properties: array<string, mixed>|array{}|null, checkoutProcessor: string|null, jsonData: string|null, sourceName: string|null, sourceId: string|null, cartHdrUid: int}
 */
final class CheckoutResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /checkout
     *
     * Create new Checkout
     * Call: $api->commerce->checkout->create($data)
     *
     * Request body: An order to check out; stored exactly as sent and converted to a P21 import
     * when processed
     * Response data: A new checkout with the order payload it stored
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://commerce.augur-api.com/checkout
     * Contract: https://commerce.augur-api.com/openapi.json#/paths/~1checkout/post
     *
     * Request body ($data): CheckoutCreateBody (fields listed on the class)
     *
     * Response data type: CheckoutCreateData (fields listed on the class)
     *
     * @param CheckoutCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /checkout/{checkoutUid}
     *
     * Get Checkout Details
     * Call: $api->commerce->checkout->get($checkoutUid)
     *
     * Errors:
     *   404: Checkout not found.
     *
     * GET https://commerce.augur-api.com/checkout/{checkoutUid}
     * Contract: https://commerce.augur-api.com/openapi.json#/paths/~1checkout~1{checkoutUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CheckoutGetData (fields listed on the class)
     *
     * @param int $checkoutUid Checkout ID (checkout_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $checkoutUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{checkoutUid}',
            $params,
            ['checkoutUid' => (string) $checkoutUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /checkout/{checkoutUid}/activate
     *
     * Activate Checkout
     * Call: $api->commerce->checkout->updateActivate($checkoutUid, $data)
     *
     * Response data: A checkout's id and status after a status change
     * No request body: the API ignores any body sent.
     *
     * Errors:
     *   404: No record with this ID.
     *
     * PUT https://commerce.augur-api.com/checkout/{checkoutUid}/activate
     * Contract:
     * https://commerce.augur-api.com/openapi.json#/paths/~1checkout~1{checkoutUid}~1activate/put
     *
     * Response data type: CheckoutActivateUpdateData (fields listed on the class)
     *
     * @param int $checkoutUid Checkout ID (checkout_uid)
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateActivate(int $checkoutUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{checkoutUid}/activate',
            $data,
            ['checkoutUid' => (string) $checkoutUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /checkout/{checkoutUid}/doc
     *
     * Get Checkout Doc
     * Call: $api->commerce->checkout->listDoc($checkoutUid)
     *
     * Response data: A checkout row with its properties column decoded from JSON
     *
     * Errors:
     *   404: Checkout not found.
     *
     * GET https://commerce.augur-api.com/checkout/{checkoutUid}/doc
     * Contract:
     * https://commerce.augur-api.com/openapi.json#/paths/~1checkout~1{checkoutUid}~1doc/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CheckoutDocListData (fields listed on the class)
     *
     * @param int $checkoutUid Checkout ID (checkout_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDoc(int $checkoutUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{checkoutUid}/doc',
            $params,
            ['checkoutUid' => (string) $checkoutUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /checkout/{checkoutUid}/doc
     * Call: $api->commerce->checkout->getDoc($checkoutUid)
     *
     * @param int $checkoutUid Checkout ID (checkout_uid)
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $checkoutUid, array $params = []): BaseResponse
    {
        return $this->listDoc($checkoutUid, $params);
    }

    /**
     * PUT /checkout/{checkoutUid}/validate
     *
     * Validate Checkout
     * Call: $api->commerce->checkout->updateValidate($checkoutUid, $data)
     *
     * Response data: A checkout's id and status after a status change
     * No request body: the API ignores any body sent.
     *
     * Errors:
     *   404: No record with this ID.
     *
     * PUT https://commerce.augur-api.com/checkout/{checkoutUid}/validate
     * Contract:
     * https://commerce.augur-api.com/openapi.json#/paths/~1checkout~1{checkoutUid}~1validate/put
     *
     * Response data type: CheckoutActivateUpdateData (fields listed on the class)
     *
     * @param int $checkoutUid Checkout ID (checkout_uid)
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateValidate(int $checkoutUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{checkoutUid}/validate',
            $data,
            ['checkoutUid' => (string) $checkoutUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
