<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Joomla\Resources\ActionLogsResource;
use AugurApi\Services\Joomla\Resources\CategoriesResource;
use AugurApi\Services\Joomla\Resources\ContentResource;
use AugurApi\Services\Joomla\Resources\MenuResource;
use AugurApi\Services\Joomla\Resources\ModulesResource;
use AugurApi\Services\Joomla\Resources\TagsResource;
use AugurApi\Services\Joomla\Resources\UsergroupsResource;
use AugurApi\Services\Joomla\Resources\UsersResource;

/**
 * Joomla service client — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://joomla.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://joomla.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://joomla.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py joomla
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /action-logs → $api->joomla->actionLogs->list() → list of ActionLogsListItem
 *   GET /action-logs/{id} → $api->joomla->actionLogs->get($id) → ActionLogsListItem
 *   GET /categories → $api->joomla->categories->list() → list of CategoriesListItem
 *   GET /categories/{id} → $api->joomla->categories->get($id) → CategoriesListItem
 *   GET /content → $api->joomla->content->list() → list of ContentListItem
 *   GET /content/{id} → $api->joomla->content->get($id) → ContentGetData
 *   GET /content/{id}/doc → $api->joomla->content->listDoc($id) → ContentListItem
 *   GET /menu → $api->joomla->menu->list() → list of MenuListItem
 *   GET /menu/{id}/doc → $api->joomla->menu->listDoc($id) → MenuDocListData
 *   GET /modules → $api->joomla->modules->list() → list of ModulesListItem
 *   GET /modules/{id} → $api->joomla->modules->get($id) → ModulesListItem
 *   GET /tags → $api->joomla->tags->list() → list of TagsListItem
 *   GET /usergroups → $api->joomla->usergroups->list() → list<string>
 *   GET /users → $api->joomla->users->list() → list of UsersListItem
 *   POST /users → $api->joomla->users->create($data) → UsersCreateData
 *   POST /users/verify-password → $api->joomla->users->createVerifyPassword($data) →
 *       UsersVerifyPasswordCreateData
 *   GET /users/{id} → $api->joomla->users->get($id) → UsersGetData
 *   PUT /users/{id} → $api->joomla->users->update($id, $data) → bool
 *   DELETE /users/{id} → $api->joomla->users->delete($id) → bool
 *   GET /users/{id}/doc → $api->joomla->users->listDoc($id) → UsersListItem
 *   GET /users/{id}/groups → $api->joomla->users->listGroups($id) → list of UsersGroupsListItem
 *   POST /users/{id}/groups → $api->joomla->users->createGroups($id, $data) → UsersGroupsListItem
 *   GET /users/{id}/groups/{groupId} → $api->joomla->users->getGroups($id, $groupId) →
 *       UsersGroupsListItem
 *   DELETE /users/{id}/groups/{groupId} → $api->joomla->users->deleteGroups($id, $groupId) → bool
 *   GET /users/{id}/trinity → $api->joomla->users->listTrinity($id) → UsersTrinityListData
 */
final class JoomlaClient extends BaseServiceClient
{
    public readonly ActionLogsResource $actionLogs;
    public readonly CategoriesResource $categories;
    public readonly ContentResource $content;
    public readonly MenuResource $menu;
    public readonly ModulesResource $modules;
    public readonly TagsResource $tags;
    public readonly UsergroupsResource $usergroups;
    public readonly UsersResource $users;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->actionLogs = new ActionLogsResource($this->client, $this->baseUrl . '/action-logs');
        $this->categories = new CategoriesResource($this->client, $this->baseUrl . '/categories');
        $this->content = new ContentResource($this->client, $this->baseUrl . '/content');
        $this->menu = new MenuResource($this->client, $this->baseUrl . '/menu');
        $this->modules = new ModulesResource($this->client, $this->baseUrl . '/modules');
        $this->tags = new TagsResource($this->client, $this->baseUrl . '/tags');
        $this->usergroups = new UsergroupsResource($this->client, $this->baseUrl . '/usergroups');
        $this->users = new UsersResource($this->client, $this->baseUrl . '/users');
    }

    protected function getServiceName(): string
    {
        return 'joomla';
    }
}
