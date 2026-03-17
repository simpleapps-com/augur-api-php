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
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /trans-web-display-type/defaults
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDefaults(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/defaults', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /trans-web-display-type/definition
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDefinition(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/definition', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /trans-web-display-type/{webDisplayTypeUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $web_display_type_uid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{webDisplayTypeUid}',
            ['web_display_type_uid' => (string) $web_display_type_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /trans-web-display-type/{webDisplayTypeUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $web_display_type_uid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{webDisplayTypeUid}',
            $params,
            ['web_display_type_uid' => (string) $web_display_type_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /trans-web-display-type/{webDisplayTypeUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $web_display_type_uid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{webDisplayTypeUid}',
            $data,
            ['web_display_type_uid' => (string) $web_display_type_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
