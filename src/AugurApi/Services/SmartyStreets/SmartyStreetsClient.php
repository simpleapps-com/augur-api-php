<?php

declare(strict_types=1);

namespace AugurApi\Services\SmartyStreets;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\SmartyStreets\Resources\UsResource;

/**
 * SmartyStreets service client — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://smarty-streets.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path,
 *       path params and query params, each with type and required flag. Grep it for a path; for a
 *       GET that line is all you need. Bodies are not in it.
 *   https://smarty-streets.augur-api.com/openapi.json: the full contract: request and response
 *       bodies field by field, descriptions, formats and documented errors.
 *   https://smarty-streets.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py smarty-streets
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /us/lookup → $api->smartyStreets->us->getLookup() → UsLookupGetData
 */
final class SmartyStreetsClient extends BaseServiceClient
{
    public readonly UsResource $us;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->us = new UsResource($this->client, $this->baseUrl . '/us');
    }

    protected function getServiceName(): string
    {
        return 'smartyStreets';
    }
}
