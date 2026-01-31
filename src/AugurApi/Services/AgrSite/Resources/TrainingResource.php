<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Training resource.
 *
 * @fullPath api.agrSite.training
 * @service agr_site
 * @domain augur
 */
final class TrainingResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List training sets.
     *
     * @fullPath api.agrSite.training.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/training', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get training set details.
     *
     * @fullPath api.agrSite.training.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $trainingSetUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/training/{trainingSetUid}',
            [],
            ['trainingSetUid' => (string) $trainingSetUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create training set.
     *
     * @fullPath api.agrSite.training.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/training', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update training set.
     *
     * @fullPath api.agrSite.training.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $trainingSetUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/training/{trainingSetUid}',
            $data,
            ['trainingSetUid' => (string) $trainingSetUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete training set.
     *
     * @fullPath api.agrSite.training.delete
     * @return BaseResponse<bool>
     */
    public function delete(int $trainingSetUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/training/{trainingSetUid}',
            ['trainingSetUid' => (string) $trainingSetUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }

    /**
     * List conversations.
     *
     * @fullPath api.agrSite.training.listConversations
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listConversations(int $trainingSetUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/training/{trainingSetUid}/conversations',
            $params,
            ['trainingSetUid' => (string) $trainingSetUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Create conversation.
     *
     * @fullPath api.agrSite.training.createConversation
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createConversation(int $trainingSetUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/training/{trainingSetUid}/conversations',
            $data,
            ['trainingSetUid' => (string) $trainingSetUid],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Get conversation details.
     *
     * @fullPath api.agrSite.training.getConversation
     * @return BaseResponse<array<string, mixed>>
     */
    public function getConversation(int $trainingSetUid, int $trainingConvUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/training/{trainingSetUid}/conversations/{trainingConvUid}',
            [],
            [
                'trainingSetUid' => (string) $trainingSetUid,
                'trainingConvUid' => (string) $trainingConvUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Update conversation.
     *
     * @fullPath api.agrSite.training.updateConversation
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateConversation(int $trainingSetUid, int $trainingConvUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/training/{trainingSetUid}/conversations/{trainingConvUid}',
            $data,
            [
                'trainingSetUid' => (string) $trainingSetUid,
                'trainingConvUid' => (string) $trainingConvUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete conversation.
     *
     * @fullPath api.agrSite.training.deleteConversation
     * @return BaseResponse<bool>
     */
    public function deleteConversation(int $trainingSetUid, int $trainingConvUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/training/{trainingSetUid}/conversations/{trainingConvUid}',
            [
                'trainingSetUid' => (string) $trainingSetUid,
                'trainingConvUid' => (string) $trainingConvUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }

    /**
     * List messages.
     *
     * @fullPath api.agrSite.training.listMessages
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listMessages(int $trainingSetUid, int $trainingConvUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/training/{trainingSetUid}/conversations/{trainingConvUid}/messages',
            $params,
            [
                'trainingSetUid' => (string) $trainingSetUid,
                'trainingConvUid' => (string) $trainingConvUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get message details.
     *
     * @fullPath api.agrSite.training.getMessage
     * @return BaseResponse<array<string, mixed>>
     */
    public function getMessage(int $trainingSetUid, int $trainingConvUid, int $trainingMsgUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}',
            [],
            [
                'trainingSetUid' => (string) $trainingSetUid,
                'trainingConvUid' => (string) $trainingConvUid,
                'trainingMsgUid' => (string) $trainingMsgUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Create message.
     *
     * @fullPath api.agrSite.training.createMessage
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createMessage(int $trainingSetUid, int $trainingConvUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/training/{trainingSetUid}/conversations/{trainingConvUid}/messages',
            $data,
            [
                'trainingSetUid' => (string) $trainingSetUid,
                'trainingConvUid' => (string) $trainingConvUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Update message.
     *
     * @fullPath api.agrSite.training.updateMessage
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateMessage(int $trainingSetUid, int $trainingConvUid, int $trainingMsgUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}',
            $data,
            [
                'trainingSetUid' => (string) $trainingSetUid,
                'trainingConvUid' => (string) $trainingConvUid,
                'trainingMsgUid' => (string) $trainingMsgUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Delete message.
     *
     * @fullPath api.agrSite.training.deleteMessage
     * @return BaseResponse<bool>
     */
    public function deleteMessage(int $trainingSetUid, int $trainingConvUid, int $trainingMsgUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}',
            [
                'trainingSetUid' => (string) $trainingSetUid,
                'trainingConvUid' => (string) $trainingConvUid,
                'trainingMsgUid' => (string) $trainingMsgUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }
}
