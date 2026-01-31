<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\P21Apis\Resources\EntityContactsResource;
use AugurApi\Services\P21Apis\Resources\EntityCustomersResource;
use AugurApi\Services\P21Apis\Resources\TransCategoryResource;
use AugurApi\Services\P21Apis\Resources\TransCompanyResource;
use AugurApi\Services\P21Apis\Resources\TransPurchaseOrderReceiptResource;
use AugurApi\Services\P21Apis\Resources\TransUserResource;
use AugurApi\Services\P21Apis\Resources\TransWebDisplayTypeResource;

/**
 * P21 APIs service client.
 *
 * Prophet 21 transactional API integration.
 *
 * @fullPath api.p21Apis
 * @service p21_apis
 * @domain p21
 */
final class P21ApisClient extends BaseServiceClient
{
    public readonly EntityContactsResource $entityContacts;
    public readonly EntityCustomersResource $entityCustomers;
    public readonly TransCategoryResource $transCategory;
    public readonly TransCompanyResource $transCompany;
    public readonly TransPurchaseOrderReceiptResource $transPurchaseOrderReceipt;
    public readonly TransUserResource $transUser;
    public readonly TransWebDisplayTypeResource $transWebDisplayType;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->entityContacts = new EntityContactsResource($client, $this->baseUrl);
        $this->entityCustomers = new EntityCustomersResource($client, $this->baseUrl);
        $this->transCategory = new TransCategoryResource($client, $this->baseUrl);
        $this->transCompany = new TransCompanyResource($client, $this->baseUrl);
        $this->transPurchaseOrderReceipt = new TransPurchaseOrderReceiptResource($client, $this->baseUrl);
        $this->transUser = new TransUserResource($client, $this->baseUrl);
        $this->transWebDisplayType = new TransWebDisplayTypeResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'p21Apis';
    }
}
