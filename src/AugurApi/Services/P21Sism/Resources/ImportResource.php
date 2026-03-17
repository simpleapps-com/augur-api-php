<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Sism\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * import resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-sism
 */
final class ImportResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /import
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
     * GET /import/recent
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listRecent(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/recent', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /import/stuck
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listStuck(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/stuck', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /import/{importUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(string $importUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{importUid}',
            ['importUid' => (string) $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /import/{importUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $importUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{importUid}',
            $params,
            ['importUid' => (string) $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /import/{importUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(string $importUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{importUid}',
            $data,
            ['importUid' => (string) $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /import/{importUid}/imp-oe-hdr
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listImpOeHdr(string $importUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr',
            $params,
            ['importUid' => (string) $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /import/{importUid}/imp-oe-hdr
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateImpOeHdr(string $importUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr',
            $data,
            ['importUid' => (string) $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /import/{importUid}/imp-oe-hdr-salesrep
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listImpOeHdrSalesrep(string $importUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr-salesrep',
            $params,
            ['importUid' => (string) $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /import/{importUid}/imp-oe-hdr-salesrep
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateImpOeHdrSalesrep(string $importUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr-salesrep',
            $data,
            ['importUid' => (string) $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /import/{importUid}/imp-oe-hdr-web
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listImpOeHdrWeb(string $importUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr-web',
            $params,
            ['importUid' => (string) $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
