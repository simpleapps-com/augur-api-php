<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\AgrInt\Resources\BundlesResource;
use AugurApi\Services\AgrInt\Resources\ResourcesResource;
use AugurApi\Services\AgrInt\Resources\RolesResource;
use AugurApi\Services\AgrInt\Resources\UsersResource;

/**
 * AgrInt service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-int
 */
final class AgrIntClient extends BaseServiceClient
{
    public readonly BundlesResource $bundles;
    public readonly ResourcesResource $resources;
    public readonly RolesResource $roles;
    public readonly UsersResource $users;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->bundles = new BundlesResource($client, $this->baseUrl . '/bundles');
        $this->resources = new ResourcesResource($client, $this->baseUrl . '/resources');
        $this->roles = new RolesResource($client, $this->baseUrl . '/roles');
        $this->users = new UsersResource($client, $this->baseUrl . '/users');
    }

    protected function getServiceName(): string
    {
        return 'agrInt';
    }
}
