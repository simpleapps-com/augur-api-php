<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\AgrSite\Resources\ContextResource;
use AugurApi\Services\AgrSite\Resources\FyxerTranscriptResource;
use AugurApi\Services\AgrSite\Resources\GeoCodesPostalCodesResource;
use AugurApi\Services\AgrSite\Resources\MetaFilesResource;
use AugurApi\Services\AgrSite\Resources\NotificationsResource;
use AugurApi\Services\AgrSite\Resources\OpenSearchResource;
use AugurApi\Services\AgrSite\Resources\SettingsResource;
use AugurApi\Services\AgrSite\Resources\TrainingResource;

/**
 * Agr Site service client.
 *
 * @fullPath api.agrSite
 * @service agr_site
 * @domain augur
 */
final class AgrSiteClient extends BaseServiceClient
{
    public readonly ContextResource $context;
    public readonly FyxerTranscriptResource $fyxerTranscript;
    public readonly GeoCodesPostalCodesResource $geoCodesPostalCodes;
    public readonly MetaFilesResource $metaFiles;
    public readonly NotificationsResource $notifications;
    public readonly OpenSearchResource $openSearch;
    public readonly SettingsResource $settings;
    public readonly TrainingResource $training;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->context = new ContextResource($client, $this->baseUrl);
        $this->fyxerTranscript = new FyxerTranscriptResource($client, $this->baseUrl);
        $this->geoCodesPostalCodes = new GeoCodesPostalCodesResource($client, $this->baseUrl);
        $this->metaFiles = new MetaFilesResource($client, $this->baseUrl);
        $this->notifications = new NotificationsResource($client, $this->baseUrl);
        $this->openSearch = new OpenSearchResource($client, $this->baseUrl);
        $this->settings = new SettingsResource($client, $this->baseUrl);
        $this->training = new TrainingResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'agrSite';
    }
}
