<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * P21 code resource.
 *
 * @fullPath api.p21Core.codeP21
 * @service p21-core
 * @domain system-configuration
 */
final class CodeP21Resource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List P21 system codes.
     *
     * @fullPath api.p21Core.codeP21.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/code-p21', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
