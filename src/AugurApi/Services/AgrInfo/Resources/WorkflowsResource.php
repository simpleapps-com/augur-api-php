<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * workflows resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-info
 */
final class WorkflowsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /workflows
     *
     * Response data type: array
     *   workflowsUid: int
     *   workflowsId: string
     *   title: string
     *   description: string|null
     *   services: string
     *   workflow: string
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
     * POST /workflows
     *
     * Response data type: object
     *   workflowsUid: int
     *   workflowsId: string
     *   title: string
     *   description: string|null
     *   services: string
     *   workflow: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{workflowsId?: string, title: string, description?: string, services?: string, workflow: string, statusCd?: int, processCd?: int, updateCd?: int} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /workflows/{workflowsUid}
     *
     * @return BaseResponse<mixed>
     */
    public function delete(int $workflowsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{workflowsUid}',
            ['workflowsUid' => (string) $workflowsUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /workflows/{workflowsUid}
     *
     * Response data type: object
     *   workflowsUid: int
     *   workflowsId: string
     *   title: string
     *   description: string|null
     *   services: string
     *   workflow: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $workflowsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{workflowsUid}',
            $params,
            ['workflowsUid' => (string) $workflowsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /workflows/{workflowsUid}
     *
     * Response data type: object
     *   workflowsUid: int
     *   workflowsId: string
     *   title: string
     *   description: string|null
     *   services: string
     *   workflow: string
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $workflowsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{workflowsUid}',
            $data,
            ['workflowsUid' => (string) $workflowsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
