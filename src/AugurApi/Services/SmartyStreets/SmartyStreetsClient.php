<?php

declare(strict_types=1);

namespace AugurApi\Services\SmartyStreets;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\SmartyStreets\Resources\UsResource;

/**
 * SmartyStreets service client.
 *
 * @fullPath api.smartyStreets
 * @service smarty_streets
 * @domain address-validation
 */
final class SmartyStreetsClient extends BaseServiceClient
{
    public readonly UsResource $us;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->us = new UsResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'smartyStreets';
    }
}
