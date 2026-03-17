<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * rubrics resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-info
 */
final class RubricsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /rubrics
     *
     * Response data type: array
     * Known fields: rubricsUid, title, id, content, updateCd, statusCd, processCd, dateCreated, ... (9 total)
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
     * POST /rubrics
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
     * DELETE /rubrics/{rubricsUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $rubricsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{rubricsUid}',
            ['rubricsUid' => (string) $rubricsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /rubrics/{rubricsUid}
     *
     * Response data type: object
     * Known fields: rubricsUid, title, id, content, updateCd, statusCd, processCd, dateCreated, ... (9 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $rubricsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{rubricsUid}',
            $params,
            ['rubricsUid' => (string) $rubricsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /rubrics/{rubricsUid}
     *
     * Response data type: object
     * Known fields: rubricsUid, title, id, content, updateCd, statusCd, processCd, dateCreated, ... (9 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $rubricsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{rubricsUid}',
            $data,
            ['rubricsUid' => (string) $rubricsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
