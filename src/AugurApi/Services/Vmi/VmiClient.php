<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Vmi\Resources\DistributorsResource;
use AugurApi\Services\Vmi\Resources\InvProfileHdrResource;
use AugurApi\Services\Vmi\Resources\ProductsResource;
use AugurApi\Services\Vmi\Resources\RestockHdrResource;
use AugurApi\Services\Vmi\Resources\SectionsResource;
use AugurApi\Services\Vmi\Resources\WarehouseResource;

/**
 * VMI (Vendor Managed Inventory) service client.
 *
 * @fullPath api.vmi
 * @service vmi
 * @domain inventory
 */
final class VmiClient extends BaseServiceClient
{
    public readonly DistributorsResource $distributors;
    public readonly InvProfileHdrResource $invProfileHdr;
    public readonly ProductsResource $products;
    public readonly RestockHdrResource $restockHdr;
    public readonly SectionsResource $sections;
    public readonly WarehouseResource $warehouse;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->distributors = new DistributorsResource($client, $this->baseUrl);
        $this->invProfileHdr = new InvProfileHdrResource($client, $this->baseUrl);
        $this->products = new ProductsResource($client, $this->baseUrl);
        $this->restockHdr = new RestockHdrResource($client, $this->baseUrl);
        $this->sections = new SectionsResource($client, $this->baseUrl);
        $this->warehouse = new WarehouseResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'vmi';
    }
}
