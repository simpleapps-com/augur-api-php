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
     * Known fields: trainingSetUid, name, description, formatType, systemPrompt, developerPrompt, modelTarget, trainSplitPct, ... (15 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /training
     *
     * Response data type: object
     * Known fields: trainingSetUid, name, description, formatType, systemPrompt, developerPrompt, modelTarget, trainSplitPct, ... (15 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /training/{trainingSetUid}
     *
     * Response data type: object
     * Known fields: trainingSetUid, name, description, formatType, systemPrompt, developerPrompt, modelTarget, trainSplitPct, ... (15 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /training/{trainingSetUid}
     *
     * Response data type: object
     * Known fields: trainingSetUid, name, description, formatType, systemPrompt, developerPrompt, modelTarget, trainSplitPct, ... (15 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /training/{trainingSetUid}
     *
     * Response data type: object
     * Known fields: trainingSetUid, name, description, formatType, systemPrompt, developerPrompt, modelTarget, trainSplitPct, ... (15 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /training/{trainingSetUid}/conversations
     *
     * Response data type: array
     * Known fields: trainingConvUid, trainingSetUid, sourceType, generatorModel, serviceName, dataTypeName, dataTypeUid, category, ... (16 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listConversations(int $trainingSetUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{trainingSetUid}/conversations',
            $params,
            ['trainingSetUid' => (string) $trainingSetUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /training/{trainingSetUid}/conversations
     *
     * Response data type: object
     * Known fields: trainingConvUid, trainingSetUid, sourceType, generatorModel, serviceName, dataTypeName, dataTypeUid, category, ... (16 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /training/{trainingSetUid}/conversations/{trainingConvUid}
     *
     * Response data type: object
     * Known fields: trainingConvUid, trainingSetUid, sourceType, generatorModel, serviceName, dataTypeName, dataTypeUid, category, ... (16 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /training/{trainingSetUid}/conversations/{trainingConvUid}
     *
     * Response data type: object
     * Known fields: trainingConvUid, trainingSetUid, sourceType, generatorModel, serviceName, dataTypeName, dataTypeUid, category, ... (16 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /training/{trainingSetUid}/conversations/{trainingConvUid}
     *
     * Response data type: object
     * Known fields: trainingConvUid, trainingSetUid, sourceType, generatorModel, serviceName, dataTypeName, dataTypeUid, category, ... (16 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /training/{trainingSetUid}/conversations/{trainingConvUid}/messages
     *
     * Response data type: array
     * Known fields: trainingMsgUid, trainingConvUid, sequenceNo, role, channel, content, analysis, commentary, ... (16 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listConversationsMessages(int $trainingSetUid, int $trainingConvUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{trainingSetUid}/conversations/{trainingConvUid}/messages',
            $params,
            ['trainingSetUid' => (string) $trainingSetUid, 'trainingConvUid' => (string) $trainingConvUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /training/{trainingSetUid}/conversations/{trainingConvUid}/messages
     *
     * Response data type: object
     * Known fields: trainingMsgUid, trainingConvUid, sequenceNo, role, channel, content, analysis, commentary, ... (16 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}
     *
     * Response data type: object
     * Known fields: trainingMsgUid, trainingConvUid, sequenceNo, role, channel, content, analysis, commentary, ... (16 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}
     *
     * Response data type: object
     * Known fields: trainingMsgUid, trainingConvUid, sequenceNo, role, channel, content, analysis, commentary, ... (16 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}
     *
     * Response data type: object
     * Known fields: trainingMsgUid, trainingConvUid, sequenceNo, role, channel, content, analysis, commentary, ... (16 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
