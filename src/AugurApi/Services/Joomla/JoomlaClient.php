<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Joomla\Resources\ContentResource;
use AugurApi\Services\Joomla\Resources\MenuResource;
use AugurApi\Services\Joomla\Resources\TagsResource;
use AugurApi\Services\Joomla\Resources\UsergroupsResource;
use AugurApi\Services\Joomla\Resources\UsersResource;

/**
 * Joomla service client.
 *
 * @fullPath api.joomla
 * @service joomla
 * @domain cms
 */
final class JoomlaClient extends BaseServiceClient
{
    public readonly ContentResource $content;
    public readonly MenuResource $menu;
    public readonly TagsResource $tags;
    public readonly UsergroupsResource $usergroups;
    public readonly UsersResource $users;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->content = new ContentResource($client, $this->baseUrl);
        $this->menu = new MenuResource($client, $this->baseUrl);
        $this->tags = new TagsResource($client, $this->baseUrl);
        $this->usergroups = new UsergroupsResource($client, $this->baseUrl);
        $this->users = new UsersResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'joomla';
    }
}
