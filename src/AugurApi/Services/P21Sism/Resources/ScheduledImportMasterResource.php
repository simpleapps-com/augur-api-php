<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Sism\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * scheduledImportMaster resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-sism
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
     * @param array<string, mixed> $data
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
