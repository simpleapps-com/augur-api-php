<?php

declare(strict_types=1);

namespace AugurApi\Core;

use AugurApi\Core\Exceptions\AugurApiException;
use AugurApi\Core\Exceptions\AuthenticationException;
use AugurApi\Core\Exceptions\NotFoundException;
use AugurApi\Core\Exceptions\RateLimitException;
use AugurApi\Core\Exceptions\ValidationException;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * PSR-18 compliant HTTP client for Augur API.
 *
 * Every exception it throws carries the kebab service name (set via
 * forService()) and the path template, never the URL or param values.
 */
final class Client
{
    private const array PUBLIC_ENDPOINTS = ['/health-check', '/ping'];

    /** edgeCache values sent as-is (sub-hour); anything else is parsed as hours. */
    private const array EDGE_CACHE_SUB_HOUR = ['30s', '1m', '5m'];
    private const array EDGE_CACHE_HOURS = [1, 2, 3, 4, 5, 8];

    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactory;
    private StreamFactoryInterface $streamFactory;

    /** Kebab service name carried on exceptions; '' until forService(). */
    private string $service = '';

    /** The service base URL; the rest of a request URL is the path template. */
    private string $serviceBaseUrl = '';

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
     * A copy bound to one service, so its exceptions name the service and the
     * full path template (resource prefix included).
     *
     * @param string $serviceName camelCase service name, as Config::getBaseUrl() takes it
     */
    public function forService(string $serviceName): self
    {
        $scoped = clone $this;
        $scoped->service = strtolower((string) preg_replace('/([a-z0-9])([A-Z])/', '$1-$2', $serviceName));
        $scoped->serviceBaseUrl = $this->config->getBaseUrl($serviceName);

        return $scoped;
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
     * $params is appended last, after $pathParams, so existing positional calls
     * keep working. The API declares query params on POST/PUT/DELETE as well as
     * GET, and passing [] unconditionally made them unreachable.
     *
     * @param array<int|string, mixed> $data Request body (object or list of objects)
     * @param array<string, string> $pathParams Path parameter substitutions
     * @param array<string, mixed> $params Query parameters
     * @return array<string, mixed>
     */
    public function post(
        string $baseUrl,
        string $path,
        array $data = [],
        array $pathParams = [],
        array $params = [],
    ): array {
        return $this->request('POST', $baseUrl, $path, $params, $data, $pathParams);
    }

    /**
     * @param array<string, mixed> $data Request body
     * @param array<string, string> $pathParams Path parameter substitutions
     * @param array<string, mixed> $params Query parameters
     * @return array<string, mixed>
     */
    public function put(
        string $baseUrl,
        string $path,
        array $data = [],
        array $pathParams = [],
        array $params = [],
    ): array {
        return $this->request('PUT', $baseUrl, $path, $params, $data, $pathParams);
    }

    /**
     * @param array<string, string> $pathParams Path parameter substitutions
     * @param array<string, mixed> $params Query parameters
     * @return array<string, mixed>
     */
    public function delete(
        string $baseUrl,
        string $path,
        array $pathParams = [],
        array $params = [],
    ): array {
        return $this->request('DELETE', $baseUrl, $path, $params, null, $pathParams);
    }

    /**
     * Raw transport: send one request and return the 2xx response as received.
     *
     * Non-2xx statuses throw through the shared status switch. GET is retried
     * per Config; POST/PUT/DELETE are sent once.
     *
     * @param array<string, mixed> $params Query parameters (null values skipped)
     * @param array<int|string, mixed>|null $data Request body; null sends none
     * @param array<string, string> $pathParams Path parameter substitutions
     * @throws AugurApiException
     */
    public function send(
        string $method,
        string $baseUrl,
        string $path,
        array $params = [],
        ?array $data = null,
        array $pathParams = [],
    ): RawResponse {
        $template = $this->templateFor($baseUrl, $path);
        $request = $this->buildRequest($method, $baseUrl, $path, $template, $params, $data, $pathParams);

        // Only retry idempotent GET requests; POST/PUT/DELETE fail fast
        if ($method === 'GET') {
            return $this->executeWithRetry($request, $template);
        }

        return $this->dispatch($request, $template);
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
        $json = $this->send($method, $baseUrl, $path, $params, $data, $pathParams)->json;
        /** @var array<string, mixed> $decoded */
        $decoded = is_array($json) ? $json : [];

        return $decoded;
    }

    /**
     * The path template: the part of the URL after the service base URL.
     */
    private function templateFor(string $baseUrl, string $path): string
    {
        $isUnderService = $this->serviceBaseUrl !== '' && str_starts_with($baseUrl, $this->serviceBaseUrl);

        return ($isUnderService ? substr($baseUrl, strlen($this->serviceBaseUrl)) : '') . $path;
    }

    /**
     * @param array<string, mixed> $params Query parameters
     * @param array<int|string, mixed>|null $data Request body (object or list of objects)
     * @param array<string, string> $pathParams Path parameter substitutions
     */
    private function buildRequest(
        string $method,
        string $baseUrl,
        string $path,
        string $template,
        array $params,
        ?array $data,
        array $pathParams,
    ): RequestInterface {
        $resolvedPath = $this->resolvePath($path, $pathParams, $template);
        $url = $baseUrl . $resolvedPath;

        $filteredParams = $this->filterParams($this->applyEdgeCache($params));
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

        return $request;
    }

    /**
     * Send once; wrap transport failures and route non-2xx through the status switch.
     */
    private function dispatch(RequestInterface $request, string $template): RawResponse
    {
        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            // The transport's own message can hold the URL, so it is not reused.
            throw new AugurApiException('Network request failed', 0, $e, $this->service, $template);
        }

        $raw = new RawResponse(
            $response->getStatusCode(),
            $response->getHeaderLine('Content-Type'),
            (string) $response->getBody(),
        );
        if ($raw->status < 200 || $raw->status >= 300) {
            throw $this->errorFor($raw, $template);
        }

        return $raw;
    }

    /**
     * @param array<string, string> $pathParams
     */
    private function resolvePath(string $path, array $pathParams, string $template): string
    {
        // Values go in unencoded: the API never decodes path segments, and
        // PathValidator limits them to characters a path carries literally.
        foreach ($pathParams as $key => $value) {
            // Try exact match first (fast path)
            $placeholder = '{' . $key . '}';
            if (str_contains($path, $placeholder)) {
                PathValidator::validate($template, $key, $value, $this->service);
                $path = str_replace($placeholder, $value, $path);
            } else {
                // Fallback: normalise both sides to handle camelCase vs kebab/snake
                // e.g. pathParams key "salesRepId" matching placeholder "{salesrep-id}"
                $normKey = strtolower(str_replace(['-', '_'], '', $key));
                $service = $this->service;
                $path = (string) preg_replace_callback(
                    '/\{([^}]+)\}/',
                    static function (array $m) use ($normKey, $template, $value, $service): string {
                        $normPlaceholder = strtolower(str_replace(['-', '_'], '', $m[1]));
                        if ($normPlaceholder === $normKey) {
                            PathValidator::validate($template, $m[1], $value, $service);
                            return $value;
                        }
                        return $m[0];
                    },
                    $path,
                );
            }
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
     * Drop nulls; send a list comma-joined ([704, 705] → "704,705"), as the API expects.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    private function filterParams(array $params): array
    {
        $kept = array_filter($params, static fn ($v) => $v !== null);
        return array_map(
            static fn ($v) => is_array($v) && array_is_list($v) ? implode(',', $v) : $v,
            $kept,
        );
    }

    /**
     * Replace edgeCache with Cloudflare's cacheSiteId{suffix} = siteId.
     * An unsupported value just drops edgeCache.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    private function applyEdgeCache(array $params): array
    {
        $value = $params['edgeCache'] ?? null;
        if ($value === null) {
            return $params;
        }

        unset($params['edgeCache']);
        $suffix = self::edgeCacheSuffix($value);
        if ($suffix !== null) {
            $params['cacheSiteId' . $suffix] = $this->config->siteId;
        }

        return $params;
    }

    /**
     * '30s' | '1m' | '5m' as-is, else the leading integer (parseInt semantics)
     * when it is 1-5 or 8; null for anything else.
     */
    private static function edgeCacheSuffix(mixed $value): ?string
    {
        if (!is_string($value) && !is_int($value) && !is_float($value)) {
            return null;
        }
        $text = (string) $value;
        if (in_array($text, self::EDGE_CACHE_SUB_HOUR, true)) {
            return $text;
        }
        if (preg_match('/^\s*([+-]?\d+)/', $text, $m) !== 1) {
            return null;
        }
        $hours = (int) $m[1];

        return in_array($hours, self::EDGE_CACHE_HOURS, true) ? (string) $hours : null;
    }

    private function executeWithRetry(RequestInterface $request, string $template): RawResponse
    {
        $attempt = 0;
        $lastException = null;

        while ($attempt <= $this->config->retries) {
            try {
                return $this->dispatch($request, $template);
            } catch (AugurApiException $e) {
                $lastException = $e;

                if (!$this->isRetryableError($e)) {
                    throw $e;
                }

                $attempt++;
                if ($attempt <= $this->config->retries) {
                    $delay = $this->calculateDelay($attempt);
                    usleep($delay * 1000);
                }
            }
        }

        throw $lastException ?? new AugurApiException(
            'Request failed after retries',
            0,
            null,
            $this->service,
            $template,
        );
    }

    private function calculateDelay(int $attempt): int
    {
        $baseDelay = $this->config->retryDelay;
        $delay = $baseDelay * (int) pow(2, $attempt - 1);
        $jitter = random_int(0, (int) ($delay * 0.1));
        return min($delay + $jitter, 30000);
    }

    /**
     * The one status switch shared by typed methods and call().
     */
    private function errorFor(RawResponse $response, string $template): AugurApiException
    {
        $status = $response->status;
        $message = static fn (string $default): string => self::messageOf($response, $default);

        return match ($status) {
            400 => new ValidationException(
                $message('Validation failed'),
                $status,
                self::errorsOf($response),
                $this->service,
                $template,
            ),
            401 => new AuthenticationException($message('Authentication failed'), $status, $this->service, $template),
            404 => new NotFoundException($message('Resource not found'), $status, $this->service, $template),
            429 => new RateLimitException($message('Rate limit exceeded'), $status, $this->service, $template),
            default => new AugurApiException(
                $message("Request failed with status {$status}"),
                $status,
                null,
                $this->service,
                $template,
            ),
        };
    }

    /**
     * The body's `message` when it is a non-empty string; else the fixed $default.
     *
     * A non-JSON body (an HTML error page, say) never reaches the message: it can
     * carry stack traces or server paths, and augur sends its reason as `message`.
     */
    private static function messageOf(RawResponse $response, string $default): string
    {
        $json = $response->json;
        $message = is_array($json) ? ($json['message'] ?? null) : null;

        return is_string($message) && $message !== '' ? $message : $default;
    }

    /**
     * @return array<array-key, mixed>
     */
    private static function errorsOf(RawResponse $response): array
    {
        $errors = is_array($response->json) ? ($response->json['errors'] ?? null) : null;

        return is_array($errors) ? $errors : [];
    }

    private function isRetryableError(AugurApiException $e): bool
    {
        return $e instanceof RateLimitException || $e->getCode() >= 500;
    }
}
