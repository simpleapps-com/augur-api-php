<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * training resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-site.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-site.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-site.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * TrainingListItem:
 * Returned by: $api->agrSite->training->list()
 * Returned by: $api->agrSite->training->create($data)
 * Returned by: $api->agrSite->training->get($trainingSetUid)
 * Returned by: $api->agrSite->training->update($trainingSetUid, $data)
 * Returned by: $api->agrSite->training->delete($trainingSetUid)
 *   trainingSetUid: int — Primary key
 *   name: string — Dataset name (max 100 chars)
 *   description: string|null — Dataset description (max 65536 chars)
 *   formatType: string|null — Format type (harmony, chatml, alpaca) (max 20 chars)
 *   systemPrompt: string|null — System role content (max 65536 chars)
 *   developerPrompt: string|null — Developer role content (Harmony only) (max 65536 chars)
 *   modelTarget: string|null — Target model for fine-tuning (max 100 chars)
 *   trainSplitPct: int — Training split percentage
 *   totalConversations: int — Count of conversations
 *   totalTokens: int — Total tokens in dataset
 *   statusCd: int — Record status
 *   processCd: int — Processing status
 *   updateCd: int — Update tracking
 *   dateCreated: string — Created timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — Modified timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *
 * TrainingCreateBody: Create a training set
 * Request body of: $api->agrSite->training->create($data)
 *   name: string|null — Training set name; nothing is stored when missing
 *   formatType?: string|null — Training data format
 *   description?: string|null — Description
 *   systemPrompt?: string|null — System prompt for every conversation
 *   developerPrompt?: string|null — Developer prompt for every conversation
 *   modelTarget?: string|null — Model the set is built for
 *   trainSplitPct?: int|null — Percent of conversations used for training (Default: 80)
 *
 * TrainingUpdateBody: Partial update of a training set; an absent field keeps its current value
 * Request body of: $api->agrSite->training->update($trainingSetUid, $data)
 *   name?: string|null — Training set name
 *   formatType?: string|null — Training data format
 *   description?: string|null — Description
 *   systemPrompt?: string|null — System prompt for every conversation
 *   developerPrompt?: string|null — Developer prompt for every conversation
 *   modelTarget?: string|null — Model the set is built for
 *   trainSplitPct?: int|null — Percent of conversations used for training
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *
 * TrainingConversationsListItem:
 * Returned by: $api->agrSite->training->listConversations($trainingSetUid)
 * Returned by: $api->agrSite->training->createConversations($trainingSetUid, $data)
 * Returned by: $api->agrSite->training->getConversations($trainingSetUid, $trainingConvUid)
 * Returned by:
 * $api->agrSite->training->updateConversations($trainingSetUid, $trainingConvUid, $data)
 * Returned by: $api->agrSite->training->deleteConversations($trainingSetUid, $trainingConvUid)
 *   trainingConvUid: int — Primary key
 *   trainingSetUid: int — FK to training_set
 *   sourceType: string — Source type (synthetic, datatype, curated, import) (max 20 chars)
 *   generatorModel: string|null — AI model that generated Q&A (oss-20b, claude-opus, etc.) (max 100
 *       chars)
 *   serviceName: string|null — Source MS (nullable for synthetic) (max 100 chars)
 *   dataTypeName: string|null — Source DT (nullable for synthetic) (max 100 chars)
 *   dataTypeUid: int|null — FK to source record (nullable, many convs per source)
 *   category: string|null — Topic category (pricing, shipping, etc.) (max 50 chars)
 *   qualityScore: float|null — 0.00-1.00 quality rating
 *   splitType: string — Split type (train, val, test) (max 10 chars)
 *   totalTokens: int — Tokens in conversation
 *   statusCd: int — Record status
 *   processCd: int — Processing status
 *   updateCd: int — Update tracking
 *   dateCreated: string — Created timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — Modified timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *
 * TrainingConversationsCreateBody: Add a conversation to the training set in the path
 * Request body of: $api->agrSite->training->createConversations($trainingSetUid, $data)
 *   sourceType?: string|null — Where the conversation came from (Default: synthetic)
 *   generatorModel?: string|null — Model that generated the conversation
 *   serviceName?: string|null — Service the conversation is about
 *   dataTypeName?: string|null — Datatype the conversation is about
 *   dataTypeUid?: int|null — ID of the record the conversation is about
 *   category?: string|null — Category
 *   qualityScore?: float|null — Quality score
 *   splitType?: string|null — train or validation (Default: train)
 *   totalTokens?: int|null — Token count (Default: 0)
 *
 * TrainingConversationsUpdateBody: Partial update of a training conversation; an absent field keeps
 * its current value
 * Request body of:
 * $api->agrSite->training->updateConversations($trainingSetUid, $trainingConvUid, $data)
 *   sourceType?: string|null — Where the conversation came from
 *   generatorModel?: string|null — Model that generated the conversation
 *   category?: string|null — Category
 *   qualityScore?: float|null — Quality score
 *   splitType?: string|null — train or validation
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *
 * TrainingConversationsMessagesListItem:
 * Returned by:
 * $api->agrSite->training->listConversationsMessages($trainingSetUid, $trainingConvUid)
 * Returned by:
 * $api->agrSite->training->createConversationsMessages($trainingSetUid, $trainingConvUid, $data)
 * Returned by:
 * $api->agrSite->training->getConversationsMessages($trainingSetUid, $trainingConvUid, $trainingMsgUid)
 * Returned by:
 * $api->agrSite->training->updateConversationsMessages($trainingSetUid, $trainingConvUid, $trainingMsgUid, $data)
 * Returned by:
 * $api->agrSite->training->deleteConversationsMessages($trainingSetUid, $trainingConvUid, $trainingMsgUid)
 *   trainingMsgUid: int — Primary key
 *   trainingConvUid: int — FK to training_conv
 *   sequenceNo: int — Message order (1, 2, 3...)
 *   role: string — Message role (system, developer, user, assistant, tool) (max 20 chars)
 *   channel: string|null — Harmony channel (analysis, commentary, final) (max 20 chars)
 *   content: string|null — User question / general content (max 65536 chars)
 *   analysis: string|null — Reasoning (assistant thinking) (max 65536 chars)
 *   commentary: string|null — Tool preamble (Harmony) (max 65536 chars)
 *   final: string|null — Answer (assistant response) (max 65536 chars)
 *   weight: int — Training weight (0=skip, 1=train)
 *   tokens: int — Tokens in message
 *   statusCd: int — Record status
 *   processCd: int — Processing status
 *   updateCd: int — Update tracking
 *   dateCreated: string — Created timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — Modified timestamp (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *
 * TrainingConversationsMessagesCreateBody: Add a message to the training conversation in the path
 * Request body of:
 * $api->agrSite->training->createConversationsMessages($trainingSetUid, $trainingConvUid, $data)
 *   sequenceNo?: int|null — Position in the conversation (Default: 0)
 *   role?: string|null — Speaker role (Default: user)
 *   channel?: string|null — Message channel
 *   content?: string|null — Message content
 *   analysis?: string|null — Analysis text
 *   commentary?: string|null — Commentary text
 *   final?: string|null — Final answer text
 *   weight?: int|null — Training weight (Default: 1)
 *   tokens?: int|null — Token count (Default: 0)
 *
 * TrainingConversationsMessagesUpdateBody: Partial update of a training message; an absent field
 * keeps its current value
 * Request body of:
 * $api->agrSite->training->updateConversationsMessages($trainingSetUid, $trainingConvUid, $trainingMsgUid, $data)
 *   sequenceNo?: int|null — Position in the conversation
 *   role?: string|null — Speaker role
 *   channel?: string|null — Message channel
 *   content?: string|null — Message content
 *   analysis?: string|null — Analysis text
 *   commentary?: string|null — Commentary text
 *   final?: string|null — Final answer text
 *   weight?: int|null — Training weight
 *   tokens?: int|null — Token count
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *
 * @phpstan-type TrainingListItem array{trainingSetUid: int, name: string, description: string|null, formatType: string|null, systemPrompt: string|null, developerPrompt: string|null, modelTarget: string|null, trainSplitPct: int, totalConversations: int, totalTokens: int, statusCd: int, processCd: int, updateCd: int, dateCreated: string, dateLastModified: string}
 * @phpstan-type TrainingCreateBody array{name: string|null, formatType?: string|null, description?: string|null, systemPrompt?: string|null, developerPrompt?: string|null, modelTarget?: string|null, trainSplitPct?: int|null}
 * @phpstan-type TrainingUpdateBody array{name?: string|null, formatType?: string|null, description?: string|null, systemPrompt?: string|null, developerPrompt?: string|null, modelTarget?: string|null, trainSplitPct?: int|null, statusCd?: int|null}
 * @phpstan-type TrainingConversationsListItem array{trainingConvUid: int, trainingSetUid: int, sourceType: string, generatorModel: string|null, serviceName: string|null, dataTypeName: string|null, dataTypeUid: int|null, category: string|null, qualityScore: float|null, splitType: string, totalTokens: int, statusCd: int, processCd: int, updateCd: int, dateCreated: string, dateLastModified: string}
 * @phpstan-type TrainingConversationsCreateBody array{sourceType?: string|null, generatorModel?: string|null, serviceName?: string|null, dataTypeName?: string|null, dataTypeUid?: int|null, category?: string|null, qualityScore?: float|null, splitType?: string|null, totalTokens?: int|null}
 * @phpstan-type TrainingConversationsUpdateBody array{sourceType?: string|null, generatorModel?: string|null, category?: string|null, qualityScore?: float|null, splitType?: string|null, statusCd?: int|null}
 * @phpstan-type TrainingConversationsMessagesListItem array{trainingMsgUid: int, trainingConvUid: int, sequenceNo: int, role: string, channel: string|null, content: string|null, analysis: string|null, commentary: string|null, final: string|null, weight: int, tokens: int, statusCd: int, processCd: int, updateCd: int, dateCreated: string, dateLastModified: string}
 * @phpstan-type TrainingConversationsMessagesCreateBody array{sequenceNo?: int|null, role?: string|null, channel?: string|null, content?: string|null, analysis?: string|null, commentary?: string|null, final?: string|null, weight?: int|null, tokens?: int|null}
 * @phpstan-type TrainingConversationsMessagesUpdateBody array{sequenceNo?: int|null, role?: string|null, channel?: string|null, content?: string|null, analysis?: string|null, commentary?: string|null, final?: string|null, weight?: int|null, tokens?: int|null, statusCd?: int|null}
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
     * List Training Sets
     * Call: $api->agrSite->training->list()
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a training_set column.
     *
     * GET https://agr-site.augur-api.com/training
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1training/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: training_set_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of TrainingListItem (fields listed on the class)
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
     * Create Training Set
     * Call: $api->agrSite->training->create($data)
     *
     * Request body: Create a training set
     *
     * POST https://agr-site.augur-api.com/training
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1training/post
     *
     * Request body ($data): TrainingCreateBody (fields listed on the class)
     *
     * Response data type: TrainingListItem (fields listed on the class)
     *
     * @param TrainingCreateBody $data
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
     * DELETE /training/{trainingSetUid}
     *
     * DELETE Training Set
     * Call: $api->agrSite->training->delete($trainingSetUid)
     *
     * Errors:
     *   400: trainingSetUid is 0 or negative.
     *   404: No training set with this ID.
     *
     * DELETE https://agr-site.augur-api.com/training/{trainingSetUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1training~1{trainingSetUid}/delete
     *
     * Response data type: TrainingListItem (fields listed on the class)
     *
     * @param int $trainingSetUid Training set the conversations belong to
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
     * Get Training Set Details
     * Call: $api->agrSite->training->get($trainingSetUid)
     *
     * Errors:
     *   404: No training set with this ID.
     *
     * GET https://agr-site.augur-api.com/training/{trainingSetUid}
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1training~1{trainingSetUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: TrainingListItem (fields listed on the class)
     *
     * @param int $trainingSetUid Training set the conversations belong to
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
     * Update Training Set
     * Call: $api->agrSite->training->update($trainingSetUid, $data)
     *
     * Request body: Partial update of a training set; an absent field keeps its current value
     *
     * Errors:
     *   400: trainingSetUid is 0 or negative.
     *   404: No training set with this ID.
     *
     * PUT https://agr-site.augur-api.com/training/{trainingSetUid}
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1training~1{trainingSetUid}/put
     *
     * Request body ($data): TrainingUpdateBody (fields listed on the class)
     *
     * Response data type: TrainingListItem (fields listed on the class)
     *
     * @param int $trainingSetUid Training set the conversations belong to
     * @param TrainingUpdateBody $data
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
     * List Training Conversations
     * Call: $api->agrSite->training->listConversations($trainingSetUid)
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a training_conv column.
     *   404: No training set with this trainingSetUid.
     *
     * GET https://agr-site.augur-api.com/training/{trainingSetUid}/conversations
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1training~1{trainingSetUid}~1conversations/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: training_conv_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of TrainingConversationsListItem (fields listed on the class)
     *
     * @param int $trainingSetUid Training set the conversations belong to
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
     * Create Training Conversation
     * Call: $api->agrSite->training->createConversations($trainingSetUid, $data)
     *
     * Request body: Add a conversation to the training set in the path
     *
     * Errors:
     *   400: trainingSetUid is 0 or negative.
     *   404: No training set with this trainingSetUid.
     *
     * POST https://agr-site.augur-api.com/training/{trainingSetUid}/conversations
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1training~1{trainingSetUid}~1conversations/post
     *
     * Request body ($data): TrainingConversationsCreateBody (fields listed on the class)
     *
     * Response data type: TrainingConversationsListItem (fields listed on the class)
     *
     * @param int $trainingSetUid Training set the conversations belong to
     * @param TrainingConversationsCreateBody $data
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
     * DELETE Training Conversation
     * Call: $api->agrSite->training->deleteConversations($trainingSetUid, $trainingConvUid)
     *
     * Errors:
     *   400: trainingSetUid or trainingConvUid is 0 or negative.
     *   404: No training conversation with this ID.
     *
     * DELETE
     * https://agr-site.augur-api.com/training/{trainingSetUid}/conversations/{trainingConvUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1training~1{trainingSetUid}~1conversations~1{trainingConvUid}/delete
     *
     * Response data type: TrainingConversationsListItem (fields listed on the class)
     *
     * @param int $trainingSetUid Training set the conversations belong to
     * @param int $trainingConvUid Training conversation ID
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
     * Get Training Conversation Details
     * Call: $api->agrSite->training->getConversations($trainingSetUid, $trainingConvUid)
     *
     * Errors:
     *   400: trainingSetUid or trainingConvUid is 0 or negative.
     *   404: No training conversation with this ID.
     *
     * GET https://agr-site.augur-api.com/training/{trainingSetUid}/conversations/{trainingConvUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1training~1{trainingSetUid}~1conversations~1{trainingConvUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: TrainingConversationsListItem (fields listed on the class)
     *
     * @param int $trainingSetUid Training set the conversations belong to
     * @param int $trainingConvUid Training conversation ID
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
     * Update Training Conversation
     * Call: $api->agrSite->training->updateConversations($trainingSetUid, $trainingConvUid, $data)
     *
     * Request body: Partial update of a training conversation; an absent field keeps its current
     * value
     *
     * Errors:
     *   400: trainingSetUid or trainingConvUid is 0 or negative.
     *   404: No training conversation with this ID.
     *
     * PUT https://agr-site.augur-api.com/training/{trainingSetUid}/conversations/{trainingConvUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1training~1{trainingSetUid}~1conversations~1{trainingConvUid}/put
     *
     * Request body ($data): TrainingConversationsUpdateBody (fields listed on the class)
     *
     * Response data type: TrainingConversationsListItem (fields listed on the class)
     *
     * @param int $trainingSetUid Training set the conversations belong to
     * @param int $trainingConvUid Training conversation ID
     * @param TrainingConversationsUpdateBody $data
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
     * List Training Messages
     * Call: $api->agrSite->training->listConversationsMessages($trainingSetUid, $trainingConvUid)
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on a training_msg column.
     *   404: No training set with this trainingSetUid, or no conversation with this trainingConvUid
     *       in that set.
     *
     * GET
     * https://agr-site.augur-api.com/training/{trainingSetUid}/conversations/{trainingConvUid}/messages
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1training~1{trainingSetUid}~1conversations~1{trainingConvUid}~1messages/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: training_msg_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of TrainingConversationsMessagesListItem (fields listed on the
     * class)
     *
     * @param int $trainingSetUid Training set the conversations belong to
     * @param int $trainingConvUid Training conversation ID
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
     * Create Training Message
     * Call:
     * $api->agrSite->training->createConversationsMessages($trainingSetUid, $trainingConvUid, $data)
     *
     * Request body: Add a message to the training conversation in the path
     *
     * Errors:
     *   400: trainingSetUid or trainingConvUid is 0 or negative.
     *   404: No training set with this trainingSetUid, or no conversation with this trainingConvUid
     *       in that set.
     *
     * POST
     * https://agr-site.augur-api.com/training/{trainingSetUid}/conversations/{trainingConvUid}/messages
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1training~1{trainingSetUid}~1conversations~1{trainingConvUid}~1messages/post
     *
     * Request body ($data): TrainingConversationsMessagesCreateBody (fields listed on the class)
     *
     * Response data type: TrainingConversationsMessagesListItem (fields listed on the class)
     *
     * @param int $trainingSetUid Training set the conversations belong to
     * @param int $trainingConvUid Training conversation ID
     * @param TrainingConversationsMessagesCreateBody $data
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
     * DELETE Training Message
     * Call:
     * $api->agrSite->training->deleteConversationsMessages($trainingSetUid, $trainingConvUid, $trainingMsgUid)
     *
     * Errors:
     *   400: trainingSetUid, trainingConvUid or trainingMsgUid is 0 or negative.
     *   404: No training message with this ID.
     *
     * DELETE
     * https://agr-site.augur-api.com/training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1training~1{trainingSetUid}~1conversations~1{trainingConvUid}~1messages~1{trainingMsgUid}/delete
     *
     * Response data type: TrainingConversationsMessagesListItem (fields listed on the class)
     *
     * @param int $trainingSetUid Training set the conversations belong to
     * @param int $trainingConvUid Training conversation ID
     * @param int $trainingMsgUid Training message ID
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
     * Get Training Message Details
     * Call:
     * $api->agrSite->training->getConversationsMessages($trainingSetUid, $trainingConvUid, $trainingMsgUid)
     *
     * Errors:
     *   400: trainingSetUid, trainingConvUid or trainingMsgUid is 0 or negative.
     *   404: No training message with this ID.
     *
     * GET
     * https://agr-site.augur-api.com/training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1training~1{trainingSetUid}~1conversations~1{trainingConvUid}~1messages~1{trainingMsgUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: TrainingConversationsMessagesListItem (fields listed on the class)
     *
     * @param int $trainingSetUid Training set the conversations belong to
     * @param int $trainingConvUid Training conversation ID
     * @param int $trainingMsgUid Training message ID
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
     * Update Training Message
     * Call:
     * $api->agrSite->training->updateConversationsMessages($trainingSetUid, $trainingConvUid, $trainingMsgUid, $data)
     *
     * Request body: Partial update of a training message; an absent field keeps its current value
     *
     * Errors:
     *   400: trainingSetUid, trainingConvUid or trainingMsgUid is 0 or negative.
     *   404: No training message with this ID.
     *
     * PUT
     * https://agr-site.augur-api.com/training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid}
     * Contract:
     * https://agr-site.augur-api.com/openapi.json#/paths/~1training~1{trainingSetUid}~1conversations~1{trainingConvUid}~1messages~1{trainingMsgUid}/put
     *
     * Request body ($data): TrainingConversationsMessagesUpdateBody (fields listed on the class)
     *
     * Response data type: TrainingConversationsMessagesListItem (fields listed on the class)
     *
     * @param int $trainingSetUid Training set the conversations belong to
     * @param int $trainingConvUid Training conversation ID
     * @param int $trainingMsgUid Training message ID
     * @param TrainingConversationsMessagesUpdateBody $data
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
