<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Joomla\Resources\CategoriesResource;
use AugurApi\Services\Joomla\Resources\ContentResource;
use AugurApi\Services\Joomla\Resources\MenuResource;
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
    public readonly CategoriesResource $categories;
    public readonly ContentResource $content;
    public readonly MenuResource $menu;
    public readonly TagsResource $tags;
    public readonly UsergroupsResource $usergroups;
    public readonly UsersResource $users;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->categories = new CategoriesResource($client, $this->baseUrl . '/categories');
        $this->content = new ContentResource($client, $this->baseUrl . '/content');
        $this->menu = new MenuResource($client, $this->baseUrl . '/menu');
        $this->tags = new TagsResource($client, $this->baseUrl . '/tags');
        $this->usergroups = new UsergroupsResource($client, $this->baseUrl . '/usergroups');
        $this->users = new UsersResource($client, $this->baseUrl . '/users');
    }

    protected function getServiceName(): string
    {
        return 'joomla';
    }
}
