<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\AgrInt\Resources\RolesResource;
use AugurApi\Services\AgrInt\Resources\UsersResource;

/**
 * AgrInt service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-int
 */
final class AgrIntClient extends BaseServiceClient
{
    public readonly RolesResource $roles;
    public readonly UsersResource $users;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->roles = new RolesResource($client, $this->baseUrl . '/roles');
        $this->users = new UsersResource($client, $this->baseUrl . '/users');
    }

    protected function getServiceName(): string
    {
        return 'agrInt';
    }
}
