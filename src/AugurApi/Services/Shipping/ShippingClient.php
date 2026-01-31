<?php

declare(strict_types=1);

namespace AugurApi\Services\Shipping;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Shipping\Resources\RatesResource;

/**
 * Shipping service client.
 *
 * @fullPath api.shipping
 * @service shipping
 * @domain shipping
 */
final class ShippingClient extends BaseServiceClient
{
    public readonly RatesResource $rates;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->rates = new RatesResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'shipping';
    }
}
