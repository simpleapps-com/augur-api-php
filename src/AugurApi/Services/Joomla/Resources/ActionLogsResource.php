<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * actionLogs resource — generated from spec.
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
 * ActionLogsListItem:
 * Returned by: $api->joomla->actionLogs->list()
 * Returned by: $api->joomla->actionLogs->get($id)
 *   id: int — Action log ID
 *   messageLanguageKey: string — Joomla language key of the log message (max 255 chars)
 *   message: string — Log message data (JSON) (max 2147483647 chars)
 *   logDate: string — When the action happened (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   extension: string — Extension that logged the action (e.g. com_users) (max 50 chars)
 *   userId: int — Joomla user who acted
 *   itemId: int — ID of the item acted on
 *   ipAddress: string — IP address of the request (max 40 chars)
 *
 * @phpstan-type ActionLogsListItem array{id: int, messageLanguageKey: string, message: string, logDate: string, extension: string, userId: int, itemId: int, ipAddress: string}
 */
final class ActionLogsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /action-logs
     *
     * List Action Logs
     * Call: $api->joomla->actionLogs->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an action_logs column.
     *
     * GET https://joomla.augur-api.com/action-logs
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1action-logs/get
     *
     * Query params ($params; `?` = optional):
     *   extension?: string — Filter by Joomla extension (e.g. com_users)
     *   itemId?: int — Filter by affected item id
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Offset number of results (Default: 0)
     *   orderBy?: string — Sort ordering (Default: id|DESC)
     *   userId?: int — Filter by Joomla user id
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ActionLogsListItem (fields listed on the class)
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
     * GET /action-logs/{id}
     *
     * Get Action Log Doc
     * Call: $api->joomla->actionLogs->get($id)
     *
     * Errors:
     *   404: No action log with this ID.
     *
     * GET https://joomla.augur-api.com/action-logs/{id}
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1action-logs~1{id}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ActionLogsListItem (fields listed on the class)
     *
     * @param int $id action_logs.id
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
