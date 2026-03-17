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
 * P21Apis service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-apis
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
        $this->entityContacts = new EntityContactsResource($client, $this->baseUrl . '/entity-contacts');
        $this->entityCustomers = new EntityCustomersResource($client, $this->baseUrl . '/entity-customers');
        $this->transCategory = new TransCategoryResource($client, $this->baseUrl . '/trans-category');
        $this->transCompany = new TransCompanyResource($client, $this->baseUrl . '/trans-company');
        $this->transPurchaseOrderReceipt = new TransPurchaseOrderReceiptResource($client, $this->baseUrl . '/trans-purchase-order-receipt');
        $this->transUser = new TransUserResource($client, $this->baseUrl . '/trans-user');
        $this->transWebDisplayType = new TransWebDisplayTypeResource($client, $this->baseUrl . '/trans-web-display-type');
    }

    protected function getServiceName(): string
    {
        return 'p21Apis';
    }
}
