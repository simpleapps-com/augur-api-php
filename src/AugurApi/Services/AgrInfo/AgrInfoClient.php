<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\AgrInfo\Resources\AkashaResource;
use AugurApi\Services\AgrInfo\Resources\ContextResource;
use AugurApi\Services\AgrInfo\Resources\JoomlaResource;
use AugurApi\Services\AgrInfo\Resources\MicroservicesResource;
use AugurApi\Services\AgrInfo\Resources\OllamaResource;
use AugurApi\Services\AgrInfo\Resources\RubricsResource;
use AugurApi\Services\AgrInfo\Resources\SitesResource;
use AugurApi\Services\AgrInfo\Resources\WorkflowsResource;

/**
 * AgrInfo service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-info
 */
final class AgrInfoClient extends BaseServiceClient
{
    public readonly AkashaResource $akasha;
    public readonly ContextResource $context;
    public readonly JoomlaResource $joomla;
    public readonly MicroservicesResource $microservices;
    public readonly OllamaResource $ollama;
    public readonly RubricsResource $rubrics;
    public readonly SitesResource $sites;
    public readonly WorkflowsResource $workflows;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->akasha = new AkashaResource($this->client, $this->baseUrl . '/akasha');
        $this->context = new ContextResource($this->client, $this->baseUrl . '/context');
        $this->joomla = new JoomlaResource($this->client, $this->baseUrl . '/joomla');
        $this->microservices = new MicroservicesResource($this->client, $this->baseUrl . '/microservices');
        $this->ollama = new OllamaResource($this->client, $this->baseUrl . '/ollama');
        $this->rubrics = new RubricsResource($this->client, $this->baseUrl . '/rubrics');
        $this->sites = new SitesResource($this->client, $this->baseUrl . '/sites');
        $this->workflows = new WorkflowsResource($this->client, $this->baseUrl . '/workflows');
    }

    protected function getServiceName(): string
    {
        return 'agrInfo';
    }
}
