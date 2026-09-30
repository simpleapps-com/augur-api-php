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
     *   microservicesUid: int
     *   name: string|null
     *   id: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
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
     * POST /microservices
     *
     * Response data type: object
     *   microservicesUid: int
     *   name: string|null
     *   id: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /microservices/{microservicesUid}
     *
     * @return BaseResponse<mixed>
     */
    public function delete(int $microservicesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{microservicesUid}',
            ['microservicesUid' => (string) $microservicesUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /microservices/{microservicesUid}
     *
     * Response data type: object
     *   microservicesUid: int
     *   name: string|null
     *   id: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /microservices/{microservicesUid}
     *
     * Response data type: object
     *   microservicesUid: int
     *   name: string|null
     *   id: string|null
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   dateCreated: string
     *   dateLastModified: string
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
