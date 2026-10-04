<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * paypal resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://payments.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://payments.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://payments.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py payments
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * PaypalAuthorizationCaptureCreateDataOption1: PayPal Payments v2 capture; a field PayPal did not
 * send is absent
 * Returned by: $api->payments->paypal->createAuthorizationCapture($data)
 * Field `captures` of PaypalOrderCreateDataOption1PurchaseUnitsItemPayments
 *   id: string — Capture ID; pass it to refund
 *   status?: string|null — COMPLETED, DECLINED, PARTIALLY_REFUNDED, PENDING, REFUNDED or FAILED
 *   statusDetails?: array<string, mixed>|array{}|null — Reason the capture is in its status ([]
 *       when empty)
 *   amount?: PaypalAuthorizationCaptureCreateDataOption1Amount — Captured amount
 *   invoiceId?: string|null — Invoice identifier
 *   customId?: string|null — Merchant custom ID sent with the order
 *   networkTransactionReference?: array<string, mixed>|array{}|null — Card network transaction
 *       reference ([] when empty)
 *   sellerProtection?: array<string, mixed>|array{}|null — Seller protection eligibility ([] when
 *       empty)
 *   finalCapture?: bool|null — true when no further capture is possible on the authorization
 *   sellerReceivableBreakdown?: array<string, mixed>|array{}|null — Gross, PayPal fee and net
 *       amounts ([] when empty)
 *   disbursementMode?: string|null — INSTANT or DELAYED
 *   links?: list<PaypalAuthorizationCaptureCreateDataOption1LinksItem>|null — Related actions
 *       (refund, self, up)
 *     each item: PaypalAuthorizationCaptureCreateDataOption1LinksItem — HATEOAS link PayPal returns
 *         on a resource (approve, self, capture, void, refund, up)
 *   processorResponse?: array<string, mixed>|array{}|null — Card processor response codes ([] when
 *       empty)
 *   createTime?: string|null — When the capture was created (ISO 8601)
 *   updateTime?: string|null — When the capture was last updated (ISO 8601)
 *   supplementaryData?: array<string, mixed>|array{}|null — Related order and transaction
 *       identifiers ([] when empty)
 *   payee?: array<string, mixed>|array{}|null — Merchant receiving the payment ([] when empty)
 *
 * PaypalAuthorizationCaptureCreateDataOption1Amount: Captured amount
 * Field `amount` of PaypalAuthorizationCaptureCreateDataOption1
 * Field `amount` of PaypalAuthorizationVoidCreateDataOption1
 * Field `amount` of PaypalCaptureRefundCreateDataOption1
 * Field `amount` of PaypalOrderCreateDataOption1PurchaseUnitsItem
 *   currencyCode: string — ISO-4217 currency code
 *   value: string — Amount as a decimal string, e.g. "10.00"
 *   breakdown?: array<string, mixed>|array{}|null — Order amount breakdown (item total, shipping,
 *       tax, discount), when PayPal sends one ([] when empty)
 *
 * PaypalAuthorizationCaptureCreateDataOption1LinksItem: HATEOAS link PayPal returns on a resource
 * (approve, self, capture, void, refund, up)
 * Field `links` of PaypalAuthorizationCaptureCreateDataOption1
 * Field `links` of PaypalAuthorizationVoidCreateDataOption1
 * Field `links` of PaypalCaptureRefundCreateDataOption1
 * Field `links` of PaypalOrderCreateDataOption1
 *   href: string — Link URL
 *   rel: string — Link relation, e.g. approve, payer-action, self
 *   method?: string|null — HTTP method for the link
 *
 * PaypalAuthorizationCaptureCreateDataOption2: Outcome when PayPal sent no resource: success true
 * for an empty 2xx body (a void), false with PayPal's error otherwise
 * Returned by: $api->payments->paypal->createAuthorizationCapture($data)
 * Returned by: $api->payments->paypal->createAuthorizationVoid($data)
 * Returned by: $api->payments->paypal->createCaptureRefund($data)
 * Returned by: $api->payments->paypal->createOrder($data)
 * Returned by: $api->payments->paypal->listOrderReturn()
 * Returned by: $api->payments->paypal->createOrderAuthorize($data)
 * Returned by: $api->payments->paypal->createOrderCapture($data)
 * Returned by: $api->payments->paypal->listOrderDetails()
 * Returned by: $api->payments->paypal->listRefund()
 *   success: bool — true when PayPal accepted the request with an empty body
 *   statusMessage?: string|null — Failure message (PayPal's message, or why the call failed)
 *   name?: string|null — PayPal error name, e.g. UNPROCESSABLE_ENTITY; UNKNOWN when PayPal sent
 *       none
 *   details?: list<PaypalAuthorizationCaptureCreateDataOption2DetailsItem>|null — PayPal error
 *       issues; empty when PayPal sent none
 *     each item: PaypalAuthorizationCaptureCreateDataOption2DetailsItem — One issue in a PayPal
 *         error response; a field PayPal did not send is absent
 *   debugId?: string|null — PayPal debug ID to quote to PayPal support
 *   responseBody?: string|null — Raw PayPal response body when it was not JSON
 *   statusCode?: int|null — PayPal's HTTP status code; absent when PayPal could not be reached
 *
 * PaypalAuthorizationCaptureCreateDataOption2DetailsItem: One issue in a PayPal error response; a
 * field PayPal did not send is absent
 * Field `details` of PaypalAuthorizationCaptureCreateDataOption2
 *   issue?: string|null — PayPal issue code, e.g. ORDER_NOT_APPROVED
 *   description?: string|null — Issue description
 *   field?: string|null — Request field the issue is about
 *   value?: string|null — Value of that field
 *   location?: string|null — Where the field was: body, path or query
 *
 * PaypalAuthorizationCaptureCreateBody: Capture funds from a PayPal authorization, in USD
 * Request body of: $api->payments->paypal->createAuthorizationCapture($data)
 *   authorizationId: string|null — PayPal authorization ID to capture
 *   amount?: float|null — Amount to capture; defaults to the full authorization
 *   invoiceId?: string|null — Invoice identifier
 *   finalCapture?: bool|null — true (or the string "true" or "1") marks this the final capture for
 *       the authorization
 *   testMode?: bool|null — true (or the string "true" or "1") uses the PayPal sandbox; default live
 *
 * PaypalAuthorizationVoidCreateDataOption1: PayPal Payments v2 authorization; a field PayPal did
 * not send is absent
 * Returned by: $api->payments->paypal->createAuthorizationVoid($data)
 * Field `authorizations` of PaypalOrderCreateDataOption1PurchaseUnitsItemPayments
 *   id: string — Authorization ID; pass it to capture or void
 *   status?: string|null — CREATED, CAPTURED, DENIED, PARTIALLY_CAPTURED, VOIDED or PENDING
 *   statusDetails?: array<string, mixed>|array{}|null — Reason the authorization is in its status
 *       ([] when empty)
 *   amount?: PaypalAuthorizationCaptureCreateDataOption1Amount — Authorized amount
 *   invoiceId?: string|null — Invoice identifier sent with the order
 *   customId?: string|null — Merchant custom ID sent with the order
 *   networkTransactionReference?: array<string, mixed>|array{}|null — Card network transaction
 *       reference ([] when empty)
 *   sellerProtection?: array<string, mixed>|array{}|null — Seller protection eligibility ([] when
 *       empty)
 *   expirationTime?: string|null — When the authorization expires (ISO 8601)
 *   links?: list<PaypalAuthorizationCaptureCreateDataOption1LinksItem>|null — Related actions
 *       (capture, void, reauthorize, self, up)
 *     each item: PaypalAuthorizationCaptureCreateDataOption1LinksItem — HATEOAS link PayPal returns
 *         on a resource (approve, self, capture, void, refund, up)
 *   createTime?: string|null — When the authorization was created (ISO 8601)
 *   updateTime?: string|null — When the authorization was last updated (ISO 8601)
 *   processorResponse?: array<string, mixed>|array{}|null — Card processor response codes ([] when
 *       empty)
 *   supplementaryData?: array<string, mixed>|array{}|null — Related order and transaction
 *       identifiers ([] when empty)
 *   payee?: array<string, mixed>|array{}|null — Merchant receiving the payment ([] when empty)
 *
 * PaypalAuthorizationVoidCreateBody: Void (cancel) a PayPal authorization
 * Request body of: $api->payments->paypal->createAuthorizationVoid($data)
 *   authorizationId: string|null — PayPal authorization ID to void
 *   testMode?: bool|null — true (or the string "true" or "1") uses the PayPal sandbox; default live
 *
 * PaypalCaptureRefundCreateDataOption1: PayPal Payments v2 refund; a field PayPal did not send is
 * absent
 * Returned by: $api->payments->paypal->createCaptureRefund($data)
 * Returned by: $api->payments->paypal->listRefund()
 * Field `refunds` of PaypalOrderCreateDataOption1PurchaseUnitsItemPayments
 *   id: string — Refund ID
 *   status?: string|null — CANCELLED, FAILED, PENDING or COMPLETED
 *   statusDetails?: array<string, mixed>|array{}|null — Reason the refund is in its status ([] when
 *       empty)
 *   amount?: PaypalAuthorizationCaptureCreateDataOption1Amount — Refunded amount
 *   invoiceId?: string|null — Invoice identifier
 *   customId?: string|null — Merchant custom ID
 *   acquirerReferenceNumber?: string|null — Card network acquirer reference number
 *   noteToPayer?: string|null — Note shown to the payer on the refund
 *   sellerPayableBreakdown?: array<string, mixed>|array{}|null — Gross, PayPal fee and net amounts
 *       of the refund ([] when empty)
 *   payer?: array<string, mixed>|array{}|null — Merchant that issued the refund ([] when empty)
 *   links?: list<PaypalAuthorizationCaptureCreateDataOption1LinksItem>|null — Related actions
 *       (self, up)
 *     each item: PaypalAuthorizationCaptureCreateDataOption1LinksItem — HATEOAS link PayPal returns
 *         on a resource (approve, self, capture, void, refund, up)
 *   createTime?: string|null — When the refund was created (ISO 8601)
 *   updateTime?: string|null — When the refund was last updated (ISO 8601)
 *
 * PaypalCaptureRefundCreateBody: Refund a captured PayPal payment, in USD
 * Request body of: $api->payments->paypal->createCaptureRefund($data)
 *   captureId: string|null — PayPal capture ID to refund
 *   amount?: float|null — Amount to refund; defaults to the full capture
 *   invoiceId?: string|null — Invoice identifier
 *   noteToPayer?: string|null — Note shown to the payer on the refund
 *   testMode?: bool|null — true (or the string "true" or "1") uses the PayPal sandbox; default live
 *
 * PaypalOrderCreateDataOption1: PayPal Orders v2 order; a field PayPal did not send is absent
 * Returned by: $api->payments->paypal->createOrder($data)
 * Returned by: $api->payments->paypal->listOrderReturn()
 * Returned by: $api->payments->paypal->createOrderAuthorize($data)
 * Returned by: $api->payments->paypal->createOrderCapture($data)
 * Returned by: $api->payments->paypal->listOrderDetails()
 *   id: string — PayPal order ID; the buyer approves it, then it is authorized or captured
 *   intent?: string|null — CAPTURE or AUTHORIZE
 *   status?: string|null — CREATED, SAVED, APPROVED, VOIDED, COMPLETED or PAYER_ACTION_REQUIRED
 *   paymentSource?: array<string, mixed>|array{}|null — Funding source the buyer used (paypal,
 *       card, venmo...) ([] when empty)
 *   purchaseUnits?: list<PaypalOrderCreateDataOption1PurchaseUnitsItem>|null — Purchase units, with
 *       the payments made against each
 *     each item: PaypalOrderCreateDataOption1PurchaseUnitsItem — One PayPal order purchase unit; a
 *         field PayPal did not send is absent
 *   payer?: PaypalOrderCreateDataOption1Payer — Buyer who approved the order
 *   createTime?: string|null — When the order was created (ISO 8601)
 *   updateTime?: string|null — When the order was last updated (ISO 8601)
 *   links?: list<PaypalAuthorizationCaptureCreateDataOption1LinksItem>|null — Related actions; rel
 *       approve or payer-action is the URL the buyer approves at
 *     each item: PaypalAuthorizationCaptureCreateDataOption1LinksItem — HATEOAS link PayPal returns
 *         on a resource (approve, self, capture, void, refund, up)
 *   processingInstruction?: string|null — Order processing instruction
 *
 * PaypalOrderCreateDataOption1PurchaseUnitsItem: One PayPal order purchase unit; a field PayPal did
 * not send is absent
 * Field `purchaseUnits` of PaypalOrderCreateDataOption1
 *   referenceId?: string|null — Purchase unit reference ID
 *   amount?: PaypalAuthorizationCaptureCreateDataOption1Amount — Purchase unit amount
 *   payee?: array<string, mixed>|array{}|null — Merchant receiving the payment ([] when empty)
 *   paymentInstruction?: array<string, mixed>|array{}|null — Platform fees and disbursement
 *       instructions ([] when empty)
 *   description?: string|null — Purchase description
 *   customId?: string|null — Merchant custom ID
 *   invoiceId?: string|null — Invoice identifier sent at order creation
 *   softDescriptor?: string|null — Statement descriptor shown to the payer
 *   shipping?: array<string, mixed>|array{}|null — Shipping name, address and options ([] when
 *       empty)
 *   supplementaryData?: array<string, mixed>|array{}|null — Card and level 2/3 data ([] when empty)
 *   payments?: PaypalOrderCreateDataOption1PurchaseUnitsItemPayments — Authorizations, captures and
 *       refunds made against the unit
 *
 * PaypalOrderCreateDataOption1PurchaseUnitsItemPayments: Authorizations, captures and refunds made
 * against the unit
 * Field `payments` of PaypalOrderCreateDataOption1PurchaseUnitsItem
 *   authorizations?: list<PaypalAuthorizationVoidCreateDataOption1>|null — Authorizations; the ID
 *       is what capture and void take
 *     each item: PaypalAuthorizationVoidCreateDataOption1 — PayPal Payments v2 authorization; a
 *         field PayPal did not send is absent
 *   captures?: list<PaypalAuthorizationCaptureCreateDataOption1>|null — Captures; the ID is what
 *       refund takes
 *     each item: PaypalAuthorizationCaptureCreateDataOption1 — PayPal Payments v2 capture; a field
 *         PayPal did not send is absent
 *   refunds?: list<PaypalCaptureRefundCreateDataOption1>|null — Refunds
 *     each item: PaypalCaptureRefundCreateDataOption1 — PayPal Payments v2 refund; a field PayPal
 *         did not send is absent
 *
 * PaypalOrderCreateDataOption1Payer: Buyer who approved the order
 * Field `payer` of PaypalOrderCreateDataOption1
 *   name?: PaypalOrderCreateDataOption1PayerName — Payer name
 *   emailAddress?: string|null — Payer email address
 *   payerId?: string|null — PayPal payer ID (the PayerID PayPal appends to the return URL)
 *   phone?: array<string, mixed>|array{}|null — Payer phone ([] when empty)
 *   birthDate?: string|null — Payer birth date (YYYY-MM-DD)
 *   taxInfo?: array<string, mixed>|array{}|null — Payer tax ID ([] when empty)
 *   address?: PaypalOrderCreateDataOption1PayerAddress — Payer address
 *
 * PaypalOrderCreateDataOption1PayerName: Payer name
 * Field `name` of PaypalOrderCreateDataOption1Payer
 *   givenName?: string|null — Given (first) name
 *   surname?: string|null — Surname (last name)
 *
 * PaypalOrderCreateDataOption1PayerAddress: Payer address
 * Field `address` of PaypalOrderCreateDataOption1Payer
 *   addressLine1?: string|null — First address line
 *   addressLine2?: string|null — Second address line
 *   adminArea2?: string|null — City or locality
 *   adminArea1?: string|null — State, province or region
 *   postalCode?: string|null — Postal code
 *   countryCode?: string|null — ISO 3166-1 alpha-2 country code
 *
 * PaypalOrderCreateBody: Create a PayPal order
 * Request body of: $api->payments->paypal->createOrder($data)
 *   amount: float|null — Order amount in dollars
 *   intent: string|null — Order intent: CAPTURE or AUTHORIZE
 *   currencyCode?: string|null — ISO-4217 currency code; default USD
 *   invoiceId?: string|null — Invoice identifier
 *   returnUrl?: string|null — URL PayPal redirects the buyer to after approval
 *   cancelUrl?: string|null — URL PayPal redirects the buyer to on cancel
 *   testMode?: bool|null — true (or the string "true" or "1") uses the PayPal sandbox; default live
 *
 * PaypalOrderAuthorizeCreateBody: Authorize or capture an approved PayPal order
 * Request body of: $api->payments->paypal->createOrderAuthorize($data)
 * Request body of: $api->payments->paypal->createOrderCapture($data)
 *   orderId: string|null — PayPal order ID
 *   testMode?: bool|null — true (or the string "true" or "1") uses the PayPal sandbox; default live
 *
 * PaypalWebhookCreateData: Acknowledgement of a PayPal webhook whose signature PayPal verified
 * Returned by: $api->payments->paypal->createWebhook($data)
 *   verified: bool — Always true; a failed verification responds 400 instead
 *
 * PaypalWebhookCreateBody: PayPal webhook event envelope, as PayPal posts it (snake_case keys);
 * verified against PayPal as sent
 * Request body of: $api->payments->paypal->createWebhook($data)
 *   id?: string|null — Webhook event ID
 *   eventVersion?: string|null — Event version
 *   createTime?: string|null — When the event was created (ISO 8601)
 *   resourceType?: string|null — Type of the resource the event is about, e.g. capture or
 *       checkout-order
 *   resourceVersion?: string|null — Version of the resource
 *   eventType?: string|null — Event type, e.g. PAYMENT.CAPTURE.COMPLETED
 *   summary?: string|null — Human-readable event summary
 *   resource?: array<string, mixed>|array{}|null — The PayPal resource the event is about, as
 *       PayPal sent it ([] when empty)
 *
 * @phpstan-type PaypalAuthorizationCaptureCreateDataOption1 array{id: string, status?: string|null, statusDetails?: array<string, mixed>|array{}|null, amount?: PaypalAuthorizationCaptureCreateDataOption1Amount, invoiceId?: string|null, customId?: string|null, networkTransactionReference?: array<string, mixed>|array{}|null, sellerProtection?: array<string, mixed>|array{}|null, finalCapture?: bool|null, sellerReceivableBreakdown?: array<string, mixed>|array{}|null, disbursementMode?: string|null, links?: list<PaypalAuthorizationCaptureCreateDataOption1LinksItem>|null, processorResponse?: array<string, mixed>|array{}|null, createTime?: string|null, updateTime?: string|null, supplementaryData?: array<string, mixed>|array{}|null, payee?: array<string, mixed>|array{}|null}
 * @phpstan-type PaypalAuthorizationCaptureCreateDataOption1Amount array{currencyCode: string, value: string, breakdown?: array<string, mixed>|array{}|null}
 * @phpstan-type PaypalAuthorizationCaptureCreateDataOption1LinksItem array{href: string, rel: string, method?: string|null}
 * @phpstan-type PaypalAuthorizationCaptureCreateDataOption2 array{success: bool, statusMessage?: string|null, name?: string|null, details?: list<PaypalAuthorizationCaptureCreateDataOption2DetailsItem>|null, debugId?: string|null, responseBody?: string|null, statusCode?: int|null}
 * @phpstan-type PaypalAuthorizationCaptureCreateDataOption2DetailsItem array{issue?: string|null, description?: string|null, field?: string|null, value?: string|null, location?: string|null}
 * @phpstan-type PaypalAuthorizationCaptureCreateBody array{authorizationId: string|null, amount?: float|null, invoiceId?: string|null, finalCapture?: bool|null, testMode?: bool|null}
 * @phpstan-type PaypalAuthorizationVoidCreateDataOption1 array{id: string, status?: string|null, statusDetails?: array<string, mixed>|array{}|null, amount?: PaypalAuthorizationCaptureCreateDataOption1Amount, invoiceId?: string|null, customId?: string|null, networkTransactionReference?: array<string, mixed>|array{}|null, sellerProtection?: array<string, mixed>|array{}|null, expirationTime?: string|null, links?: list<PaypalAuthorizationCaptureCreateDataOption1LinksItem>|null, createTime?: string|null, updateTime?: string|null, processorResponse?: array<string, mixed>|array{}|null, supplementaryData?: array<string, mixed>|array{}|null, payee?: array<string, mixed>|array{}|null}
 * @phpstan-type PaypalAuthorizationVoidCreateBody array{authorizationId: string|null, testMode?: bool|null}
 * @phpstan-type PaypalCaptureRefundCreateDataOption1 array{id: string, status?: string|null, statusDetails?: array<string, mixed>|array{}|null, amount?: PaypalAuthorizationCaptureCreateDataOption1Amount, invoiceId?: string|null, customId?: string|null, acquirerReferenceNumber?: string|null, noteToPayer?: string|null, sellerPayableBreakdown?: array<string, mixed>|array{}|null, payer?: array<string, mixed>|array{}|null, links?: list<PaypalAuthorizationCaptureCreateDataOption1LinksItem>|null, createTime?: string|null, updateTime?: string|null}
 * @phpstan-type PaypalCaptureRefundCreateBody array{captureId: string|null, amount?: float|null, invoiceId?: string|null, noteToPayer?: string|null, testMode?: bool|null}
 * @phpstan-type PaypalOrderCreateDataOption1 array{id: string, intent?: string|null, status?: string|null, paymentSource?: array<string, mixed>|array{}|null, purchaseUnits?: list<PaypalOrderCreateDataOption1PurchaseUnitsItem>|null, payer?: PaypalOrderCreateDataOption1Payer, createTime?: string|null, updateTime?: string|null, links?: list<PaypalAuthorizationCaptureCreateDataOption1LinksItem>|null, processingInstruction?: string|null}
 * @phpstan-type PaypalOrderCreateDataOption1PurchaseUnitsItem array{referenceId?: string|null, amount?: PaypalAuthorizationCaptureCreateDataOption1Amount, payee?: array<string, mixed>|array{}|null, paymentInstruction?: array<string, mixed>|array{}|null, description?: string|null, customId?: string|null, invoiceId?: string|null, softDescriptor?: string|null, shipping?: array<string, mixed>|array{}|null, supplementaryData?: array<string, mixed>|array{}|null, payments?: PaypalOrderCreateDataOption1PurchaseUnitsItemPayments}
 * @phpstan-type PaypalOrderCreateDataOption1PurchaseUnitsItemPayments array{authorizations?: list<PaypalAuthorizationVoidCreateDataOption1>|null, captures?: list<PaypalAuthorizationCaptureCreateDataOption1>|null, refunds?: list<PaypalCaptureRefundCreateDataOption1>|null}
 * @phpstan-type PaypalOrderCreateDataOption1Payer array{name?: PaypalOrderCreateDataOption1PayerName, emailAddress?: string|null, payerId?: string|null, phone?: array<string, mixed>|array{}|null, birthDate?: string|null, taxInfo?: array<string, mixed>|array{}|null, address?: PaypalOrderCreateDataOption1PayerAddress}
 * @phpstan-type PaypalOrderCreateDataOption1PayerName array{givenName?: string|null, surname?: string|null}
 * @phpstan-type PaypalOrderCreateDataOption1PayerAddress array{addressLine1?: string|null, addressLine2?: string|null, adminArea2?: string|null, adminArea1?: string|null, postalCode?: string|null, countryCode?: string|null}
 * @phpstan-type PaypalOrderCreateBody array{amount: float|null, intent: string|null, currencyCode?: string|null, invoiceId?: string|null, returnUrl?: string|null, cancelUrl?: string|null, testMode?: bool|null}
 * @phpstan-type PaypalOrderAuthorizeCreateBody array{orderId: string|null, testMode?: bool|null}
 * @phpstan-type PaypalWebhookCreateData array{verified: bool}
 * @phpstan-type PaypalWebhookCreateBody array{id?: string|null, eventVersion?: string|null, createTime?: string|null, resourceType?: string|null, resourceVersion?: string|null, eventType?: string|null, summary?: string|null, resource?: array<string, mixed>|array{}|null}
 */
final class PaypalResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /paypal/authorization/capture
     *
     * Capture funds from a PayPal authorization.
     * Call: $api->payments->paypal->createAuthorizationCapture($data)
     *
     * Request body: Capture funds from a PayPal authorization, in USD
     *
     * Errors:
     *   400: Invalid request body. Or Missing required field: authorizationId.
     *   502: PayPal could not issue an access token: credentials are not configured for the site,
     *       or the PayPal OAuth call failed.
     *
     * POST https://payments.augur-api.com/paypal/authorization/capture
     * Contract:
     * https://payments.augur-api.com/openapi.json#/paths/~1paypal~1authorization~1capture/post
     *
     * Request body ($data): PaypalAuthorizationCaptureCreateBody (fields listed on the class)
     *
     * Response data type:
     * PaypalAuthorizationCaptureCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
     *   one of:
     *     PaypalAuthorizationCaptureCreateDataOption1 — PayPal Payments v2 capture; a field PayPal
     *         did not send is absent
     *     PaypalAuthorizationCaptureCreateDataOption2 — Outcome when PayPal sent no resource:
     *         success true for an empty 2xx body (a void), false with PayPal's error otherwise
     *
     * @param PaypalAuthorizationCaptureCreateBody $data
     * @return BaseResponse<PaypalAuthorizationCaptureCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2>
     */
    public function createAuthorizationCapture(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/authorization/capture', $data);

        /** @var BaseResponse<PaypalAuthorizationCaptureCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paypal/authorization/void
     *
     * Void a PayPal authorization.
     * Call: $api->payments->paypal->createAuthorizationVoid($data)
     *
     * Void (cancel) a PayPal authorization.
     *
     * Request body: Void (cancel) a PayPal authorization
     *
     * Errors:
     *   400: Invalid request body. Or Missing required field: authorizationId.
     *   502: PayPal could not issue an access token: credentials are not configured for the site,
     *       or the PayPal OAuth call failed.
     *
     * POST https://payments.augur-api.com/paypal/authorization/void
     * Contract:
     * https://payments.augur-api.com/openapi.json#/paths/~1paypal~1authorization~1void/post
     *
     * Request body ($data): PaypalAuthorizationVoidCreateBody (fields listed on the class)
     *
     * Response data type:
     * PaypalAuthorizationVoidCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
     *   one of:
     *     PaypalAuthorizationVoidCreateDataOption1 — PayPal Payments v2 authorization; a field
     *         PayPal did not send is absent
     *     PaypalAuthorizationCaptureCreateDataOption2 — Outcome when PayPal sent no resource:
     *         success true for an empty 2xx body (a void), false with PayPal's error otherwise
     *
     * @param PaypalAuthorizationVoidCreateBody $data
     * @return BaseResponse<PaypalAuthorizationVoidCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2>
     */
    public function createAuthorizationVoid(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/authorization/void', $data);

        /** @var BaseResponse<PaypalAuthorizationVoidCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paypal/capture/refund
     *
     * Refund a captured PayPal payment.
     * Call: $api->payments->paypal->createCaptureRefund($data)
     *
     * Request body: Refund a captured PayPal payment, in USD
     *
     * Errors:
     *   400: Invalid request body. Or Missing required field: captureId.
     *   502: PayPal could not issue an access token: credentials are not configured for the site,
     *       or the PayPal OAuth call failed.
     *
     * POST https://payments.augur-api.com/paypal/capture/refund
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1paypal~1capture~1refund/post
     *
     * Request body ($data): PaypalCaptureRefundCreateBody (fields listed on the class)
     *
     * Response data type:
     * PaypalCaptureRefundCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
     *   one of:
     *     PaypalCaptureRefundCreateDataOption1 — PayPal Payments v2 refund; a field PayPal did not
     *         send is absent
     *     PaypalAuthorizationCaptureCreateDataOption2 — Outcome when PayPal sent no resource:
     *         success true for an empty 2xx body (a void), false with PayPal's error otherwise
     *
     * @param PaypalCaptureRefundCreateBody $data
     * @return BaseResponse<PaypalCaptureRefundCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2>
     */
    public function createCaptureRefund(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/capture/refund', $data);

        /** @var BaseResponse<PaypalCaptureRefundCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paypal/order
     *
     * Create a PayPal order.
     * Call: $api->payments->paypal->createOrder($data)
     *
     * Create a PayPal order with intent CAPTURE or AUTHORIZE.
     *
     * Request body: Create a PayPal order
     *
     * Errors:
     *   400: Invalid request body. Or Missing required field: amount. Or Missing required field:
     *       intent.
     *   502: PayPal could not issue an access token: credentials are not configured for the site,
     *       or the PayPal OAuth call failed.
     *
     * POST https://payments.augur-api.com/paypal/order
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1paypal~1order/post
     *
     * Request body ($data): PaypalOrderCreateBody (fields listed on the class)
     *
     * Response data type: PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
     *   one of:
     *     PaypalOrderCreateDataOption1 — PayPal Orders v2 order; a field PayPal did not send is
     *         absent
     *     PaypalAuthorizationCaptureCreateDataOption2 — Outcome when PayPal sent no resource:
     *         success true for an empty 2xx body (a void), false with PayPal's error otherwise
     *
     * @param PaypalOrderCreateBody $data
     * @return BaseResponse<PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2>
     */
    public function createOrder(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/order', $data);

        /** @var BaseResponse<PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /paypal/order-return
     *
     * Handle the PayPal approval redirect.
     * Call: $api->payments->paypal->listOrderReturn()
     *
     * Handle the PayPal approval redirect and auto-authorize the order.
     *
     * Auth: bearer token; spec scopes: none listed (most endpoints list `public`)
     *
     * Errors:
     *   400: Missing required query parameter: site_id and token are required.
     *   502: PayPal could not issue an access token: credentials are not configured for the site,
     *       or the PayPal OAuth call failed.
     *
     * GET https://payments.augur-api.com/paypal/order-return
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1paypal~1order-return/get
     *
     * Query params ($params; `?` = optional):
     *   siteId: string — siteId, passed in the query because PayPal redirects the browser here via
     *       a GET and cannot send the x-site-id header
     *   testMode?: string — "true" or "1" uses the PayPal sandbox; any other value or none uses
     *       live; must match the mode the order was created in
     *   token: string — PayPal order ID (PayPal appends token to the return URL)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
     *   one of:
     *     PaypalOrderCreateDataOption1 — PayPal Orders v2 order; a field PayPal did not send is
     *         absent
     *     PaypalAuthorizationCaptureCreateDataOption2 — Outcome when PayPal sent no resource:
     *         success true for an empty 2xx body (a void), false with PayPal's error otherwise
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2>
     */
    public function listOrderReturn(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/order-return', $params);

        /** @var BaseResponse<PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paypal/order/authorize
     *
     * Authorize an approved PayPal order.
     * Call: $api->payments->paypal->createOrderAuthorize($data)
     *
     * Authorize an approved PayPal order, creating an authorization.
     *
     * Request body: Authorize or capture an approved PayPal order
     *
     * Errors:
     *   400: Invalid request body. Or Missing required field: orderId.
     *   502: PayPal could not issue an access token: credentials are not configured for the site,
     *       or the PayPal OAuth call failed.
     *
     * POST https://payments.augur-api.com/paypal/order/authorize
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1paypal~1order~1authorize/post
     *
     * Request body ($data): PaypalOrderAuthorizeCreateBody (fields listed on the class)
     *
     * Response data type: PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
     *   one of:
     *     PaypalOrderCreateDataOption1 — PayPal Orders v2 order; a field PayPal did not send is
     *         absent
     *     PaypalAuthorizationCaptureCreateDataOption2 — Outcome when PayPal sent no resource:
     *         success true for an empty 2xx body (a void), false with PayPal's error otherwise
     *
     * @param PaypalOrderAuthorizeCreateBody $data
     * @return BaseResponse<PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2>
     */
    public function createOrderAuthorize(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/order/authorize', $data);

        /** @var BaseResponse<PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paypal/order/capture
     *
     * Capture payment for an approved PayPal order.
     * Call: $api->payments->paypal->createOrderCapture($data)
     *
     * Request body: Authorize or capture an approved PayPal order
     *
     * Errors:
     *   400: Invalid request body. Or Missing required field: orderId.
     *   502: PayPal could not issue an access token: credentials are not configured for the site,
     *       or the PayPal OAuth call failed.
     *
     * POST https://payments.augur-api.com/paypal/order/capture
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1paypal~1order~1capture/post
     *
     * Request body ($data): PaypalOrderAuthorizeCreateBody (fields listed on the class)
     *
     * Response data type: PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
     *   one of:
     *     PaypalOrderCreateDataOption1 — PayPal Orders v2 order; a field PayPal did not send is
     *         absent
     *     PaypalAuthorizationCaptureCreateDataOption2 — Outcome when PayPal sent no resource:
     *         success true for an empty 2xx body (a void), false with PayPal's error otherwise
     *
     * @param PaypalOrderAuthorizeCreateBody $data
     * @return BaseResponse<PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2>
     */
    public function createOrderCapture(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/order/capture', $data);

        /** @var BaseResponse<PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /paypal/order/details
     *
     * Get a PayPal order by ID.
     * Call: $api->payments->paypal->listOrderDetails()
     *
     * Retrieve details for a PayPal order by ID.
     *
     * Errors:
     *   400: Missing required parameter: orderId.
     *   502: PayPal could not issue an access token: credentials are not configured for the site,
     *       or the PayPal OAuth call failed.
     *
     * GET https://payments.augur-api.com/paypal/order/details
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1paypal~1order~1details/get
     *
     * Query params ($params; `?` = optional):
     *   orderId: string — PayPal order ID
     *   testMode?: string — "true" or "1" uses the PayPal sandbox; any other value or none uses
     *       live
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
     *   one of:
     *     PaypalOrderCreateDataOption1 — PayPal Orders v2 order; a field PayPal did not send is
     *         absent
     *     PaypalAuthorizationCaptureCreateDataOption2 — Outcome when PayPal sent no resource:
     *         success true for an empty 2xx body (a void), false with PayPal's error otherwise
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2>
     */
    public function listOrderDetails(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/order/details', $params);

        /** @var BaseResponse<PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /paypal/refund
     *
     * Get a PayPal refund by ID.
     * Call: $api->payments->paypal->listRefund()
     *
     * Retrieve details for a PayPal refund by ID.
     *
     * Errors:
     *   400: Missing required parameter: refundId.
     *   502: PayPal could not issue an access token: credentials are not configured for the site,
     *       or the PayPal OAuth call failed.
     *
     * GET https://payments.augur-api.com/paypal/refund
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1paypal~1refund/get
     *
     * Query params ($params; `?` = optional):
     *   refundId: string — PayPal refund ID
     *   testMode?: string — "true" or "1" uses the PayPal sandbox; any other value or none uses
     *       live
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type:
     * PaypalCaptureRefundCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
     *   one of:
     *     PaypalCaptureRefundCreateDataOption1 — PayPal Payments v2 refund; a field PayPal did not
     *         send is absent
     *     PaypalAuthorizationCaptureCreateDataOption2 — Outcome when PayPal sent no resource:
     *         success true for an empty 2xx body (a void), false with PayPal's error otherwise
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<PaypalCaptureRefundCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2>
     */
    public function listRefund(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/refund', $params);

        /** @var BaseResponse<PaypalCaptureRefundCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /paypal/webhook
     *
     * Receive a PayPal webhook event.
     * Call: $api->payments->paypal->createWebhook($data)
     *
     * Process an inbound PayPal webhook event notification.
     *
     * Request body: PayPal webhook event envelope, as PayPal posts it (snake_case keys); verified
     * against PayPal as sent
     * Response data: Acknowledgement of a PayPal webhook whose signature PayPal verified
     *
     * Auth: bearer token; spec scopes: none listed (most endpoints list `public`)
     *
     * Errors:
     *   400: Missing required query parameter: site_id. Or Webhook signature verification failed.
     *   502: PayPal could not issue an access token: credentials are not configured for the site,
     *       or the PayPal OAuth call failed.
     *
     * POST https://payments.augur-api.com/paypal/webhook
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1paypal~1webhook/post
     *
     * Request body ($data): PaypalWebhookCreateBody (fields listed on the class)
     *
     * Query params ($params; `?` = optional):
     *   siteId: string — siteId, passed in the query because PayPal posts server-to-server and
     *       cannot send the x-site-id header
     *   testMode?: string — "true" or "1" uses the PayPal sandbox; any other value or none uses
     *       live; must match the webhook environment registered with PayPal
     *
     * Response data type: PaypalWebhookCreateData (fields listed on the class)
     *
     * @param PaypalWebhookCreateBody $data
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function createWebhook(array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/webhook',
            $data,
            [],
            $params,
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
