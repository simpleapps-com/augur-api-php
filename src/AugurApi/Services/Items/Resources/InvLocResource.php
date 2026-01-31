<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Inv Loc resource.
 *
 * @fullPath api.items.invLoc
 * @service items
 * @domain inventory-management
 */
final class InvLocResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List inventory locations.
     *
     * @fullPath api.items.invLoc.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/inv-loc', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
