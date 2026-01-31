<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Microservices resource.
 *
 * @fullPath api.agrInfo.microservices
 * @service agr_info
 * @domain augur
 */
final class MicroservicesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List microservices.
     *
     * @fullPath api.agrInfo.microservices.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/microservices', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get microservice details.
     *
     * @fullPath api.agrInfo.microservices.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $microservicesUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/microservices/{microservicesUid}',
            [],
            ['microservicesUid' => (string) $microservicesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create microservice.
     *
     * @fullPath api.agrInfo.microservices.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/microservices', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update microservice.
     *
     * @fullPath api.agrInfo.microservices.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $microservicesUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/microservices/{microservicesUid}',
            $data,
            ['microservicesUid' => (string) $microservicesUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete microservice.
     *
     * @fullPath api.agrInfo.microservices.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $microservicesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/microservices/{microservicesUid}',
            ['microservicesUid' => (string) $microservicesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
