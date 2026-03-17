<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invProfileHdr resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
 */
final class InvProfileHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-profile-hdr
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
     * POST /inv-profile-hdr
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
     * POST /inv-profile-hdr/{customerId}/upload
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createUpload(int $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/upload',
            $data,
            ['customerId' => (string) $customerId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /inv-profile-hdr/{invProfileHdrUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $invProfileHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invProfileHdrUid}',
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-profile-hdr/{invProfileHdrUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invProfileHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invProfileHdrUid}',
            $params,
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /inv-profile-hdr/{invProfileHdrUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invProfileHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invProfileHdrUid}',
            $data,
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listInvProfileLine(int $invProfileHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invProfileHdrUid}/inv-profile-line',
            $params,
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createInvProfileLine(int $invProfileHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invProfileHdrUid}/inv-profile-line',
            $data,
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteInvProfileLine(int $invProfileHdrUid, int $invProfileLineUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}',
            ['invProfileHdrUid' => (string) $invProfileHdrUid, 'invProfileLineUid' => (string) $invProfileLineUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getInvProfileLine(int $invProfileHdrUid, int $invProfileLineUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}',
            $params,
            ['invProfileHdrUid' => (string) $invProfileHdrUid, 'invProfileLineUid' => (string) $invProfileLineUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateInvProfileLine(int $invProfileHdrUid, int $invProfileLineUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}',
            $data,
            ['invProfileHdrUid' => (string) $invProfileHdrUid, 'invProfileLineUid' => (string) $invProfileLineUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
