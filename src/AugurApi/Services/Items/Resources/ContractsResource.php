<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Contracts resource.
 *
 * @fullPath api.items.contracts
 * @service items
 * @domain contract-management
 */
final class ContractsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List contract item attributes.
     *
     * @fullPath api.items.contracts.attributes.list
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listAttributes(int $jobNo): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/contracts/{jobNo}/attributes',
            [],
            ['jobNo' => (string) $jobNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * List contract items for a job.
     *
     * @fullPath api.items.contracts.items.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listItems(int $jobNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/contracts/{jobNo}/items',
            $params,
            ['jobNo' => (string) $jobNo],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
