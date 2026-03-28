<?php

declare(strict_types=1);

namespace AugurApi\Services\Slack\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * webHook resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py slack
 */
final class WebHookResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /web-hook
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
     * GET /web-hook/refresh
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getRefresh(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/refresh', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
