<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * items resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py open-search
 */
final class ItemsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /items
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
     * PUT /items/refresh
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function updateRefresh(array $data = []): BaseResponse
    {
        $response = $this->client->put($this->baseUrl, '/refresh', $data);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /items/{invMastUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /items/{invMastUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function update(int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /items/{invMastUid}/refresh
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getRefresh(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/refresh',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
