<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * menu resource — generated from spec.
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
 * MenuListItem:
 * Returned by: $api->joomla->menu->list()
 *   id: int — Menu item ID
 *   menutype: string — Menu the item belongs to (max 24 chars)
 *   title: string — Title (max 255 chars)
 *   alias: string — URL alias (max 400 chars)
 *   note: string — Admin note (max 255 chars)
 *   path: string — Route path (max 1024 chars)
 *   link: string — Joomla link (index.php?option=...) (max 1024 chars)
 *   type: string — Item type (component, url, alias, separator, heading) (max 16 chars)
 *   published: int — Publish state (1 = published, 0 = unpublished, -2 = trashed)
 *   level: int — Depth in the tree
 *   componentId: int — Component the item opens
 *   checkedOut: int — User who has the record checked out; 0 when none
 *   checkedOutTime: string — When the record was checked out (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   browserNav: int — Target window (0 = parent, 1 = new window, 2 = popup)
 *   access: int — Access level ID
 *   img: string — Menu image (max 255 chars)
 *   templateStyleId: int — Template style; 0 for the default
 *   params: string — Joomla params JSON (max 16777215 chars)
 *   lft: int — Nested-set left value
 *   rgt: int — Nested-set right value
 *   home: int — 1 when this is the home page
 *   language: string — Language tag (* = all) (max 7 chars)
 *   clientId: int — 0 = site, 1 = administrator
 *   parentId: int — Parent menu item ID
 *
 * MenuDocListData: A Joomla menu item with its child items, recursively
 * (MenuHelper::generateDocument)
 * Returned by: $api->joomla->menu->listDoc($id)
 *   id: int — Menu item ID
 *   access: int — Access level
 *   alias: string — URL alias
 *   level: int — Depth in the menu tree
 *   link: string — Joomla link (index.php?option=...)
 *   menuType: string — Menu the item belongs to
 *   parentId: int — Parent menu item ID
 *   path: string — Route path
 *   published: int — 1 when published
 *   title: string — Title
 *   type: string — Item type (component, url, alias, separator, heading)
 *   children: list<mixed> — Child menu items
 *
 * @phpstan-type MenuListItem array{id: int, menutype: string, title: string, alias: string, note: string, path: string, link: string, type: string, published: int, level: int, componentId: int, checkedOut: int, checkedOutTime: string, browserNav: int, access: int, img: string, templateStyleId: int, params: string, lft: int, rgt: int, home: int, language: string, clientId: int, parentId: int}
 * @phpstan-type MenuDocListData array{id: int, access: int, alias: string, level: int, link: string, menuType: string, parentId: int, path: string, published: int, title: string, type: string, children: list<mixed>}
 */
final class MenuResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /menu
     *
     * List Menu Items
     * Call: $api->joomla->menu->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a menu column.
     *
     * GET https://joomla.augur-api.com/menu
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1menu/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   menutype?: string — Joomla menu type identifier
     *   offset?: int — Offset number of results (Default: 0)
     *   orderBy?: string — Sort ordering (Default: lft|ASC)
     *   parentId?: int — Parent menu item ID
     *   published?: int — Published state filter
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of MenuListItem (fields listed on the class)
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
     * GET /menu/{id}/doc
     *
     * Get Menu Doc
     * Call: $api->joomla->menu->listDoc($id)
     *
     * Response data: A Joomla menu item with its child items, recursively
     * (MenuHelper::generateDocument)
     *
     * Errors:
     *   404: No menu item with this ID (or, for ID 0, with this alias).
     *
     * GET https://joomla.augur-api.com/menu/{id}/doc
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1menu~1{id}~1doc/get
     *
     * Query params ($params; `?` = optional):
     *   alias?: string — Menu alias for lookup when id=0
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: MenuDocListData (fields listed on the class)
     *
     * @param int $id menu.id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDoc(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/doc',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /menu/{id}/doc
     * Call: $api->joomla->menu->getDoc($id)
     *
     * @param int $id menu.id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $id, array $params = []): BaseResponse
    {
        return $this->listDoc($id, $params);
    }
}
