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
 * Pricing service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py pricing
 */
final class PricingClient extends BaseServiceClient
{
    public readonly JobPriceHdrResource $jobPriceHdr;
    public readonly PriceEngineResource $priceEngine;
    public readonly TaxEngineResource $taxEngine;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->jobPriceHdr = new JobPriceHdrResource($client, $this->baseUrl . '/job-price-hdr');
        $this->priceEngine = new PriceEngineResource($client, $this->baseUrl . '/price-engine');
        $this->taxEngine = new TaxEngineResource($client, $this->baseUrl . '/tax-engine');
    }

    protected function getServiceName(): string
    {
        return 'pricing';
    }
}
