<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrWork;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;

/**
 * AgrWork service client — generated from spec.
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
