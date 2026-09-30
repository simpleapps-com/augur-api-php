<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * modules resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py joomla
 */
final class ModulesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /modules
     *
     * Response data type: array
     *   id: int
     *   assetId: int
     *   title: string
     *   note: string
     *   content: string|null
     *   ordering: int
     *   position: string
     *   checkedOut: int
     *   checkedOutTime: string
     *   publishUp: string
     *   publishDown: string
     *   published: int
     *   module: string|null
     *   access: int
     *   showtitle: int
     *   params: string
     *   clientId: int
     *   language: string
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
     * GET /modules/{id}
     *
     * Response data type: object
     *   id: int
     *   assetId: int
     *   title: string
     *   note: string
     *   content: string|null
     *   ordering: int
     *   position: string
     *   checkedOut: int
     *   checkedOutTime: string
     *   publishUp: string
     *   publishDown: string
     *   published: int
     *   module: string|null
     *   access: int
     *   showtitle: int
     *   params: string
     *   clientId: int
     *   language: string
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
