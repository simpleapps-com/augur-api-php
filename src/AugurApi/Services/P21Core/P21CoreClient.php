<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\P21Core\Resources\AddressResource;
use AugurApi\Services\P21Core\Resources\CashDrawerResource;
use AugurApi\Services\P21Core\Resources\CodeP21Resource;
use AugurApi\Services\P21Core\Resources\CompanyResource;
use AugurApi\Services\P21Core\Resources\FreightCodeResource;
use AugurApi\Services\P21Core\Resources\LocationResource;
use AugurApi\Services\P21Core\Resources\PaymentTypesResource;

/**
 * P21Core service client — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://p21-core.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://p21-core.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://p21-core.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-core
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /address → $api->p21Core->address->list() → list of AddressListItem
 *   GET /address/{id} → $api->p21Core->address->get($id) → AddressListItem
 *   GET /address/{id}/corp-address → $api->p21Core->address->listCorpAddress($id) →
 *       list of AddressListItem
 *   GET /address/{id}/default → $api->p21Core->address->listDefault($id) → AddressListItem
 *   GET /address/{id}/enable → $api->p21Core->address->getEnable($id) → AddressListItem
 *   GET /cash-drawer → $api->p21Core->cashDrawer->list() → list of CashDrawerListItem
 *   GET /cash-drawer/{cashDrawerUid} → $api->p21Core->cashDrawer->get($cashDrawerUid) →
 *       CashDrawerListItem
 *   GET /code-p21 → $api->p21Core->codeP21->list() → list of CodeP21ListItem
 *   GET /code-p21/{codeUid} → $api->p21Core->codeP21->get($codeUid) → CodeP21ListItem
 *   GET /company → $api->p21Core->company->list() → list of CompanyListItem
 *   GET /company/{companyId} → $api->p21Core->company->get($companyId) → CompanyListItem
 *   GET /freight-code → $api->p21Core->freightCode->list() → list of FreightCodeListItem
 *   GET /freight-code/{freightCodeUid} → $api->p21Core->freightCode->get($freightCodeUid) →
 *       FreightCodeListItem
 *   GET /location → $api->p21Core->location->list() → list of LocationListItem
 *   GET /location/{locationId} → $api->p21Core->location->get($locationId) → LocationListItem
 *   GET /payment-types → $api->p21Core->paymentTypes->list() → list of PaymentTypesListItem
 */
final class P21CoreClient extends BaseServiceClient
{
    public readonly AddressResource $address;
    public readonly CashDrawerResource $cashDrawer;
    public readonly CodeP21Resource $codeP21;
    public readonly CompanyResource $company;
    public readonly FreightCodeResource $freightCode;
    public readonly LocationResource $location;
    public readonly PaymentTypesResource $paymentTypes;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->address = new AddressResource($this->client, $this->baseUrl . '/address');
        $this->cashDrawer = new CashDrawerResource($this->client, $this->baseUrl . '/cash-drawer');
        $this->codeP21 = new CodeP21Resource($this->client, $this->baseUrl . '/code-p21');
        $this->company = new CompanyResource($this->client, $this->baseUrl . '/company');
        $this->freightCode = new FreightCodeResource($this->client, $this->baseUrl . '/freight-code');
        $this->location = new LocationResource($this->client, $this->baseUrl . '/location');
        $this->paymentTypes = new PaymentTypesResource($this->client, $this->baseUrl . '/payment-types');
    }

    protected function getServiceName(): string
    {
        return 'p21Core';
    }
}
