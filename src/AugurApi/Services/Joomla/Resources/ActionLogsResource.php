<?php

declare(strict_types=1);

namespace AugurApi\Services\Joomla\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * actionLogs resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py joomla
 */
final class ActionLogsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /action-logs
     *
     * Response data type: array
     *   id: int
     *   messageLanguageKey: string
     *   message: string
     *   logDate: string
     *   extension: string
     *   userId: int
     *   itemId: int
     *   ipAddress: string
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
     * GET /action-logs/{id}
     *
     * Response data type: array
     *   id: int
     *   messageLanguageKey: string
     *   message: string
     *   logDate: string
     *   extension: string
     *   userId: int
     *   itemId: int
     *   ipAddress: string
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function get(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
