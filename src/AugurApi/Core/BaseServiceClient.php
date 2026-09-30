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
        /** @var BaseResponse<array{siteHash: string, siteId: string}> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $d): mixed => $d);

        return $result;
    }

    /**
     * Ping endpoint.
     *
     * @return BaseResponse<string>
     */
    public function ping(): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/ping');
        /** @var BaseResponse<string> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $d): mixed => $d);

        return $result;
    }

    /**
     * Whoami endpoint: decoded JWT claims. Sends x-site-id and the Bearer token.
     *
     * @return BaseResponse<array{
     *     email: string,
     *     name: string,
     *     scope: mixed,
     *     siteId: string,
     *     tokenType: string,
     *     userId: int,
     *     username: string
     * }>
     */
    public function whoami(): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/whoami');
        /**
         * @var BaseResponse<array{
         *     email: string,
         *     name: string,
         *     scope: mixed,
         *     siteId: string,
         *     tokenType: string,
         *     userId: int,
         *     username: string
         * }> $result
         */
        $result = BaseResponse::fromArray($response, static fn (mixed $d): mixed => $d);

        return $result;
    }
}
