<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * tags resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://joomla.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://joomla.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://joomla.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py joomla
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * TagsListItem: A tag with the number of matching published articles that carry it
 * (TagsHelper::listAll)
 * Returned by: $api->joomla->tags->list()
 *   id: int|null — Tag ID
 *   tag: string — Tag title
 *   total: int — Published articles in the requested category (catId) that carry the tag
 *
 * @phpstan-type TagsListItem array{id: int|null, tag: string, total: int}
 */
final class TagsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /tags
     *
     * Get tag list
     * Call: $api->joomla->tags->list()
     *
     * Get Tag List
     *
     * Response data, each item: A tag with the number of matching published articles that carry it
     * (TagsHelper::listAll)
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a tags column.
     *
     * GET https://joomla.augur-api.com/tags
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1tags/get
     *
     * Query params ($params; `?` = optional):
     *   catId?: int — Category whose published articles are counted per tag (total)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Offset number of results (Default: 0)
     *   orderBy?: string — Order By (Default: title|ASC)
     *   parentId?: int — Parent tag; only its direct published children are listed (Default: 0)
     *   q?: string — Query string
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of TagsListItem (fields listed on the class)
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
}
