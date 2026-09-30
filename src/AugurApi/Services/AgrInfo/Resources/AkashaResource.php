<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * akasha resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-info
 */
final class AkashaResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /akasha/generate
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createGenerate(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/generate', $data);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
