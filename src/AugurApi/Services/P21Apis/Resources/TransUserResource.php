<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * transUser resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://p21-apis.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://p21-apis.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://p21-apis.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-apis
 */
final class TransUserResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /trans-user/{usersUid}
     *
     * Get User Details by User UID
     * Call: $api->p21Apis->transUser->get($usersUid)
     *
     * Errors:
     *   400: The path usersUid is 0 and no userId query parameter was given.
     *
     * GET https://p21-apis.augur-api.com/trans-user/{usersUid}
     * Contract: https://p21-apis.augur-api.com/openapi.json#/paths/~1trans-user~1{usersUid}/get
     *
     * Query params ($params; `?` = optional):
     *   userId?: string — Prophet 21 user ID (users.id) to fetch
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param int $usersUid User UID
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $usersUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{usersUid}',
            $params,
            ['usersUid' => (string) $usersUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
