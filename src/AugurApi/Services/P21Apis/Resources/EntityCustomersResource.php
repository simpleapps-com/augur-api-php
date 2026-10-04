<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * entityCustomers resource — generated from spec.
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
final class EntityCustomersResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /entity-customers/refresh
     *
     * Trigger an entity customers refresh
     * Call: $api->p21Apis->entityCustomers->getRefresh()
     *
     * Queue the entity customers refresh jobs for the site; data is true once queued
     *
     * GET https://p21-apis.augur-api.com/entity-customers/refresh
     * Contract: https://p21-apis.augur-api.com/openapi.json#/paths/~1entity-customers~1refresh/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: bool
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<bool>
     */
    public function getRefresh(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/refresh', $params);

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
