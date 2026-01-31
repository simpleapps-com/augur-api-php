<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Logistics\Resources\ShipviaResource;
use AugurApi\Services\Logistics\Resources\SpeedshipResource;

/**
 * Logistics service client.
 *
 * @fullPath api.logistics
 * @service logistics
 * @domain shipping
 */
final class LogisticsClient extends BaseServiceClient
{
    public readonly ShipviaResource $shipvia;
    public readonly SpeedshipResource $speedship;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->shipvia = new ShipviaResource($client, $this->baseUrl);
        $this->speedship = new SpeedshipResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'logistics';
    }
}
