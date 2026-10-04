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
 * Public specs (the source of truth for every shape in this file):
 *   https://items.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://items.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://items.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /attribute-groups → $api->items->attributeGroups->list() → list of AttributeGroupsListItem
 *   POST /attribute-groups → $api->items->attributeGroups->create($data) →
 *       AttributeGroupsCreateData
 *   GET /attribute-groups/{attributeGroupUid} →
 *       $api->items->attributeGroups->get($attributeGroupUid) → AttributeGroupsListItem
 *   PUT /attribute-groups/{attributeGroupUid} →
 *       $api->items->attributeGroups->update($attributeGroupUid, $data) → AttributeGroupsCreateData
 *   DELETE /attribute-groups/{attributeGroupUid} →
 *       $api->items->attributeGroups->delete($attributeGroupUid) → AttributeGroupsCreateData
 *   GET /attribute-groups/{attributeGroupUid}/attributes →
 *       $api->items->attributeGroups->listAttributes($attributeGroupUid) →
 *       list of AttributeGroupsAttributesListItem
 *   POST /attribute-groups/{attributeGroupUid}/attributes →
 *       $api->items->attributeGroups->createAttributes($attributeGroupUid, $data) →
 *       AttributeGroupsAttributesCreateData
 *   GET /attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid} →
 *       $api->items->attributeGroups->getAttributes($attributeGroupUid, $attributeXAttributeGroupUid) →
 *       AttributeGroupsAttributesListItem
 *   PUT /attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid} →
 *       $api->items->attributeGroups->updateAttributes($attributeGroupUid, $attributeXAttributeGroupUid, $data) →
 *       AttributeGroupsAttributesUpdateData
 *   DELETE /attribute-groups/{attributeGroupUid}/attributes/{attributeXAttributeGroupUid} →
 *       $api->items->attributeGroups->deleteAttributes($attributeGroupUid, $attributeXAttributeGroupUid) →
 *       AttributeGroupsAttributesUpdateData
 *   GET /attributes → $api->items->attributes->list() → list of AttributesListItem
 *   POST /attributes → $api->items->attributes->create($data) → AttributesCreateData
 *   POST /attributes/resolve → $api->items->attributes->createResolve($data) →
 *       AttributesResolveCreateData
 *   GET /attributes/{attributeUid} → $api->items->attributes->get($attributeUid) →
 *       AttributesListItem
 *   PUT /attributes/{attributeUid} → $api->items->attributes->update($attributeUid, $data) →
 *       AttributesCreateData
 *   DELETE /attributes/{attributeUid} → $api->items->attributes->delete($attributeUid) →
 *       AttributesCreateData
 *   GET /attributes/{attributeUid}/items → $api->items->attributes->listItems($attributeUid) →
 *       list of AttributesItemsListItem
 *   GET /attributes/{attributeUid}/values → $api->items->attributes->listValues($attributeUid) →
 *       list of AttributesValuesListItem
 *   POST /attributes/{attributeUid}/values →
 *       $api->items->attributes->createValues($attributeUid, $data) → AttributesValuesListItem
 *   GET /attributes/{attributeUid}/values/{attributeValueUid} →
 *       $api->items->attributes->getValues($attributeUid, $attributeValueUid) →
 *       AttributesValuesListItem
 *   PUT /attributes/{attributeUid}/values/{attributeValueUid} →
 *       $api->items->attributes->updateValues($attributeUid, $attributeValueUid, $data) →
 *       AttributesValuesListItem
 *   DELETE /attributes/{attributeUid}/values/{attributeValueUid} →
 *       $api->items->attributes->deleteValues($attributeUid, $attributeValueUid) →
 *       AttributesValuesListItem
 *   GET /brands → $api->items->brands->list() → list of BrandsListItem
 *   POST /brands → $api->items->brands->create($data) → BrandsListItem
 *   GET /brands/{brandsUid} → $api->items->brands->get($brandsUid) → BrandsListItem
 *   PUT /brands/{brandsUid} → $api->items->brands->update($brandsUid, $data) → BrandsListItem
 *   DELETE /brands/{brandsUid} → $api->items->brands->delete($brandsUid) → BrandsListItem
 *   GET /brands/{brandsUid}/attributes → $api->items->brands->listAttributes($brandsUid) →
 *       BrandsAttributesListData
 *   GET /brands/{brandsUid}/facets → $api->items->brands->listFacets($brandsUid) →
 *       BrandsFacetsListData
 *   GET /brands/{brandsUid}/items → $api->items->brands->listItems($brandsUid) →
 *       BrandsItemsListData
 *   POST /brands/{brandsUid}/items → $api->items->brands->createItems($brandsUid, $data) →
 *       BrandsItemsCreateData
 *   GET /brands/{brandsUid}/items/{brandsXItemsUid} →
 *       $api->items->brands->getItems($brandsUid, $brandsXItemsUid) → BrandsItemsCreateData
 *   PUT /brands/{brandsUid}/items/{brandsXItemsUid} →
 *       $api->items->brands->updateItems($brandsUid, $brandsXItemsUid, $data) →
 *       BrandsItemsCreateData
 *   DELETE /brands/{brandsUid}/items/{brandsXItemsUid} →
 *       $api->items->brands->deleteItems($brandsUid, $brandsXItemsUid) → BrandsItemsCreateData
 *   GET /categories/lookup → $api->items->categories->getLookup() → CategoriesLookupGetData
 *   GET /categories/{itemCategoryUid} → $api->items->categories->get($itemCategoryUid) →
 *       CategoriesLookupGetData
 *   GET /categories/{itemCategoryUid}/attributes →
 *       $api->items->categories->listAttributes($itemCategoryUid) → BrandsAttributesListData
 *   GET /categories/{itemCategoryUid}/facets →
 *       $api->items->categories->listFacets($itemCategoryUid) → BrandsFacetsListData
 *   GET /categories/{itemCategoryUid}/images →
 *       $api->items->categories->listImages($itemCategoryUid) → CategoriesImagesListData
 *   GET /categories/{itemCategoryUid}/items →
 *       $api->items->categories->listItems($itemCategoryUid) → CategoriesItemsListData
 *   GET /contracts/{jobNo}/attributes → $api->items->contracts->listAttributes($jobNo) →
 *       BrandsAttributesListData
 *   GET /contracts/{jobNo}/facets → $api->items->contracts->listFacets($jobNo) →
 *       BrandsFacetsListData
 *   GET /contracts/{jobNo}/items → $api->items->contracts->listItems($jobNo) →
 *       ContractsItemsListData
 *   POST /internal/pdf → $api->items->internal->createPdf($data) → string
 *   GET /inv-loc → $api->items->invLoc->list() → list of InvLocListItem
 *   GET /inv-mast → $api->items->invMast->list() → list of InvMastListItem
 *   GET /inv-mast-links/{invMastUid} → $api->items->invMastLinks->get($invMastUid) →
 *       list of InvMastLinksGetItem
 *   GET /inv-mast-sub-parts/{invMastUid} → $api->items->invMastSubParts->get($invMastUid) →
 *       list of InvMastSubPartsGetItem
 *   GET /inv-mast-ud → $api->items->invMastUd->list() → list of InvMastUdListItem
 *   POST /inv-mast/attributes/bulk → $api->items->invMast->createAttributesBulk($data) →
 *       InvMastAttributesBulkCreateData
 *   GET /inv-mast/lookup → $api->items->invMast->getLookup() → list of InvMastLookupGetItem
 *   GET /inv-mast/{invMastUid} → $api->items->invMast->get($invMastUid) → InvMastGetData
 *   GET /inv-mast/{invMastUid}/alternate-code →
 *       $api->items->invMast->listAlternateCode($invMastUid) → list of InvMastAlternateCodeListItem
 *   GET /inv-mast/{invMastUid}/attributes → $api->items->invMast->listAttributes($invMastUid) →
 *       list of InvMastAttributesListItem
 *   POST /inv-mast/{invMastUid}/attributes →
 *       $api->items->invMast->createAttributes($invMastUid, $data) → InvMastAttributesCreateData
 *   GET /inv-mast/{invMastUid}/attributes/{attributeUid}/values →
 *       $api->items->invMast->listAttributesValues($invMastUid, $attributeUid) →
 *       list of InvMastAttributesListItem
 *   POST /inv-mast/{invMastUid}/attributes/{attributeUid}/values →
 *       $api->items->invMast->createAttributesValues($invMastUid, $attributeUid, $data) →
 *       InvMastAttributesCreateData
 *   PUT /inv-mast/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid} →
 *       $api->items->invMast->updateAttributesValues($invMastUid, $attributeUid, $attributeValueUid, $data) →
 *       InvMastAttributesCreateData
 *   DELETE /inv-mast/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid} →
 *       $api->items->invMast->deleteAttributesValues($invMastUid, $attributeUid, $attributeValueUid) →
 *       InvMastAttributesCreateData
 *   GET /inv-mast/{invMastUid}/doc → $api->items->invMast->listDoc($invMastUid) → InvMastListItem
 *   GET /inv-mast/{invMastUid}/faq → $api->items->invMast->listFaq($invMastUid) →
 *       list of InvMastFaqListItem
 *   GET /inv-mast/{invMastUid}/faq/{invMastFaqUid} →
 *       $api->items->invMast->getFaq($invMastUid, $invMastFaqUid) → InvMastFaqListItem
 *   PUT /inv-mast/{invMastUid}/faq/{invMastFaqUid} →
 *       $api->items->invMast->updateFaq($invMastUid, $invMastFaqUid, $data) → InvMastFaqListItem
 *   DELETE /inv-mast/{invMastUid}/faq/{invMastFaqUid} →
 *       $api->items->invMast->deleteFaq($invMastUid, $invMastFaqUid) → InvMastFaqListItem
 *   GET /inv-mast/{invMastUid}/inv-accessory →
 *       $api->items->invMast->listInvAccessory($invMastUid) → list of InvMastInvAccessoryListItem
 *   GET /inv-mast/{invMastUid}/inv-sub → $api->items->invMast->listInvSub($invMastUid) →
 *       list of InvMastInvSubListItem
 *   GET /inv-mast/{invMastUid}/locations/{locationId}/bins →
 *       $api->items->invMast->listLocationsBins($invMastUid, $locationId) →
 *       list of InvMastLocationsBinsListItem
 *   GET /inv-mast/{invMastUid}/locations/{locationId}/bins/{bin} →
 *       $api->items->invMast->getLocationsBins($invMastUid, $locationId, $bin) →
 *       InvMastLocationsBinsListItem
 *   GET /inv-mast/{invMastUid}/precache → $api->items->invMast->listPrecache($invMastUid) → bool
 *   GET /inv-mast/{invMastUid}/similar → $api->items->invMast->listSimilar($invMastUid) →
 *       list of InvMastSimilarListItem
 *   GET /inv-mast/{invMastUid}/stock → $api->items->invMast->getStock($invMastUid) →
 *       InvMastStockGetData
 *   GET /item-category → $api->items->itemCategory->list() → list of ItemCategoryListItem
 *   GET /item-category/lookup → $api->items->itemCategory->getLookup() → ItemCategoryLookupGetData
 *   GET /item-category/{itemCategoryUid}/precache →
 *       $api->items->itemCategory->listPrecache($itemCategoryUid) → bool
 *   GET /item-favorites/{usersId}/items → $api->items->itemFavorites->listItems($usersId) →
 *       list of ItemFavoritesItemsListItem
 *   POST /item-favorites/{usersId}/items →
 *       $api->items->itemFavorites->createItems($usersId, $data) →
 *       list of ItemFavoritesItemsListItem
 *   GET /item-favorites/{usersId}/items/{invMastUid} →
 *       $api->items->itemFavorites->getItems($usersId, $invMastUid) → ItemFavoritesItemsListItem
 *   PUT /item-favorites/{usersId}/items/{invMastUid} →
 *       $api->items->itemFavorites->updateItems($usersId, $invMastUid, $data) →
 *       ItemFavoritesItemsListItem
 *   DELETE /item-favorites/{usersId}/items/{invMastUid} →
 *       $api->items->itemFavorites->deleteItems($usersId, $invMastUid) → bool
 *   GET /item-uom → $api->items->itemUom->list() → list of ItemUomListItem
 *   GET /item-uom/{itemUomUid} → $api->items->itemUom->get($itemUomUid) → ItemUomListItem
 *   GET /item-wishlist/{usersId} → $api->items->itemWishlist->get($usersId) →
 *       list of ItemWishlistGetItem
 *   POST /item-wishlist/{usersId} → $api->items->itemWishlist->create($usersId, $data) →
 *       ItemWishlistCreateData
 *   PUT /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid} →
 *       $api->items->itemWishlist->updateHdr($usersId, $itemWishlistHdrUid, $data) →
 *       ItemWishlistCreateData
 *   DELETE /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid} →
 *       $api->items->itemWishlist->deleteHdr($usersId, $itemWishlistHdrUid) →
 *       ItemWishlistCreateData
 *   GET /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid} →
 *       $api->items->itemWishlist->getHdr($usersId, $itemWishlistHdrUid) →
 *       list of ItemWishlistHdrGetItem
 *   POST /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid} →
 *       $api->items->itemWishlist->createHdr($usersId, $itemWishlistHdrUid, $data) →
 *       list of ItemWishlistHdrCreateItem
 *   GET /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid} →
 *       $api->items->itemWishlist->getHdrLine($usersId, $itemWishlistHdrUid, $itemWishlistLineUid) →
 *       ItemWishlistHdrCreateItem
 *   PUT /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid} →
 *       $api->items->itemWishlist->updateHdrLine($usersId, $itemWishlistHdrUid, $itemWishlistLineUid, $data) →
 *       ItemWishlistHdrCreateItem
 *   DELETE /item-wishlist/{usersId}/hdr/{itemWishlistHdrUid}/line/{itemWishlistLineUid} →
 *       $api->items->itemWishlist->deleteHdrLine($usersId, $itemWishlistHdrUid, $itemWishlistLineUid) →
 *       ItemWishlistHdrCreateItem
 *   GET /locations/{locationId}/bins → $api->items->locations->listBins($locationId) →
 *       list of InvMastLocationsBinsListItem
 *   GET /locations/{locationId}/bins/{bin} → $api->items->locations->getBins($locationId, $bin) →
 *       list of InvMastLocationsBinsListItem
 *   GET /p21/inv-mast → $api->items->p21->listInvMast() → list of InvMastGetData
 *   GET /variants → $api->items->variants->list() → list of VariantsListItem
 *   POST /variants → $api->items->variants->create($data) → VariantsListItem
 *   GET /variants/{itemVariantHdrUid} → $api->items->variants->get($itemVariantHdrUid) →
 *       VariantsListItem
 *   PUT /variants/{itemVariantHdrUid} → $api->items->variants->update($itemVariantHdrUid, $data) →
 *       VariantsListItem
 *   DELETE /variants/{itemVariantHdrUid} → $api->items->variants->delete($itemVariantHdrUid) →
 *       VariantsListItem
 *   GET /variants/{itemVariantHdrUid}/attributes →
 *       $api->items->variants->listAttributes($itemVariantHdrUid) →
 *       list of VariantsAttributesListItem
 *   POST /variants/{itemVariantHdrUid}/attributes →
 *       $api->items->variants->createAttributes($itemVariantHdrUid, $data) →
 *       VariantsAttributesListItem
 *   GET /variants/{itemVariantHdrUid}/attributes/{attributeUid} →
 *       $api->items->variants->getAttributes($itemVariantHdrUid, $attributeUid) →
 *       VariantsAttributesListItem
 *   PUT /variants/{itemVariantHdrUid}/attributes/{attributeUid} →
 *       $api->items->variants->updateAttributes($itemVariantHdrUid, $attributeUid, $data) →
 *       VariantsAttributesListItem
 *   DELETE /variants/{itemVariantHdrUid}/attributes/{attributeUid} →
 *       $api->items->variants->deleteAttributes($itemVariantHdrUid, $attributeUid) →
 *       VariantsAttributesListItem
 *   GET /variants/{itemVariantHdrUid}/doc → $api->items->variants->listDoc($itemVariantHdrUid) →
 *       VariantsDocListData
 *   GET /variants/{itemVariantHdrUid}/lines →
 *       $api->items->variants->listLines($itemVariantHdrUid) → list of VariantsLinesListItem
 *   POST /variants/{itemVariantHdrUid}/lines →
 *       $api->items->variants->createLines($itemVariantHdrUid, $data) → VariantsLinesListItem
 *   GET /variants/{itemVariantHdrUid}/lines/{itemVariantLineUid} →
 *       $api->items->variants->getLines($itemVariantHdrUid, $itemVariantLineUid) →
 *       VariantsLinesListItem
 *   PUT /variants/{itemVariantHdrUid}/lines/{itemVariantLineUid} →
 *       $api->items->variants->updateLines($itemVariantHdrUid, $itemVariantLineUid, $data) →
 *       VariantsLinesListItem
 *   DELETE /variants/{itemVariantHdrUid}/lines/{itemVariantLineUid} →
 *       $api->items->variants->deleteLines($itemVariantHdrUid, $itemVariantLineUid) →
 *       VariantsLinesListItem
 *   GET /variants/{itemVariantHdrUid}/similar →
 *       $api->items->variants->listSimilar($itemVariantHdrUid) → list of VariantsSimilarListItem
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
