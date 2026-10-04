<?php

declare(strict_types=1);

namespace AugurApi\Services\Shipping;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Shipping\Resources\RatesResource;

/**
 * Shipping service client — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://shipping.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://shipping.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://shipping.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py shipping
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   POST /rates → $api->shipping->rates->create($data) → list of RatesCreateItem
 */
final class ShippingClient extends BaseServiceClient
{
    public readonly RatesResource $rates;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->rates = new RatesResource($this->client, $this->baseUrl . '/rates');
    }

    protected function getServiceName(): string
    {
        return 'shipping';
    }
}
