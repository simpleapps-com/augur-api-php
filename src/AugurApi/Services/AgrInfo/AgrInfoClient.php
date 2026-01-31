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

/**
 * Agr Info service client.
 *
 * @fullPath api.agrInfo
 * @service agr_info
 * @domain augur
 */
final class AgrInfoClient extends BaseServiceClient
{
    public readonly AkashaResource $akasha;
    public readonly ContextResource $context;
    public readonly JoomlaResource $joomla;
    public readonly MicroservicesResource $microservices;
    public readonly OllamaResource $ollama;
    public readonly RubricsResource $rubrics;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->akasha = new AkashaResource($client, $this->baseUrl);
        $this->context = new ContextResource($client, $this->baseUrl);
        $this->joomla = new JoomlaResource($client, $this->baseUrl);
        $this->microservices = new MicroservicesResource($client, $this->baseUrl);
        $this->ollama = new OllamaResource($client, $this->baseUrl);
        $this->rubrics = new RubricsResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'agrInfo';
    }
}
