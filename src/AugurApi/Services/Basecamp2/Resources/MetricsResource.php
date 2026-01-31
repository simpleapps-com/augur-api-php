<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Metrics resource.
 *
 * @fullPath api.basecamp2.metrics
 * @service basecamp2
 * @domain project-management
 */
final class MetricsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List all metrics with pagination.
     *
     * @fullPath api.basecamp2.metrics.list
     * @param array<string, mixed> $params List parameters including pagination and ordering
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/metrics', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
