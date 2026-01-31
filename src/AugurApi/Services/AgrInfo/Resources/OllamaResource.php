<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Ollama resource.
 *
 * @fullPath api.agrInfo.ollama
 * @service agr-info
 * @domain ai-model-management
 */
final class OllamaResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get list of available Ollama AI model tags.
     *
     * @fullPath api.agrInfo.ollama.tags.list
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listTags(): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/ollama/tags', []);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
