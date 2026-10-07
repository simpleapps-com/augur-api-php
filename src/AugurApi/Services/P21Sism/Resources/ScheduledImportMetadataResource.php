<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Sism\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * scheduledImportMetadata resource — generated from spec.
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
 * ScheduledImportMasterMetadataCreateData:
 * Returned by: $api->p21Sism->scheduledImportMetadata->list()
 * Returned by: $api->p21Sism->scheduledImportMetadata->get($scheduledImportMetadataUid)
 * Returned by: $api->p21Sism->scheduledImportMetadata->update($scheduledImportMetadataUid, $data)
 * Returned by: $api->p21Sism->scheduledImportMetadata->delete($scheduledImportMetadataUid)
 *   scheduledImportMetadataUid: int — Scheduled import metadata ID
 *   scheduledImportMasterUid: int — Scheduled import master this delivery method is for; one record
 *       per master
 *   deliveryMethod: string — How import:deliver reaches P21: pending_import (on-premise P21), ftp
 *       or sftp (hosted P21) (max 40 chars)
 *   properties: string|null — FTP/SFTP connection as a JSON string (host, port, username, password,
 *       path); pending_import does not read it (max 16777215 chars)
 *   dateCreated: string — Date the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — Date the record was last modified (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * ScheduledImportMetadataUpdateBody: Change the delivery method or connection properties of a
 * scheduled import metadata record; absent fields stay as they are
 * Request body of:
 * $api->p21Sism->scheduledImportMetadata->update($scheduledImportMetadataUid, $data)
 *   deliveryMethod?: string|null — New delivery method: pending_import, ftp or sftp; any casing
 *   properties?: ScheduledImportMasterMetadataSftpCreateBody — New FTP/SFTP connection; replaces
 *       the stored properties as a whole
 *
 * ScheduledImportMasterMetadataSftpCreateBody: New FTP/SFTP connection; replaces the stored
 * properties as a whole
 * Field `properties` of ScheduledImportMetadataUpdateBody
 *   host?: string|null — FTP/SFTP server host name
 *   port?: string|null — FTP/SFTP server port
 *   username?: string|null — FTP/SFTP login user name
 *   password?: string|null — FTP/SFTP login password
 *   path?: string|null — Remote directory the import files are written to
 *
 * @phpstan-type ScheduledImportMasterMetadataCreateData array{scheduledImportMetadataUid: int, scheduledImportMasterUid: int, deliveryMethod: string, properties: string|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type ScheduledImportMetadataUpdateBody array{deliveryMethod?: string|null, properties?: ScheduledImportMasterMetadataSftpCreateBody}
 * @phpstan-type ScheduledImportMasterMetadataSftpCreateBody array{host?: string|null, port?: string|null, username?: string|null, password?: string|null, path?: string|null}
 */
final class ScheduledImportMetadataResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /scheduled-import-metadata
     *
     * List scheduled import metadata
     * Call: $api->p21Sism->scheduledImportMetadata->list()
     *
     * List scheduled import metadata: the delivery method import:deliver uses for each scheduled
     * import master
     *
     * Errors:
     *   400: orderBy is not one scheduled_import_metadata column with |ASC or |DESC.
     *
     * GET https://p21-sism.augur-api.com/scheduled-import-metadata
     * Contract: https://p21-sism.augur-api.com/openapi.json#/paths/~1scheduled-import-metadata/get
     *
     * Query params ($params; `?` = optional):
     *   deliveryMethod?: string — Filter by delivery method: pending_import, ftp, sftp
     *   limit?: int — limit number of results (Default: 10)
     *   offset?: int — offset (Default: 0)
     *   orderBy?: string — Order By field (Default: scheduled_import_metadata_uid|ASC)
     *   scheduledImportMasterUid?: int — Filter by scheduled import master
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ScheduledImportMasterMetadataCreateData (fields listed on the
     * class)
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
     * DELETE /scheduled-import-metadata/{scheduledImportMetadataUid}
     *
     * Soft delete a scheduled import metadata record
     * Call: $api->p21Sism->scheduledImportMetadata->delete($scheduledImportMetadataUid)
     *
     * Soft delete a scheduled import metadata record (statusCd 700)
     *
     * Errors:
     *   404: No scheduled import metadata with this ID.
     *
     * DELETE https://p21-sism.augur-api.com/scheduled-import-metadata/{scheduledImportMetadataUid}
     * Contract:
     * https://p21-sism.augur-api.com/openapi.json#/paths/~1scheduled-import-metadata~1{scheduledImportMetadataUid}/delete
     *
     * Response data type: ScheduledImportMasterMetadataCreateData (fields listed on the class)
     *
     * @param string $scheduledImportMetadataUid Scheduled import metadata record to soft delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(string $scheduledImportMetadataUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{scheduledImportMetadataUid}',
            ['scheduledImportMetadataUid' => (string) $scheduledImportMetadataUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /scheduled-import-metadata/{scheduledImportMetadataUid}
     *
     * Get one scheduled import metadata record
     * Call: $api->p21Sism->scheduledImportMetadata->get($scheduledImportMetadataUid)
     *
     * Get one scheduled import metadata record, including its properties
     *
     * Errors:
     *   404: No scheduled import metadata with this ID.
     *
     * GET https://p21-sism.augur-api.com/scheduled-import-metadata/{scheduledImportMetadataUid}
     * Contract:
     * https://p21-sism.augur-api.com/openapi.json#/paths/~1scheduled-import-metadata~1{scheduledImportMetadataUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ScheduledImportMasterMetadataCreateData (fields listed on the class)
     *
     * @param string $scheduledImportMetadataUid Scheduled import metadata record to return
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $scheduledImportMetadataUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{scheduledImportMetadataUid}',
            $params,
            ['scheduledImportMetadataUid' => (string) $scheduledImportMetadataUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /scheduled-import-metadata/{scheduledImportMetadataUid}
     *
     * Change a scheduled import metadata record
     * Call: $api->p21Sism->scheduledImportMetadata->update($scheduledImportMetadataUid, $data)
     *
     * Change the delivery method or connection properties of a scheduled import metadata record
     *
     * Request body: Change the delivery method or connection properties of a scheduled import
     * metadata record; absent fields stay as they are
     *
     * Errors:
     *   400: Body carries neither deliveryMethod nor properties.
     *   404: No scheduled import metadata with this ID.
     *   422: Unknown deliveryMethod, or the record after the change is ftp/sftp without all five
     *       connection properties.
     *
     * PUT https://p21-sism.augur-api.com/scheduled-import-metadata/{scheduledImportMetadataUid}
     * Contract:
     * https://p21-sism.augur-api.com/openapi.json#/paths/~1scheduled-import-metadata~1{scheduledImportMetadataUid}/put
     *
     * Request body ($data): ScheduledImportMetadataUpdateBody (fields listed on the class)
     *
     * Response data type: ScheduledImportMasterMetadataCreateData (fields listed on the class)
     *
     * @param string $scheduledImportMetadataUid Scheduled import metadata record to change
     * @param ScheduledImportMetadataUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(string $scheduledImportMetadataUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{scheduledImportMetadataUid}',
            $data,
            ['scheduledImportMetadataUid' => (string) $scheduledImportMetadataUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
