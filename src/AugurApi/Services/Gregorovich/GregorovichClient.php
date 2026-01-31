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
 * Gregorovich AI service client.
 *
 * @fullPath api.gregorovich
 * @service gregorovich
 * @domain ai
 */
final class GregorovichClient extends BaseServiceClient
{
    public readonly ChatGptResource $chatGpt;
    public readonly DocumentsResource $documents;
    public readonly OllamaResource $ollama;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->chatGpt = new ChatGptResource($client, $this->baseUrl);
        $this->documents = new DocumentsResource($client, $this->baseUrl);
        $this->ollama = new OllamaResource($client, $this->baseUrl);
    }

    protected function getServiceName(): string
    {
        return 'gregorovich';
    }
}
