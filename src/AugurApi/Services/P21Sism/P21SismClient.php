<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Sism;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\P21Sism\Resources\ImpOeLineResource;
use AugurApi\Services\P21Sism\Resources\ImportResource;
use AugurApi\Services\P21Sism\Resources\ScheduledImportMasterResource;

/**
 * P21 SISM service client.
 *
 * Prophet 21 SISM import/export (import suspense, scheduled imports, etc.).
 *
 * @fullPath api.p21Sism
 * @service p21_sism
 * @domain p21
 */
final class P21SismClient extends BaseServiceClient
{
    public readonly ImpOeLineResource $impOeLine;
    public readonly ImportResource $import;
    public readonly ScheduledImportMasterResource $scheduledImportMaster;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->impOeLine = new ImpOeLineResource($client, $this->baseUrl);
        $this->import = new ImportResource($client, $this->baseUrl);
        $this->scheduledImportMaster = new ScheduledImportMasterResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'p21Sism';
    }
}
