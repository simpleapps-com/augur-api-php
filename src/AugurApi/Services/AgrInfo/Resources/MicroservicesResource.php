<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * microservices resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-info
 */
final class MicroservicesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /microservices
     *
     * Response data type: array
     * Known fields: microservicesUid, name, id, updateCd, statusCd, processCd, dateCreated, dateLastModified
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
     * POST /microservices
     *
     * Response data type: object
     * Known fields: microservicesUid, name, id, updateCd, statusCd, processCd, dateCreated, dateLastModified
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
     * DELETE /microservices/{microservicesUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $microservicesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{microservicesUid}',
            ['microservicesUid' => (string) $microservicesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /microservices/{microservicesUid}
     *
     * Response data type: object
     * Known fields: microservicesUid, name, id, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $microservicesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{microservicesUid}',
            $params,
            ['microservicesUid' => (string) $microservicesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /microservices/{microservicesUid}
     *
     * Response data type: object
     * Known fields: microservicesUid, name, id, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $microservicesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{microservicesUid}',
            $data,
            ['microservicesUid' => (string) $microservicesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
