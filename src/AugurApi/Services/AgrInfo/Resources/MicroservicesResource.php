<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * microservices resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-info.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-info.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-info.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-info
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * MicroservicesListItem:
 * Returned by: $api->agrInfo->microservices->list()
 * Returned by: $api->agrInfo->microservices->create($data)
 * Returned by: $api->agrInfo->microservices->get($microservicesUid)
 * Returned by: $api->agrInfo->microservices->update($microservicesUid, $data)
 * Returned by: $api->agrInfo->microservices->delete($microservicesUid)
 *   microservicesUid: int — Microservice ID
 *   name: string|null — Microservice name (max 255 chars)
 *   id: string|null — Microservice id (slug derived from the name) (max 255 chars)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *
 * MicroservicesCreateBody: Register a microservice, or return the existing one whose id the name
 * derives
 * Request body of: $api->agrInfo->microservices->create($data)
 *   name: string|null — Microservice name; required, the id slug is derived from it
 *
 * MicroservicesUpdateBody: Partial update of a microservice's codes; an absent field keeps its
 * current value
 * Request body of: $api->agrInfo->microservices->update($microservicesUid, $data)
 *   updateCd?: int|null — Update code (1185 = Import Complete)
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code (704 = Active, 1185 = Import Complete)
 *
 * @phpstan-type MicroservicesListItem array{microservicesUid: int, name: string|null, id: string|null, updateCd: int, statusCd: int, processCd: int, dateCreated: string, dateLastModified: string}
 * @phpstan-type MicroservicesCreateBody array{name: string|null}
 * @phpstan-type MicroservicesUpdateBody array{updateCd?: int|null, statusCd?: int|null, processCd?: int|null}
 */
final class MicroservicesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /microservices
     *
     * List Microservices
     * Call: $api->agrInfo->microservices->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a microservices column.
     *
     * GET https://agr-info.augur-api.com/microservices
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1microservices/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: microservices_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of MicroservicesListItem (fields listed on the class)
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
     * POST /microservices
     *
     * Create Microservice
     * Call: $api->agrInfo->microservices->create($data)
     *
     * Request body: Register a microservice, or return the existing one whose id the name derives
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or name is missing.
     *
     * POST https://agr-info.augur-api.com/microservices
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1microservices/post
     *
     * Request body ($data): MicroservicesCreateBody (fields listed on the class)
     *
     * Response data type: MicroservicesListItem (fields listed on the class)
     *
     * @param MicroservicesCreateBody $data
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
     * DELETE /microservices/{microservicesUid}
     *
     * DELETE Microservice
     * Call: $api->agrInfo->microservices->delete($microservicesUid)
     *
     * Errors:
     *   404: No microservice with this ID.
     *
     * DELETE https://agr-info.augur-api.com/microservices/{microservicesUid}
     * Contract:
     * https://agr-info.augur-api.com/openapi.json#/paths/~1microservices~1{microservicesUid}/delete
     *
     * Response data type: MicroservicesListItem (fields listed on the class)
     *
     * @param int $microservicesUid Microservice ID
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $microservicesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{microservicesUid}',
            ['microservicesUid' => (string) $microservicesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /microservices/{microservicesUid}
     *
     * Get Microservice Details
     * Call: $api->agrInfo->microservices->get($microservicesUid)
     *
     * Errors:
     *   404: No microservice with this ID.
     *
     * GET https://agr-info.augur-api.com/microservices/{microservicesUid}
     * Contract:
     * https://agr-info.augur-api.com/openapi.json#/paths/~1microservices~1{microservicesUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: MicroservicesListItem (fields listed on the class)
     *
     * @param int $microservicesUid Microservice ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $microservicesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{microservicesUid}',
            $params,
            ['microservicesUid' => (string) $microservicesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /microservices/{microservicesUid}
     *
     * Update Microservice
     * Call: $api->agrInfo->microservices->update($microservicesUid, $data)
     *
     * Request body: Partial update of a microservice's codes; an absent field keeps its current
     * value
     *
     * Errors:
     *   400: The body is missing or not a JSON object.
     *   404: No microservice with this ID.
     *
     * PUT https://agr-info.augur-api.com/microservices/{microservicesUid}
     * Contract:
     * https://agr-info.augur-api.com/openapi.json#/paths/~1microservices~1{microservicesUid}/put
     *
     * Request body ($data): MicroservicesUpdateBody (fields listed on the class)
     *
     * Response data type: MicroservicesListItem (fields listed on the class)
     *
     * @param int $microservicesUid Microservice ID
     * @param MicroservicesUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $microservicesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{microservicesUid}',
            $data,
            ['microservicesUid' => (string) $microservicesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
