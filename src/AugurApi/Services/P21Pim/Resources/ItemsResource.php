<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Items resource for AI-powered product descriptions.
 *
 * @fullPath api.p21Pim.items
 * @service p21-pim
 * @domain ai-content-generation
 */
final class ItemsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Generate marketing-focused display descriptions (255 character limit).
     *
     * @fullPath api.p21Pim.items.suggestDisplayDesc.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function suggestDisplayDesc(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/items/{invMastUid}/suggest-display-desc',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Generate detailed web descriptions (4000 character limit).
     *
     * @fullPath api.p21Pim.items.suggestWebDesc.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function suggestWebDesc(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/items/{invMastUid}/suggest-web-desc',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
