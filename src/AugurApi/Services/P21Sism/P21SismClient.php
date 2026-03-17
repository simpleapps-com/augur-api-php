<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Sism;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\P21Sism\Resources\ImportResource;
use AugurApi\Services\P21Sism\Resources\ScheduledImportMasterResource;

/**
 * P21Sism service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-sism
 */
final class P21SismClient extends BaseServiceClient
{
    public readonly ImportResource $import;
    public readonly ScheduledImportMasterResource $scheduledImportMaster;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->import = new ImportResource($client, $this->baseUrl . '/import');
        $this->scheduledImportMaster = new ScheduledImportMasterResource($client, $this->baseUrl . '/scheduled-import-master');
    }

    protected function getServiceName(): string
    {
        return 'p21Sism';
    }
}
