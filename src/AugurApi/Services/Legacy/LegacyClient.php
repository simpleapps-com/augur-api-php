<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Legacy\Resources\InvMastResource;
use AugurApi\Services\Legacy\Resources\ItemCategoryResource;
use AugurApi\Services\Legacy\Resources\LegacyResource;
use AugurApi\Services\Legacy\Resources\OrdersResource;

/**
 * Legacy service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py legacy
 */
final class LegacyClient extends BaseServiceClient
{
    public readonly InvMastResource $invMast;
    public readonly ItemCategoryResource $itemCategory;
    public readonly LegacyResource $legacy;
    public readonly OrdersResource $orders;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->invMast = new InvMastResource($client, $this->baseUrl . '/inv-mast');
        $this->itemCategory = new ItemCategoryResource($client, $this->baseUrl . '/item-category');
        $this->legacy = new LegacyResource($client, $this->baseUrl . '/legacy');
        $this->orders = new OrdersResource($client, $this->baseUrl . '/orders');
    }

    protected function getServiceName(): string
    {
        return 'legacy';
    }
}
