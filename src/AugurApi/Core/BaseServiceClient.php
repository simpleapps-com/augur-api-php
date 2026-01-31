<?php

declare(strict_types=1);

namespace AugurApi\Core;

/**
 * Base class for all service clients.
 */
abstract class BaseServiceClient
{
    protected readonly string $baseUrl;

    public function __construct(
        protected readonly Client $client,
        protected readonly Config $config,
    ) {
        $this->baseUrl = $config->getBaseUrl($this->getServiceName());
    }

    abstract protected function getServiceName(): string;

    /**
     * Health check endpoint.
     *
     * @return BaseResponse<array{siteHash: string, siteId: string}>
     */
    public function healthCheck(): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/health-check');
        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Ping endpoint.
     *
     * @return BaseResponse<string>
     */
    public function ping(): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/ping');
        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }

    /**
     * Whoami endpoint.
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function whoami(): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/whoami');
        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
