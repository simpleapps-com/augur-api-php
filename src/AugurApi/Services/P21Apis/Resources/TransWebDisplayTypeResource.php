<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Apis\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Transaction web display type resource.
 *
 * @fullPath api.p21Apis.transWebDisplayType
 * @service p21-apis
 * @domain web-display-management
 */
final class TransWebDisplayTypeResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Create a new transaction web display type.
     *
     * @fullPath api.p21Apis.transWebDisplayType.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/trans-web-display-type', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Get transaction web display type details by display type UID.
     *
     * @fullPath api.p21Apis.transWebDisplayType.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $webDisplayTypeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/trans-web-display-type/{webDisplayTypeUid}',
            $params,
            ['webDisplayTypeUid' => (string) $webDisplayTypeUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Update transaction web display type by display type UID.
     *
     * @fullPath api.p21Apis.transWebDisplayType.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $webDisplayTypeUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/trans-web-display-type/{webDisplayTypeUid}',
            $data,
            ['webDisplayTypeUid' => (string) $webDisplayTypeUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete transaction web display type by display type UID.
     *
     * @fullPath api.p21Apis.transWebDisplayType.delete
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $webDisplayTypeUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/trans-web-display-type/{webDisplayTypeUid}',
            ['webDisplayTypeUid' => (string) $webDisplayTypeUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get web display type defaults for configuration setup.
     *
     * @fullPath api.p21Apis.transWebDisplayType.defaults.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDefaults(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/trans-web-display-type/defaults', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get web display type definition for service schema information.
     *
     * @fullPath api.p21Apis.transWebDisplayType.definition.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDefinition(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/trans-web-display-type/definition', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
