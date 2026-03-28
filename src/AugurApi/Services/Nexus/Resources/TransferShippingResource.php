<?php

declare(strict_types=1);

namespace AugurApi\Services\Nexus\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * transferShipping resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py nexus
 */
final class TransferShippingResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /transfer-shipping
     *
     * Response data type: array
     * Known fields: transferReceiptUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (11 total)
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
     * POST /transfer-shipping
     *
     * Response data type: object
     * Known fields: transferReceiptUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (11 total)
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
     * DELETE /transfer-shipping/{transferReceiptUid}
     *
     * Response data type: object
     * Known fields: transferReceiptUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (11 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $transferReceiptUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{transferReceiptUid}',
            ['transferReceiptUid' => (string) $transferReceiptUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /transfer-shipping/{transferReceiptUid}
     *
     * Response data type: object
     * Known fields: transferReceiptUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (11 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $transferReceiptUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{transferReceiptUid}',
            $params,
            ['transferReceiptUid' => (string) $transferReceiptUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /transfer-shipping/{transferReceiptUid}
     *
     * Response data type: object
     * Known fields: transferReceiptUid, importState, dateCreated, dateLastModified, updateCd, statusCd, processCd, referenceNo, ... (11 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $transferReceiptUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{transferReceiptUid}',
            $data,
            ['transferReceiptUid' => (string) $transferReceiptUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
