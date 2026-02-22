<?php

declare(strict_types=1);

namespace AugurApi\Core;

use AugurApi\Core\Exceptions\AugurApiException;
use AugurApi\Core\Exceptions\AuthenticationException;
use AugurApi\Core\Exceptions\RateLimitException;
use AugurApi\Core\Exceptions\ValidationException;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * PSR-18 compliant HTTP client for Augur API.
 */
final class Client
{
    private const array PUBLIC_ENDPOINTS = ['/health-check', '/ping', '/whoami'];

    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactory;
    private StreamFactoryInterface $streamFactory;

    public function __construct(
        private readonly Config $config,
        ?ClientInterface $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null,
    ) {
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
    }

    /**
     * @param array<string, mixed> $params Query parameters
     * @param array<string, string> $pathParams Path parameter substitutions
     * @return array<string, mixed>
     */
    public function get(
        string $baseUrl,
        string $path,
        array $params = [],
        array $pathParams = [],
    ): array {
        return $this->request('GET', $baseUrl, $path, $params, null, $pathParams);
    }

    /**
     * @param array<int|string, mixed> $data Request body (object or list of objects)
     * @param array<string, string> $pathParams Path parameter substitutions
     * @return array<string, mixed>
     */
    public function post(
        string $baseUrl,
        string $path,
        array $data = [],
        array $pathParams = [],
    ): array {
        return $this->request('POST', $baseUrl, $path, [], $data, $pathParams);
    }

    /**
     * @param array<string, mixed> $data Request body
     * @param array<string, string> $pathParams Path parameter substitutions
     * @return array<string, mixed>
     */
    public function put(
        string $baseUrl,
        string $path,
        array $data = [],
        array $pathParams = [],
    ): array {
        return $this->request('PUT', $baseUrl, $path, [], $data, $pathParams);
    }

    /**
     * @param array<string, string> $pathParams Path parameter substitutions
     * @return array<string, mixed>
     */
    public function delete(
        string $baseUrl,
        string $path,
        array $pathParams = [],
    ): array {
        return $this->request('DELETE', $baseUrl, $path, [], null, $pathParams);
    }

    /**
     * @param array<string, mixed> $params Query parameters
     * @param array<int|string, mixed>|null $data Request body (object or list of objects)
     * @param array<string, string> $pathParams Path parameter substitutions
     * @return array<string, mixed>
     */
    private function request(
        string $method,
        string $baseUrl,
        string $path,
        array $params = [],
        ?array $data = null,
        array $pathParams = [],
    ): array {
        $resolvedPath = $this->resolvePath($path, $pathParams);
        $url = $baseUrl . $resolvedPath;

        $filteredParams = $this->filterParams($params);
        if (!empty($filteredParams)) {
            $url .= '?' . http_build_query($filteredParams);
        }

        $request = $this->requestFactory->createRequest($method, $url);
        $request = $this->addHeaders($request, $resolvedPath);

        if ($data !== null) {
            $body = $this->streamFactory->createStream((string) json_encode($data));
            $request = $request->withBody($body);
            $request = $request->withHeader('Content-Type', 'application/json');
        }

        return $this->executeWithRetry($request);
    }

    /**
     * @param array<string, string> $pathParams
     */
    private function resolvePath(string $path, array $pathParams): string
    {
        foreach ($pathParams as $key => $value) {
            $path = str_replace('{' . $key . '}', urlencode($value), $path);
        }
        return $path;
    }

    private function addHeaders(RequestInterface $request, string $path): RequestInterface
    {
        $request = $request->withHeader('x-site-id', $this->config->siteId);
        $request = $request->withHeader('Accept', 'application/json');

        if (!$this->isPublicEndpoint($path)) {
            $request = $request->withHeader(
                'Authorization',
                'Bearer ' . $this->config->bearerToken,
            );
        }

        return $request;
    }

    private function isPublicEndpoint(string $path): bool
    {
        foreach (self::PUBLIC_ENDPOINTS as $endpoint) {
            if (str_ends_with($path, $endpoint)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    private function filterParams(array $params): array
    {
        return array_filter($params, static fn ($v) => $v !== null);
    }

    /**
     * @return array<string, mixed>
     */
    private function executeWithRetry(RequestInterface $request): array
    {
        $attempt = 0;
        $lastException = null;

        while ($attempt <= $this->config->retries) {
            try {
                $response = $this->httpClient->sendRequest($request);
                return $this->handleResponse($response);
            } catch (\Exception $e) {
                $lastException = $e;

                if ($e instanceof AuthenticationException) {
                    throw $e;
                }

                if ($e instanceof RateLimitException || $this->isRetryableError($e)) {
                    $attempt++;
                    if ($attempt <= $this->config->retries) {
                        $delay = $this->calculateDelay($attempt);
                        usleep($delay * 1000);
                    }
                    continue;
                }

                throw $e;
            }
        }

        throw $lastException ?? new AugurApiException('Request failed after retries');
    }

    private function calculateDelay(int $attempt): int
    {
        $baseDelay = $this->config->retryDelay;
        $delay = $baseDelay * (int) pow(2, $attempt - 1);
        $jitter = random_int(0, (int) ($delay * 0.1));
        return min($delay + $jitter, 30000);
    }

    /**
     * @return array<string, mixed>
     */
    private function handleResponse(ResponseInterface $response): array
    {
        $statusCode = $response->getStatusCode();
        $body = (string) $response->getBody();
        /** @var array<string, mixed> $data */
        $data = json_decode($body, true) ?? [];

        if ($statusCode === 401 || $statusCode === 403) {
            throw new AuthenticationException(
                $data['message'] ?? 'Authentication failed',
                $statusCode,
            );
        }

        if ($statusCode === 429) {
            throw new RateLimitException(
                $data['message'] ?? 'Rate limit exceeded',
                $statusCode,
            );
        }

        if ($statusCode === 400) {
            throw new ValidationException(
                $data['message'] ?? 'Validation failed',
                $statusCode,
                $data['errors'] ?? [],
            );
        }

        if ($statusCode >= 400) {
            throw new AugurApiException(
                $data['message'] ?? 'API request failed',
                $statusCode,
            );
        }

        return $data;
    }

    private function isRetryableError(\Exception $e): bool
    {
        return $e instanceof AugurApiException && $e->getCode() >= 500;
    }
}
