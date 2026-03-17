<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * suggestions resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py open-search
 */
final class SuggestionsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /suggestions
     *
     * Response data type: array
     * Known fields: suggestionsUid, queryStringUid, suggestionsString, suggestionsMetaphone, avgTotalResults, dateCreated, dateLastModified, updateCd, ... (10 total)
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
     * GET /suggestions/suggest
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listSuggest(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/suggest', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /suggestions/{suggestionsUid}
     *
     * Response data type: object
     * Known fields: suggestionsUid, queryStringUid, suggestionsString, suggestionsMetaphone, avgTotalResults, dateCreated, dateLastModified, updateCd, ... (10 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $suggestionsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{suggestionsUid}',
            $params,
            ['suggestionsUid' => (string) $suggestionsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
