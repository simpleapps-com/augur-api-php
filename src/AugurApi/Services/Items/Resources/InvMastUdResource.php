<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMastUd resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 */
final class InvMastUdResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast-ud
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
