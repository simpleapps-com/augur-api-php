<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * company resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-core
 */
final class CompanyResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /company
     *
     * Response data type: array
     * Known fields: companyUid, companyId, companyName, dateCreated, dateLastModified, deleteFlag, updateCd, lastMaintainedBy, ... (14 total)
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
     * GET /company/{companyUid}
     *
     * Response data type: object
     * Known fields: companyUid, companyId, companyName, dateCreated, dateLastModified, deleteFlag, updateCd, lastMaintainedBy, ... (14 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $companyUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{companyUid}',
            $params,
            ['companyUid' => (string) $companyUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
