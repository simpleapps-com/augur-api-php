<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * training resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 */
final class TrainingResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /training
     *
     * Response data type: array
     *   trainingSetUid: int
     *   name: string
     *   description: string|null
     *   formatType: string|null
     *   systemPrompt: string|null
     *   developerPrompt: string|null
     *   modelTarget: string|null
     *   trainSplitPct: int
     *   totalConversations: int
     *   totalTokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
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
     * POST /training
     *
     * Response data type: object
     *   trainingSetUid: int
     *   name: string
     *   description: string|null
     *   formatType: string|null
     *   systemPrompt: string|null
     *   developerPrompt: string|null
     *   modelTarget: string|null
     *   trainSplitPct: int
     *   totalConversations: int
     *   totalTokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
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
     * DELETE /training/{trainingSetUid}
     *
     * Response data type: object
     *   trainingSetUid: int
     *   name: string
     *   description: string|null
     *   formatType: string|null
     *   systemPrompt: string|null
     *   developerPrompt: string|null
     *   modelTarget: string|null
     *   trainSplitPct: int
     *   totalConversations: int
     *   totalTokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $trainingSetUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{trainingSetUid}',
            ['trainingSetUid' => (string) $trainingSetUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /training/{trainingSetUid}
     *
     * Response data type: object
     *   trainingSetUid: int
     *   name: string
     *   description: string|null
     *   formatType: string|null
     *   systemPrompt: string|null
     *   developerPrompt: string|null
     *   modelTarget: string|null
     *   trainSplitPct: int
     *   totalConversations: int
     *   totalTokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $trainingSetUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{trainingSetUid}',
            $params,
            ['trainingSetUid' => (string) $trainingSetUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /training/{trainingSetUid}
     *
     * Response data type: object
     *   trainingSetUid: int
     *   name: string
     *   description: string|null
     *   formatType: string|null
     *   systemPrompt: string|null
     *   developerPrompt: string|null
     *   modelTarget: string|null
     *   trainSplitPct: int
     *   totalConversations: int
     *   totalTokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $trainingSetUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{trainingSetUid}',
            $data,
            ['trainingSetUid' => (string) $trainingSetUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /training/{trainingSetUid}/conversations
     *
     * Response data type: array
     *   trainingConvUid: int
     *   trainingSetUid: int
     *   sourceType: string
     *   generatorModel: string|null
     *   serviceName: string|null
     *   dataTypeName: string|null
     *   dataTypeUid: int|null
     *   category: string|null
     *   qualityScore: float|null
     *   splitType: string
     *   totalTokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listConversations(int $trainingSetUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{trainingSetUid}/conversations',
            $params,
            ['trainingSetUid' => (string) $trainingSetUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /training/{trainingSetUid}/conversations
     *
     * Response data type: object
     *   trainingConvUid: int
     *   trainingSetUid: int
     *   sourceType: string
     *   generatorModel: string|null
     *   serviceName: string|null
     *   dataTypeName: string|null
     *   dataTypeUid: int|null
     *   category: string|null
     *   qualityScore: float|null
     *   splitType: string
     *   totalTokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createConversations(int $trainingSetUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{trainingSetUid}/conversations',
            $data,
            ['trainingSetUid' => (string) $trainingSetUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /training/{trainingSetUid}/conversations/{trainingConvUid}
     *
     * Response data type: object
     *   trainingConvUid: int
     *   trainingSetUid: int
     *   sourceType: string
     *   generatorModel: string|null
     *   serviceName: string|null
     *   dataTypeName: string|null
     *   dataTypeUid: int|null
     *   category: string|null
     *   qualityScore: float|null
     *   splitType: string
     *   totalTokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteConversations(int $trainingSetUid, int $trainingConvUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{trainingSetUid}/conversations/{trainingConvUid}',
            ['trainingSetUid' => (string) $trainingSetUid, 'trainingConvUid' => (string) $trainingConvUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /training/{trainingSetUid}/conversations/{trainingConvUid}
     *
     * Response data type: object
     *   trainingConvUid: int
     *   trainingSetUid: int
     *   sourceType: string
     *   generatorModel: string|null
     *   serviceName: string|null
     *   dataTypeName: string|null
     *   dataTypeUid: int|null
     *   category: string|null
     *   qualityScore: float|null
     *   splitType: string
     *   totalTokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getConversations(int $trainingSetUid, int $trainingConvUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{trainingSetUid}/conversations/{trainingConvUid}',
            $params,
            ['trainingSetUid' => (string) $trainingSetUid, 'trainingConvUid' => (string) $trainingConvUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /training/{trainingSetUid}/conversations/{trainingConvUid}
     *
     * Response data type: object
     *   trainingConvUid: int
     *   trainingSetUid: int
     *   sourceType: string
     *   generatorModel: string|null
     *   serviceName: string|null
     *   dataTypeName: string|null
     *   dataTypeUid: int|null
     *   category: string|null
     *   qualityScore: float|null
     *   splitType: string
     *   totalTokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateConversations(int $trainingSetUid, int $trainingConvUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{trainingSetUid}/conversations/{trainingConvUid}',
            $data,
            ['trainingSetUid' => (string) $trainingSetUid, 'trainingConvUid' => (string) $trainingConvUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /training/{trainingSetUid}/conversations/{trainingConvUid}/messages
     *
     * Response data type: array
     *   trainingMsgUid: int
     *   trainingConvUid: int
     *   sequenceNo: int
     *   role: string
     *   channel: string|null
     *   content: string|null
     *   analysis: string|null
     *   commentary: string|null
     *   final: string|null
     *   weight: int
     *   tokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listConversationsMessages(int $trainingSetUid, int $trainingConvUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{trainingSetUid}/conversations/{trainingConvUid}/messages',
            $params,
            ['trainingSetUid' => (string) $trainingSetUid, 'trainingConvUid' => (string) $trainingConvUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /training/{trainingSetUid}/conversations/{trainingConvUid}/messages
     *
     * Response data type: object
     *   trainingMsgUid: int
     *   trainingConvUid: int
     *   sequenceNo: int
     *   role: string
     *   channel: string|null
     *   content: string|null
     *   analysis: string|null
     *   commentary: string|null
     *   final: string|null
     *   weight: int
     *   tokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createConversationsMessages(int $trainingSetUid, int $trainingConvUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{trainingSetUid}/conversations/{trainingConvUid}/messages',
            $data,
            ['trainingSetUid' => (string) $trainingSetUid, 'trainingConvUid' => (string) $trainingConvUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}
     *
     * Response data type: object
     *   trainingMsgUid: int
     *   trainingConvUid: int
     *   sequenceNo: int
     *   role: string
     *   channel: string|null
     *   content: string|null
     *   analysis: string|null
     *   commentary: string|null
     *   final: string|null
     *   weight: int
     *   tokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteConversationsMessages(int $trainingSetUid, int $trainingConvUid, int $trainingMsgUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}',
            ['trainingSetUid' => (string) $trainingSetUid, 'trainingConvUid' => (string) $trainingConvUid, 'trainingMsgUid' => (string) $trainingMsgUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}
     *
     * Response data type: object
     *   trainingMsgUid: int
     *   trainingConvUid: int
     *   sequenceNo: int
     *   role: string
     *   channel: string|null
     *   content: string|null
     *   analysis: string|null
     *   commentary: string|null
     *   final: string|null
     *   weight: int
     *   tokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getConversationsMessages(int $trainingSetUid, int $trainingConvUid, int $trainingMsgUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}',
            $params,
            ['trainingSetUid' => (string) $trainingSetUid, 'trainingConvUid' => (string) $trainingConvUid, 'trainingMsgUid' => (string) $trainingMsgUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}
     *
     * Response data type: object
     *   trainingMsgUid: int
     *   trainingConvUid: int
     *   sequenceNo: int
     *   role: string
     *   channel: string|null
     *   content: string|null
     *   analysis: string|null
     *   commentary: string|null
     *   final: string|null
     *   weight: int
     *   tokens: int
     *   statusCd: int
     *   processCd: int
     *   updateCd: int
     *   dateCreated: string
     *   dateLastModified: string
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateConversationsMessages(int $trainingSetUid, int $trainingConvUid, int $trainingMsgUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}',
            $data,
            ['trainingSetUid' => (string) $trainingSetUid, 'trainingConvUid' => (string) $trainingConvUid, 'trainingMsgUid' => (string) $trainingMsgUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
