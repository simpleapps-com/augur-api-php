<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Akasha resource.
 *
 * @fullPath api.agrInfo.akasha
 * @service agr-info
 * @domain ai-content-generation
 */
final class AkashaResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Generate AI response using Akasha model.
     *
     * @fullPath api.agrInfo.akasha.generate.create
     * @param array<string, mixed> $data
     * @return BaseResponse<string>
     */
    public function generate(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/akasha/generate', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
