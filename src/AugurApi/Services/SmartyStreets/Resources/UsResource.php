<?php

declare(strict_types=1);

namespace AugurApi\Services\SmartyStreets\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * us resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py smarty-streets
 */
final class UsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /us/lookup
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
