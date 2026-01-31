<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Sism\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Scheduled import master resource.
 *
 * @fullPath api.p21Sism.scheduledImportMaster
 * @service p21-sism
 * @domain scheduled-import-management
 */
final class ScheduledImportMasterResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Create SFTP metadata for a scheduled import master configuration.
     *
     * @fullPath api.p21Sism.scheduledImportMaster.metadata.sftp.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createMetadataSftp(string $scheduledImportMasterUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/scheduled-import-master/{scheduledImportMasterUid}/metadata/sftp',
            $data,
            ['scheduledImportMasterUid' => $scheduledImportMasterUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
