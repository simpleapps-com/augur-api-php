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
