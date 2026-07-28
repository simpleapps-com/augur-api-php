<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * queryStringRedirect resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py open-search
 */
final class QueryStringRedirectResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /query-string-redirect
     *
     * Response data type: array
     * Known fields: queryStringRedirectUid, queryStringUid, queryStringRedirectLink, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (9 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /query-string-redirect
     *
     * Response data type: object
     * Known fields: queryStringRedirectUid, queryStringUid, queryStringRedirectLink, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (9 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /query-string-redirect/{queryStringRedirectUid}
     *
     * Response data type: object
     * Known fields: queryStringRedirectUid, queryStringUid, queryStringRedirectLink, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (9 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $queryStringRedirectUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{queryStringRedirectUid}',
            ['queryStringRedirectUid' => (string) $queryStringRedirectUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /query-string-redirect/{queryStringRedirectUid}
     *
     * Response data type: object
     * Known fields: queryStringRedirectUid, queryStringUid, queryStringRedirectLink, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (9 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $queryStringRedirectUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{queryStringRedirectUid}',
            $params,
            ['queryStringRedirectUid' => (string) $queryStringRedirectUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /query-string-redirect/{queryStringRedirectUid}
     *
     * Response data type: object
     * Known fields: queryStringRedirectUid, queryStringUid, queryStringRedirectLink, dateCreated, dateLastModified, updateCd, statusCd, processCd, ... (9 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $queryStringRedirectUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{queryStringRedirectUid}',
            $data,
            ['queryStringRedirectUid' => (string) $queryStringRedirectUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
