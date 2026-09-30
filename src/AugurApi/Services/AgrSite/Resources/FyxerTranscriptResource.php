<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * fyxerTranscript resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
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
     * Response data type: array
     *   fyxerTranscriptHdrUid: int
     *   link: string
     *   summary: string|null
     *   transcript: string|null
     *   dateRecorded: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   title: string|null
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
     * Response data type: object
     *   fyxerTranscriptHdrUid: int
     *   link: string
     *   summary: string|null
     *   transcript: string|null
     *   dateRecorded: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   title: string|null
     *
     * @param array<string, mixed> $data
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
     * DELETE /fyxer-transcript/{fyxerTranscriptHdrUid}
     *
     * @return BaseResponse<mixed>
     */
    public function delete(int $fyxerTranscriptHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{fyxerTranscriptHdrUid}',
            ['fyxerTranscriptHdrUid' => (string) $fyxerTranscriptHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /fyxer-transcript/{fyxerTranscriptHdrUid}
     *
     * Response data type: object
     *   fyxerTranscriptHdrUid: int
     *   link: string
     *   summary: string|null
     *   transcript: string|null
     *   dateRecorded: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   title: string|null
     *
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
     * Response data type: object
     *   fyxerTranscriptHdrUid: int
     *   link: string
     *   summary: string|null
     *   transcript: string|null
     *   dateRecorded: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   title: string|null
     *
     * @param array<string, mixed> $data
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
