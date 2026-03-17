<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\P21Pim\Resources\InvMastExtResource;
use AugurApi\Services\P21Pim\Resources\ItemsResource;
use AugurApi\Services\P21Pim\Resources\PodcastsResource;

/**
 * P21Pim service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-pim
 */
final class P21PimClient extends BaseServiceClient
{
    public readonly InvMastExtResource $invMastExt;
    public readonly ItemsResource $items;
    public readonly PodcastsResource $podcasts;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->invMastExt = new InvMastExtResource($client, $this->baseUrl . '/inv-mast-ext');
        $this->items = new ItemsResource($client, $this->baseUrl . '/items');
        $this->podcasts = new PodcastsResource($client, $this->baseUrl . '/podcasts');
    }

    protected function getServiceName(): string
    {
        return 'p21Pim';
    }
}
