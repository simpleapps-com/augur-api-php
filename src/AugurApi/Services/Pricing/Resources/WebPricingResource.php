<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * webPricing resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py pricing
 */
final class WebPricingResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /web-pricing
     *
     * Response data type: array
     *   webPricingUid: int
     *   name: string
     *   description: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   statusCd: int
     *   updateCd: int
     *   processCd: int
     *   sequenceNo: int
     *   customerMode: string
     *   minQty: int|null
     *   maxQty: int|null
     *   discountPct: float
     *   effectiveDate: string|null
     *   expirationDate: string|null
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
     * POST /web-pricing
     *
     * Response data type: object
     *   webPricingUid: int
     *   name: string
     *   description: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   statusCd: int
     *   updateCd: int
     *   processCd: int
     *   sequenceNo: int
     *   customerMode: string
     *   minQty: int|null
     *   maxQty: int|null
     *   discountPct: float
     *   effectiveDate: string|null
     *   expirationDate: string|null
     *
     * @param array{name: string, description?: string|null, discountPct: float, sequenceNo?: int, customerMode?: 'NONE'|'ALL'|'ONLY'|'EXCEPT', minQty?: int|null, maxQty?: int|null, effectiveDate?: string|null, expirationDate?: string|null} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /web-pricing/{webPricingUid}
     *
     * Response data type: object
     *   webPricingUid: int
     *   name: string
     *   description: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   statusCd: int
     *   updateCd: int
     *   processCd: int
     *   sequenceNo: int
     *   customerMode: string
     *   minQty: int|null
     *   maxQty: int|null
     *   discountPct: float
     *   effectiveDate: string|null
     *   expirationDate: string|null
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $webPricingUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{webPricingUid}',
            ['webPricingUid' => (string) $webPricingUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /web-pricing/{webPricingUid}
     *
     * Response data type: object
     *   webPricingUid: int
     *   name: string
     *   description: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   statusCd: int
     *   updateCd: int
     *   processCd: int
     *   sequenceNo: int
     *   customerMode: string
     *   minQty: int|null
     *   maxQty: int|null
     *   discountPct: float
     *   effectiveDate: string|null
     *   expirationDate: string|null
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $webPricingUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{webPricingUid}',
            $params,
            ['webPricingUid' => (string) $webPricingUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /web-pricing/{webPricingUid}
     *
     * Response data type: object
     *   webPricingUid: int
     *   name: string
     *   description: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   statusCd: int
     *   updateCd: int
     *   processCd: int
     *   sequenceNo: int
     *   customerMode: string
     *   minQty: int|null
     *   maxQty: int|null
     *   discountPct: float
     *   effectiveDate: string|null
     *   expirationDate: string|null
     *
     * @param array{name?: string, description?: string|null, discountPct?: float, sequenceNo?: int, customerMode?: 'NONE'|'ALL'|'ONLY'|'EXCEPT', minQty?: int, maxQty?: int, effectiveDate?: string, expirationDate?: string, statusCd?: 704|705|700} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $webPricingUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{webPricingUid}',
            $data,
            ['webPricingUid' => (string) $webPricingUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /web-pricing/{webPricingUid}/customers
     *
     * Response data type: array
     *   webPricingXCustomerUid: int
     *   webPricingUid: int
     *   customerId: float
     *   dateCreated: string
     *   dateLastModified: string
     *   statusCd: int
     *   updateCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listCustomers(int $webPricingUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{webPricingUid}/customers',
            $params,
            ['webPricingUid' => (string) $webPricingUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /web-pricing/{webPricingUid}/customers
     *
     * Response data type: object
     *   webPricingXCustomerUid: int
     *   webPricingUid: int
     *   customerId: float
     *   dateCreated: string
     *   dateLastModified: string
     *   statusCd: int
     *   updateCd: int
     *   processCd: int
     *
     * @param array{customerId: int} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createCustomers(int $webPricingUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{webPricingUid}/customers',
            $data,
            ['webPricingUid' => (string) $webPricingUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /web-pricing/{webPricingUid}/customers/{customerId}
     *
     * Response data type: object
     *   webPricingXCustomerUid: int
     *   webPricingUid: int
     *   customerId: float
     *   dateCreated: string
     *   dateLastModified: string
     *   statusCd: int
     *   updateCd: int
     *   processCd: int
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteCustomers(int $webPricingUid, int $customerId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{webPricingUid}/customers/{customerId}',
            ['webPricingUid' => (string) $webPricingUid, 'customerId' => (string) $customerId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /web-pricing/{webPricingUid}/customers/{customerId}
     *
     * Response data type: object
     *   webPricingXCustomerUid: int
     *   webPricingUid: int
     *   customerId: float
     *   dateCreated: string
     *   dateLastModified: string
     *   statusCd: int
     *   updateCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getCustomers(int $webPricingUid, int $customerId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{webPricingUid}/customers/{customerId}',
            $params,
            ['webPricingUid' => (string) $webPricingUid, 'customerId' => (string) $customerId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /web-pricing/{webPricingUid}/customers/{customerId}
     *
     * Response data type: object
     *   webPricingXCustomerUid: int
     *   webPricingUid: int
     *   customerId: float
     *   dateCreated: string
     *   dateLastModified: string
     *   statusCd: int
     *   updateCd: int
     *   processCd: int
     *
     * @param array{statusCd?: 704|705|700} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateCustomers(int $webPricingUid, int $customerId, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{webPricingUid}/customers/{customerId}',
            $data,
            ['webPricingUid' => (string) $webPricingUid, 'customerId' => (string) $customerId],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
