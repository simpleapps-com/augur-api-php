<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMastFiles resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-pim
 */
final class InvMastFilesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast-files
     *
     * Response data type: array
     *   invMastFilesUid: int
     *   invMastUid: int
     *   fileName: string
     *   filePath: string
     *   linkArea: int
     *   rowStatusFlag: int
     *   sequenceNo: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   fileDesc: string
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
     * POST /inv-mast-files
     *
     * Response data type: object
     *   invMastFilesUid: int
     *   invMastUid: int
     *   fileName: string
     *   filePath: string
     *   linkArea: int
     *   rowStatusFlag: int
     *   sequenceNo: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   fileDesc: string
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
     * DELETE /inv-mast-files/{invMastFilesUid}
     *
     * @return BaseResponse<mixed>
     */
    public function delete(int $invMastFilesUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastFilesUid}',
            ['invMastFilesUid' => (string) $invMastFilesUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast-files/{invMastFilesUid}
     *
     * Response data type: object
     *   invMastFilesUid: int
     *   invMastUid: int
     *   fileName: string
     *   filePath: string
     *   linkArea: int
     *   rowStatusFlag: int
     *   sequenceNo: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   fileDesc: string
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastFilesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastFilesUid}',
            $params,
            ['invMastFilesUid' => (string) $invMastFilesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-mast-files/{invMastFilesUid}
     *
     * Response data type: object
     *   invMastFilesUid: int
     *   invMastUid: int
     *   fileName: string
     *   filePath: string
     *   linkArea: int
     *   rowStatusFlag: int
     *   sequenceNo: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   fileDesc: string
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invMastFilesUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastFilesUid}',
            $data,
            ['invMastFilesUid' => (string) $invMastFilesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
