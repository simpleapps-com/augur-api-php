<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * content resource — generated from spec.
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
 * ContentListItem: A Joomla article with its images and custom fields
 * (ContentHelper::generateDocument)
 * Returned by: $api->joomla->content->list()
 * Returned by: $api->joomla->content->listDoc($id)
 *   id: int — Article ID
 *   title: string — Title
 *   alias: string — URL alias
 *   catid: int — Category ID
 *   introtext: string|null — Intro text (HTML)
 *   fulltext: string|null — Full text (HTML)
 *   ordering: int — Sort position within the category
 *   images: array<string, mixed>|array{} — Joomla images JSON (image_intro, image_fulltext and
 *       their attributes); [] when none ([] when empty)
 *   fields: list<ContentListItemFieldsItem> — Custom field values
 *     each item: ContentListItemFieldsItem — One custom field value on an article
 *         (FieldsHelper::listFieldsWithValuesByContentId)
 *
 * ContentListItemFieldsItem: One custom field value on an article
 * (FieldsHelper::listFieldsWithValuesByContentId)
 * Field `fields` of ContentListItem
 *   value: string — Field value
 *   title: string — Field title
 *   name: string — Field name
 *   label: string — Field label
 *
 * ContentGetData: A Joomla article's core fields, without images or custom fields
 * Returned by: $api->joomla->content->get($id)
 *   id: int — Article ID
 *   title: string — Title
 *   alias: string — URL alias
 *   introtext: string|null — Intro text (HTML)
 *   fulltext: string|null — Full text (HTML)
 *   catid: int — Category ID
 *
 * @phpstan-type ContentListItem array{id: int, title: string, alias: string, catid: int, introtext: string|null, fulltext: string|null, ordering: int, images: array<string, mixed>|array{}, fields: list<ContentListItemFieldsItem>}
 * @phpstan-type ContentListItemFieldsItem array{value: string, title: string, name: string, label: string}
 * @phpstan-type ContentGetData array{id: int, title: string, alias: string, introtext: string|null, fulltext: string|null, catid: int}
 */
final class ContentResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /content
     *
     * Get Content list
     * Call: $api->joomla->content->list()
     *
     * Get Content List
     *
     * Response data, each item: A Joomla article with its images and custom fields
     * (ContentHelper::generateDocument)
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a content column.
     *
     * GET https://joomla.augur-api.com/content
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1content/get
     *
     * Query params ($params; `?` = optional):
     *   categoryIdList?: string — CSV List of category IDs
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Offset number of results (Default: 0)
     *   orderBy?: string — Sort ordering: default (ordering|ASC)
     *   q?: string — Query string
     *   tagsList?: string — CSV List of tags
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ContentListItem (fields listed on the class)
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
     * GET /content/{id}
     *
     * Get Content Detail
     * Call: $api->joomla->content->get($id)
     *
     * Response data: A Joomla article's core fields, without images or custom fields
     *
     * Errors:
     *   404: No article with this ID (or, for ID 0, with this alias and catid).
     *
     * GET https://joomla.augur-api.com/content/{id}
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1content~1{id}/get
     *
     * Query params ($params; `?` = optional):
     *   alias?: string — content.alias
     *   catid?: int — content.catid
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ContentGetData (fields listed on the class)
     *
     * @param int $id content.id
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

    /**
     * GET /content/{id}/doc
     *
     * Get Content Doc
     * Call: $api->joomla->content->listDoc($id)
     *
     * Response data: A Joomla article with its images and custom fields
     * (ContentHelper::generateDocument)
     *
     * Errors:
     *   404: No article with this ID (or, for ID 0, with this alias and catid).
     *
     * GET https://joomla.augur-api.com/content/{id}/doc
     * Contract: https://joomla.augur-api.com/openapi.json#/paths/~1content~1{id}~1doc/get
     *
     * Query params ($params; `?` = optional):
     *   alias?: string — content.alias
     *   catid?: int — content.catid
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ContentListItem (fields listed on the class)
     *
     * @param int $id content.id
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
     * Alias for listDoc — GET /content/{id}/doc
     * Call: $api->joomla->content->getDoc($id)
     *
     * @param int $id content.id
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $id, array $params = []): BaseResponse
    {
        return $this->listDoc($id, $params);
    }
}
