<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Payments\Resources\ElementResource;
use AugurApi\Services\Payments\Resources\MonerisResource;
use AugurApi\Services\Payments\Resources\PaypalResource;
use AugurApi\Services\Payments\Resources\PaytraceResource;
use AugurApi\Services\Payments\Resources\UnifiedResource;

/**
 * Payments service client — generated from spec.
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
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   POST /element/payment → $api->payments->element->createPayment($data) →
 *       ElementPaymentCreateData
 *   GET /moneris/pre-auth → $api->payments->moneris->listPreAuth() → MonerisPreAuthListData
 *   GET /moneris/pre-auth-complete → $api->payments->moneris->listPreAuthComplete() →
 *       MonerisPreAuthListData
 *   POST /paypal/authorization/capture →
 *       $api->payments->paypal->createAuthorizationCapture($data) →
 *       PaypalAuthorizationCaptureCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
 *   POST /paypal/authorization/void → $api->payments->paypal->createAuthorizationVoid($data) →
 *       PaypalAuthorizationVoidCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
 *   POST /paypal/capture/refund → $api->payments->paypal->createCaptureRefund($data) →
 *       PaypalCaptureRefundCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
 *   POST /paypal/order → $api->payments->paypal->createOrder($data) →
 *       PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
 *   GET /paypal/order-return → $api->payments->paypal->listOrderReturn() →
 *       PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
 *   POST /paypal/order/authorize → $api->payments->paypal->createOrderAuthorize($data) →
 *       PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
 *   POST /paypal/order/capture → $api->payments->paypal->createOrderCapture($data) →
 *       PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
 *   GET /paypal/order/details → $api->payments->paypal->listOrderDetails() →
 *       PaypalOrderCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
 *   GET /paypal/refund → $api->payments->paypal->listRefund() →
 *       PaypalCaptureRefundCreateDataOption1|PaypalAuthorizationCaptureCreateDataOption2
 *   POST /paypal/webhook → $api->payments->paypal->createWebhook($data) → PaypalWebhookCreateData
 *   POST /paytrace/authorization → $api->payments->paytrace->createAuthorization($data) → untyped
 *   POST /paytrace/capture → $api->payments->paytrace->createCapture($data) → untyped
 *   POST /paytrace/refund → $api->payments->paytrace->createRefund($data) → untyped
 *   POST /paytrace/sale → $api->payments->paytrace->createSale($data) → untyped
 *   POST /paytrace/void → $api->payments->paytrace->createVoid($data) → untyped
 *   GET /unified/account-query → $api->payments->unified->listAccountQuery() → untyped
 *   GET /unified/billing-update → $api->payments->unified->listBillingUpdate() → bool
 *   GET /unified/card-info → $api->payments->unified->listCardInfo() → untyped
 *   GET /unified/surcharge → $api->payments->unified->listSurcharge() → untyped
 *   GET /unified/transaction-response → $api->payments->unified->listTransactionResponse() →
 *       untyped
 *   GET /unified/transaction-setup → $api->payments->unified->listTransactionSetup() →
 *       UnifiedTransactionSetupListData
 *   GET /unified/validate → $api->payments->unified->listValidate() → bool
 */
final class PaymentsClient extends BaseServiceClient
{
    public readonly ElementResource $element;
    public readonly MonerisResource $moneris;
    public readonly PaypalResource $paypal;
    public readonly PaytraceResource $paytrace;
    public readonly UnifiedResource $unified;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->element = new ElementResource($this->client, $this->baseUrl . '/element');
        $this->moneris = new MonerisResource($this->client, $this->baseUrl . '/moneris');
        $this->paypal = new PaypalResource($this->client, $this->baseUrl . '/paypal');
        $this->paytrace = new PaytraceResource($this->client, $this->baseUrl . '/paytrace');
        $this->unified = new UnifiedResource($this->client, $this->baseUrl . '/unified');
    }

    protected function getServiceName(): string
    {
        return 'payments';
    }
}
