<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * queryStringRedirect resource — generated from spec.
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
 * QueryStringRedirectListItem:
 * Returned by: $api->openSearch->queryStringRedirect->list()
 * Returned by: $api->openSearch->queryStringRedirect->create($data)
 * Returned by: $api->openSearch->queryStringRedirect->get($queryStringRedirectUid)
 * Returned by: $api->openSearch->queryStringRedirect->update($queryStringRedirectUid, $data)
 * Returned by: $api->openSearch->queryStringRedirect->delete($queryStringRedirectUid)
 *   queryStringRedirectUid: int — query_string_redirect row UID
 *   queryStringUid: int — query_string row whose searches redirect
 *   queryStringRedirectLink: string — Link returned to the storefront as queryStringRedirectLink
 *       when a search matches query_string (max 255 chars)
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code: 1185 = Import Complete, 704 = needs processing
 *   statusCd: int — Status code: 704 = Active, 705 = Inactive, 700 = Deleted
 *   processCd: int — Process code: 704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete
 *   queryString: string|null — Cleaned search text that triggers the redirect (max 65535 chars)
 *
 * QueryStringRedirectCreateBody: Create a redirect from a search query string to a page; an absent
 * field takes the helper's default
 * Request body of: $api->openSearch->queryStringRedirect->create($data)
 *   queryString?: string|null — Search text to redirect; registered as a query_string when new, and
 *       wins over queryStringUid
 *   queryStringUid?: int|null — Existing query_string_uid to redirect, used when queryString is
 *       absent
 *   queryStringRedirectLink?: string|null — Link the search redirects to
 *
 * QueryStringRedirectUpdateBody: Partial update of a query string redirect; an absent field keeps
 * its current value
 * Request body of: $api->openSearch->queryStringRedirect->update($queryStringRedirectUid, $data)
 *   queryString?: string|null — New search text; registered as a query_string when new, and wins
 *       over queryStringUid
 *   queryStringUid?: int|null — Existing query_string_uid to redirect, used when queryString is
 *       absent
 *   queryStringRedirectLink?: string|null — New link the search redirects to
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code
 *   updateCd?: int|null — Update code
 *
 * @phpstan-type QueryStringRedirectListItem array{queryStringRedirectUid: int, queryStringUid: int, queryStringRedirectLink: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, queryString: string|null}
 * @phpstan-type QueryStringRedirectCreateBody array{queryString?: string|null, queryStringUid?: int|null, queryStringRedirectLink?: string|null}
 * @phpstan-type QueryStringRedirectUpdateBody array{queryString?: string|null, queryStringUid?: int|null, queryStringRedirectLink?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 */
final class QueryStringRedirectResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /query-string-redirect
     *
     * List Query String Redirects
     * Call: $api->openSearch->queryStringRedirect->list()
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://open-search.augur-api.com/query-string-redirect
     * Contract: https://open-search.augur-api.com/openapi.json#/paths/~1query-string-redirect/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: query_string_redirect_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of QueryStringRedirectListItem (fields listed on the class)
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
     * POST /query-string-redirect
     *
     * Create Query String Redirect
     * Call: $api->openSearch->queryStringRedirect->create($data)
     *
     * Request body: Create a redirect from a search query string to a page; an absent field takes
     * the helper's default
     *
     * Success status: 201 (not 200)
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * POST https://open-search.augur-api.com/query-string-redirect
     * Contract: https://open-search.augur-api.com/openapi.json#/paths/~1query-string-redirect/post
     *
     * Request body ($data): QueryStringRedirectCreateBody (fields listed on the class)
     *
     * Response data type: QueryStringRedirectListItem (fields listed on the class)
     *
     * @param QueryStringRedirectCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /query-string-redirect/{queryStringRedirectUid}
     *
     * Soft Delete Query String Redirect
     * Call: $api->openSearch->queryStringRedirect->delete($queryStringRedirectUid)
     *
     * Errors:
     *   404: No row exists with this UID.
     *
     * DELETE https://open-search.augur-api.com/query-string-redirect/{queryStringRedirectUid}
     * Contract:
     * https://open-search.augur-api.com/openapi.json#/paths/~1query-string-redirect~1{queryStringRedirectUid}/delete
     *
     * Response data type: QueryStringRedirectListItem (fields listed on the class)
     *
     * @param int $queryStringRedirectUid query_string_redirect row UID
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $queryStringRedirectUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{queryStringRedirectUid}',
            ['queryStringRedirectUid' => (string) $queryStringRedirectUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /query-string-redirect/{queryStringRedirectUid}
     *
     * Get Query String Redirect Details
     * Call: $api->openSearch->queryStringRedirect->get($queryStringRedirectUid)
     *
     * GET https://open-search.augur-api.com/query-string-redirect/{queryStringRedirectUid}
     * Contract:
     * https://open-search.augur-api.com/openapi.json#/paths/~1query-string-redirect~1{queryStringRedirectUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: QueryStringRedirectListItem (fields listed on the class)
     *
     * @param int $queryStringRedirectUid query_string_redirect row UID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $queryStringRedirectUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{queryStringRedirectUid}',
            $params,
            ['queryStringRedirectUid' => (string) $queryStringRedirectUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /query-string-redirect/{queryStringRedirectUid}
     *
     * Update Query String Redirect
     * Call: $api->openSearch->queryStringRedirect->update($queryStringRedirectUid, $data)
     *
     * Request body: Partial update of a query string redirect; an absent field keeps its current
     * value
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No row exists with this UID.
     *
     * PUT https://open-search.augur-api.com/query-string-redirect/{queryStringRedirectUid}
     * Contract:
     * https://open-search.augur-api.com/openapi.json#/paths/~1query-string-redirect~1{queryStringRedirectUid}/put
     *
     * Request body ($data): QueryStringRedirectUpdateBody (fields listed on the class)
     *
     * Response data type: QueryStringRedirectListItem (fields listed on the class)
     *
     * @param int $queryStringRedirectUid query_string_redirect row UID
     * @param QueryStringRedirectUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $queryStringRedirectUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{queryStringRedirectUid}',
            $data,
            ['queryStringRedirectUid' => (string) $queryStringRedirectUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
