<?php

declare(strict_types=1);

namespace AugurApi\Services\Commerce\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Checkout resource.
 *
 * @fullPath api.commerce.checkout
 * @service commerce
 * @domain commerce
 */
final class CheckoutResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Create new checkout.
     *
     * @fullPath api.commerce.checkout.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/checkout', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Get checkout details.
     *
     * @fullPath api.commerce.checkout.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $checkoutUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/checkout/{checkoutUid}',
            [],
            ['checkoutUid' => (string) $checkoutUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get checkout document.
     *
     * @fullPath api.commerce.checkout.getDoc
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $checkoutUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/checkout/{checkoutUid}/doc',
            [],
            ['checkoutUid' => (string) $checkoutUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Validate checkout.
     *
     * @fullPath api.commerce.checkout.validate
     * @return BaseResponse<array<string, mixed>>
     */
    public function validate(int $checkoutUid): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/checkout/{checkoutUid}/validate',
            [],
            ['checkoutUid' => (string) $checkoutUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Activate checkout.
     *
     * @fullPath api.commerce.checkout.activate
     * @return BaseResponse<array<string, mixed>>
     */
    public function activate(int $checkoutUid): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/checkout/{checkoutUid}/activate',
            [],
            ['checkoutUid' => (string) $checkoutUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create new P21 checkout.
     *
     * @fullPath api.commerce.checkout.createProphet21Hdr
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createProphet21Hdr(int $checkoutUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/checkout/{checkoutUid}/prophet21-hdr',
            $data,
            ['checkoutUid' => (string) $checkoutUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Add items to Prophet 21 checkout.
     *
     * @fullPath api.commerce.checkout.addProphet21Line
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function addProphet21Line(int $checkoutUid, int $prophet21HdrUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/checkout/{checkoutUid}/prophet21-hdr/{prophet21HdrUid}/prophet21-line',
            $data,
            ['checkoutUid' => (string) $checkoutUid, 'prophet21HdrUid' => (string) $prophet21HdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
