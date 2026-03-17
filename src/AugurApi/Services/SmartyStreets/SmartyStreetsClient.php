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
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py smarty-streets
 */
final class SmartyStreetsClient extends BaseServiceClient
{
    public readonly UsResource $us;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->us = new UsResource($client, $this->baseUrl . '/us');
    }

    protected function getServiceName(): string
    {
        return 'smartyStreets';
    }
}
