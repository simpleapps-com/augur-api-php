<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * transCompany resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-apis
 */
final class TransCompanyResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /trans-company
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /trans-company/{companyUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function delete(int $companyUid, array $params = []): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{companyUid}',
            ['companyUid' => (string) $companyUid],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /trans-company/{companyUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $companyUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{companyUid}',
            $params,
            ['companyUid' => (string) $companyUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /trans-company/{companyUid}
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function update(int $companyUid, array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{companyUid}',
            $data,
            ['companyUid' => (string) $companyUid],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
