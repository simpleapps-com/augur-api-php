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
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-int.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-int.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-int.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-int
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /bundles → $api->agrInt->bundles->list() → list of BundlesListItem
 *   POST /bundles → $api->agrInt->bundles->create($data) → BundlesListItem
 *   GET /bundles/{bundlesUid} → $api->agrInt->bundles->get($bundlesUid) → BundlesListItem
 *   PUT /bundles/{bundlesUid} → $api->agrInt->bundles->update($bundlesUid, $data) → BundlesListItem
 *   DELETE /bundles/{bundlesUid} → $api->agrInt->bundles->delete($bundlesUid) → BundlesListItem
 *   GET /bundles/{bundlesUid}/resources → $api->agrInt->bundles->listResources($bundlesUid) →
 *       list of BundlesResourcesListItem
 *   POST /bundles/{bundlesUid}/resources →
 *       $api->agrInt->bundles->createResources($bundlesUid, $data) → BundlesResourcesListItem
 *   GET /bundles/{bundlesUid}/resources/{bundlesXResourcesUid} →
 *       $api->agrInt->bundles->getResources($bundlesUid, $bundlesXResourcesUid) →
 *       BundlesResourcesListItem
 *   PUT /bundles/{bundlesUid}/resources/{bundlesXResourcesUid} →
 *       $api->agrInt->bundles->updateResources($bundlesUid, $bundlesXResourcesUid, $data) →
 *       BundlesResourcesListItem
 *   DELETE /bundles/{bundlesUid}/resources/{bundlesXResourcesUid} →
 *       $api->agrInt->bundles->deleteResources($bundlesUid, $bundlesXResourcesUid) →
 *       BundlesResourcesListItem
 *   GET /clients → $api->agrInt->clients->list() → list of ClientsListItem
 *   POST /clients → $api->agrInt->clients->create($data) → ClientsCreateData
 *   POST /clients/validate → $api->agrInt->clients->createValidate($data) →
 *       ClientsValidateCreateData
 *   GET /clients/{clientsUid} → $api->agrInt->clients->get($clientsUid) → ClientsGetData
 *   PUT /clients/{clientsUid} → $api->agrInt->clients->update($clientsUid, $data) → ClientsListItem
 *   DELETE /clients/{clientsUid} → $api->agrInt->clients->delete($clientsUid) → ClientsListItem
 *   GET /resources → $api->agrInt->resources->list() → list of ResourcesListItem
 *   GET /resources/{resourcesUid} → $api->agrInt->resources->get($resourcesUid) → ResourcesListItem
 *   GET /roles → $api->agrInt->roles->list() → list of RolesListItem
 *   POST /roles → $api->agrInt->roles->create($data) → RolesListItem
 *   GET /roles/{rolesUid} → $api->agrInt->roles->get($rolesUid) → RolesListItem
 *   PUT /roles/{rolesUid} → $api->agrInt->roles->update($rolesUid, $data) → RolesListItem
 *   DELETE /roles/{rolesUid} → $api->agrInt->roles->delete($rolesUid) → RolesListItem
 *   GET /roles/{rolesUid}/bundles → $api->agrInt->roles->listBundles($rolesUid) →
 *       list of RolesBundlesListItem
 *   POST /roles/{rolesUid}/bundles → $api->agrInt->roles->createBundles($rolesUid, $data) →
 *       RolesBundlesListItem
 *   GET /roles/{rolesUid}/bundles/{rolesXBundlesUid} →
 *       $api->agrInt->roles->getBundles($rolesUid, $rolesXBundlesUid) → RolesBundlesListItem
 *   PUT /roles/{rolesUid}/bundles/{rolesXBundlesUid} →
 *       $api->agrInt->roles->updateBundles($rolesUid, $rolesXBundlesUid, $data) →
 *       RolesBundlesListItem
 *   DELETE /roles/{rolesUid}/bundles/{rolesXBundlesUid} →
 *       $api->agrInt->roles->deleteBundles($rolesUid, $rolesXBundlesUid) → RolesBundlesListItem
 *   GET /users → $api->agrInt->users->list() → list of UsersListItem
 *   POST /users → $api->agrInt->users->create($data) → UsersListItem
 *   POST /users/rotate → $api->agrInt->users->createRotate($data) → UsersRotateCreateData
 *   POST /users/validate → $api->agrInt->users->createValidate($data) → UsersValidateCreateData
 *   POST /users/verify → $api->agrInt->users->createVerify($data) → UsersRotateCreateData
 *   GET /users/{usersUid} → $api->agrInt->users->get($usersUid) → UsersListItem
 *   PUT /users/{usersUid} → $api->agrInt->users->update($usersUid, $data) → UsersListItem
 *   DELETE /users/{usersUid} → $api->agrInt->users->delete($usersUid) → UsersListItem
 *   GET /users/{usersUid}/roles → $api->agrInt->users->listRoles($usersUid) →
 *       list of UsersRolesListItem
 *   POST /users/{usersUid}/roles → $api->agrInt->users->createRoles($usersUid, $data) →
 *       UsersRolesListItem
 *   GET /users/{usersUid}/roles/{usersXRolesUid} →
 *       $api->agrInt->users->getRoles($usersUid, $usersXRolesUid) → UsersRolesListItem
 *   PUT /users/{usersUid}/roles/{usersXRolesUid} →
 *       $api->agrInt->users->updateRoles($usersUid, $usersXRolesUid, $data) → UsersRolesListItem
 *   DELETE /users/{usersUid}/roles/{usersXRolesUid} →
 *       $api->agrInt->users->deleteRoles($usersUid, $usersXRolesUid) → UsersRolesListItem
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
