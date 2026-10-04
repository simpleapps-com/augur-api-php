<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * podcasts resource — generated from spec.
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
 * PodcastsListItem:
 * Returned by: $api->p21Pim->podcasts->list()
 * Returned by: $api->p21Pim->podcasts->create($data)
 * Returned by: $api->p21Pim->podcasts->get($podcastsUid)
 * Returned by: $api->p21Pim->podcasts->update($podcastsUid, $data)
 * Returned by: $api->p21Pim->podcasts->delete($podcastsUid)
 *   podcastsUid: int — Podcast ID
 *   title: string|null — Podcast title (max 255 chars)
 *   path: string|null — Path of the audio file (max 255 chars)
 *   transcript: string — Podcast transcript (max 2147483647 chars)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * PodcastsCreateBody: Create a podcast
 * Request body of: $api->p21Pim->podcasts->create($data)
 *   title?: string|null — Podcast title; defaults to empty
 *   path?: string|null — Path of the audio file; defaults to empty
 *   transcript?: string|null — Podcast transcript; defaults to empty
 *
 * PodcastsUpdateBody: Partial update of a podcast; an absent field keeps its current value
 * Request body of: $api->p21Pim->podcasts->update($podcastsUid, $data)
 *   title?: string|null — Podcast title
 *   path?: string|null — Path of the audio file
 *   transcript?: string|null — Podcast transcript
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *
 * @phpstan-type PodcastsListItem array{podcastsUid: int, title: string|null, path: string|null, transcript: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type PodcastsCreateBody array{title?: string|null, path?: string|null, transcript?: string|null}
 * @phpstan-type PodcastsUpdateBody array{title?: string|null, path?: string|null, transcript?: string|null, statusCd?: int|null}
 */
final class PodcastsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /podcasts
     *
     * List Podcasts
     * Call: $api->p21Pim->podcasts->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a podcasts column.
     *
     * GET https://p21-pim.augur-api.com/podcasts
     * Contract: https://p21-pim.augur-api.com/openapi.json#/paths/~1podcasts/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: podcasts_uid|ASC)
     *   q?: string — Search Query
     *   statusCd?: int — Status Code (status_cd) [(704)|(705)|(700)]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of PodcastsListItem (fields listed on the class)
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
     * POST /podcasts
     *
     * Create Podcast
     * Call: $api->p21Pim->podcasts->create($data)
     *
     * Request body: Create a podcast
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://p21-pim.augur-api.com/podcasts
     * Contract: https://p21-pim.augur-api.com/openapi.json#/paths/~1podcasts/post
     *
     * Request body ($data): PodcastsCreateBody (fields listed on the class)
     *
     * Response data type: PodcastsListItem (fields listed on the class)
     *
     * @param PodcastsCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /podcasts/{podcastsUid}
     *
     * DELETE Podcast
     * Call: $api->p21Pim->podcasts->delete($podcastsUid)
     *
     * Errors:
     *   404: No podcast with this ID.
     *
     * DELETE https://p21-pim.augur-api.com/podcasts/{podcastsUid}
     * Contract: https://p21-pim.augur-api.com/openapi.json#/paths/~1podcasts~1{podcastsUid}/delete
     *
     * Response data type: PodcastsListItem (fields listed on the class)
     *
     * @param int $podcastsUid Podcast ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $podcastsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{podcastsUid}',
            ['podcastsUid' => (string) $podcastsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /podcasts/{podcastsUid}
     *
     * Get Podcast Details
     * Call: $api->p21Pim->podcasts->get($podcastsUid)
     *
     * Errors:
     *   404: No podcast with this ID.
     *
     * GET https://p21-pim.augur-api.com/podcasts/{podcastsUid}
     * Contract: https://p21-pim.augur-api.com/openapi.json#/paths/~1podcasts~1{podcastsUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: PodcastsListItem (fields listed on the class)
     *
     * @param int $podcastsUid Podcast ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $podcastsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{podcastsUid}',
            $params,
            ['podcastsUid' => (string) $podcastsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /podcasts/{podcastsUid}
     *
     * Update Podcast
     * Call: $api->p21Pim->podcasts->update($podcastsUid, $data)
     *
     * Request body: Partial update of a podcast; an absent field keeps its current value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No podcast with this ID.
     *
     * PUT https://p21-pim.augur-api.com/podcasts/{podcastsUid}
     * Contract: https://p21-pim.augur-api.com/openapi.json#/paths/~1podcasts~1{podcastsUid}/put
     *
     * Request body ($data): PodcastsUpdateBody (fields listed on the class)
     *
     * Response data type: PodcastsListItem (fields listed on the class)
     *
     * @param int $podcastsUid Podcast ID
     * @param PodcastsUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $podcastsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{podcastsUid}',
            $data,
            ['podcastsUid' => (string) $podcastsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
