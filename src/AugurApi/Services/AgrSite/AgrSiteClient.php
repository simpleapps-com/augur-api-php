<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\AgrSite\Resources\ConfigsResource;
use AugurApi\Services\AgrSite\Resources\ContextResource;
use AugurApi\Services\AgrSite\Resources\DatafilesResource;
use AugurApi\Services\AgrSite\Resources\FyxerTranscriptResource;
use AugurApi\Services\AgrSite\Resources\GeoCodesPostalCodesResource;
use AugurApi\Services\AgrSite\Resources\MetaFilesResource;
use AugurApi\Services\AgrSite\Resources\NotificationsResource;
use AugurApi\Services\AgrSite\Resources\OpenSearchResource;
use AugurApi\Services\AgrSite\Resources\PostalCodesXShiptosResource;
use AugurApi\Services\AgrSite\Resources\SettingsResource;
use AugurApi\Services\AgrSite\Resources\TrainingResource;
use AugurApi\Services\AgrSite\Resources\UsersResource;

/**
 * AgrSite service client — generated from spec.
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
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /configs → $api->agrSite->configs->list() → list of ConfigsListItem
 *   GET /configs/{serviceName} → $api->agrSite->configs->get($serviceName) → ConfigsGetData
 *   PUT /configs/{serviceName} → $api->agrSite->configs->update($serviceName, $data) →
 *       ConfigsGetData
 *   GET /context/{siteId} → $api->agrSite->context->get($siteId) →
 *       ContextGetDataOption1|ContextGetDataOption2
 *   POST /datafiles → $api->agrSite->datafiles->create($data) → string
 *   GET /fyxer-transcript → $api->agrSite->fyxerTranscript->list() →
 *       list of FyxerTranscriptListItem
 *   POST /fyxer-transcript → $api->agrSite->fyxerTranscript->create($data) →
 *       FyxerTranscriptListItem
 *   GET /fyxer-transcript/{fyxerTranscriptHdrUid} →
 *       $api->agrSite->fyxerTranscript->get($fyxerTranscriptHdrUid) → FyxerTranscriptListItem
 *   PUT /fyxer-transcript/{fyxerTranscriptHdrUid} →
 *       $api->agrSite->fyxerTranscript->update($fyxerTranscriptHdrUid, $data) →
 *       FyxerTranscriptListItem
 *   DELETE /fyxer-transcript/{fyxerTranscriptHdrUid} →
 *       $api->agrSite->fyxerTranscript->delete($fyxerTranscriptHdrUid) → FyxerTranscriptListItem
 *   GET /geo-codes-postal-codes → $api->agrSite->geoCodesPostalCodes->list() →
 *       list of GeoCodesPostalCodesListItem
 *   GET /geo-codes-postal-codes/{geoCodesPostalCodesUid} →
 *       $api->agrSite->geoCodesPostalCodes->get($geoCodesPostalCodesUid) →
 *       GeoCodesPostalCodesListItem
 *   GET /meta-files/robots → $api->agrSite->metaFiles->listRobots() → MetaFilesRobotsListData
 *   POST /notifications → $api->agrSite->notifications->create($data) → NotificationsCreateData
 *   GET /open-search/embedding → $api->agrSite->openSearch->listEmbedding() →
 *       OpenSearchEmbeddingListData
 *   GET /postal-codes-x-shiptos → $api->agrSite->postalCodesXShiptos->list() →
 *       list of PostalCodesXShiptosListItem
 *   POST /postal-codes-x-shiptos → $api->agrSite->postalCodesXShiptos->create($data) →
 *       PostalCodesXShiptosListItem
 *   GET /postal-codes-x-shiptos/{postalCodesXShiptosUid} →
 *       $api->agrSite->postalCodesXShiptos->get($postalCodesXShiptosUid) →
 *       PostalCodesXShiptosListItem
 *   PUT /postal-codes-x-shiptos/{postalCodesXShiptosUid} →
 *       $api->agrSite->postalCodesXShiptos->update($postalCodesXShiptosUid, $data) →
 *       PostalCodesXShiptosListItem
 *   DELETE /postal-codes-x-shiptos/{postalCodesXShiptosUid} →
 *       $api->agrSite->postalCodesXShiptos->delete($postalCodesXShiptosUid) →
 *       PostalCodesXShiptosListItem
 *   GET /settings → $api->agrSite->settings->list() → list of SettingsListItem
 *   POST /settings → $api->agrSite->settings->create($data) → SettingsListItem
 *   GET /settings/{settingsUid} → $api->agrSite->settings->get($settingsUid) → SettingsListItem
 *   PUT /settings/{settingsUid} → $api->agrSite->settings->update($settingsUid, $data) →
 *       SettingsListItem
 *   DELETE /settings/{settingsUid} → $api->agrSite->settings->delete($settingsUid) →
 *       SettingsListItem
 *   GET /training → $api->agrSite->training->list() → list of TrainingListItem
 *   POST /training → $api->agrSite->training->create($data) → TrainingListItem
 *   GET /training/{trainingSetUid} → $api->agrSite->training->get($trainingSetUid) →
 *       TrainingListItem
 *   PUT /training/{trainingSetUid} → $api->agrSite->training->update($trainingSetUid, $data) →
 *       TrainingListItem
 *   DELETE /training/{trainingSetUid} → $api->agrSite->training->delete($trainingSetUid) →
 *       TrainingListItem
 *   GET /training/{trainingSetUid}/conversations →
 *       $api->agrSite->training->listConversations($trainingSetUid) →
 *       list of TrainingConversationsListItem
 *   POST /training/{trainingSetUid}/conversations →
 *       $api->agrSite->training->createConversations($trainingSetUid, $data) →
 *       TrainingConversationsListItem
 *   GET /training/{trainingSetUid}/conversations/{trainingConvUid} →
 *       $api->agrSite->training->getConversations($trainingSetUid, $trainingConvUid) →
 *       TrainingConversationsListItem
 *   PUT /training/{trainingSetUid}/conversations/{trainingConvUid} →
 *       $api->agrSite->training->updateConversations($trainingSetUid, $trainingConvUid, $data) →
 *       TrainingConversationsListItem
 *   DELETE /training/{trainingSetUid}/conversations/{trainingConvUid} →
 *       $api->agrSite->training->deleteConversations($trainingSetUid, $trainingConvUid) →
 *       TrainingConversationsListItem
 *   GET /training/{trainingSetUid}/conversations/{trainingConvUid}/messages →
 *       $api->agrSite->training->listConversationsMessages($trainingSetUid, $trainingConvUid) →
 *       list of TrainingConversationsMessagesListItem
 *   POST /training/{trainingSetUid}/conversations/{trainingConvUid}/messages →
 *       $api->agrSite->training->createConversationsMessages($trainingSetUid, $trainingConvUid, $data) →
 *       TrainingConversationsMessagesListItem
 *   GET /training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid} →
 *       $api->agrSite->training->getConversationsMessages($trainingSetUid, $trainingConvUid, $trainingMsgUid) →
 *       TrainingConversationsMessagesListItem
 *   PUT /training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid} →
 *       $api->agrSite->training->updateConversationsMessages($trainingSetUid, $trainingConvUid, $trainingMsgUid, $data) →
 *       TrainingConversationsMessagesListItem
 *   DELETE /training/{trainingSetUid}/conversations/{trainingConvUid}/messages/{trainingMsgUid} →
 *       $api->agrSite->training->deleteConversationsMessages($trainingSetUid, $trainingConvUid, $trainingMsgUid) →
 *       TrainingConversationsMessagesListItem
 *   GET /users/{userId}/addresses → $api->agrSite->users->listAddresses($userId) →
 *       list of UsersAddressesListItem
 *   POST /users/{userId}/addresses → $api->agrSite->users->createAddresses($userId, $data) →
 *       UsersAddressesListItem
 *   GET /users/{userId}/addresses/{userAddressUid} →
 *       $api->agrSite->users->getAddresses($userId, $userAddressUid) → UsersAddressesListItem
 *   PUT /users/{userId}/addresses/{userAddressUid} →
 *       $api->agrSite->users->updateAddresses($userId, $userAddressUid, $data) →
 *       UsersAddressesListItem
 *   DELETE /users/{userId}/addresses/{userAddressUid} →
 *       $api->agrSite->users->deleteAddresses($userId, $userAddressUid) → UsersAddressesListItem
 */
final class AgrSiteClient extends BaseServiceClient
{
    public readonly ConfigsResource $configs;
    public readonly ContextResource $context;
    public readonly DatafilesResource $datafiles;
    public readonly FyxerTranscriptResource $fyxerTranscript;
    public readonly GeoCodesPostalCodesResource $geoCodesPostalCodes;
    public readonly MetaFilesResource $metaFiles;
    public readonly NotificationsResource $notifications;
    public readonly OpenSearchResource $openSearch;
    public readonly PostalCodesXShiptosResource $postalCodesXShiptos;
    public readonly SettingsResource $settings;
    public readonly TrainingResource $training;
    public readonly UsersResource $users;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->configs = new ConfigsResource($this->client, $this->baseUrl . '/configs');
        $this->context = new ContextResource($this->client, $this->baseUrl . '/context');
        $this->datafiles = new DatafilesResource($this->client, $this->baseUrl . '/datafiles');
        $this->fyxerTranscript = new FyxerTranscriptResource($this->client, $this->baseUrl . '/fyxer-transcript');
        $this->geoCodesPostalCodes = new GeoCodesPostalCodesResource($this->client, $this->baseUrl . '/geo-codes-postal-codes');
        $this->metaFiles = new MetaFilesResource($this->client, $this->baseUrl . '/meta-files');
        $this->notifications = new NotificationsResource($this->client, $this->baseUrl . '/notifications');
        $this->openSearch = new OpenSearchResource($this->client, $this->baseUrl . '/open-search');
        $this->postalCodesXShiptos = new PostalCodesXShiptosResource($this->client, $this->baseUrl . '/postal-codes-x-shiptos');
        $this->settings = new SettingsResource($this->client, $this->baseUrl . '/settings');
        $this->training = new TrainingResource($this->client, $this->baseUrl . '/training');
        $this->users = new UsersResource($this->client, $this->baseUrl . '/users');
    }

    protected function getServiceName(): string
    {
        return 'agrSite';
    }
}
