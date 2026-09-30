<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * content resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py joomla
 */
final class ContentResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /content
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /content/{id}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /content/{id}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listDoc(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/doc',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /content/{id}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getDoc(int $id, array $params = []): BaseResponse
    {
        return $this->listDoc($id, $params);
    }
}
