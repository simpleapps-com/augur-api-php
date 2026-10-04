<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * usergroups resource — generated from spec.
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
 */
final class UsergroupsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /usergroups
     *
     * Get User Groups
     * Call: $api->joomla->usergroups->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a usergroups column.
     *
     * GET https://joomla.augur-api.com/usergroups
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1usergroups/get
     *
     * Query params ($params; `?` = optional):
     *   orderBy?: string — Select order of the groups Default: title|ASC
     *   parentIdList?: string — CSV List of parent ids (default:blank)
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list<string>
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<string>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<list<string>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
