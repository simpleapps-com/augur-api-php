<?php

declare(strict_types=1);

namespace AugurApi\Services\Ups;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Ups\Resources\RatesShopResource;

/**
 * Ups service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py ups
 */
final class UpsClient extends BaseServiceClient
{
    public readonly RatesShopResource $ratesShop;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->ratesShop = new RatesShopResource($client, $this->baseUrl . '/rates-shop');
    }

    protected function getServiceName(): string
    {
        return 'ups';
    }
}
