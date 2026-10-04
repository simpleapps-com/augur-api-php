<?php

declare(strict_types=1);

namespace AugurApi\Services\Gregorovich\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * documents resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://gregorovich.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path,
 *       path params and query params, each with type and required flag. Grep it for a path; for a
 *       GET that line is all you need. Bodies are not in it.
 *   https://gregorovich.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://gregorovich.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py gregorovich
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * DocumentsListItem: One stored document without its content, returned by GET /api/documents
 * Returned by: $api->gregorovich->documents->list()
 *   documentsUid: int — Document unique identifier
 *   location: string|null — Where the document content is stored
 *   contentLength: int — Content length in bytes
 *   contentHash: string — MD5 hash of the content
 *
 * @phpstan-type DocumentsListItem array{documentsUid: int, location: string|null, contentLength: int, contentHash: string}
 */
final class DocumentsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /documents
     *
     * list the documents
     * Call: $api->gregorovich->documents->list()
     *
     * Response data, each item: One stored document without its content, returned by GET
     * /api/documents
     *
     * GET https://gregorovich.augur-api.com/documents
     * Contract: https://gregorovich.augur-api.com/openapi.json#/paths/~1documents/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of DocumentsListItem (fields listed on the class)
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
