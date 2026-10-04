<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * fyxerTranscript resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-site.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-site.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-site.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * FyxerTranscriptListItem:
 * Returned by: $api->agrSite->fyxerTranscript->list()
 * Returned by: $api->agrSite->fyxerTranscript->create($data)
 * Returned by: $api->agrSite->fyxerTranscript->get($fyxerTranscriptHdrUid)
 * Returned by: $api->agrSite->fyxerTranscript->update($fyxerTranscriptHdrUid, $data)
 * Returned by: $api->agrSite->fyxerTranscript->delete($fyxerTranscriptHdrUid)
 *   fyxerTranscriptHdrUid: int — Fyxer transcript ID
 *   link: string — Recording link (max 255 chars)
 *   summary: string|null — Meeting summary (max 4294967295 chars)
 *   transcript: string|null — Full transcript text (max 4294967295 chars)
 *   dateRecorded: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateCreated: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   dateLastModified: string — MySQL datetime format: YYYY-MM-DD HH:mm:ss (mysql-datetime, e.g.
 *       2025-07-30 15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   title: string|null — Meeting title (max 255 chars)
 *
 * FyxerTranscriptCreateBody: Create a Fyxer meeting transcript, or return the existing one with the
 * same link
 * Request body of: $api->agrSite->fyxerTranscript->create($data)
 *   title: string|null — Meeting title
 *   link?: string|null — Recording link; an existing transcript with this link is returned
 *       unchanged
 *   transcript?: string|null — Full transcript text
 *   summary?: string|null — Meeting summary
 *   dateRecorded?: string|null — When the meeting was recorded (any date-time PHP can parse)
 *
 * FyxerTranscriptUpdateBody: Partial update of a Fyxer meeting transcript; an absent field keeps
 * its current value
 * Request body of: $api->agrSite->fyxerTranscript->update($fyxerTranscriptHdrUid, $data)
 *   link?: string|null — Recording link
 *   summary?: string|null — Meeting summary
 *   transcript?: string|null — Full transcript text
 *   title?: string|null — Meeting title
 *   dateRecorded?: string|null — When the meeting was recorded (any date-time PHP can parse)
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code (704 = Active, 1185 = Import Complete)
 *
 * @phpstan-type FyxerTranscriptListItem array{fyxerTranscriptHdrUid: int, link: string, summary: string|null, transcript: string|null, dateRecorded: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, title: string|null}
 * @phpstan-type FyxerTranscriptCreateBody array{title: string|null, link?: string|null, transcript?: string|null, summary?: string|null, dateRecorded?: string|null}
 * @phpstan-type FyxerTranscriptUpdateBody array{link?: string|null, summary?: string|null, transcript?: string|null, title?: string|null, dateRecorded?: string|null, statusCd?: int|null, processCd?: int|null}
 */
final class FyxerTranscriptResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /fyxer-transcript
     *
     * List Fyxer Transcripts
     * Call: $api->agrSite->fyxerTranscript->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a fyxer_transcript_hdr column.
     *
     * GET https://agr-site.augur-api.com/fyxer-transcript
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1fyxer-transcript/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: fyxer_transcript_hdr_uid|ASC)
     *   q?: string — Search Query
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of FyxerTranscriptListItem (fields listed on the class)
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
     * POST /fyxer-transcript
     *
     * Create Fyxer Transcript
     * Call: $api->agrSite->fyxerTranscript->create($data)
     *
     * Request body: Create a Fyxer meeting transcript, or return the existing one with the same
     * link
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *
     * POST https://agr-site.augur-api.com/fyxer-transcript
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1fyxer-transcript/post
     *
     * Request body ($data): FyxerTranscriptCreateBody (fields listed on the class)
     *
     * Response data type: FyxerTranscriptListItem (fields listed on the class)
     *
     * @param FyxerTranscriptCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /fyxer-transcript/{fyxerTranscriptHdrUid}
     *
     * DELETE Fyxer Transcript
     * Call: $api->agrSite->fyxerTranscript->delete($fyxerTranscriptHdrUid)
     *
     * Errors:
     *   404: No transcript with this ID.
     *
     * DELETE https://agr-site.augur-api.com/fyxer-transcript/{fyxerTranscriptHdrUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1fyxer-transcript~1{fyxerTranscriptHdrUid}/delete
     *
     * Response data type: FyxerTranscriptListItem (fields listed on the class)
     *
     * @param int $fyxerTranscriptHdrUid Fyxer transcript ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $fyxerTranscriptHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{fyxerTranscriptHdrUid}',
            ['fyxerTranscriptHdrUid' => (string) $fyxerTranscriptHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /fyxer-transcript/{fyxerTranscriptHdrUid}
     *
     * Get Fyxer Transcript Details
     * Call: $api->agrSite->fyxerTranscript->get($fyxerTranscriptHdrUid)
     *
     * Errors:
     *   404: No transcript with this ID.
     *
     * GET https://agr-site.augur-api.com/fyxer-transcript/{fyxerTranscriptHdrUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1fyxer-transcript~1{fyxerTranscriptHdrUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: FyxerTranscriptListItem (fields listed on the class)
     *
     * @param int $fyxerTranscriptHdrUid Fyxer transcript ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $fyxerTranscriptHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{fyxerTranscriptHdrUid}',
            $params,
            ['fyxerTranscriptHdrUid' => (string) $fyxerTranscriptHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /fyxer-transcript/{fyxerTranscriptHdrUid}
     *
     * Update Fyxer Transcript
     * Call: $api->agrSite->fyxerTranscript->update($fyxerTranscriptHdrUid, $data)
     *
     * Request body: Partial update of a Fyxer meeting transcript; an absent field keeps its current
     * value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No transcript with this ID.
     *
     * PUT https://agr-site.augur-api.com/fyxer-transcript/{fyxerTranscriptHdrUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1fyxer-transcript~1{fyxerTranscriptHdrUid}/put
     *
     * Request body ($data): FyxerTranscriptUpdateBody (fields listed on the class)
     *
     * Response data type: FyxerTranscriptListItem (fields listed on the class)
     *
     * @param int $fyxerTranscriptHdrUid Fyxer transcript ID
     * @param FyxerTranscriptUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $fyxerTranscriptHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{fyxerTranscriptHdrUid}',
            $data,
            ['fyxerTranscriptHdrUid' => (string) $fyxerTranscriptHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
