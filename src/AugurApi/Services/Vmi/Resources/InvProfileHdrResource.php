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
     * @return BaseResponse<mixed>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /inv-profile-hdr
     *
     * Response data type: object
     *   invProfileHdrUid: int
     *   invProfileHdrId: string
     *   invProfileHdrDesc: string
     *   customerId: float
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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
     * POST /inv-profile-hdr/{customerId}/upload
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createUpload(int $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{customerId}/upload',
            $data,
            ['customerId' => (string) $customerId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /inv-profile-hdr/{invProfileHdrUid}
     *
     * @return BaseResponse<mixed>
     */
    public function delete(int $invProfileHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invProfileHdrUid}',
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-profile-hdr/{invProfileHdrUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $invProfileHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invProfileHdrUid}',
            $params,
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-profile-hdr/{invProfileHdrUid}
     *
     * Response data type: object
     *   invProfileHdrUid: int
     *   invProfileHdrId: string
     *   invProfileHdrDesc: string
     *   customerId: float
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line
     *
     * Response data type: array
     *   invProfileLineUid: int
     *   invProfileHdrUid: int
     *   invMastUid: int
     *   invProfileLineType: string
     *   invProfileHdrMinQty: float
     *   invProfileHdrMaxQty: float
     *   invProfileHdrReorderQty: float
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   sectionsUid: int
     *   keywords: string|null
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listInvProfileLine(int $invProfileHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invProfileHdrUid}/inv-profile-line',
            $params,
            ['invProfileHdrUid' => (string) $invProfileHdrUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line
     *
     * Response data type: object
     *   invProfileLineUid: int
     *   invProfileHdrUid: int
     *   invMastUid: int
     *   invProfileLineType: string
     *   invProfileHdrMinQty: float
     *   invProfileHdrMaxQty: float
     *   invProfileHdrReorderQty: float
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   sectionsUid: int
     *   keywords: string|null
     *
     * @param list<array{invProfileLineType: string, invMastUid: int, sectionsUid?: int, invProfileHdrMinQty?: float, invProfileHdrMaxQty?: float, invProfileHdrReorderQty?: float}> $data
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}
     *
     * Response data type: object
     *   invProfileLineUid: int
     *   invProfileHdrUid: int
     *   invMastUid: int
     *   invProfileLineType: string
     *   invProfileHdrMinQty: float
     *   invProfileHdrMaxQty: float
     *   invProfileHdrReorderQty: float
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   sectionsUid: int
     *   keywords: string|null
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}
     *
     * Response data type: object
     *   invProfileLineUid: int
     *   invProfileHdrUid: int
     *   invMastUid: int
     *   invProfileLineType: string
     *   invProfileHdrMinQty: float
     *   invProfileHdrMaxQty: float
     *   invProfileHdrReorderQty: float
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   sectionsUid: int
     *   keywords: string|null
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-profile-hdr/{invProfileHdrUid}/inv-profile-line/{invProfileLineUid}
     *
     * Response data type: object
     *   invProfileLineUid: int
     *   invProfileHdrUid: int
     *   invMastUid: int
     *   invProfileLineType: string
     *   invProfileHdrMinQty: float
     *   invProfileHdrMaxQty: float
     *   invProfileHdrReorderQty: float
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   sectionsUid: int
     *   keywords: string|null
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
