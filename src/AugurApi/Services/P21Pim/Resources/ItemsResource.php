<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * items resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://p21-pim.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://p21-pim.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://p21-pim.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-pim
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ItemsSuggestDisplayDescListDataOption1Item: One AI-suggested item description, ranked by
 * closeness to the item's meaning (closest first)
 * Returned by: $api->p21Pim->items->listSuggestDisplayDesc($invMastUid)
 * Returned by: $api->p21Pim->items->listSuggestWebDesc($invMastUid)
 *   description: string — Suggested description
 *   length: int — Length of the description in characters
 *   euclideanDistance: float — Euclidean (L2) distance from the item's meaning embedding; smaller
 *       is closer
 *   taxicabDistance: float — Taxicab (L1) distance from the item's meaning embedding; smaller is
 *       closer
 *
 * @phpstan-type ItemsSuggestDisplayDescListDataOption1Item array{description: string, length: int, euclideanDistance: float, taxicabDistance: float}
 */
final class ItemsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /items/{invMastUid}/suggest-display-desc
     *
     * Suggest Item Display Description
     * Call: $api->p21Pim->items->listSuggestDisplayDesc($invMastUid)
     *
     * GET https://p21-pim.augur-api.com/items/{invMastUid}/suggest-display-desc
     * Contract:
     * https://p21-pim.augur-api.com/openapi.json#/paths/~1items~1{invMastUid}~1suggest-display-desc/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   model?: string — LLM to use default: llama3.2-vision:11b
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list<ItemsSuggestDisplayDescListDataOption1Item>|false
     *   one of:
     *     list<ItemsSuggestDisplayDescListDataOption1Item>
     *       each item: ItemsSuggestDisplayDescListDataOption1Item — One AI-suggested item
     *           description, ranked by closeness to the item's meaning (closest first)
     *     false — false when the operation failed
     *
     * @param int $invMastUid Item (inv_mast) to suggest descriptions for
     * @param array<string, mixed> $params
     * @return BaseResponse<list<ItemsSuggestDisplayDescListDataOption1Item>|false>
     */
    public function listSuggestDisplayDesc(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/suggest-display-desc',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<ItemsSuggestDisplayDescListDataOption1Item>|false> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /items/{invMastUid}/suggest-web-desc
     *
     * Suggest Item Web Description
     * Call: $api->p21Pim->items->listSuggestWebDesc($invMastUid)
     *
     * GET https://p21-pim.augur-api.com/items/{invMastUid}/suggest-web-desc
     * Contract:
     * https://p21-pim.augur-api.com/openapi.json#/paths/~1items~1{invMastUid}~1suggest-web-desc/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   model?: string — LLM to use default: llama3.2-vision:11b
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list<ItemsSuggestDisplayDescListDataOption1Item>|false
     *   one of:
     *     list<ItemsSuggestDisplayDescListDataOption1Item>
     *       each item: ItemsSuggestDisplayDescListDataOption1Item — One AI-suggested item
     *           description, ranked by closeness to the item's meaning (closest first)
     *     false — false when the operation failed
     *
     * @param int $invMastUid Item (inv_mast) to suggest descriptions for
     * @param array<string, mixed> $params
     * @return BaseResponse<list<ItemsSuggestDisplayDescListDataOption1Item>|false>
     */
    public function listSuggestWebDesc(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/suggest-web-desc',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<ItemsSuggestDisplayDescListDataOption1Item>|false> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
