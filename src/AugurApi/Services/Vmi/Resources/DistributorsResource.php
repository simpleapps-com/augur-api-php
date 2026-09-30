<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * distributors resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
 */
final class DistributorsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /distributors
     *
     * Response data type: array
     *   distributorsUid: int
     *   customerId: float
     *   distributorsId: string
     *   distributorsName: string
     *   distributorsDesc: string
     *   distributorsEmail: string
     *   distributorsAccount: string
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
     * POST /distributors
     *
     * Response data type: object
     *   distributorsUid: int
     *   customerId: float
     *   distributorsId: string
     *   distributorsName: string
     *   distributorsDesc: string
     *   distributorsEmail: string
     *   distributorsAccount: string
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
     * DELETE /distributors/{distributorsUid}
     *
     * Response data type: object
     *   distributorsUid: int
     *   customerId: float
     *   distributorsId: string
     *   distributorsName: string
     *   distributorsDesc: string
     *   distributorsEmail: string
     *   distributorsAccount: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $distributorsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{distributorsUid}',
            ['distributorsUid' => (string) $distributorsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /distributors/{distributorsUid}
     *
     * Response data type: object
     *   distributorsUid: int
     *   customerId: float
     *   distributorsId: string
     *   distributorsName: string
     *   distributorsDesc: string
     *   distributorsEmail: string
     *   distributorsAccount: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $distributorsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{distributorsUid}',
            $params,
            ['distributorsUid' => (string) $distributorsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /distributors/{distributorsUid}
     *
     * Response data type: object
     *   distributorsUid: int
     *   customerId: float
     *   distributorsId: string
     *   distributorsName: string
     *   distributorsDesc: string
     *   distributorsEmail: string
     *   distributorsAccount: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $distributorsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{distributorsUid}',
            $data,
            ['distributorsUid' => (string) $distributorsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /distributors/{distributorsUid}/enable
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function updateEnable(int $distributorsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{distributorsUid}/enable',
            $data,
            ['distributorsUid' => (string) $distributorsUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /distributors/{distributorsUid}/products
     *
     * Response data type: array
     *   productsUid: int
     *   distributorsUid: int
     *   productsId: string
     *   productsDesc: string
     *   defaultSellingUnit: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   upcOrEanId: string|null
     *   imageUrl: string|null
     *   partNumber: string|null
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function createProducts(int $distributorsUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{distributorsUid}/products',
            $data,
            ['distributorsUid' => (string) $distributorsUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
