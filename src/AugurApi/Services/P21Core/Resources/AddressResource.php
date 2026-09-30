<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * address resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-core
 */
final class AddressResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /address
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /address/refresh
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getRefresh(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/refresh', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /address/{id}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /address/{id}/corp-address
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listCorpAddress(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/corp-address',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /address/{id}/default
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listDefault(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/default',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /address/{id}/enable
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getEnable(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/enable',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
