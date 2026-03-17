<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Logistics\Resources\ShipviaResource;
use AugurApi\Services\Logistics\Resources\SpeedshipResource;
use AugurApi\Services\Logistics\Resources\UpsResource;

/**
 * Logistics service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py logistics
 */
final class LogisticsClient extends BaseServiceClient
{
    public readonly ShipviaResource $shipvia;
    public readonly SpeedshipResource $speedship;
    public readonly UpsResource $ups;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->shipvia = new ShipviaResource($client, $this->baseUrl . '/shipvia');
        $this->speedship = new SpeedshipResource($client, $this->baseUrl . '/speedship');
        $this->ups = new UpsResource($client, $this->baseUrl . '/ups');
    }

    protected function getServiceName(): string
    {
        return 'logistics';
    }
}
