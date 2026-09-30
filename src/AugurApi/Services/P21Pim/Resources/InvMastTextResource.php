<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMastText resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-pim
 */
final class InvMastTextResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast-text
     *
     * Response data type: array
     *   invMastTextUid: int
     *   invMastUid: int
     *   sequenceNo: int
     *   textValue: string
     *   displayOnWebFlag: string
     *   webDisplayTypeUid: int
     *   textTypeCd: int
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
     * POST /inv-mast-text
     *
     * Response data type: object
     *   invMastTextUid: int
     *   invMastUid: int
     *   sequenceNo: int
     *   textValue: string
     *   displayOnWebFlag: string
     *   webDisplayTypeUid: int
     *   textTypeCd: int
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
     * DELETE /inv-mast-text/{invMastTextUid}
     *
     * @return BaseResponse<mixed>
     */
    public function delete(int $invMastTextUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastTextUid}',
            ['invMastTextUid' => (string) $invMastTextUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast-text/{invMastTextUid}
     *
     * Response data type: object
     *   invMastTextUid: int
     *   invMastUid: int
     *   sequenceNo: int
     *   textValue: string
     *   displayOnWebFlag: string
     *   webDisplayTypeUid: int
     *   textTypeCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastTextUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastTextUid}',
            $params,
            ['invMastTextUid' => (string) $invMastTextUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-mast-text/{invMastTextUid}
     *
     * Response data type: object
     *   invMastTextUid: int
     *   invMastUid: int
     *   sequenceNo: int
     *   textValue: string
     *   displayOnWebFlag: string
     *   webDisplayTypeUid: int
     *   textTypeCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invMastTextUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastTextUid}',
            $data,
            ['invMastTextUid' => (string) $invMastTextUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
