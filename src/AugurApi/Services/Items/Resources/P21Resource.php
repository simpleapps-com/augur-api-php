<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * p21 resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 */
final class P21Resource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /p21/inv-mast
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listInvMast(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/inv-mast', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
