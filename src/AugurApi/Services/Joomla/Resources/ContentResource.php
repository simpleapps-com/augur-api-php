<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Content resource.
 *
 * @fullPath api.joomla.content
 * @service joomla
 * @domain cms
 */
final class ContentResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get content list.
     *
     * @fullPath api.joomla.content.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/content', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get content detail.
     *
     * @fullPath api.joomla.content.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/content/{id}',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get content doc.
     *
     * @fullPath api.joomla.content.getDoc
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $id): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/content/{id}/doc',
            [],
            ['id' => (string) $id],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
