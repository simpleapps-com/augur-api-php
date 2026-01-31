<?php

declare(strict_types=1);

namespace AugurApi\Tests\Core;

use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Core\Exceptions\AugurApiException;
use AugurApi\Core\Exceptions\AuthenticationException;
use AugurApi\Core\Exceptions\RateLimitException;
use AugurApi\Core\Exceptions\ValidationException;
use Http\Mock\Client as MockClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    private MockClient $mockClient;
    private Psr17Factory $factory;
    private Config $config;
    private Client $client;

    protected function setUp(): void
    {
        $this->mockClient = new MockClient();
        $this->factory = new Psr17Factory();
        $this->config = new Config(
            siteId: 'TEST123',
            bearerToken: 'test-token',
            retries: 2,
            retryDelay: 10,
        );
        $this->client = new Client(
            $this->config,
            $this->mockClient,
            $this->factory,
            $this->factory,
        );
    }

    /**
     * @param array<string, mixed> $body
     */
    private function addResponse(array $body, int $status = 200): void
    {
        $this->mockClient->addResponse(
            new Response($status, ['Content-Type' => 'application/json'], (string) json_encode($body)),
        );
    }

    public function testGetMethod(): void
    {
        $this->addResponse(['data' => 'test']);

        $result = $this->client->get('https://api.example.com', '/test');

        $this->assertEquals(['data' => 'test'], $result);

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('https://api.example.com/test', (string) $request->getUri());
    }

    public function testPostMethod(): void
    {
        $this->addResponse(['id' => 1, 'status' => 201]);

        $result = $this->client->post('https://api.example.com', '/items', ['name' => 'Test']);

        $this->assertEquals(['id' => 1, 'status' => 201], $result);

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('application/json', $request->getHeaderLine('Content-Type'));
        $this->assertEquals('{"name":"Test"}', (string) $request->getBody());
    }

    public function testPutMethod(): void
    {
        $this->addResponse(['success' => true]);

        $result = $this->client->put('https://api.example.com', '/items/1', ['name' => 'Updated']);

        $this->assertEquals(['success' => true], $result);

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals('{"name":"Updated"}', (string) $request->getBody());
    }

    public function testDeleteMethod(): void
    {
        $this->addResponse(['success' => true]);

        $result = $this->client->delete('https://api.example.com', '/items/1');

        $this->assertEquals(['success' => true], $result);

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('DELETE', $request->getMethod());
    }

    public function testPathParameterSubstitution(): void
    {
        $this->addResponse(['data' => 'test']);

        $this->client->get(
            'https://api.example.com',
            '/items/{itemId}/variants/{variantId}',
            [],
            ['itemId' => 'ABC', 'variantId' => '123'],
        );

        $request = $this->mockClient->getLastRequest();
        $this->assertStringContainsString('/items/ABC/variants/123', $request->getUri()->getPath());
    }

    public function testPathParameterUrlEncoding(): void
    {
        $this->addResponse(['data' => 'test']);

        $this->client->get(
            'https://api.example.com',
            '/items/{itemId}',
            [],
            ['itemId' => 'item/with/slashes'],
        );

        $request = $this->mockClient->getLastRequest();
        $this->assertStringContainsString('/items/item%2Fwith%2Fslashes', (string) $request->getUri());
    }

    public function testQueryParameterFiltering(): void
    {
        $this->addResponse(['data' => []]);

        $this->client->get(
            'https://api.example.com',
            '/items',
            ['q' => 'test', 'limit' => 10, 'offset' => null, 'filter' => null],
        );

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('q=test&limit=10', $request->getUri()->getQuery());
    }

    public function testEmptyQueryParametersNotIncluded(): void
    {
        $this->addResponse(['data' => []]);

        $this->client->get('https://api.example.com', '/items', ['filter' => null]);

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('', $request->getUri()->getQuery());
    }

    public function testPublicEndpointHealthCheckNoAuthHeader(): void
    {
        $this->addResponse(['data' => ['siteHash' => 'abc']]);

        $this->client->get('https://api.example.com', '/health-check');

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('TEST123', $request->getHeaderLine('x-site-id'));
        $this->assertEquals('', $request->getHeaderLine('Authorization'));
    }

    public function testPublicEndpointPingNoAuthHeader(): void
    {
        $this->addResponse(['data' => 'pong']);

        $this->client->get('https://api.example.com', '/ping');

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('TEST123', $request->getHeaderLine('x-site-id'));
        $this->assertEquals('', $request->getHeaderLine('Authorization'));
    }

    public function testPublicEndpointWhoamiNoAuthHeader(): void
    {
        $this->addResponse(['data' => ['siteId' => 'TEST123']]);

        $this->client->get('https://api.example.com', '/whoami');

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('TEST123', $request->getHeaderLine('x-site-id'));
        $this->assertEquals('', $request->getHeaderLine('Authorization'));
    }

    public function testProtectedEndpointIncludesAuthHeader(): void
    {
        $this->addResponse(['data' => []]);

        $this->client->get('https://api.example.com', '/items');

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('TEST123', $request->getHeaderLine('x-site-id'));
        $this->assertEquals('Bearer test-token', $request->getHeaderLine('Authorization'));
    }

    public function testSiteIdHeaderAlwaysIncluded(): void
    {
        $this->addResponse(['data' => 'test']);

        $this->client->get('https://api.example.com', '/test');

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('TEST123', $request->getHeaderLine('x-site-id'));
    }

    public function testAcceptHeaderAlwaysIncluded(): void
    {
        $this->addResponse(['data' => 'test']);

        $this->client->get('https://api.example.com', '/test');

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('application/json', $request->getHeaderLine('Accept'));
    }

    public function testError401ThrowsAuthenticationException(): void
    {
        $this->addResponse(['message' => 'Invalid token'], 401);

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Invalid token');
        $this->expectExceptionCode(401);

        $this->client->get('https://api.example.com', '/items');
    }

    public function testError403ThrowsAuthenticationException(): void
    {
        $this->addResponse(['message' => 'Access denied'], 403);

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Access denied');
        $this->expectExceptionCode(403);

        $this->client->get('https://api.example.com', '/items');
    }

    public function testError429ThrowsRateLimitException(): void
    {
        // Add enough responses for all retries
        for ($i = 0; $i <= $this->config->retries; $i++) {
            $this->addResponse(['message' => 'Too many requests'], 429);
        }

        $this->expectException(RateLimitException::class);
        $this->expectExceptionMessage('Too many requests');
        $this->expectExceptionCode(429);

        $this->client->get('https://api.example.com', '/items');
    }

    public function testError400ThrowsValidationException(): void
    {
        $this->addResponse([
            'message' => 'Invalid input',
            'errors' => ['field' => 'required'],
        ], 400);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid input');
        $this->expectExceptionCode(400);

        $this->client->get('https://api.example.com', '/items');
    }

    public function testValidationExceptionContainsErrors(): void
    {
        $this->addResponse([
            'message' => 'Validation failed',
            'errors' => ['name' => 'required', 'email' => 'invalid format'],
        ], 400);

        try {
            $this->client->post('https://api.example.com', '/items', []);
            $this->fail('Expected ValidationException');
        } catch (ValidationException $e) {
            $this->assertEquals(['name' => 'required', 'email' => 'invalid format'], $e->errors);
        }
    }

    public function testError500ThrowsAugurApiException(): void
    {
        // Add enough responses for all retries
        for ($i = 0; $i <= $this->config->retries; $i++) {
            $this->addResponse(['message' => 'Internal server error'], 500);
        }

        $this->expectException(AugurApiException::class);
        $this->expectExceptionMessage('Internal server error');
        $this->expectExceptionCode(500);

        $this->client->get('https://api.example.com', '/items');
    }

    public function testGenericErrorThrowsAugurApiException(): void
    {
        // 503 is >= 500 so it will retry; add enough responses for all retries
        for ($i = 0; $i <= $this->config->retries; $i++) {
            $this->addResponse(['message' => 'Service unavailable'], 503);
        }

        $this->expectException(AugurApiException::class);
        $this->expectExceptionCode(503);

        $this->client->get('https://api.example.com', '/items');
    }

    public function testRetryOn500Error(): void
    {
        // First call fails with 500
        $this->addResponse(['message' => 'Server error'], 500);
        // Retry succeeds
        $this->addResponse(['data' => 'success']);

        $result = $this->client->get('https://api.example.com', '/items');

        $this->assertEquals(['data' => 'success'], $result);
    }

    public function testRetryOnRateLimit(): void
    {
        // First call hits rate limit
        $this->addResponse(['message' => 'Rate limited'], 429);
        // Retry succeeds
        $this->addResponse(['data' => 'success']);

        $result = $this->client->get('https://api.example.com', '/items');

        $this->assertEquals(['data' => 'success'], $result);
    }

    public function testNoRetryOnAuthenticationError(): void
    {
        // Only add one response - no retries should happen
        $this->addResponse(['message' => 'Unauthorized'], 401);

        $this->expectException(AuthenticationException::class);

        $this->client->get('https://api.example.com', '/items');
    }

    public function testMaxRetriesExhausted(): void
    {
        // Add responses for initial + all retries (config has 2 retries)
        for ($i = 0; $i <= $this->config->retries; $i++) {
            $this->addResponse(['message' => 'Server error'], 500);
        }

        $this->expectException(AugurApiException::class);

        $this->client->get('https://api.example.com', '/items');
    }

    public function testDefaultErrorMessage(): void
    {
        $this->addResponse([], 500);

        $this->expectException(AugurApiException::class);
        $this->expectExceptionMessage('API request failed');

        // Exhaust retries
        for ($i = 0; $i < $this->config->retries; $i++) {
            $this->addResponse([], 500);
        }

        $this->client->get('https://api.example.com', '/items');
    }

    public function testDefaultAuthErrorMessage(): void
    {
        $this->addResponse([], 401);

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Authentication failed');

        $this->client->get('https://api.example.com', '/items');
    }

    public function testDefaultRateLimitMessage(): void
    {
        for ($i = 0; $i <= $this->config->retries; $i++) {
            $this->addResponse([], 429);
        }

        $this->expectException(RateLimitException::class);
        $this->expectExceptionMessage('Rate limit exceeded');

        $this->client->get('https://api.example.com', '/items');
    }

    public function testDefaultValidationMessage(): void
    {
        $this->addResponse([], 400);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Validation failed');

        $this->client->get('https://api.example.com', '/items');
    }

    public function testEmptyResponseBody(): void
    {
        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], ''),
        );

        $result = $this->client->get('https://api.example.com', '/items');

        $this->assertEquals([], $result);
    }

    public function testPostWithEmptyData(): void
    {
        $this->addResponse(['id' => 1]);

        $result = $this->client->post('https://api.example.com', '/items', []);

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('[]', (string) $request->getBody());
    }

    public function testDeleteWithPathParams(): void
    {
        $this->addResponse(['success' => true]);

        $this->client->delete(
            'https://api.example.com',
            '/items/{id}',
            ['id' => '123'],
        );

        $request = $this->mockClient->getLastRequest();
        $this->assertStringContainsString('/items/123', (string) $request->getUri());
    }

    public function testPublicEndpointWithBasePath(): void
    {
        $this->addResponse(['data' => 'pong']);

        $this->client->get('https://api.example.com', '/api/v1/health-check');

        $request = $this->mockClient->getLastRequest();
        $this->assertEquals('', $request->getHeaderLine('Authorization'));
    }
}
