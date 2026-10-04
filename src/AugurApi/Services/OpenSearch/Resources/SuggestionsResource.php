<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * suggestions resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://open-search.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path,
 *       path params and query params, each with type and required flag. Grep it for a path; for a
 *       GET that line is all you need. Bodies are not in it.
 *   https://open-search.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://open-search.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py open-search
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * SuggestionsListItem:
 * Returned by: $api->openSearch->suggestions->list()
 * Returned by: $api->openSearch->suggestions->get($suggestionsUid)
 *   suggestionsUid: int — suggestions row UID
 *   queryStringUid: int — query_string row this suggestion was built from
 *   suggestionsString: string — Suggested search text (max 255 chars)
 *   suggestionsMetaphone: string|null — Metaphone key per word, used for sound-alike matching (max
 *       255 chars)
 *   avgTotalResults: int — Average openSearch hit count for this text
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code: 1185 = Import Complete, 704 = needs processing
 *   statusCd: int — Status code: 704 = Active, 705 = Inactive, 700 = Deleted
 *   processCd: int — Process code: 704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete
 *
 * SuggestionsSuggestListItem: One search-term suggestion from GET /api/suggestions/suggest, ranked
 * by how well it matches the typed query
 * Returned by: $api->openSearch->suggestions->listSuggest()
 *   suggestionsUid: int — Suggestion row UID
 *   queryStringUid: int — query_string row this suggestion was built from
 *   suggestionsString: string — Suggested search text; underscores shown as dashes
 *   suggestionsMetaphone: string|null — Metaphone key per word, used for sound-alike matching
 *   avgTotalResults: int — Average OpenSearch hit count for this text; one suggestion is kept per
 *       value
 *   dateCreated: string — When the suggestion was created (YYYY-MM-DD HH:mm:ss)
 *   dateLastModified: string — When the suggestion last changed (YYYY-MM-DD HH:mm:ss)
 *   updateCd: int — Update code
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code
 *   score: int — Rank: prefix, exact-word and metaphone matches, plus avgTotalResults; highest
 *       first
 *
 * @phpstan-type SuggestionsListItem array{suggestionsUid: int, queryStringUid: int, suggestionsString: string, suggestionsMetaphone: string|null, avgTotalResults: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type SuggestionsSuggestListItem array{suggestionsUid: int, queryStringUid: int, suggestionsString: string, suggestionsMetaphone: string|null, avgTotalResults: int, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, score: int}
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
     * List Suggestions
     * Call: $api->openSearch->suggestions->list()
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://open-search.augur-api.com/suggestions
     * Contract: https://open-search.augur-api.com/openapi.json#/paths/~1suggestions/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: suggestions_uid|ASC)
     *   processCd?: int — Process Code filter
     *   query?: string — Search query string
     *   queryStringUid?: int — Query String UID filter
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of SuggestionsListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /suggestions/suggest
     *
     * Get search suggestions for autocomplete
     * Call: $api->openSearch->suggestions->listSuggest()
     *
     * Response data, each item: One search-term suggestion from GET /api/suggestions/suggest,
     * ranked by how well it matches the typed query
     *
     * GET https://open-search.augur-api.com/suggestions/suggest
     * Contract: https://open-search.augur-api.com/openapi.json#/paths/~1suggestions~1suggest/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   q?: string — Search query string for autocomplete
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of SuggestionsSuggestListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listSuggest(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/suggest', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /suggestions/{suggestionsUid}
     *
     * Get Suggestion Details
     * Call: $api->openSearch->suggestions->get($suggestionsUid)
     *
     * Errors:
     *   404: No row exists with this UID.
     *
     * GET https://open-search.augur-api.com/suggestions/{suggestionsUid}
     * Contract:
     * https://open-search.augur-api.com/openapi.json#/paths/~1suggestions~1{suggestionsUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: SuggestionsListItem (fields listed on the class)
     *
     * @param int $suggestionsUid suggestions row UID
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
