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
    public readonly WorkflowsResource $workflows;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->akasha = new AkashaResource($client, $this->baseUrl . '/akasha');
        $this->context = new ContextResource($client, $this->baseUrl . '/context');
        $this->joomla = new JoomlaResource($client, $this->baseUrl . '/joomla');
        $this->microservices = new MicroservicesResource($client, $this->baseUrl . '/microservices');
        $this->ollama = new OllamaResource($client, $this->baseUrl . '/ollama');
        $this->rubrics = new RubricsResource($client, $this->baseUrl . '/rubrics');
        $this->workflows = new WorkflowsResource($client, $this->baseUrl . '/workflows');
    }

    protected function getServiceName(): string
    {
        return 'agrInfo';
    }
}
