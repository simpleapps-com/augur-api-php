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
 * Public specs (the source of truth for every shape in this file):
 *   https://vmi.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://vmi.augur-api.com/openapi.json: the full contract: request and response bodies field by
 *       field, descriptions, formats and documented errors.
 *   https://vmi.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /distributors → $api->vmi->distributors->list() → list of DistributorsListItem
 *   POST /distributors → $api->vmi->distributors->create($data) → DistributorsListItem
 *   GET /distributors/{distributorsUid} → $api->vmi->distributors->get($distributorsUid) →
 *       DistributorsListItem
 *   PUT /distributors/{distributorsUid} →
 *       $api->vmi->distributors->update($distributorsUid, $data) → bool
 *   DELETE /distributors/{distributorsUid} → $api->vmi->distributors->delete($distributorsUid) →
 *       bool
 *   PUT /distributors/{distributorsUid}/enable →
 *       $api->vmi->distributors->updateEnable($distributorsUid, $data) →
 *       DistributorsEnableUpdateData
 *   POST /distributors/{distributorsUid}/products →
 *       $api->vmi->distributors->createProducts($distributorsUid, $data) →
 *       DistributorsProductsCreateData
 *   GET /inv-profile-hdr → $api->vmi->invProfileHdr->list() → list of InvProfileHdrListItem
 *   POST /inv-profile-hdr → $api->vmi->invProfileHdr->create($data) → InvProfileHdrCreateData
 *   POST /inv-profile-hdr/{customerId}/upload →
 *       $api->vmi->invProfileHdr->createUpload($customerId, $data) → InvProfileHdrUploadCreateData
 *   GET /inv-profile-hdr/{invProfileHdrUid} → $api->vmi->invProfileHdr->get($invProfileHdrUid) →
 *       InvProfileHdrListItem
 *   PUT /inv-profile-hdr/{invProfileHdrUid} →
 *       $api->vmi->invProfileHdr->update($invProfileHdrUid, $data) → InvProfileHdrCreateData
 *   DELETE /inv-profile-hdr/{invProfileHdrUid} →
 *       $api->vmi->invProfileHdr->delete($invProfileHdrUid) → bool
 *   GET /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line →
 *       $api->vmi->invProfileHdr->listInvProfileLine($invProfileHdrUid) →
 *       list of InvProfileHdrInvProfileLineListItem
 *   POST /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line →
 *       $api->vmi->invProfileHdr->createInvProfileLine($invProfileHdrUid, $data) →
 *       list of InvProfileHdrInvProfileLineListItem
 *   GET /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid} →
 *       $api->vmi->invProfileHdr->getInvProfileLine($invProfileHdrUid, $invProfileLineUid) →
 *       InvProfileHdrInvProfileLineListItem
 *   PUT /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid} →
 *       $api->vmi->invProfileHdr->updateInvProfileLine($invProfileHdrUid, $invProfileLineUid, $data) →
 *       bool
 *   DELETE /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid} →
 *       $api->vmi->invProfileHdr->deleteInvProfileLine($invProfileHdrUid, $invProfileLineUid) →
 *       bool
 *   GET /products → $api->vmi->products->list() → list of DistributorsProductsCreateData
 *   GET /products/find → $api->vmi->products->listFind() → list of ProductsFindListItem
 *   GET /products/{productsUid} → $api->vmi->products->get($productsUid) →
 *       DistributorsProductsCreateData
 *   PUT /products/{productsUid} → $api->vmi->products->update($productsUid, $data) → bool
 *   DELETE /products/{productsUid} → $api->vmi->products->delete($productsUid) → bool
 *   PUT /products/{productsUid}/enable → $api->vmi->products->updateEnable($productsUid, $data) →
 *       DistributorsEnableUpdateData
 *   GET /restock-hdr → $api->vmi->restockHdr->list() → list of RestockHdrListItem
 *   POST /restock-hdr → $api->vmi->restockHdr->create($data) → RestockHdrCreateData
 *   GET /restock-hdr/{restockHdrUid} → $api->vmi->restockHdr->get($restockHdrUid) →
 *       RestockHdrListItem
 *   PUT /restock-hdr/{restockHdrUid} → $api->vmi->restockHdr->update($restockHdrUid, $data) → bool
 *   DELETE /restock-hdr/{restockHdrUid} → $api->vmi->restockHdr->delete($restockHdrUid) → bool
 *   GET /sections → $api->vmi->sections->list() → list of SectionsListItem
 *   POST /sections → $api->vmi->sections->create($data) → SectionsListItem
 *   GET /sections/{sectionsUid} → $api->vmi->sections->get($sectionsUid) → SectionsListItem
 *   PUT /sections/{sectionsUid} → $api->vmi->sections->update($sectionsUid, $data) → bool
 *   DELETE /sections/{sectionsUid} → $api->vmi->sections->delete($sectionsUid) → bool
 *   PUT /sections/{sectionsUid}/enable → $api->vmi->sections->updateEnable($sectionsUid, $data) →
 *       DistributorsEnableUpdateData
 *   GET /warehouse → $api->vmi->warehouse->list() → list of WarehouseListItem
 *   POST /warehouse → $api->vmi->warehouse->create($data) → WarehouseCreateData
 *   GET /warehouse/{warehouseUid} → $api->vmi->warehouse->get($warehouseUid) → WarehouseListItem
 *   PUT /warehouse/{warehouseUid} → $api->vmi->warehouse->update($warehouseUid, $data) →
 *       WarehouseCreateData
 *   DELETE /warehouse/{warehouseUid} → $api->vmi->warehouse->delete($warehouseUid) →
 *       WarehouseCreateData
 *   POST /warehouse/{warehouseUid}/adjust →
 *       $api->vmi->warehouse->createAdjust($warehouseUid, $data) →
 *       list of WarehouseAdjustCreateItem
 *   GET /warehouse/{warehouseUid}/availability →
 *       $api->vmi->warehouse->listAvailability($warehouseUid) → WarehouseAvailabilityListData
 *   PUT /warehouse/{warehouseUid}/enable →
 *       $api->vmi->warehouse->updateEnable($warehouseUid, $data) → DistributorsEnableUpdateData
 *   POST /warehouse/{warehouseUid}/receive →
 *       $api->vmi->warehouse->createReceive($warehouseUid, $data) →
 *       list of WarehouseReceiveCreateItem
 *   GET /warehouse/{warehouseUid}/replenish → $api->vmi->warehouse->listReplenish($warehouseUid) →
 *       WarehouseReplenishListData
 *   POST /warehouse/{warehouseUid}/usage →
 *       $api->vmi->warehouse->createUsage($warehouseUid, $data) → WarehouseUsageCreateData
 *   GET /warehouse/{warehouseUid}/users → $api->vmi->warehouse->listUsers($warehouseUid) →
 *       list of WarehouseUsersListItem
 *   POST /warehouse/{warehouseUid}/users →
 *       $api->vmi->warehouse->createUsers($warehouseUid, $data) → WarehouseUsersCreateData
 *   GET /warehouse/{warehouseUid}/users/{usersId} →
 *       $api->vmi->warehouse->getUsers($warehouseUid, $usersId) → WarehouseUsersListItem
 *   PUT /warehouse/{warehouseUid}/users/{usersId} →
 *       $api->vmi->warehouse->updateUsers($warehouseUid, $usersId, $data) →
 *       WarehouseUsersCreateData
 *   DELETE /warehouse/{warehouseUid}/users/{usersId} →
 *       $api->vmi->warehouse->deleteUsers($warehouseUid, $usersId) → WarehouseUsersCreateData
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
        $this->distributors = new DistributorsResource($this->client, $this->baseUrl . '/distributors');
        $this->invProfileHdr = new InvProfileHdrResource($this->client, $this->baseUrl . '/inv-profile-hdr');
        $this->products = new ProductsResource($this->client, $this->baseUrl . '/products');
        $this->restockHdr = new RestockHdrResource($this->client, $this->baseUrl . '/restock-hdr');
        $this->sections = new SectionsResource($this->client, $this->baseUrl . '/sections');
        $this->warehouse = new WarehouseResource($this->client, $this->baseUrl . '/warehouse');
    }

    protected function getServiceName(): string
    {
        return 'vmi';
    }
}
