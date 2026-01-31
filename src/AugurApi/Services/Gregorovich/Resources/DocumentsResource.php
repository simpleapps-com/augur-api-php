<?php

declare(strict_types=1);

namespace AugurApi\Services\Gregorovich\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Documents resource.
 *
 * @fullPath api.gregorovich.documents
 * @service gregorovich
 * @domain document-management
 */
final class DocumentsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List documents in the AI knowledge base.
     *
     * @fullPath api.gregorovich.documents.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/documents', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
