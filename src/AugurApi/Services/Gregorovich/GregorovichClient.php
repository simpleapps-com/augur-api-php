<?php

declare(strict_types=1);

namespace AugurApi\Services\Gregorovich;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Gregorovich\Resources\ChatGptResource;
use AugurApi\Services\Gregorovich\Resources\DocumentsResource;
use AugurApi\Services\Gregorovich\Resources\OllamaResource;

/**
 * Gregorovich service client — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py gregorovich
 */
final class GregorovichClient extends BaseServiceClient
{
    public readonly ChatGptResource $chatGpt;
    public readonly DocumentsResource $documents;
    public readonly OllamaResource $ollama;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->chatGpt = new ChatGptResource($client, $this->baseUrl . '/chat-gpt');
        $this->documents = new DocumentsResource($client, $this->baseUrl . '/documents');
        $this->ollama = new OllamaResource($client, $this->baseUrl . '/ollama');
    }

    protected function getServiceName(): string
    {
        return 'gregorovich';
    }
}
