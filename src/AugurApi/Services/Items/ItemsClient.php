<?php

declare(strict_types=1);

namespace AugurApi\Services\Items;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Items\Resources\AttributeGroupsResource;
use AugurApi\Services\Items\Resources\AttributesResource;
use AugurApi\Services\Items\Resources\BrandsResource;
use AugurApi\Services\Items\Resources\CategoriesResource;
use AugurApi\Services\Items\Resources\ContractsResource;
use AugurApi\Services\Items\Resources\InternalResource;
use AugurApi\Services\Items\Resources\InvLocResource;
use AugurApi\Services\Items\Resources\InvMastLinksResource;
use AugurApi\Services\Items\Resources\InvMastResource;
use AugurApi\Services\Items\Resources\InvMastSubPartsResource;
use AugurApi\Services\Items\Resources\InvMastUdResource;
use AugurApi\Services\Items\Resources\ItemCategoryResource;
use AugurApi\Services\Items\Resources\ItemFavoritesResource;
use AugurApi\Services\Items\Resources\ItemUomResource;
use AugurApi\Services\Items\Resources\ItemWishlistResource;
use AugurApi\Services\Items\Resources\LocationsResource;
use AugurApi\Services\Items\Resources\P21Resource;
use AugurApi\Services\Items\Resources\VariantsResource;

/**
 * Items service client.
 *
 * @fullPath api.items
 * @service items
 * @domain inventory-management
 */
final class ItemsClient extends BaseServiceClient
{
    public readonly AttributeGroupsResource $attributeGroups;
    public readonly AttributesResource $attributes;
    public readonly BrandsResource $brands;
    public readonly CategoriesResource $categories;
    public readonly ContractsResource $contracts;
    public readonly InternalResource $internal;
    public readonly InvLocResource $invLoc;
    public readonly InvMastLinksResource $invMastLinks;
    public readonly InvMastResource $invMast;
    public readonly InvMastSubPartsResource $invMastSubParts;
    public readonly InvMastUdResource $invMastUd;
    public readonly ItemCategoryResource $itemCategory;
    public readonly ItemFavoritesResource $itemFavorites;
    public readonly ItemUomResource $itemUom;
    public readonly ItemWishlistResource $itemWishlist;
    public readonly LocationsResource $locations;
    public readonly P21Resource $p21;
    public readonly VariantsResource $variants;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->attributeGroups = new AttributeGroupsResource($client, $this->baseUrl);
        $this->attributes = new AttributesResource($client, $this->baseUrl);
        $this->brands = new BrandsResource($client, $this->baseUrl);
        $this->categories = new CategoriesResource($client, $this->baseUrl);
        $this->contracts = new ContractsResource($client, $this->baseUrl);
        $this->internal = new InternalResource($client, $this->baseUrl);
        $this->invLoc = new InvLocResource($client, $this->baseUrl);
        $this->invMastLinks = new InvMastLinksResource($client, $this->baseUrl);
        $this->invMast = new InvMastResource($client, $this->baseUrl);
        $this->invMastSubParts = new InvMastSubPartsResource($client, $this->baseUrl);
        $this->invMastUd = new InvMastUdResource($client, $this->baseUrl);
        $this->itemCategory = new ItemCategoryResource($client, $this->baseUrl);
        $this->itemFavorites = new ItemFavoritesResource($client, $this->baseUrl);
        $this->itemUom = new ItemUomResource($client, $this->baseUrl);
        $this->itemWishlist = new ItemWishlistResource($client, $this->baseUrl);
        $this->locations = new LocationsResource($client, $this->baseUrl);
        $this->p21 = new P21Resource($client, $this->baseUrl);
        $this->variants = new VariantsResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'items';
    }
}
