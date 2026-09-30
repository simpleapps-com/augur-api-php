<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMastExt resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-pim
 */
final class InvMastExtResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast-ext
     *
     * Response data type: array
     *   invMastExtUid: int
     *   invMastUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   upcOrEan: string|null
     *   upcOrEanId: string|null
     *   upcOrEanPrefix: string|null
     *   upcOrEanItem: string|null
     *   attributeGroupUid: int|null
     *   brandName: string|null
     *   manufacturerName: string|null
     *   partNumber: string|null
     *   metaTitle: string|null
     *   metaDescription: string|null
     *   metaKeywords: string|null
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
     * POST /inv-mast-ext
     *
     * Response data type: object
     *   invMastExtUid: int
     *   invMastUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   upcOrEan: string|null
     *   upcOrEanId: string|null
     *   upcOrEanPrefix: string|null
     *   upcOrEanItem: string|null
     *   attributeGroupUid: int|null
     *   brandName: string|null
     *   manufacturerName: string|null
     *   partNumber: string|null
     *   metaTitle: string|null
     *   metaDescription: string|null
     *   metaKeywords: string|null
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
     * DELETE /inv-mast-ext/{invMastExtUid}
     *
     * @return BaseResponse<mixed>
     */
    public function delete(int $invMastExtUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastExtUid}',
            ['invMastExtUid' => (string) $invMastExtUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast-ext/{invMastExtUid}
     *
     * Response data type: object
     *   invMastExtUid: int
     *   invMastUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   upcOrEan: string|null
     *   upcOrEanId: string|null
     *   upcOrEanPrefix: string|null
     *   upcOrEanItem: string|null
     *   attributeGroupUid: int|null
     *   brandName: string|null
     *   manufacturerName: string|null
     *   partNumber: string|null
     *   metaTitle: string|null
     *   metaDescription: string|null
     *   metaKeywords: string|null
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastExtUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastExtUid}',
            $params,
            ['invMastExtUid' => (string) $invMastExtUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-mast-ext/{invMastExtUid}
     *
     * Response data type: object
     *   invMastExtUid: int
     *   invMastUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   upcOrEan: string|null
     *   upcOrEanId: string|null
     *   upcOrEanPrefix: string|null
     *   upcOrEanItem: string|null
     *   attributeGroupUid: int|null
     *   brandName: string|null
     *   manufacturerName: string|null
     *   partNumber: string|null
     *   metaTitle: string|null
     *   metaDescription: string|null
     *   metaKeywords: string|null
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $invMastExtUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastExtUid}',
            $data,
            ['invMastExtUid' => (string) $invMastExtUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
