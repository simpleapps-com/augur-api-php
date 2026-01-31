<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Sism\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Import resource.
 *
 * @fullPath api.p21Sism.import
 * @service p21-sism
 * @domain data-import-management
 */
final class ImportResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List imports with filtering capabilities.
     *
     * @fullPath api.p21Sism.import.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/import', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get import details by UID.
     *
     * @fullPath api.p21Sism.import.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $importUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/import/{importUid}',
            [],
            ['importUid' => $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Update import details.
     *
     * @fullPath api.p21Sism.import.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(string $importUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/import/{importUid}',
            $data,
            ['importUid' => $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Clean pending import data.
     *
     * @fullPath api.p21Sism.import.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(string $importUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/import/{importUid}',
            ['importUid' => $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get recent imports for monitoring.
     *
     * @fullPath api.p21Sism.import.recent.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listRecent(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/import/recent', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get stuck imports for troubleshooting.
     *
     * @fullPath api.p21Sism.import.stuck.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listStuck(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/import/stuck', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get order entry header details.
     *
     * @fullPath api.p21Sism.import.impOeHdr.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function getImpOeHdr(string $importUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/import/{importUid}/imp-oe-hdr',
            [],
            ['importUid' => $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Update order entry header data.
     *
     * @fullPath api.p21Sism.import.impOeHdr.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateImpOeHdr(string $importUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/import/{importUid}/imp-oe-hdr',
            $data,
            ['importUid' => $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Get order entry sales representative details.
     *
     * @fullPath api.p21Sism.import.impOeHdrSalesrep.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function getImpOeHdrSalesrep(string $importUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/import/{importUid}/imp-oe-hdr-salesrep',
            [],
            ['importUid' => $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Update order entry sales representative data.
     *
     * @fullPath api.p21Sism.import.impOeHdrSalesrep.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateImpOeHdrSalesrep(string $importUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/import/{importUid}/imp-oe-hdr-salesrep',
            $data,
            ['importUid' => $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Get order entry web header details.
     *
     * @fullPath api.p21Sism.import.impOeHdrWeb.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function getImpOeHdrWeb(string $importUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/import/{importUid}/imp-oe-hdr-web',
            [],
            ['importUid' => $importUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
