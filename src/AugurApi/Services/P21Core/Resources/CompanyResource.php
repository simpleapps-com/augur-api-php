<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Company resource.
 *
 * @fullPath api.p21Core.company
 * @service p21-core
 * @domain company-and-corporate-management
 */
final class CompanyResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List companies with filtering.
     *
     * @fullPath api.p21Core.company.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/company', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get company details by UID.
     *
     * @fullPath api.p21Core.company.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $companyUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/company/{companyUid}',
            $params,
            ['companyUid' => (string) $companyUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
