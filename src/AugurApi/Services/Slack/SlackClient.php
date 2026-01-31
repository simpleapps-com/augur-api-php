<?php

declare(strict_types=1);

namespace AugurApi\Services\Slack;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Slack\Resources\WebHookResource;

/**
 * Slack service client.
 *
 * @fullPath api.slack
 * @service slack
 * @domain notifications
 */
final class SlackClient extends BaseServiceClient
{
    public readonly WebHookResource $webHook;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->webHook = new WebHookResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'slack';
    }
}
