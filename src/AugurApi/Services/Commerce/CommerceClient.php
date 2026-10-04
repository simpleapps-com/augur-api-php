<?php

declare(strict_types=1);

namespace AugurApi\Services\Commerce;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Commerce\Resources\CartHdrResource;
use AugurApi\Services\Commerce\Resources\CartLineResource;
use AugurApi\Services\Commerce\Resources\CheckoutResource;

/**
 * Commerce service client — generated from spec.
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
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /cart-hdr/list → $api->commerce->cartHdr->listList() → list of CartHdrListListItem
 *   GET /cart-hdr/lookup → $api->commerce->cartHdr->getLookup() → CartHdrLookupGetDataOption1|false
 *   GET /cart-hdr/{cartHdrUid}/also-bought → $api->commerce->cartHdr->listAlsoBought($cartHdrUid) →
 *       list of CartHdrAlsoBoughtListItem
 *   GET /cart-line/{cartHdrUid} → $api->commerce->cartLine->get($cartHdrUid) →
 *       list of CartLineGetItem
 *   DELETE /cart-line/{cartHdrUid} → $api->commerce->cartLine->delete($cartHdrUid) → bool
 *   POST /cart-line/{cartHdrUid}/add → $api->commerce->cartLine->createAdd($cartHdrUid, $data) →
 *       bool
 *   DELETE /cart-line/{cartHdrUid}/lines/{lineNo} →
 *       $api->commerce->cartLine->deleteLines($cartHdrUid, $lineNo) → CartLineLinesDeleteData
 *   POST /cart-line/{cartHdrUid}/update →
 *       $api->commerce->cartLine->createUpdate($cartHdrUid, $data) → bool
 *   POST /checkout → $api->commerce->checkout->create($data) → CheckoutCreateData
 *   GET /checkout/{checkoutUid} → $api->commerce->checkout->get($checkoutUid) → CheckoutGetData
 *   PUT /checkout/{checkoutUid}/activate →
 *       $api->commerce->checkout->updateActivate($checkoutUid, $data) → CheckoutActivateUpdateData
 *   GET /checkout/{checkoutUid}/doc → $api->commerce->checkout->listDoc($checkoutUid) →
 *       CheckoutDocListData
 *   PUT /checkout/{checkoutUid}/validate →
 *       $api->commerce->checkout->updateValidate($checkoutUid, $data) → CheckoutActivateUpdateData
 */
final class CommerceClient extends BaseServiceClient
{
    public readonly CartHdrResource $cartHdr;
    public readonly CartLineResource $cartLine;
    public readonly CheckoutResource $checkout;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->cartHdr = new CartHdrResource($this->client, $this->baseUrl . '/cart-hdr');
        $this->cartLine = new CartLineResource($this->client, $this->baseUrl . '/cart-line');
        $this->checkout = new CheckoutResource($this->client, $this->baseUrl . '/checkout');
    }

    protected function getServiceName(): string
    {
        return 'commerce';
    }
}
