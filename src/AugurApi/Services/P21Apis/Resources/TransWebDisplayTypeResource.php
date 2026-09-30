<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * transWebDisplayType resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-apis
 */
final class TransWebDisplayTypeResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /trans-web-display-type
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
     * GET /trans-web-display-type/defaults
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listDefaults(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/defaults', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /trans-web-display-type/definition
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listDefinition(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/definition', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /trans-web-display-type/{webDisplayTypeUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function delete(int $webDisplayTypeUid, array $params = []): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{webDisplayTypeUid}',
            ['webDisplayTypeUid' => (string) $webDisplayTypeUid],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /trans-web-display-type/{webDisplayTypeUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $webDisplayTypeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{webDisplayTypeUid}',
            $params,
            ['webDisplayTypeUid' => (string) $webDisplayTypeUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /trans-web-display-type/{webDisplayTypeUid}
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function update(int $webDisplayTypeUid, array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{webDisplayTypeUid}',
            $data,
            ['webDisplayTypeUid' => (string) $webDisplayTypeUid],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
