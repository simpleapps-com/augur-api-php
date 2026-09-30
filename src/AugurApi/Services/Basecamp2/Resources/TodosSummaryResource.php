<?php

declare(strict_types=1);

namespace AugurApi\Services\Basecamp2\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * todosSummary resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py basecamp2
 */
final class TodosSummaryResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /todos-summary
     *
     * Response data type: array
     *   id: int
     *   summary: string|null
     *   summaryTokens: int
     *   context: string|null
     *   contextTokens: int
     *   modelName: string|null
     *   vector: string|null
     *   vectorCd: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   akashaCd: int
     *   complexityScore: int|null
     *   complexityReason: string|null
     *   estimatedMinutes: int|null
     *   requiredServices: string|null
     *   worthinessReason: string|null
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
     * GET /todos-summary/{id}
     *
     * Response data type: object
     *   id: int
     *   summary: string|null
     *   summaryTokens: int
     *   context: string|null
     *   contextTokens: int
     *   modelName: string|null
     *   vector: string|null
     *   vectorCd: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *   akashaCd: int
     *   complexityScore: int|null
     *   complexityReason: string|null
     *   estimatedMinutes: int|null
     *   requiredServices: string|null
     *   worthinessReason: string|null
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
