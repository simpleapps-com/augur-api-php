<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Internal resource.
 *
 * @fullPath api.items.internal
 * @service items
 * @domain document-generation
 */
final class InternalResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Generate PDF document.
     *
     * @fullPath api.items.internal.pdf.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createPdf(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/internal/pdf', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
