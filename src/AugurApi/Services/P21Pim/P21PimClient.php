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
 * P21 PIM service client.
 *
 * Prophet 21 Product Information Management (inv mast ext, files, text, items, podcasts).
 *
 * @fullPath api.p21Pim
 * @service p21_pim
 * @domain p21
 */
final class P21PimClient extends BaseServiceClient
{
    public readonly InvMastExtResource $invMastExt;
    public readonly ItemsResource $items;
    public readonly PodcastsResource $podcasts;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->invMastExt = new InvMastExtResource($client, $this->baseUrl);
        $this->items = new ItemsResource($client, $this->baseUrl);
        $this->podcasts = new PodcastsResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'p21Pim';
    }
}
