<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Joomla resource.
 *
 * @fullPath api.agrInfo.joomla
 * @service agr-info
 * @domain ai-content-generation
 */
final class JoomlaResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Generate AI response using Joomla model.
     *
     * @fullPath api.agrInfo.joomla.generate.create
     * @param array<string, mixed> $data
     * @return BaseResponse<string>
     */
    public function generate(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/joomla/generate', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
