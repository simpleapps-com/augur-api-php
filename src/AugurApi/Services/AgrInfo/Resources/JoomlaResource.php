<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * joomla resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-info.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-info.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-info.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-info
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * AkashaGenerateCreateBody: Ask a question answered by an LLM over the matching knowledge records
 * (Akasha or Joomla)
 * Request body of: $api->agrInfo->joomla->createGenerate($data)
 *   content?: string|null — The question; defaults to a usage question about the endpoint
 *   embedModel?: string|null — Embedding model used to find matching records; defaults to
 *       nomic-embed-text
 *   genModel?: string|null — Model that writes the answer; defaults to gemma2:27b
 *   limit?: int|null — Number of matching records to use as context; defaults to 10
 *   offset?: int|null — Records to skip before the first one used; defaults to 0
 *
 * @phpstan-type AkashaGenerateCreateBody array{content?: string|null, embedModel?: string|null, genModel?: string|null, limit?: int|null, offset?: int|null}
 */
final class JoomlaResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /joomla/generate
     *
     * Generate Response from joomla
     * Call: $api->agrInfo->joomla->createGenerate($data)
     *
     * Request body: Ask a question answered by an LLM over the matching knowledge records (Akasha
     * or Joomla)
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://agr-info.augur-api.com/joomla/generate
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1joomla~1generate/post
     *
     * Request body ($data): AkashaGenerateCreateBody (fields listed on the class)
     *
     * Response data type: string
     *
     * @param AkashaGenerateCreateBody $data
     * @return BaseResponse<string>
     */
    public function createGenerate(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/generate', $data);

        /** @var BaseResponse<string> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
