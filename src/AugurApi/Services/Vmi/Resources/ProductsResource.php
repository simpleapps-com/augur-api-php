<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * products resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
 */
final class ProductsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /products
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
     * GET /products/find
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
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listFind(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/find', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /products/{productsUid}
     *
     * Response data type: object
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
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $productsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{productsUid}',
            ['productsUid' => (string) $productsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /products/{productsUid}
     *
     * Response data type: object
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
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $productsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{productsUid}',
            $params,
            ['productsUid' => (string) $productsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /products/{productsUid}
     *
     * Response data type: object
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
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $productsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{productsUid}',
            $data,
            ['productsUid' => (string) $productsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /products/{productsUid}/enable
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
    public function updateEnable(int $productsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{productsUid}/enable',
            $data,
            ['productsUid' => (string) $productsUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
