<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * InvProfileHdr resource.
 *
 * @fullPath api.vmi.invProfileHdr
 * @service vmi
 * @domain inventory
 */
final class InvProfileHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List inventory profile headers.
     *
     * @fullPath api.vmi.invProfileHdr.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/inv-profile-hdr', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get inventory profile header details.
     *
     * @fullPath api.vmi.invProfileHdr.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invProfileHdrUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-profile-hdr/{invProfileHdrUid}',
            [],
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create inventory profile header.
     *
     * @fullPath api.vmi.invProfileHdr.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/inv-profile-hdr', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update inventory profile header.
     *
     * @fullPath api.vmi.invProfileHdr.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invProfileHdrUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/inv-profile-hdr/{invProfileHdrUid}',
            $data,
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete inventory profile header.
     *
     * @fullPath api.vmi.invProfileHdr.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $invProfileHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/inv-profile-hdr/{invProfileHdrUid}',
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }

    /**
     * Upload Excel file to create inventory profile headers.
     *
     * @fullPath api.vmi.invProfileHdr.upload.create
     * @return BaseResponse<array<string, mixed>>
     */
    public function uploadCreate(int $customerId): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/inv-profile-hdr/{customerId}/upload',
            [],
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * List inventory profile lines for a header.
     *
     * @fullPath api.vmi.invProfileHdr.invProfileLine.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listInvProfileLine(int $invProfileHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-profile-hdr/{invProfileHdrUid}/inv-profile-line',
            $params,
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get inventory profile line details.
     *
     * @fullPath api.vmi.invProfileHdr.invProfileLine.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function getInvProfileLine(int $invProfileHdrUid, int $invProfileLineUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}',
            [],
            [
                'invProfileHdrUid' => (string) $invProfileHdrUid,
                'invProfileLineUid' => (string) $invProfileLineUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create inventory profile line.
     *
     * @fullPath api.vmi.invProfileHdr.invProfileLine.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createInvProfileLine(int $invProfileHdrUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/inv-profile-hdr/{invProfileHdrUid}/inv-profile-line',
            $data,
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update inventory profile line.
     *
     * @fullPath api.vmi.invProfileHdr.invProfileLine.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateInvProfileLine(
        int $invProfileHdrUid,
        int $invProfileLineUid,
        array $data,
    ): BaseResponse {
        $response = $this->client->put(
            $this->baseUrl,
            '/inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}',
            $data,
            [
                'invProfileHdrUid' => (string) $invProfileHdrUid,
                'invProfileLineUid' => (string) $invProfileLineUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete inventory profile line.
     *
     * @fullPath api.vmi.invProfileHdr.invProfileLine.delete
     * @return BaseResponse<bool>
     */
    public function deleteInvProfileLine(int $invProfileHdrUid, int $invProfileLineUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}',
            [
                'invProfileHdrUid' => (string) $invProfileHdrUid,
                'invProfileLineUid' => (string) $invProfileLineUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
