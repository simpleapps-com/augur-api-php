<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Inv Mast UD resource.
 *
 * @fullPath api.items.invMastUd
 * @service items
 * @domain inventory-management
 */
final class InvMastUdResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List inventory master user-defined records.
     *
     * @fullPath api.items.invMastUd.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/inv-mast-ud', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
