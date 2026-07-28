<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * oauth resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-info
 */
final class OauthResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * DELETE /oauth/grants/{grantId}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteGrants(string $grantId): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/grants/{grantId}',
            ['grantId' => (string) $grantId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /oauth/refresh
     *
     * Response data type: object
     * Known fields: grantId, usersId, accessToken, refreshToken, accessTokenExpiresAt, refreshTokenExpiresAt
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createRefresh(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/refresh', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
