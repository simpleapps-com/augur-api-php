<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Sections resource.
 *
 * @fullPath api.vmi.sections
 * @service vmi
 * @domain inventory
 */
final class SectionsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List sections.
     *
     * @fullPath api.vmi.sections.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/sections', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get section details.
     *
     * @fullPath api.vmi.sections.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $sectionsUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/sections/{sectionsUid}',
            [],
            ['sectionsUid' => (string) $sectionsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create section.
     *
     * @fullPath api.vmi.sections.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/sections', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update section.
     *
     * @fullPath api.vmi.sections.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $sectionsUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/sections/{sectionsUid}',
            $data,
            ['sectionsUid' => (string) $sectionsUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete section.
     *
     * @fullPath api.vmi.sections.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $sectionsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/sections/{sectionsUid}',
            ['sectionsUid' => (string) $sectionsUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }

    /**
     * Enable section.
     *
     * @fullPath api.vmi.sections.enable
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function enable(int $sectionsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/sections/{sectionsUid}/enable',
            $data,
            ['sectionsUid' => (string) $sectionsUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
