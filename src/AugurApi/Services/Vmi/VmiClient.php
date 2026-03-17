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
 * Vmi service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
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
        $this->distributors = new DistributorsResource($client, $this->baseUrl . '/distributors');
        $this->invProfileHdr = new InvProfileHdrResource($client, $this->baseUrl . '/inv-profile-hdr');
        $this->products = new ProductsResource($client, $this->baseUrl . '/products');
        $this->restockHdr = new RestockHdrResource($client, $this->baseUrl . '/restock-hdr');
        $this->sections = new SectionsResource($client, $this->baseUrl . '/sections');
        $this->warehouse = new WarehouseResource($client, $this->baseUrl . '/warehouse');
    }

    protected function getServiceName(): string
    {
        return 'vmi';
    }
}
