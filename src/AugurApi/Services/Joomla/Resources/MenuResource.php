<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;
use AugurApi\Core\Schemas\EdgeCache;

/**
 * Menu resource.
 *
 * @fullPath api.joomla.menu
 * @service joomla
 * @domain cms
 */
final class MenuResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get menu doc.
     *
     * @fullPath api.joomla.menu.getDoc
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $id, ?EdgeCache $edgeCache = null): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/menu/{id}/doc',
            $edgeCache !== null ? ['edgeCache' => $edgeCache->value] : [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
