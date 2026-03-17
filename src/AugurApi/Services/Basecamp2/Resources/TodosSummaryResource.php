<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * todosSummary resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py basecamp2
 */
final class TodosSummaryResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /todos-summary
     *
     * Response data type: array
     * Known fields: id, summary, summaryTokens, context, contextTokens, modelName, vector, vectorCd, ... (19 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /todos-summary/{id}
     *
     * Response data type: object
     * Known fields: id, summary, summaryTokens, context, contextTokens, modelName, vector, vectorCd, ... (19 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}',
            $params,
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
