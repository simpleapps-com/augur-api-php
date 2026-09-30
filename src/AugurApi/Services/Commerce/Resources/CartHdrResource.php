<?php

declare(strict_types=1);

namespace AugurApi\Services\Commerce\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * cartHdr resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py commerce
 */
final class CartHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /cart-hdr/list
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listList(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/list', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /cart-hdr/lookup
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /cart-hdr/{cartHdrUid}/also-bought
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listAlsoBought(int $cartHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{cartHdrUid}/also-bought',
            $params,
            ['cartHdrUid' => (string) $cartHdrUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
