<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Pricing\Resources\JobPriceHdrResource;
use AugurApi\Services\Pricing\Resources\PriceEngineResource;
use AugurApi\Services\Pricing\Resources\TaxEngineResource;
use AugurApi\Services\Pricing\Resources\WebPricingResource;

/**
 * Pricing service client — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://pricing.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://pricing.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://pricing.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py pricing
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /job-price-hdr → $api->pricing->jobPriceHdr->list() → list of JobPriceHdrListItem
 *   GET /job-price-hdr/{jobPriceHdrUid} → $api->pricing->jobPriceHdr->get($jobPriceHdrUid) →
 *       JobPriceHdrListItem
 *   GET /job-price-hdr/{jobPriceHdrUid}/lines →
 *       $api->pricing->jobPriceHdr->listLines($jobPriceHdrUid) → list of JobPriceHdrLinesListItem
 *   GET /job-price-hdr/{jobPriceHdrUid}/lines/{jobPriceLineUid} →
 *       $api->pricing->jobPriceHdr->getLines($jobPriceHdrUid, $jobPriceLineUid) →
 *       JobPriceHdrLinesListItem
 *   GET /price-engine → $api->pricing->priceEngine->list() → PriceEngineListData
 *   POST /price-engine → $api->pricing->priceEngine->create($data) → PriceEngineCreateData
 *   POST /tax-engine → $api->pricing->taxEngine->create($data) → TaxEngineCreateData
 *   GET /web-pricing → $api->pricing->webPricing->list() → list of WebPricingListItem
 *   POST /web-pricing → $api->pricing->webPricing->create($data) → WebPricingListItem
 *   GET /web-pricing/{webPricingUid} → $api->pricing->webPricing->get($webPricingUid) →
 *       WebPricingListItem
 *   PUT /web-pricing/{webPricingUid} → $api->pricing->webPricing->update($webPricingUid, $data) →
 *       WebPricingListItem
 *   DELETE /web-pricing/{webPricingUid} → $api->pricing->webPricing->delete($webPricingUid) →
 *       WebPricingListItem
 *   GET /web-pricing/{webPricingUid}/customers →
 *       $api->pricing->webPricing->listCustomers($webPricingUid) →
 *       list of WebPricingCustomersListItem
 *   POST /web-pricing/{webPricingUid}/customers →
 *       $api->pricing->webPricing->createCustomers($webPricingUid, $data) →
 *       WebPricingCustomersListItem
 *   GET /web-pricing/{webPricingUid}/customers/{customerId} →
 *       $api->pricing->webPricing->getCustomers($webPricingUid, $customerId) →
 *       WebPricingCustomersListItem
 *   PUT /web-pricing/{webPricingUid}/customers/{customerId} →
 *       $api->pricing->webPricing->updateCustomers($webPricingUid, $customerId, $data) →
 *       WebPricingCustomersListItem
 *   DELETE /web-pricing/{webPricingUid}/customers/{customerId} →
 *       $api->pricing->webPricing->deleteCustomers($webPricingUid, $customerId) →
 *       WebPricingCustomersListItem
 */
final class PricingClient extends BaseServiceClient
{
    public readonly JobPriceHdrResource $jobPriceHdr;
    public readonly PriceEngineResource $priceEngine;
    public readonly TaxEngineResource $taxEngine;
    public readonly WebPricingResource $webPricing;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->jobPriceHdr = new JobPriceHdrResource($this->client, $this->baseUrl . '/job-price-hdr');
        $this->priceEngine = new PriceEngineResource($this->client, $this->baseUrl . '/price-engine');
        $this->taxEngine = new TaxEngineResource($this->client, $this->baseUrl . '/tax-engine');
        $this->webPricing = new WebPricingResource($this->client, $this->baseUrl . '/web-pricing');
    }

    protected function getServiceName(): string
    {
        return 'pricing';
    }
}
