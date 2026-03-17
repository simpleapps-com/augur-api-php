<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * location resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-core
 */
final class LocationResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /location
     *
     * Response data type: array
     * Known fields: locationId, companyId, defaultBranchId, deleteFlag, dateCreated, dateLastModified, lastMaintainedBy, locationName, ... (19 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /location/{locationId}
     *
     * Response data type: object
     * Known fields: locationId, companyId, defaultBranchId, deleteFlag, dateCreated, dateLastModified, lastMaintainedBy, locationName, ... (19 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(float $locationId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{locationId}',
            $params,
            ['locationId' => (string) $locationId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
