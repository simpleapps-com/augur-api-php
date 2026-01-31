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
use AugurApi\Services\P21Core\Resources\LocationResource;
use AugurApi\Services\P21Core\Resources\PaymentTypesResource;

/**
 * P21 Core service client.
 *
 * Prophet 21 core data (address, branch, company, location, users, etc.).
 *
 * @fullPath api.p21Core
 * @service p21_core
 * @domain p21
 */
final class P21CoreClient extends BaseServiceClient
{
    public readonly AddressResource $address;
    public readonly CashDrawerResource $cashDrawer;
    public readonly CodeP21Resource $codeP21;
    public readonly CompanyResource $company;
    public readonly LocationResource $location;
    public readonly PaymentTypesResource $paymentTypes;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->address = new AddressResource($client, $this->baseUrl);
        $this->cashDrawer = new CashDrawerResource($client, $this->baseUrl);
        $this->codeP21 = new CodeP21Resource($client, $this->baseUrl);
        $this->company = new CompanyResource($client, $this->baseUrl);
        $this->location = new LocationResource($client, $this->baseUrl);
        $this->paymentTypes = new PaymentTypesResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'p21Core';
    }
}
