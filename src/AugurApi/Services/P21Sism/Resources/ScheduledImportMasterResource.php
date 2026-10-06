<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Sism\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * scheduledImportMaster resource — generated from spec.
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
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ScheduledImportMasterListItem:
 * Returned by: $api->p21Sism->scheduledImportMaster->list()
 * Returned by: $api->p21Sism->scheduledImportMaster->get($scheduledImportMasterUid)
 *   scheduledImportMasterUid: int — P21 scheduled import master ID (the value for p21_sism
 *       default_scheduled_import_master_uid)
 *   impexpSourceUid: int — P21 import/export source (11 = Seller Import)
 *   transactionSetUid: int — P21 transaction set (1 = Sales Order)
 *   pollingPath: string — Folder P21 polls for import files (max 200 chars)
 *   transactionLogPath: string — Folder P21 writes import transaction logs to (max 200 chars)
 *   transactionSumPath: string — Folder P21 writes import summary files to (max 200 chars)
 *   transactionSusPath: string — Folder P21 writes suspended import files to (max 200 chars)
 *   transactionErrPath: string — Folder P21 writes import error files to (max 200 chars)
 *   active: string — Y when P21 runs this scheduled import (max 1 chars)
 *   dateCreated: string — Date the record was created in P21 (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   dateLastModified: string — Date the record was last modified in P21 (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   lastMaintainedBy: string — P21 user who last changed the record (max 30 chars)
 *   fileFormatCd: int|null — P21 import file format code
 *   xmlDocumentUid: int|null — P21 XML document definition, for XML imports
 *   fileLockingFlag: string — Y when P21 locks import files while reading them (max 1 chars)
 *   updateCd: int — Update code (1185 = Import Complete)
 *
 * ScheduledImportMasterMetadataSftpCreateData: The SFTP delivery metadata saved for a scheduled
 * import master
 * Returned by:
 * $api->p21Sism->scheduledImportMaster->createMetadataSftp($scheduledImportMasterUid, $data)
 *   scheduledImportMetadataUid: int — Scheduled import metadata unique ID
 *   scheduledImportMasterUid: int — Scheduled import master the metadata belongs to
 *   properties: string|null — Saved SFTP connection properties as a JSON string
 *
 * ScheduledImportMasterMetadataSftpCreateBody: SFTP connection properties for a scheduled import
 * master; the whole body is stored as-is as the metadata properties
 * Request body of:
 * $api->p21Sism->scheduledImportMaster->createMetadataSftp($scheduledImportMasterUid, $data)
 *   host?: string|null — SFTP server host name
 *   port?: string|null — SFTP server port
 *   username?: string|null — SFTP login user name
 *   password?: string|null — SFTP login password
 *   path?: string|null — Remote directory the import files are written to
 *
 * @phpstan-type ScheduledImportMasterListItem array{scheduledImportMasterUid: int, impexpSourceUid: int, transactionSetUid: int, pollingPath: string, transactionLogPath: string, transactionSumPath: string, transactionSusPath: string, transactionErrPath: string, active: string, dateCreated: string, dateLastModified: string, lastMaintainedBy: string, fileFormatCd: int|null, xmlDocumentUid: int|null, fileLockingFlag: string, updateCd: int}
 * @phpstan-type ScheduledImportMasterMetadataSftpCreateData array{scheduledImportMetadataUid: int, scheduledImportMasterUid: int, properties: string|null}
 * @phpstan-type ScheduledImportMasterMetadataSftpCreateBody array{host?: string|null, port?: string|null, username?: string|null, password?: string|null, path?: string|null}
 */
final class ScheduledImportMasterResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /scheduled-import-master
     *
     * List P21 scheduled import masters
     * Call: $api->p21Sism->scheduledImportMaster->list()
     *
     * List P21 scheduled import masters. suggestedDefault=Y returns the one to set as p21_sism
     * default_scheduled_import_master_uid.
     *
     * Errors:
     *   400: orderBy is not one scheduled_import_master column with |ASC or |DESC.
     *
     * GET https://p21-sism.augur-api.com/scheduled-import-master
     * Contract: https://p21-sism.augur-api.com/openapi.json#/paths/~1scheduled-import-master/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — limit number of results (Default: 10)
     *   offset?: int — offset (Default: 0)
     *   orderBy?: string — Order By field (Default: scheduled_import_master_uid|ASC)
     *   suggestedDefault?: string — Y returns only the suggested
     *       default_scheduled_import_master_uid: active, Seller Import (impexpSourceUid 11), Sales
     *       Order (transactionSetUid 1)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ScheduledImportMasterListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /scheduled-import-master/{scheduledImportMasterUid}
     *
     * Get one P21 scheduled import master
     * Call: $api->p21Sism->scheduledImportMaster->get($scheduledImportMasterUid)
     *
     * Errors:
     *   400: scheduledImportMasterUid is not a positive integer.
     *   404: No scheduled import master with this ID.
     *
     * GET https://p21-sism.augur-api.com/scheduled-import-master/{scheduledImportMasterUid}
     * Contract:
     * https://p21-sism.augur-api.com/openapi.json#/paths/~1scheduled-import-master~1{scheduledImportMasterUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ScheduledImportMasterListItem (fields listed on the class)
     *
     * @param string $scheduledImportMasterUid P21 scheduled import master to return
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $scheduledImportMasterUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{scheduledImportMasterUid}',
            $params,
            ['scheduledImportMasterUid' => (string) $scheduledImportMasterUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /scheduled-import-master/{scheduledImportMasterUid}/metadata/sftp
     *
     * Create SFTP metadata for a scheduled import master
     * Call:
     * $api->p21Sism->scheduledImportMaster->createMetadataSftp($scheduledImportMasterUid, $data)
     *
     * Request body: SFTP connection properties for a scheduled import master; the whole body is
     * stored as-is as the metadata properties
     * Response data: The SFTP delivery metadata saved for a scheduled import master
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST
     * https://p21-sism.augur-api.com/scheduled-import-master/{scheduledImportMasterUid}/metadata/sftp
     * Contract:
     * https://p21-sism.augur-api.com/openapi.json#/paths/~1scheduled-import-master~1{scheduledImportMasterUid}~1metadata~1sftp/post
     *
     * Request body ($data): ScheduledImportMasterMetadataSftpCreateBody (fields listed on the
     * class)
     *
     * Response data type: ScheduledImportMasterMetadataSftpCreateData (fields listed on the class)
     *
     * @param string $scheduledImportMasterUid scheduled_import_master.scheduled_import_master_uid
     * @param ScheduledImportMasterMetadataSftpCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createMetadataSftp(string $scheduledImportMasterUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{scheduledImportMasterUid}/metadata/sftp',
            $data,
            ['scheduledImportMasterUid' => (string) $scheduledImportMasterUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
