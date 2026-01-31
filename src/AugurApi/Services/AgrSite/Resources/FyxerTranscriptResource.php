<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Fyxer transcript resource.
 *
 * @fullPath api.agrSite.fyxerTranscript
 * @service agr_site
 * @domain augur
 */
final class FyxerTranscriptResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List Fyxer transcripts.
     *
     * @fullPath api.agrSite.fyxerTranscript.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/fyxer-transcript', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get Fyxer transcript details.
     *
     * @fullPath api.agrSite.fyxerTranscript.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $fyxerTranscriptHdrUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/fyxer-transcript/{fyxerTranscriptHdrUid}',
            [],
            ['fyxerTranscriptHdrUid' => (string) $fyxerTranscriptHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create Fyxer transcript.
     *
     * @fullPath api.agrSite.fyxerTranscript.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/fyxer-transcript', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update Fyxer transcript.
     *
     * @fullPath api.agrSite.fyxerTranscript.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $fyxerTranscriptHdrUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/fyxer-transcript/{fyxerTranscriptHdrUid}',
            $data,
            ['fyxerTranscriptHdrUid' => (string) $fyxerTranscriptHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete Fyxer transcript.
     *
     * @fullPath api.agrSite.fyxerTranscript.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $fyxerTranscriptHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/fyxer-transcript/{fyxerTranscriptHdrUid}',
            ['fyxerTranscriptHdrUid' => (string) $fyxerTranscriptHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
