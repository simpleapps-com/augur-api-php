<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * openSearch resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-site.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-site.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-site.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * OpenSearchEmbeddingListData: The embedding vector for a search query string, stored for reuse
 * Returned by: $api->agrSite->openSearch->listEmbedding()
 *   queryString: string — Query string as sent (trimmed)
 *   queryStringCleaned: string|null — Query string after cleaning, as stored
 *   queryStringHash: string|null — Hash of the cleaned query string
 *   vector: list<float> — 768-dimension embedding; empty when none could be produced
 *
 * @phpstan-type OpenSearchEmbeddingListData array{queryString: string, queryStringCleaned: string|null, queryStringHash: string|null, vector: list<float>}
 */
final class OpenSearchResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /open-search/embedding
     *
     * Get Query String Embedding
     * Call: $api->agrSite->openSearch->listEmbedding()
     *
     * Response data: The embedding vector for a search query string, stored for reuse
     *
     * GET https://agr-site.augur-api.com/open-search/embedding
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1open-search~1embedding/get
     *
     * Query params ($params; `?` = optional):
     *   q: string — search query
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: OpenSearchEmbeddingListData (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listEmbedding(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/embedding', $params);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
