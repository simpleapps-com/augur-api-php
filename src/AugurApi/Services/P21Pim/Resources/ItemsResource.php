<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * items resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-pim
 */
final class ItemsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /items/{invMastUid}/suggest-display-desc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listSuggestDisplayDesc(int $inv_mast_uid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/suggest-display-desc',
            $params,
            ['inv_mast_uid' => (string) $inv_mast_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /items/{invMastUid}/suggest-web-desc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listSuggestWebDesc(int $inv_mast_uid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/suggest-web-desc',
            $params,
            ['inv_mast_uid' => (string) $inv_mast_uid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
