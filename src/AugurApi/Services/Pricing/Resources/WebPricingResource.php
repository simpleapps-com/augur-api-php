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
     * Known fields: webPricingUid, name, description, dateCreated, dateLastModified, statusCd, updateCd, processCd, ... (15 total)
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
     * POST /web-pricing
     *
     * Response data type: object
     * Known fields: webPricingUid, name, description, dateCreated, dateLastModified, statusCd, updateCd, processCd, ... (15 total)
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
     * DELETE /web-pricing/{webPricingUid}
     *
     * Response data type: object
     * Known fields: webPricingUid, name, description, dateCreated, dateLastModified, statusCd, updateCd, processCd, ... (15 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /web-pricing/{webPricingUid}
     *
     * Response data type: object
     * Known fields: webPricingUid, name, description, dateCreated, dateLastModified, statusCd, updateCd, processCd, ... (15 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /web-pricing/{webPricingUid}
     *
     * Response data type: object
     * Known fields: webPricingUid, name, description, dateCreated, dateLastModified, statusCd, updateCd, processCd, ... (15 total)
     *
     * @param array<string, mixed> $data
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /web-pricing/{webPricingUid}/customers
     *
     * Response data type: array
     * Known fields: webPricingXCustomerUid, webPricingUid, customerId, dateCreated, dateLastModified, statusCd, updateCd, processCd
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listCustomers(int $webPricingUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{webPricingUid}/customers',
            $params,
            ['webPricingUid' => (string) $webPricingUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /web-pricing/{webPricingUid}/customers
     *
     * Response data type: object
     * Known fields: webPricingXCustomerUid, webPricingUid, customerId, dateCreated, dateLastModified, statusCd, updateCd, processCd
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createCustomers(int $webPricingUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{webPricingUid}/customers',
            $data,
            ['webPricingUid' => (string) $webPricingUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /web-pricing/{webPricingUid}/customers/{customerId}
     *
     * Response data type: object
     * Known fields: webPricingXCustomerUid, webPricingUid, customerId, dateCreated, dateLastModified, statusCd, updateCd, processCd
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /web-pricing/{webPricingUid}/customers/{customerId}
     *
     * Response data type: object
     * Known fields: webPricingXCustomerUid, webPricingUid, customerId, dateCreated, dateLastModified, statusCd, updateCd, processCd
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /web-pricing/{webPricingUid}/customers/{customerId}
     *
     * Response data type: object
     * Known fields: webPricingXCustomerUid, webPricingUid, customerId, dateCreated, dateLastModified, statusCd, updateCd, processCd
     *
     * @param array<string, mixed> $data
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
