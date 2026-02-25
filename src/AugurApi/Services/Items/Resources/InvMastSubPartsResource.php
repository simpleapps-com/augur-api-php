<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;
use AugurApi\Core\Schemas\EdgeCache;

/**
 * Inv Mast Sub Parts resource.
 *
 * @fullPath api.items.invMastSubParts
 * @service items
 * @domain inventory-management
 */
final class InvMastSubPartsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List inventory master sub parts.
     *
     * @fullPath api.items.invMastSubParts.list
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(int $invMastUid, ?EdgeCache $edgeCache = null): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast-sub-parts/{invMastUid}',
            $edgeCache !== null ? ['edgeCache' => $edgeCache->value] : [],
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
