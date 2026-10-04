<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * transWebDisplayType resource — generated from spec.
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
final class TransWebDisplayTypeResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /trans-web-display-type
     *
     * Create Web Display Type
     * Call: $api->p21Apis->transWebDisplayType->create($data)
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://p21-apis.augur-api.com/trans-web-display-type
     * Contract: https://p21-apis.augur-api.com/openapi.json#/paths/~1trans-web-display-type/post
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /trans-web-display-type/definition
     *
     * Get service definition for Web Display Type
     * Call: $api->p21Apis->transWebDisplayType->listDefinition()
     *
     * Get Web Display Type Definition
     *
     * GET https://p21-apis.augur-api.com/trans-web-display-type/definition
     * Contract:
     * https://p21-apis.augur-api.com/openapi.json#/paths/~1trans-web-display-type~1definition/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listDefinition(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/definition', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /trans-web-display-type/{webDisplayTypeUid}
     *
     * Delete Web Display Type by Display Type UID
     * Call: $api->p21Apis->transWebDisplayType->delete($webDisplayTypeUid)
     *
     * Errors:
     *   400: The path webDisplayTypeUid is 0 and no webDisplayTypeId query parameter was given.
     *   404: No record with this ID.
     *
     * DELETE https://p21-apis.augur-api.com/trans-web-display-type/{webDisplayTypeUid}
     * Contract:
     * https://p21-apis.augur-api.com/openapi.json#/paths/~1trans-web-display-type~1{webDisplayTypeUid}/delete
     *
     * Query params ($params; `?` = optional):
     *   webDisplayTypeId?: string — Prophet 21 web display type ID to delete; when set it is used
     *       instead of webDisplayTypeUid
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param int $webDisplayTypeUid Prophet 21 web_display_type_uid to delete; MUST be 1 or more
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function delete(int $webDisplayTypeUid, array $params = []): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{webDisplayTypeUid}',
            ['webDisplayTypeUid' => (string) $webDisplayTypeUid],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /trans-web-display-type/{webDisplayTypeUid}
     *
     * Get Web Display Type Details by Display Type UID
     * Call: $api->p21Apis->transWebDisplayType->get($webDisplayTypeUid)
     *
     * Errors:
     *   400: The path webDisplayTypeUid is 0 and no webDisplayTypeId query parameter was given.
     *
     * GET https://p21-apis.augur-api.com/trans-web-display-type/{webDisplayTypeUid}
     * Contract:
     * https://p21-apis.augur-api.com/openapi.json#/paths/~1trans-web-display-type~1{webDisplayTypeUid}/get
     *
     * Query params ($params; `?` = optional):
     *   webDisplayTypeId?: string — Prophet 21 web display type ID to fetch; when set it is used
     *       instead of webDisplayTypeUid
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param int $webDisplayTypeUid Prophet 21 web_display_type_uid to fetch; send 0 together with webDisplayTypeId to look up by ID instead
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $webDisplayTypeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{webDisplayTypeUid}',
            $params,
            ['webDisplayTypeUid' => (string) $webDisplayTypeUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /trans-web-display-type/{webDisplayTypeUid}
     *
     * Update Web Display Type by Display Type UID
     * Call: $api->p21Apis->transWebDisplayType->update($webDisplayTypeUid, $data)
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No record with this ID.
     *
     * PUT https://p21-apis.augur-api.com/trans-web-display-type/{webDisplayTypeUid}
     * Contract:
     * https://p21-apis.augur-api.com/openapi.json#/paths/~1trans-web-display-type~1{webDisplayTypeUid}/put
     *
     * Query params ($params; `?` = optional):
     *   webDisplayTypeId?: string — Prophet 21 web display type ID to update; when set it overrides
     *       web_display_type_id in the body
     *
     * Response data: untyped upstream (any JSON value)
     *
     * @param int $webDisplayTypeUid Prophet 21 web_display_type_uid to update, used to find the ID when neither the query nor the body sends one; MUST be 1 or more
     * @param array<string, mixed> $data
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function update(int $webDisplayTypeUid, array $data = [], array $params = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{webDisplayTypeUid}',
            $data,
            ['webDisplayTypeUid' => (string) $webDisplayTypeUid],
            $params,
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
