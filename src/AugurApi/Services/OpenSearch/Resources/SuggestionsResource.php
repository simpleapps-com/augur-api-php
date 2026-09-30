<?php

declare(strict_types=1);

namespace AugurApi\Services\OpenSearch\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * suggestions resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py open-search
 */
final class SuggestionsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /suggestions
     *
     * Response data type: array
     *   suggestionsUid: int
     *   queryStringUid: int
     *   suggestionsString: string
     *   suggestionsMetaphone: string|null
     *   avgTotalResults: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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
     * GET /suggestions/suggest
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listSuggest(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/suggest', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /suggestions/{suggestionsUid}
     *
     * Response data type: object
     *   suggestionsUid: int
     *   queryStringUid: int
     *   suggestionsString: string
     *   suggestionsMetaphone: string|null
     *   avgTotalResults: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $suggestionsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{suggestionsUid}',
            $params,
            ['suggestionsUid' => (string) $suggestionsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
