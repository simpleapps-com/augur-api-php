<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * restockHdr resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
 */
final class RestockHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /restock-hdr
     *
     * Response data type: array
     *   restockHdrUid: int
     *   warehouseUid: int
     *   distributorsUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   jsonData: string|null
     *   processState: string
     *   poNo: string|null
     *   usersId: int
     *   customerId: float
     *   contactId: string|null
     *   deliveryInstructions: string|null
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
     * POST /restock-hdr
     *
     * Response data type: object
     *   restockHdrUid: int
     *   warehouseUid: int
     *   distributorsUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   jsonData: string|null
     *   processState: string
     *   poNo: string|null
     *   usersId: int
     *   customerId: float
     *   contactId: string|null
     *   deliveryInstructions: string|null
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
     * DELETE /restock-hdr/{restockHdrUid}
     *
     * Response data type: object
     *   restockHdrUid: int
     *   warehouseUid: int
     *   distributorsUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   jsonData: string|null
     *   processState: string
     *   poNo: string|null
     *   usersId: int
     *   customerId: float
     *   contactId: string|null
     *   deliveryInstructions: string|null
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $restockHdrUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{restockHdrUid}',
            ['restockHdrUid' => (string) $restockHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /restock-hdr/{restockHdrUid}
     *
     * Response data type: object
     *   restockHdrUid: int
     *   warehouseUid: int
     *   distributorsUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   jsonData: string|null
     *   processState: string
     *   poNo: string|null
     *   usersId: int
     *   customerId: float
     *   contactId: string|null
     *   deliveryInstructions: string|null
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $restockHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{restockHdrUid}',
            $params,
            ['restockHdrUid' => (string) $restockHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /restock-hdr/{restockHdrUid}
     *
     * Response data type: object
     *   restockHdrUid: int
     *   warehouseUid: int
     *   distributorsUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   jsonData: string|null
     *   processState: string
     *   poNo: string|null
     *   usersId: int
     *   customerId: float
     *   contactId: string|null
     *   deliveryInstructions: string|null
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $restockHdrUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{restockHdrUid}',
            $data,
            ['restockHdrUid' => (string) $restockHdrUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
