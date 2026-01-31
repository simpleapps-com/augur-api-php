<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Pricing\Resources\JobPriceHdrResource;
use AugurApi\Services\Pricing\Resources\PriceEngineResource;
use AugurApi\Services\Pricing\Resources\TaxEngineResource;

/**
 * Pricing service client.
 *
 * @fullPath api.pricing
 * @service pricing
 * @domain pricing
 */
final class PricingClient extends BaseServiceClient
{
    public readonly JobPriceHdrResource $jobPriceHdr;
    public readonly PriceEngineResource $priceEngine;
    public readonly TaxEngineResource $taxEngine;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->jobPriceHdr = new JobPriceHdrResource($client, $this->baseUrl);
        $this->priceEngine = new PriceEngineResource($client, $this->baseUrl);
        $this->taxEngine = new TaxEngineResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'pricing';
    }
}
