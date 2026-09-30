<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\AgrInt\Resources\BundlesResource;
use AugurApi\Services\AgrInt\Resources\ClientsResource;
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
    public readonly ClientsResource $clients;
    public readonly ResourcesResource $resources;
    public readonly RolesResource $roles;
    public readonly UsersResource $users;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->bundles = new BundlesResource($this->client, $this->baseUrl . '/bundles');
        $this->clients = new ClientsResource($this->client, $this->baseUrl . '/clients');
        $this->resources = new ResourcesResource($this->client, $this->baseUrl . '/resources');
        $this->roles = new RolesResource($this->client, $this->baseUrl . '/roles');
        $this->users = new UsersResource($this->client, $this->baseUrl . '/users');
    }

    protected function getServiceName(): string
    {
        return 'agrInt';
    }
}
