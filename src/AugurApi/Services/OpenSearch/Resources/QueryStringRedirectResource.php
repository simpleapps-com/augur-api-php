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
     *   queryStringRedirectUid: int
     *   queryStringUid: int
     *   queryStringRedirectLink: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   queryString: string|null
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
     * POST /query-string-redirect
     *
     * Response data type: object
     *   queryStringRedirectUid: int
     *   queryStringUid: int
     *   queryStringRedirectLink: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   queryString: string|null
     *
     * @param array{queryString?: string|null, queryStringUid?: int|null, queryStringRedirectLink?: string|null} $data
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
     * DELETE /query-string-redirect/{queryStringRedirectUid}
     *
     * Response data type: object
     *   queryStringRedirectUid: int
     *   queryStringUid: int
     *   queryStringRedirectLink: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   queryString: string|null
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /query-string-redirect/{queryStringRedirectUid}
     *
     * Response data type: object
     *   queryStringRedirectUid: int
     *   queryStringUid: int
     *   queryStringRedirectLink: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   queryString: string|null
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /query-string-redirect/{queryStringRedirectUid}
     *
     * Response data type: object
     *   queryStringRedirectUid: int
     *   queryStringUid: int
     *   queryStringRedirectLink: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   queryString: string|null
     *
     * @param array{queryString?: string|null, queryStringUid?: int|null, queryStringRedirectLink?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null} $data
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
