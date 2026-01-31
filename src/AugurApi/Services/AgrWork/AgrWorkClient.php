<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrWork;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;

/**
 * Agr Work service client.
 *
 * @fullPath api.agrWork
 * @service agr_work
 * @domain augur
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
