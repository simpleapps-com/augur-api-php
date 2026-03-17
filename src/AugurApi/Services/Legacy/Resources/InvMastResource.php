<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMast resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py legacy
 */
final class InvMastResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast/{invMastUid}/also-bought
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAlsoBought(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/also-bought',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/tags
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listTags(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/tags',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /inv-mast/{invMastUid}/tags
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createTags(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/{invMastUid}/tags', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /inv-mast/{invMastUid}/tags/{invMastTagsUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteTags(int $invMastTagsUid, int $invMastUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastUid}/tags/{invMastTagsUid}',
            ['invMastTagsUid' => (string) $invMastTagsUid, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/tags/{invMastTagsUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getTags(int $invMastTagsUid, int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/tags/{invMastTagsUid}',
            $params,
            ['invMastTagsUid' => (string) $invMastTagsUid, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /inv-mast/{invMastUid}/tags/{invMastTagsUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateTags(int $invMastTagsUid, int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}/tags/{invMastTagsUid}',
            $data,
            ['invMastTagsUid' => (string) $invMastTagsUid, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/web-desc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listWebDesc(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/web-desc',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /inv-mast/{invMastUid}/web-desc
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createWebDesc(int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invMastUid}/web-desc',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /inv-mast/{invMastUid}/web-desc/{invMastWebDescUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteWebDesc(int $invMastUid, int $invMastWebDescUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastUid}/web-desc/{invMastWebDescUid}',
            ['invMastUid' => (string) $invMastUid, 'invMastWebDescUid' => (string) $invMastWebDescUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/web-desc/{invMastWebDescUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getWebDesc(int $invMastUid, int $invMastWebDescUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/web-desc/{invMastWebDescUid}',
            $params,
            ['invMastUid' => (string) $invMastUid, 'invMastWebDescUid' => (string) $invMastWebDescUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /inv-mast/{invMastUid}/web-desc/{invMastWebDescUid}
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateWebDesc(int $invMastUid, int $invMastWebDescUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}/web-desc/{invMastWebDescUid}',
            $data,
            ['invMastUid' => (string) $invMastUid, 'invMastWebDescUid' => (string) $invMastWebDescUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
