<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * P21 resource.
 *
 * @fullPath api.items.p21
 * @service items
 * @domain inventory-management
 */
final class P21Resource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List raw P21 inventory master data.
     *
     * @fullPath api.items.p21.invMast.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listInvMast(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/p21/inv-mast', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
