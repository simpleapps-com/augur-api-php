<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
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
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 */
final class AgrSiteClient extends BaseServiceClient
{
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
        $this->context = new ContextResource($client, $this->baseUrl . '/context');
        $this->datafiles = new DatafilesResource($client, $this->baseUrl . '/datafiles');
        $this->fyxerTranscript = new FyxerTranscriptResource($client, $this->baseUrl . '/fyxer-transcript');
        $this->geoCodesPostalCodes = new GeoCodesPostalCodesResource($client, $this->baseUrl . '/geo-codes-postal-codes');
        $this->metaFiles = new MetaFilesResource($client, $this->baseUrl . '/meta-files');
        $this->notifications = new NotificationsResource($client, $this->baseUrl . '/notifications');
        $this->openSearch = new OpenSearchResource($client, $this->baseUrl . '/open-search');
        $this->postalCodesXShiptos = new PostalCodesXShiptosResource($client, $this->baseUrl . '/postal-codes-x-shiptos');
        $this->settings = new SettingsResource($client, $this->baseUrl . '/settings');
        $this->training = new TrainingResource($client, $this->baseUrl . '/training');
        $this->users = new UsersResource($client, $this->baseUrl . '/users');
    }

    protected function getServiceName(): string
    {
        return 'agrSite';
    }
}
