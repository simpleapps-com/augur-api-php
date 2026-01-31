<?php

declare(strict_types=1);

namespace AugurApi\Services\Slack\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * WebHook resource.
 *
 * @fullPath api.slack.webHook
 * @service slack
 * @domain communication-and-notifications
 */
final class WebHookResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Send Slack webhook message.
     *
     * @fullPath api.slack.webHook.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/web-hook', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Refresh webhook configurations.
     *
     * @fullPath api.slack.webHook.refresh.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function refresh(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/web-hook/refresh', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
