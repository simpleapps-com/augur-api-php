<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Logistics\Resources\FedexResource;
use AugurApi\Services\Logistics\Resources\RtsResource;
use AugurApi\Services\Logistics\Resources\ShippingMethodsResource;
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
    public readonly FedexResource $fedex;
    public readonly RtsResource $rts;
    public readonly ShippingMethodsResource $shippingMethods;
    public readonly ShipviaResource $shipvia;
    public readonly SpeedshipResource $speedship;
    public readonly UpsResource $ups;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->fedex = new FedexResource($this->client, $this->baseUrl . '/fedex');
        $this->rts = new RtsResource($this->client, $this->baseUrl . '/rts');
        $this->shippingMethods = new ShippingMethodsResource($this->client, $this->baseUrl . '/shipping-methods');
        $this->shipvia = new ShipviaResource($this->client, $this->baseUrl . '/shipvia');
        $this->speedship = new SpeedshipResource($this->client, $this->baseUrl . '/speedship');
        $this->ups = new UpsResource($this->client, $this->baseUrl . '/ups');
    }

    protected function getServiceName(): string
    {
        return 'logistics';
    }
}
