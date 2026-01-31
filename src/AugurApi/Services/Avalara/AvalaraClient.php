<?php

declare(strict_types=1);

namespace AugurApi\Services\Avalara;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Avalara\Resources\RatesResource;

/**
 * Avalara service client.
 *
 * @fullPath api.avalara
 * @service avalara
 * @domain tax
 */
final class AvalaraClient extends BaseServiceClient
{
    public readonly RatesResource $rates;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->rates = new RatesResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'avalara';
    }
}
