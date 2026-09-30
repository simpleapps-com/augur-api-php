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
 * Items service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
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
    public readonly InvMastResource $invMast;
    public readonly InvMastLinksResource $invMastLinks;
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
        $this->attributeGroups = new AttributeGroupsResource($this->client, $this->baseUrl . '/attribute-groups');
        $this->attributes = new AttributesResource($this->client, $this->baseUrl . '/attributes');
        $this->brands = new BrandsResource($this->client, $this->baseUrl . '/brands');
        $this->categories = new CategoriesResource($this->client, $this->baseUrl . '/categories');
        $this->contracts = new ContractsResource($this->client, $this->baseUrl . '/contracts');
        $this->internal = new InternalResource($this->client, $this->baseUrl . '/internal');
        $this->invLoc = new InvLocResource($this->client, $this->baseUrl . '/inv-loc');
        $this->invMast = new InvMastResource($this->client, $this->baseUrl . '/inv-mast');
        $this->invMastLinks = new InvMastLinksResource($this->client, $this->baseUrl . '/inv-mast-links');
        $this->invMastSubParts = new InvMastSubPartsResource($this->client, $this->baseUrl . '/inv-mast-sub-parts');
        $this->invMastUd = new InvMastUdResource($this->client, $this->baseUrl . '/inv-mast-ud');
        $this->itemCategory = new ItemCategoryResource($this->client, $this->baseUrl . '/item-category');
        $this->itemFavorites = new ItemFavoritesResource($this->client, $this->baseUrl . '/item-favorites');
        $this->itemUom = new ItemUomResource($this->client, $this->baseUrl . '/item-uom');
        $this->itemWishlist = new ItemWishlistResource($this->client, $this->baseUrl . '/item-wishlist');
        $this->locations = new LocationsResource($this->client, $this->baseUrl . '/locations');
        $this->p21 = new P21Resource($this->client, $this->baseUrl . '/p21');
        $this->variants = new VariantsResource($this->client, $this->baseUrl . '/variants');
    }

    protected function getServiceName(): string
    {
        return 'items';
    }
}
