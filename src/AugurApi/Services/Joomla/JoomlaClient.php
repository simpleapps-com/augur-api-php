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
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py joomla
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
