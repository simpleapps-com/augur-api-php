<?php

declare(strict_types=1);

namespace AugurApi\Services\Commerce\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * cartLine resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://commerce.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://commerce.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://commerce.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py commerce
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * CartLineGetItem: One cart line with its item's id and assembly flag
 * Returned by: $api->commerce->cartLine->get($cartHdrUid)
 *   lineNo: int — Line number within the cart
 *   invMastUid: int — Item (inv_mast) on the line
 *   quantity: float|null — Quantity in unitOfMeasure
 *   unitOfMeasure: string|null — Unit of measure
 *   lineNote: string|null — Line note
 *   key: string|null — Caller key that identifies the line, when the site enables cart line keys
 *   unitPrice: float|null — Unit price stored on the line
 *   itemId: string — Item ID of invMastUid
 *   isAssembly: string — Whether the item is an assembly [Y|N]
 *   invMastUidCount: int — Number of lines in the cart that carry the same item
 *
 * CartLineAddCreateBodyItem: One cart line to add or update; the body is a JSON array of these
 * Request body of: $api->commerce->cartLine->createAdd($cartHdrUid, $data)
 * Request body of: $api->commerce->cartLine->createUpdate($cartHdrUid, $data)
 *   invMastUid: int|null — Item (inv_mast) to put on the line
 *   quantity: float|null — Quantity in unitOfMeasure
 *   unitOfMeasure: string|null — Unit of measure; upper-cased before it is stored
 *   lineNo?: int|null — Line number to write; absent or 0 lets the cart pick the line (by item, or
 *       by key on add)
 *   lineNote?: string|null — Line note, at most 255 characters kept
 *   unitPrice?: float|null — Unit price to store on the line; absent stores none
 *   key?: string|null — Caller key that identifies the line on add when the site enables cart line
 *       keys; ignored by update
 *
 * CartLineLinesDeleteData: Confirmation that a cart line was deleted
 * Returned by: $api->commerce->cartLine->deleteLines($cartHdrUid, $lineNo)
 *   success: bool — Always true
 *   message: string — Confirmation text
 *
 * @phpstan-type CartLineGetItem array{lineNo: int, invMastUid: int, quantity: float|null, unitOfMeasure: string|null, lineNote: string|null, key: string|null, unitPrice: float|null, itemId: string, isAssembly: string, invMastUidCount: int}
 * @phpstan-type CartLineAddCreateBodyItem array{invMastUid: int|null, quantity: float|null, unitOfMeasure: string|null, lineNo?: int|null, lineNote?: string|null, unitPrice?: float|null, key?: string|null}
 * @phpstan-type CartLineLinesDeleteData array{success: bool, message: string}
 */
final class CartLineResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * DELETE /cart-line/{cartHdrUid}
     *
     * DELETE Cart Lines
     * Call: $api->commerce->cartLine->delete($cartHdrUid)
     *
     * Errors:
     *   404: No record with this ID. Or Cart not found.
     *
     * DELETE https://commerce.augur-api.com/cart-line/{cartHdrUid}
     * Contract: https://commerce.augur-api.com/openapi.json#/paths/~1cart-line~1{cartHdrUid}/delete
     *
     * Response data type: bool
     *
     * @param int $cartHdrUid Cart ID (cart_hdr_uid) the lines belong to
     * @return BaseResponse<bool>
     */
    public function delete(int $cartHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{cartHdrUid}',
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /cart-line/{cartHdrUid}
     *
     * GET Cart Lines
     * Call: $api->commerce->cartLine->get($cartHdrUid)
     *
     * Response data, each item: One cart line with its item's id and assembly flag
     *
     * GET https://commerce.augur-api.com/cart-line/{cartHdrUid}
     * Contract: https://commerce.augur-api.com/openapi.json#/paths/~1cart-line~1{cartHdrUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of CartLineGetItem (fields listed on the class)
     *
     * @param int $cartHdrUid Cart ID (cart_hdr_uid) the lines belong to
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function get(int $cartHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{cartHdrUid}',
            $params,
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /cart-line/{cartHdrUid}/add
     *
     * ADD item to the cart
     * Call: $api->commerce->cartLine->createAdd($cartHdrUid, $data)
     *
     * Request body, each item: One cart line to add or update; the body is a JSON array of these
     *
     * Errors:
     *   400: Cart header uid is required. Or Cart line data is required. Or Every cart line
     *       requires invMastUid, quantity and unitOfMeasure.
     *
     * POST https://commerce.augur-api.com/cart-line/{cartHdrUid}/add
     * Contract:
     * https://commerce.augur-api.com/openapi.json#/paths/~1cart-line~1{cartHdrUid}~1add/post
     *
     * Request body ($data): list of CartLineAddCreateBodyItem (fields listed on the class)
     *
     * Response data type: bool
     *
     * @param int $cartHdrUid Cart ID (cart_hdr_uid) the lines belong to
     * @param list<CartLineAddCreateBodyItem> $data
     * @return BaseResponse<bool>
     */
    public function createAdd(int $cartHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{cartHdrUid}/add',
            $data,
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /cart-line/{cartHdrUid}/lines/{lineNo}
     *
     * DELETE Cart Line
     * Call: $api->commerce->cartLine->deleteLines($cartHdrUid, $lineNo)
     *
     * DELETE a specific Cart Line
     *
     * Response data: Confirmation that a cart line was deleted
     *
     * Errors:
     *   404: No record with this ID. Or Cart line not found.
     *
     * DELETE https://commerce.augur-api.com/cart-line/{cartHdrUid}/lines/{lineNo}
     * Contract:
     * https://commerce.augur-api.com/openapi.json#/paths/~1cart-line~1{cartHdrUid}~1lines~1{lineNo}/delete
     *
     * Response data type: CartLineLinesDeleteData (fields listed on the class)
     *
     * @param int $cartHdrUid Cart ID (cart_hdr_uid) the lines belong to
     * @param int $lineNo Line number within the cart
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteLines(int $cartHdrUid, int $lineNo): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{cartHdrUid}/lines/{lineNo}',
            ['cartHdrUid' => (string) $cartHdrUid, 'lineNo' => (string) $lineNo],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /cart-line/{cartHdrUid}/update
     *
     * UPDATE item to the cart
     * Call: $api->commerce->cartLine->createUpdate($cartHdrUid, $data)
     *
     * Request body, each item: One cart line to add or update; the body is a JSON array of these
     *
     * Errors:
     *   400: Cart header uid is required. Or Cart line data is required. Or Every cart line
     *       requires invMastUid, quantity and unitOfMeasure.
     *
     * POST https://commerce.augur-api.com/cart-line/{cartHdrUid}/update
     * Contract:
     * https://commerce.augur-api.com/openapi.json#/paths/~1cart-line~1{cartHdrUid}~1update/post
     *
     * Request body ($data): list of CartLineAddCreateBodyItem (fields listed on the class)
     *
     * Response data type: bool
     *
     * @param int $cartHdrUid Cart ID (cart_hdr_uid) the lines belong to
     * @param list<CartLineAddCreateBodyItem> $data
     * @return BaseResponse<bool>
     */
    public function createUpdate(int $cartHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{cartHdrUid}/update',
            $data,
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
