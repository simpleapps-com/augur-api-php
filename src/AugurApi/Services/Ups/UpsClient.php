<?php

declare(strict_types=1);

namespace AugurApi\Services\Ups;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Ups\Resources\RatesShopResource;

/**
 * UPS service client.
 *
 * @fullPath api.ups
 * @service ups
 * @domain shipping
 */
final class UpsClient extends BaseServiceClient
{
    public readonly RatesShopResource $ratesShop;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->ratesShop = new RatesShopResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'ups';
    }
}
