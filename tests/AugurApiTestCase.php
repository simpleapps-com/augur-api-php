<?php

declare(strict_types=1);

namespace AugurApi\Tests;

use AugurApi\AugurApiClient;
use Http\Mock\Client as MockClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Base test case for all Augur API tests.
 *
 * Provides mock HTTP client setup and common test utilities.
 */
abstract class AugurApiTestCase extends TestCase
{
    protected MockClient $mockClient;
    protected AugurApiClient $api;
    protected Psr17Factory $factory;

    protected function setUp(): void
    {
        $this->mockClient = new MockClient();
        $this->factory = new Psr17Factory();

        $this->api = new AugurApiClient(
            siteId: 'TEST123',
            bearerToken: 'test-token',
            httpClient: $this->mockClient,
            requestFactory: $this->factory,
            streamFactory: $this->factory,
        );
    }

    /**
     * Add a successful JSON response to the mock client.
     *
     * @param array<string, mixed> $data Response data
     * @param int $status HTTP status code
     * @param int|null $total Total count for paginated responses
     */
    protected function mockResponse(array $data, int $status = 200, ?int $total = null): void
    {
        $body = [
            'data' => $data,
            'status' => $status,
        ];

        if ($total !== null) {
            $body['total'] = $total;
        }

        $this->mockClient->addResponse(
            new Response($status, ['Content-Type' => 'application/json'], (string) json_encode($body)),
        );
    }

    /**
     * Add a list response to the mock client.
     *
     * @param array<array<string, mixed>> $items List of items
     * @param int $total Total count
     */
    protected function mockListResponse(array $items, int $total = 0): void
    {
        $this->mockResponse($items, 200, $total ?: count($items));
    }

    /**
     * Add an error response to the mock client.
     *
     * @param string $message Error message
     * @param int $status HTTP status code
     * @param array<string, mixed> $errors Validation errors
     */
    protected function mockErrorResponse(string $message, int $status = 400, array $errors = []): void
    {
        $body = [
            'message' => $message,
            'status' => $status,
        ];

        if (!empty($errors)) {
            $body['errors'] = $errors;
        }

        $this->mockClient->addResponse(
            new Response($status, ['Content-Type' => 'application/json'], (string) json_encode($body)),
        );
    }

    /**
     * Add a simple success response (for delete, enable, etc.).
     */
    protected function mockSuccessResponse(): void
    {
        $this->mockResponse(['success' => true]);
    }

    /**
     * Add a health check response.
     */
    protected function mockHealthCheckResponse(): void
    {
        $this->mockResponse([
            'siteHash' => 'abc123',
            'siteId' => 'TEST123',
        ]);
    }

    /**
     * Add a ping response.
     */
    protected function mockPingResponse(): void
    {
        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => 'pong',
                'status' => 200,
            ])),
        );
    }

    /**
     * Add a whoami response.
     */
    protected function mockWhoamiResponse(): void
    {
        $this->mockResponse([
            'siteId' => 'TEST123',
            'siteName' => 'Test Site',
        ]);
    }

    /**
     * Get the last request sent by the mock client.
     */
    protected function getLastRequest(): \Psr\Http\Message\RequestInterface
    {
        return $this->mockClient->getLastRequest();
    }

    /**
     * Assert that the last request was to a specific path.
     */
    protected function assertRequestPath(string $expectedPath): void
    {
        $request = $this->getLastRequest();
        $this->assertStringContainsString($expectedPath, $request->getUri()->getPath());
    }

    /**
     * Assert that the last request used a specific HTTP method.
     */
    protected function assertRequestMethod(string $expectedMethod): void
    {
        $request = $this->getLastRequest();
        $this->assertEquals($expectedMethod, $request->getMethod());
    }

    /**
     * Assert that the last request included the x-site-id header.
     */
    protected function assertHasSiteIdHeader(): void
    {
        $request = $this->getLastRequest();
        $this->assertEquals('TEST123', $request->getHeaderLine('x-site-id'));
    }

    /**
     * Assert that the last request included the Authorization header.
     */
    protected function assertHasAuthHeader(): void
    {
        $request = $this->getLastRequest();
        $this->assertEquals('Bearer test-token', $request->getHeaderLine('Authorization'));
    }
}
