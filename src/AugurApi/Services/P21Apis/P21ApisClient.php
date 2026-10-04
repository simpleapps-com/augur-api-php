<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\P21Apis\Resources\EntityContactsResource;
use AugurApi\Services\P21Apis\Resources\EntityCustomersResource;
use AugurApi\Services\P21Apis\Resources\TransCompanyResource;
use AugurApi\Services\P21Apis\Resources\TransPurchaseOrderReceiptResource;
use AugurApi\Services\P21Apis\Resources\TransUserResource;
use AugurApi\Services\P21Apis\Resources\TransWebDisplayTypeResource;

/**
 * P21Apis service client — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://p21-apis.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://p21-apis.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://p21-apis.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-apis
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /entity-contacts/refresh → $api->p21Apis->entityContacts->getRefresh() → bool
 *   GET /entity-customers/refresh → $api->p21Apis->entityCustomers->getRefresh() → bool
 *   GET /trans-company/{companyUid} → $api->p21Apis->transCompany->get($companyUid) → untyped
 *   GET /trans-purchase-order-receipt/{poNo} →
 *       $api->p21Apis->transPurchaseOrderReceipt->get($poNo) → untyped
 *   GET /trans-user/{usersUid} → $api->p21Apis->transUser->get($usersUid) → untyped
 *   POST /trans-web-display-type → $api->p21Apis->transWebDisplayType->create($data) → untyped
 *   GET /trans-web-display-type/definition → $api->p21Apis->transWebDisplayType->listDefinition() →
 *       untyped
 *   GET /trans-web-display-type/{webDisplayTypeUid} →
 *       $api->p21Apis->transWebDisplayType->get($webDisplayTypeUid) → untyped
 *   PUT /trans-web-display-type/{webDisplayTypeUid} →
 *       $api->p21Apis->transWebDisplayType->update($webDisplayTypeUid, $data) → untyped
 *   DELETE /trans-web-display-type/{webDisplayTypeUid} →
 *       $api->p21Apis->transWebDisplayType->delete($webDisplayTypeUid) → untyped
 */
final class P21ApisClient extends BaseServiceClient
{
    public readonly EntityContactsResource $entityContacts;
    public readonly EntityCustomersResource $entityCustomers;
    public readonly TransCompanyResource $transCompany;
    public readonly TransPurchaseOrderReceiptResource $transPurchaseOrderReceipt;
    public readonly TransUserResource $transUser;
    public readonly TransWebDisplayTypeResource $transWebDisplayType;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->entityContacts = new EntityContactsResource($this->client, $this->baseUrl . '/entity-contacts');
        $this->entityCustomers = new EntityCustomersResource($this->client, $this->baseUrl . '/entity-customers');
        $this->transCompany = new TransCompanyResource($this->client, $this->baseUrl . '/trans-company');
        $this->transPurchaseOrderReceipt = new TransPurchaseOrderReceiptResource($this->client, $this->baseUrl . '/trans-purchase-order-receipt');
        $this->transUser = new TransUserResource($this->client, $this->baseUrl . '/trans-user');
        $this->transWebDisplayType = new TransWebDisplayTypeResource($this->client, $this->baseUrl . '/trans-web-display-type');
    }

    protected function getServiceName(): string
    {
        return 'p21Apis';
    }
}
