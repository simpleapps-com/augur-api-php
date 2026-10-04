<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * categories resource — generated from spec.
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
 * CategoriesListItem:
 * Returned by: $api->joomla->categories->list()
 * Returned by: $api->joomla->categories->get($id)
 *   id: int — Category ID
 *   assetId: int — Joomla asset (ACL) ID
 *   parentId: int — Parent category ID
 *   lft: int — Nested-set left value
 *   rgt: int — Nested-set right value
 *   level: int — Depth in the tree
 *   path: string — Route path (max 400 chars)
 *   extension: string — Extension the category belongs to (e.g. com_content) (max 50 chars)
 *   title: string — Title (max 255 chars)
 *   alias: string — URL alias (max 400 chars)
 *   note: string — Admin note (max 255 chars)
 *   description: string|null — Category description (HTML) (max 16777215 chars)
 *   published: int — Publish state (1 = published, 0 = unpublished, -2 = trashed)
 *   checkedOut: int — User who has the record checked out; 0 when none
 *   checkedOutTime: string — When the record was checked out (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   access: int — Access level ID
 *   params: string|null — Joomla params JSON (max 16777215 chars)
 *   metadesc: string — Meta description (max 1024 chars)
 *   metakey: string — Meta keywords (max 1024 chars)
 *   metadata: string — Metadata JSON (max 2048 chars)
 *   createdUserId: int — User who created the category
 *   createdTime: string — When the category was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   modifiedUserId: int — User who last changed the category
 *   modifiedTime: string — When the category was last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   hits: int — Page views
 *   language: string — Language tag (* = all) (max 7 chars)
 *   version: int — Version number
 *
 * @phpstan-type CategoriesListItem array{id: int, assetId: int, parentId: int, lft: int, rgt: int, level: int, path: string, extension: string, title: string, alias: string, note: string, description: string|null, published: int, checkedOut: int, checkedOutTime: string, access: int, params: string|null, metadesc: string, metakey: string, metadata: string, createdUserId: int, createdTime: string, modifiedUserId: int, modifiedTime: string, hits: int, language: string, version: int}
 */
final class CategoriesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /categories
     *
     * List Categories
     * Call: $api->joomla->categories->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a categories column.
     *
     * GET https://joomla.augur-api.com/categories
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1categories/get
     *
     * Query params ($params; `?` = optional):
     *   extension?: string — Extension filter (e.g. com_content)
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Offset number of results (Default: 0)
     *   orderBy?: string — Sort ordering (Default: id|ASC)
     *   parentId?: int — Parent category ID
     *   published?: int — Published state filter
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CategoriesListItem (fields listed on the class)
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
     * GET /categories/{id}
     *
     * Get Category by ID
     * Call: $api->joomla->categories->get($id)
     *
     * Errors:
     *   404: No category with this ID.
     *
     * GET https://joomla.augur-api.com/categories/{id}
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1categories~1{id}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: CategoriesListItem (fields listed on the class)
     *
     * @param int $id categories.id
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
