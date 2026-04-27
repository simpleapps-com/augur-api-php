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
     * Response data type: array
     * Known fields: invMastTagsUid, invMastUid, tag, updateCd, statusCd, processCd, dateCreated, dateLastModified
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
     * Response data type: object
     * Known fields: invMastTagsUid, invMastUid, tag, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createTags(string $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invMastUid}/tags',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /inv-mast/{invMastUid}/tags/{invMastTagsUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteTags(int $invMastUid, int $invMastTagsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastUid}/tags/{invMastTagsUid}',
            ['invMastUid' => (string) $invMastUid, 'invMastTagsUid' => (string) $invMastTagsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/tags/{invMastTagsUid}
     *
     * Response data type: object
     * Known fields: invMastTagsUid, invMastUid, tag, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getTags(int $invMastUid, int $invMastTagsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/tags/{invMastTagsUid}',
            $params,
            ['invMastUid' => (string) $invMastUid, 'invMastTagsUid' => (string) $invMastTagsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /inv-mast/{invMastUid}/tags/{invMastTagsUid}
     *
     * Response data type: object
     * Known fields: invMastTagsUid, invMastUid, tag, updateCd, statusCd, processCd, dateCreated, dateLastModified
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateTags(int $invMastUid, int $invMastTagsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}/tags/{invMastTagsUid}',
            $data,
            ['invMastUid' => (string) $invMastUid, 'invMastTagsUid' => (string) $invMastTagsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/web-desc
     *
     * Response data type: array
     * Known fields: invMastWebDescUid, invMastUid, webDesc1, webDesc2, webDesc3, webDesc4, webDescFull, dateCreated, ... (13 total)
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
     * Response data type: object
     * Known fields: invMastWebDescUid, invMastUid, webDesc1, webDesc2, webDesc3, webDesc4, webDescFull, dateCreated, ... (13 total)
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
     * Response data type: object
     * Known fields: invMastWebDescUid, invMastUid, webDesc1, webDesc2, webDesc3, webDesc4, webDescFull, dateCreated, ... (13 total)
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
     * Response data type: object
     * Known fields: invMastWebDescUid, invMastUid, webDesc1, webDesc2, webDesc3, webDesc4, webDescFull, dateCreated, ... (13 total)
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
