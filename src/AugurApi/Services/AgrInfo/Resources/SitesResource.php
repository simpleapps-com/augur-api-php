<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * sites resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-info
 */
final class SitesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /sites/validate
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createValidate(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/validate', $data);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
