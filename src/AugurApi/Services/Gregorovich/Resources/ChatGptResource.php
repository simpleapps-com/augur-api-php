<?php

declare(strict_types=1);

namespace AugurApi\Services\Gregorovich\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * ChatGpt resource.
 *
 * @fullPath api.gregorovich.chatGpt
 * @service gregorovich
 * @domain ai-conversation
 */
final class ChatGptResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Ask ChatGPT a question.
     *
     * @fullPath api.gregorovich.chatGpt.ask.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function ask(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/chat-gpt/ask', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
