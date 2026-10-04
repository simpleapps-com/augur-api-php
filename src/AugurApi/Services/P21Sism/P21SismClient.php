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
 * Public specs (the source of truth for every shape in this file):
 *   https://p21-sism.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://p21-sism.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://p21-sism.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-sism
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /import → $api->p21Sism->import->list() → list of ImportListItem
 *   GET /import/daily-summary → $api->p21Sism->import->listDailySummary() →
 *       list of ImportDailySummaryListItem
 *   GET /import/recent → $api->p21Sism->import->listRecent() → list of ImportRecentListItem
 *   GET /import/stuck → $api->p21Sism->import->listStuck() → list of ImportRecentListItem
 *   GET /import/{importUid} → $api->p21Sism->import->get($importUid) → ImportListItem
 *   PUT /import/{importUid} → $api->p21Sism->import->update($importUid, $data) → ImportListItem
 *   DELETE /import/{importUid} → $api->p21Sism->import->delete($importUid) → ImportDeleteData
 *   GET /import/{importUid}/imp-oe-hdr → $api->p21Sism->import->listImpOeHdr($importUid) →
 *       ImportImpOeHdrListData
 *   PUT /import/{importUid}/imp-oe-hdr → $api->p21Sism->import->updateImpOeHdr($importUid, $data) →
 *       ImportImpOeHdrListData
 *   GET /import/{importUid}/imp-oe-hdr-salesrep →
 *       $api->p21Sism->import->listImpOeHdrSalesrep($importUid) → ImportImpOeHdrSalesrepListData
 *   PUT /import/{importUid}/imp-oe-hdr-salesrep →
 *       $api->p21Sism->import->updateImpOeHdrSalesrep($importUid, $data) →
 *       ImportImpOeHdrSalesrepListData
 *   GET /import/{importUid}/imp-oe-hdr-web → $api->p21Sism->import->listImpOeHdrWeb($importUid) →
 *       ImportImpOeHdrWebListData
 *   POST /scheduled-import-master/{scheduledImportMasterUid}/metadata/sftp →
 *       $api->p21Sism->scheduledImportMaster->createMetadataSftp($scheduledImportMasterUid, $data) →
 *       ScheduledImportMasterMetadataSftpCreateData
 */
final class P21SismClient extends BaseServiceClient
{
    public readonly ImportResource $import;
    public readonly ScheduledImportMasterResource $scheduledImportMaster;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->import = new ImportResource($this->client, $this->baseUrl . '/import');
        $this->scheduledImportMaster = new ScheduledImportMasterResource($this->client, $this->baseUrl . '/scheduled-import-master');
    }

    protected function getServiceName(): string
    {
        return 'p21Sism';
    }
}
