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
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /fyxer-transcript
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
     * DELETE /fyxer-transcript/{fyxerTranscriptHdrUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $fyxerTranscriptHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{fyxerTranscriptHdrUid}',
            ['fyxerTranscriptHdrUid' => (string) $fyxerTranscriptHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /fyxer-transcript/{fyxerTranscriptHdrUid}
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /fyxer-transcript/{fyxerTranscriptHdrUid}
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
