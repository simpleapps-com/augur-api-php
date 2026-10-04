<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrWork;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;

/**
 * AgrWork service client — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-work.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-work.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-work.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-work
 */
final class AgrWorkClient extends BaseServiceClient
{
    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
    }

    protected function getServiceName(): string
    {
        return 'agrWork';
    }
}
