<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Transaction company resource.
 *
 * @fullPath api.p21Apis.transCompany
 * @service p21-apis
 * @domain company-management
 */
final class TransCompanyResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Create a new transaction company.
     *
     * @fullPath api.p21Apis.transCompany.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/trans-company', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Get transaction company details by company UID.
     *
     * @fullPath api.p21Apis.transCompany.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $companyUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/trans-company/{companyUid}',
            $params,
            ['companyUid' => (string) $companyUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Update transaction company by company UID.
     *
     * @fullPath api.p21Apis.transCompany.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $companyUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/trans-company/{companyUid}',
            $data,
            ['companyUid' => (string) $companyUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete transaction company by company UID.
     *
     * @fullPath api.p21Apis.transCompany.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $companyUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/trans-company/{companyUid}',
            ['companyUid' => (string) $companyUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
