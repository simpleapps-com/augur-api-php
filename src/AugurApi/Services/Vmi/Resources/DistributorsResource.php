<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * distributors resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
 */
final class DistributorsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /distributors
     *
     * Response data type: array
     * Known fields: distributorsUid, customerId, distributorsId, distributorsName, distributorsDesc, distributorsEmail, distributorsAccount, dateCreated, ... (12 total)
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
     * POST /distributors
     *
     * Response data type: object
     * Known fields: distributorsUid, customerId, distributorsId, distributorsName, distributorsDesc, distributorsEmail, distributorsAccount, dateCreated, ... (12 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /distributors/{distributorsUid}
     *
     * Response data type: object
     * Known fields: distributorsUid, customerId, distributorsId, distributorsName, distributorsDesc, distributorsEmail, distributorsAccount, dateCreated, ... (12 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $distributorsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{distributorsUid}',
            ['distributorsUid' => (string) $distributorsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /distributors/{distributorsUid}
     *
     * Response data type: object
     * Known fields: distributorsUid, customerId, distributorsId, distributorsName, distributorsDesc, distributorsEmail, distributorsAccount, dateCreated, ... (12 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $distributorsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{distributorsUid}',
            $params,
            ['distributorsUid' => (string) $distributorsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /distributors/{distributorsUid}
     *
     * Response data type: object
     * Known fields: distributorsUid, customerId, distributorsId, distributorsName, distributorsDesc, distributorsEmail, distributorsAccount, dateCreated, ... (12 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $distributorsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{distributorsUid}',
            $data,
            ['distributorsUid' => (string) $distributorsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /distributors/{distributorsUid}/enable
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateEnable(int $distributorsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{distributorsUid}/enable',
            $data,
            ['distributorsUid' => (string) $distributorsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /distributors/{distributorsUid}/products
     *
     * Response data type: array
     * Known fields: productsUid, distributorsUid, productsId, productsDesc, defaultSellingUnit, dateCreated, dateLastModified, updateCd, ... (13 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createProducts(int $distributorsUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{distributorsUid}/products',
            $data,
            ['distributorsUid' => (string) $distributorsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
