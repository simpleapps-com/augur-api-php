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
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py commerce
 */
final class CommerceClient extends BaseServiceClient
{
    public readonly CartHdrResource $cartHdr;
    public readonly CartLineResource $cartLine;
    public readonly CheckoutResource $checkout;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->cartHdr = new CartHdrResource($client, $this->baseUrl . '/cart-hdr');
        $this->cartLine = new CartLineResource($client, $this->baseUrl . '/cart-line');
        $this->checkout = new CheckoutResource($client, $this->baseUrl . '/checkout');
    }

    protected function getServiceName(): string
    {
        return 'commerce';
    }
}
