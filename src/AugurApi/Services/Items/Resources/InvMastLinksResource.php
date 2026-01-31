<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Inv Mast Links resource.
 *
 * @fullPath api.items.invMastLinks
 * @service items
 * @domain inventory-management
 */
final class InvMastLinksResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List inventory master links.
     *
     * @fullPath api.items.invMastLinks.list
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(int $invMastUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast-links/{invMastUid}',
            [],
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
