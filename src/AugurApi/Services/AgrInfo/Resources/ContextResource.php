<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Context resource.
 *
 * @fullPath api.agrInfo.context
 * @service agr-info
 * @domain site-context
 */
final class ContextResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get context for a site.
     *
     * @fullPath api.agrInfo.context.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $siteId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/context/{siteId}',
            $params,
            ['siteId' => $siteId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
