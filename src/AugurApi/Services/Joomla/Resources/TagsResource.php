<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Tags resource.
 *
 * @fullPath api.joomla.tags
 * @service joomla
 * @domain cms
 */
final class TagsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get tag list.
     *
     * @fullPath api.joomla.tags.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/tags', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
