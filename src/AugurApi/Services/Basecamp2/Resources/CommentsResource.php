<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * comments resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://basecamp2.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://basecamp2.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://basecamp2.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py basecamp2
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * CommentsListItem:
 * Returned by: $api->basecamp2->comments->list()
 * Returned by: $api->basecamp2->comments->get($id)
 *   id: int — Basecamp comment ID
 *   content: string — Comment HTML, or efs:{hash} when the body is stored in EFS (max 65535 chars)
 *   updatedAt: string — When the record was last updated in Basecamp (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   createdAt: string — When the record was created in Basecamp (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   creatorId: int|null — Person who wrote the comment
 *   updateCd: int — Update code (704 = queued for refresh, 1185 = refresh complete)
 *   statusCd: int — Status code (704 = Active, 700 = Deleted)
 *   processCd: int — Process code (704 = Active)
 *   todosId: int|null — To-do the comment belongs to
 *   vector: string|null — The 1536 dimensional vector that represents the comment (max 65535 chars)
 *   vectorCd: int — Embedding queue code (704 = queued, 1185 = done)
 *   vectorFlag: string — Y when an embedding exists for the comment (max 1 chars)
 *   dateLastVector: string — When the comment embedding was last built (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   location: string|null — Where the body is stored: rds (inline) or efs (max 17 chars)
 *   contentLength: int — Comment body length in characters
 *   tokenCount: int — Token count of the comment body
 *
 * @phpstan-type CommentsListItem array{id: int, content: string, updatedAt: string, createdAt: string, creatorId: int|null, updateCd: int, statusCd: int, processCd: int, todosId: int|null, vector: string|null, vectorCd: int, vectorFlag: string, dateLastVector: string, location: string|null, contentLength: int, tokenCount: int}
 */
final class CommentsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /comments
     *
     * List Comments
     * Call: $api->basecamp2->comments->list()
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://basecamp2.augur-api.com/comments
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1comments/get
     *
     * Query params ($params; `?` = optional):
     *   creatorId?: int — Filter by creator ID
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Sort field (Default: id|asc)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *   todosId?: int — Filter by todos ID
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CommentsListItem (fields listed on the class)
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
     * GET /comments/{id}
     *
     * Get Comment by ID
     * Call: $api->basecamp2->comments->get($id)
     *
     * GET https://basecamp2.augur-api.com/comments/{id}
     * Contract: https://basecamp2.augur-api.com/openapi.json#/paths/~1comments~1{id}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CommentsListItem (fields listed on the class)
     *
     * @param int $id Comment ID
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
