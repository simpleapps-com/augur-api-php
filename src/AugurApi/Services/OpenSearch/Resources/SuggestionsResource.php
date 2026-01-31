<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Suggestions resource.
 *
 * @fullPath api.openSearch.suggestions
 * @service open_search
 * @domain search
 */
final class SuggestionsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List suggestions.
     *
     * @fullPath api.openSearch.suggestions.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/suggestions', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get suggestion details.
     *
     * @fullPath api.openSearch.suggestions.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $suggestionsUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/suggestions/{suggestionsUid}',
            [],
            ['suggestionsUid' => (string) $suggestionsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get search suggestions for autocomplete.
     *
     * @fullPath api.openSearch.suggestions.suggest
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function suggest(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/suggestions/suggest', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
