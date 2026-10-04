<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * items resource — generated from spec.
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
 * ItemsListItem:
 * Returned by: $api->openSearch->items->list()
 * Returned by: $api->openSearch->items->get($invMastUid)
 * Returned by: $api->openSearch->items->update($invMastUid, $data)
 * Returned by: $api->openSearch->items->getRefresh($invMastUid)
 *   invMastUid: int — P21 inv_mast row UID of the item
 *   itemId: string|null — P21 item ID (inv_mast.item_id) (max 40 chars)
 *   online: string — Y when the item is sold online and kept in the openSearch index [Y|N] (max 1
 *       chars)
 *   updateCd: int — Marked items to have the search document (doc) rebuilt
 *   doc: string|null — Search document JSON written to openSearch; over 500 bytes it is stored on
 *       EFS and this holds efs:{path} (max 4294967295 chars)
 *   indexCd: int — Marked items to have the index updated in openSearch
 *   statusCd: int — Mapped to inv_mast.online_cd
 *   processCd: int — Mapped to inv_mast.status_cd, not really used
 *   indexStatusCd: int — Check status of item in the openSearch index
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   classId5: string|null — P21 inv_mast.class_id5 of the item (max 8 chars)
 *   dateLastChecked: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   embeddingCd: int — Process the document to get the embedding
 *   docHash: string|null — Hash of the last built doc; null for deleted or inactive items (max 64
 *       chars)
 *   indexHash: string|null — Hash of the doc last written to openSearch; null when not indexed (max
 *       64 chars)
 *   location: string|null — Where doc is stored [rds|efs] (max 65 chars)
 *   uuid: string|null — Stable ID assigned on first write, used to name the EFS doc file (max 36
 *       chars)
 *
 * ItemsRefreshUpdateBody: Choose which item queues to re-mark for reprocessing; every flag defaults
 * to true and is skipped only when sent as false
 * Request body of: $api->openSearch->items->updateRefresh($data)
 *   updateCd?: bool — Re-mark update_cd so each item's search document is rebuilt
 *   indexCd?: bool — Re-mark index_cd so each item is rewritten to the OpenSearch index
 *   processCd?: bool — Re-mark process_cd so each item's status is reprocessed
 *
 * ItemsUpdateBody: Partial update of an items row; only the status and process codes are writable,
 * an absent field keeps its value
 * Request body of: $api->openSearch->items->update($invMastUid, $data)
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code; 704 queues the item for status reprocessing
 *
 * @phpstan-type ItemsListItem array{invMastUid: int, itemId: string|null, online: string, updateCd: int, doc: string|null, indexCd: int, statusCd: int, processCd: int, indexStatusCd: int, dateCreated: string, dateLastModified: string, classId5: string|null, dateLastChecked: string, embeddingCd: int, docHash: string|null, indexHash: string|null, location: string|null, uuid: string|null}
 * @phpstan-type ItemsRefreshUpdateBody array{updateCd?: bool, indexCd?: bool, processCd?: bool}
 * @phpstan-type ItemsUpdateBody array{statusCd?: int|null, processCd?: int|null}
 */
final class ItemsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /items
     *
     * List items
     * Call: $api->openSearch->items->list()
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://open-search.augur-api.com/items
     * Contract: https://open-search.augur-api.com/openapi.json#/paths/~1items/get
     *
     * Query params ($params; `?` = optional):
     *   itemId?: string — Item ID prefix
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   online?: string — Online status [Y|N]
     *   orderBy?: string — Order By (Default: inv_mast_uid|ASC)
     *   statusCd?: int — Status Code (status_cd) [(704)|(705)|(700)]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ItemsListItem (fields listed on the class)
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
     * PUT /items/refresh
     *
     * refresh items
     * Call: $api->openSearch->items->updateRefresh($data)
     *
     * Request body: Choose which item queues to re-mark for reprocessing; every flag defaults to
     * true and is skipped only when sent as false
     *
     * PUT https://open-search.augur-api.com/items/refresh
     * Contract: https://open-search.augur-api.com/openapi.json#/paths/~1items~1refresh/put
     *
     * Request body ($data): ItemsRefreshUpdateBody (fields listed on the class)
     *
     * Response data type: bool
     *
     * @param ItemsRefreshUpdateBody $data
     * @return BaseResponse<bool>
     */
    public function updateRefresh(array $data = []): BaseResponse
    {
        $response = $this->client->put($this->baseUrl, '/refresh', $data);

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /items/{invMastUid}
     *
     * get the item document
     * Call: $api->openSearch->items->get($invMastUid)
     *
     * GET https://open-search.augur-api.com/items/{invMastUid}
     * Contract: https://open-search.augur-api.com/openapi.json#/paths/~1items~1{invMastUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ItemsListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /items/{invMastUid}
     *
     * update the item document
     * Call: $api->openSearch->items->update($invMastUid, $data)
     *
     * Request body: Partial update of an items row; only the status and process codes are writable,
     * an absent field keeps its value
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No row exists with this UID.
     *
     * PUT https://open-search.augur-api.com/items/{invMastUid}
     * Contract: https://open-search.augur-api.com/openapi.json#/paths/~1items~1{invMastUid}/put
     *
     * Request body ($data): ItemsUpdateBody (fields listed on the class)
     *
     * Response data type: ItemsListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param ItemsUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /items/{invMastUid}/refresh
     *
     * refresh the item document
     * Call: $api->openSearch->items->getRefresh($invMastUid)
     *
     * GET https://open-search.augur-api.com/items/{invMastUid}/refresh
     * Contract:
     * https://open-search.augur-api.com/openapi.json#/paths/~1items~1{invMastUid}~1refresh/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ItemsListItem (fields listed on the class)
     *
     * @param int $invMastUid inv_mast.inv_mast_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getRefresh(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/refresh',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
