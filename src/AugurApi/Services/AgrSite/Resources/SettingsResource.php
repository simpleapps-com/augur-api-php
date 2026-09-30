<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * settings resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 */
final class SettingsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /settings
     *
     * Response data type: array
     *   settingsUid: int
     *   serviceName: string
     *   name: string
     *   value: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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
     * POST /settings
     *
     * Response data type: object
     *   settingsUid: int
     *   serviceName: string
     *   name: string
     *   value: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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
     * DELETE /settings/{settingsUid}
     *
     * @return BaseResponse<mixed>
     */
    public function delete(int $settingsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{settingsUid}',
            ['settingsUid' => (string) $settingsUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /settings/{settingsUid}
     *
     * Response data type: object
     *   settingsUid: int
     *   serviceName: string
     *   name: string
     *   value: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $settingsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{settingsUid}',
            $params,
            ['settingsUid' => (string) $settingsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /settings/{settingsUid}
     *
     * Response data type: object
     *   settingsUid: int
     *   serviceName: string
     *   name: string
     *   value: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $settingsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{settingsUid}',
            $data,
            ['settingsUid' => (string) $settingsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
