<?php

declare(strict_types=1);

namespace AugurApi\Services\Gregorovich\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Ollama resource.
 *
 * @fullPath api.gregorovich.ollama
 * @service gregorovich
 * @domain ai-generation
 */
final class OllamaResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Generate content using local Ollama AI models.
     *
     * @fullPath api.gregorovich.ollama.generate.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function generate(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/ollama/generate', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
