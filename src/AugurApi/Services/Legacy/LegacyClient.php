<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Legacy\Resources\AlsoBoughtResource;
use AugurApi\Services\Legacy\Resources\InvMastTagsResource;
use AugurApi\Services\Legacy\Resources\InvMastWebDescResource;
use AugurApi\Services\Legacy\Resources\ItemCategoryResource;
use AugurApi\Services\Legacy\Resources\OrdersResource;
use AugurApi\Services\Legacy\Resources\StateResource;

/**
 * Legacy service client.
 *
 * @fullPath api.legacy
 * @service legacy
 * @domain augur
 */
final class LegacyClient extends BaseServiceClient
{
    public readonly AlsoBoughtResource $alsoBought;
    public readonly InvMastTagsResource $invMastTags;
    public readonly InvMastWebDescResource $invMastWebDesc;
    public readonly ItemCategoryResource $itemCategory;
    public readonly OrdersResource $orders;
    public readonly StateResource $state;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->alsoBought = new AlsoBoughtResource($client, $this->baseUrl);
        $this->invMastTags = new InvMastTagsResource($client, $this->baseUrl);
        $this->invMastWebDesc = new InvMastWebDescResource($client, $this->baseUrl);
        $this->itemCategory = new ItemCategoryResource($client, $this->baseUrl);
        $this->orders = new OrdersResource($client, $this->baseUrl);
        $this->state = new StateResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'legacy';
    }
}
