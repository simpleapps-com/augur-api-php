<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Usergroups resource.
 *
 * @fullPath api.joomla.usergroups
 * @service joomla
 * @domain cms
 */
final class UsergroupsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get user groups.
     *
     * @fullPath api.joomla.usergroups.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/usergroups', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
