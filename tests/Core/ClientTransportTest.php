<?php

declare(strict_types=1);

namespace AugurApi\Tests\Core;

use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Core\Exceptions\AugurApiException;
use AugurApi\Core\Exceptions\AuthenticationException;
use AugurApi\Core\Exceptions\InvalidArgumentException;
use AugurApi\Core\Exceptions\NotFoundException;
use AugurApi\Core\Exceptions\RateLimitException;
use AugurApi\Core\Exceptions\ValidationException;
use Http\Client\Exception\NetworkException;
use Http\Mock\Client as MockClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Raw transport, the shared status switch, error context and edgeCache.
 */
final class ClientTransportTest extends TestCase
{
    private MockClient $mockClient;
    private Client $client;

    protected function setUp(): void
    {
        $this->mockClient = new MockClient();
        $this->client = $this->makeClient(0);
    }

    private function makeClient(int $retries): Client
    {
        $factory = new Psr17Factory();
        $config = new Config(
            siteId: 'TEST123',
            bearerToken: 'test-token',
            retries: $retries,
            retryDelay: 1,
            baseUrls: ['items' => 'https://items.test'],
        );

        return (new Client($config, $this->mockClient, $factory, $factory))->forService('items');
    }

    private function addRaw(int $status, string $body, string $type = 'application/json'): void
    {
        $this->mockClient->addResponse(new Response($status, ['Content-Type' => $type], $body));
    }

    private function failure(callable $send): AugurApiException
    {
        try {
            $send();
        } catch (AugurApiException $e) {
            return $e;
        }
        $this->fail('Expected AugurApiException');
    }

    public function testSendReturnsRawResponse(): void
    {
        $this->addRaw(201, 'plain text', 'text/plain');

        $response = $this->client->send('POST', 'https://items.test', '/inv-mast', [], null);

        $this->assertSame(201, $response->status);
        $this->assertSame('text/plain', $response->contentType);
        $this->assertSame('plain text', $response->text);
        $this->assertFalse($response->isJson);
        $this->assertNull($response->json);
        $this->assertFalse($this->mockClient->getLastRequest()->hasHeader('Content-Type'));
    }

    /**
     * @return array<int, array{int, class-string<AugurApiException>, string}>
     */
    public static function statusProvider(): array
    {
        return [
            '400' => [400, ValidationException::class, 'Validation failed'],
            '401' => [401, AuthenticationException::class, 'Authentication failed'],
            '403' => [403, AugurApiException::class, 'Request failed with status 403'],
            '404' => [404, NotFoundException::class, 'Resource not found'],
            '409' => [409, AugurApiException::class, 'Request failed with status 409'],
            '429' => [429, RateLimitException::class, 'Rate limit exceeded'],
            '500' => [500, AugurApiException::class, 'Request failed with status 500'],
            '302' => [302, AugurApiException::class, 'Request failed with status 302'],
        ];
    }

    /**
     * @param class-string<AugurApiException> $class
     */
    #[DataProvider('statusProvider')]
    public function testStatusSwitchCarriesServiceAndTemplate(int $status, string $class, string $default): void
    {
        $this->addRaw($status, '{}');

        $e = $this->failure(fn () => $this->client->get(
            'https://items.test/inv-mast',
            '/{invMastUid}',
            ['q' => 'secret-query'],
            ['invMastUid' => '987654'],
        ));

        $this->assertSame($class, $e::class);
        $this->assertSame($status, $e->getCode());
        $this->assertSame($default, $e->getMessage());
        $this->assertSame('items', $e->service);
        $this->assertSame('/inv-mast/{invMastUid}', $e->endpoint);
    }

    public function testNonJsonBodyNeverReachesTheMessage(): void
    {
        $html = '<html><title>RuntimeException: stat failed for /augur/apps/x</title></html>';
        $this->addRaw(502, $html, 'text/html');

        $e = $this->failure(fn () => $this->client->post('https://items.test', '/inv-mast', []));

        $this->assertSame('Request failed with status 502', $e->getMessage());
    }

    public function testNonJsonBodyOnA404UsesTheFixedDefault(): void
    {
        $this->addRaw(404, 'Not Found', 'text/plain');

        $e = $this->failure(fn () => $this->client->post('https://items.test', '/nope', []));

        $this->assertInstanceOf(NotFoundException::class, $e);
        $this->assertSame('Resource not found', $e->getMessage());
    }

    public function testEmptyStringMessageFallsBackToDefault(): void
    {
        $this->addRaw(401, '{"message":""}');

        $e = $this->failure(fn () => $this->client->post('https://items.test', '/inv-mast', []));

        $this->assertSame('Authentication failed', $e->getMessage());
    }

    public function testJsonScalarBodyUsesDefaultMessage(): void
    {
        $this->addRaw(429, '"slow down"');

        $e = $this->failure(fn () => $this->client->post('https://items.test', '/inv-mast', []));

        $this->assertSame('Rate limit exceeded', $e->getMessage());
    }

    public function testWhitespaceBodyUsesDefaultMessage(): void
    {
        $this->addRaw(400, "   \n");

        $e = $this->failure(fn () => $this->client->post('https://items.test', '/inv-mast', []));

        $this->assertInstanceOf(ValidationException::class, $e);
        $this->assertSame('Validation failed', $e->getMessage());
        $this->assertSame([], $e->errors);
    }

    public function testNetworkErrorIsWrappedWithoutUrl(): void
    {
        $request = new Request('GET', 'https://items.test/inv-mast/987654');
        $this->mockClient->addException(new NetworkException('Could not reach https://items.test/inv-mast/987654', $request));

        $e = $this->failure(fn () => $this->client->get(
            'https://items.test/inv-mast',
            '/{invMastUid}',
            [],
            ['invMastUid' => '987654'],
        ));

        $this->assertSame(AugurApiException::class, $e::class);
        $this->assertSame('Network request failed', $e->getMessage());
        $this->assertSame(0, $e->getCode());
        $this->assertSame('items', $e->service);
        $this->assertSame('/inv-mast/{invMastUid}', $e->endpoint);
        $this->assertInstanceOf(NetworkException::class, $e->getPrevious());
    }

    public function testNegativeRetriesThrowWithoutSending(): void
    {
        $client = $this->makeClient(-1);

        $e = $this->failure(fn () => $client->get('https://items.test/inv-mast', ''));

        $this->assertSame('Request failed after retries', $e->getMessage());
        $this->assertSame('/inv-mast', $e->endpoint);
        $this->assertSame([], $this->mockClient->getRequests());
    }

    public function testRetriedGetKeepsContextOnFinalFailure(): void
    {
        $client = $this->makeClient(1);
        $this->addRaw(503, '{"message":"down"}');
        $this->addRaw(503, '{"message":"down"}');

        $e = $this->failure(fn () => $client->get('https://items.test', '/ping'));

        $this->assertSame('down', $e->getMessage());
        $this->assertSame('/ping', $e->endpoint);
        $this->assertCount(2, $this->mockClient->getRequests());
    }

    public function testUnscopedClientUsesPathAsTemplate(): void
    {
        $factory = new Psr17Factory();
        $client = new Client(new Config('TEST123', 'test-token'), $this->mockClient, $factory, $factory);
        $this->addRaw(404, '{}');

        $e = $this->failure(fn () => $client->post('https://items.test/inv-mast', '/{id}', [], ['id' => '5']));

        $this->assertSame('', $e->service);
        $this->assertSame('/{id}', $e->endpoint);
    }

    public function testBaseUrlOutsideServiceUsesPathAsTemplate(): void
    {
        $this->addRaw(404, '{}');

        $e = $this->failure(fn () => $this->client->post('https://elsewhere.test/x', '/y', []));

        $this->assertSame('items', $e->service);
        $this->assertSame('/y', $e->endpoint);
    }

    public function testForServiceKebabsDigitsAndCapitals(): void
    {
        $factory = new Psr17Factory();
        $client = (new Client(new Config('TEST123', 'test-token'), $this->mockClient, $factory, $factory))
            ->forService('p21Apis');
        $this->addRaw(404, '{}');

        $e = $this->failure(fn () => $client->post('https://p21-apis.augur-api.com/trans-user', '', []));

        $this->assertSame('p21-apis', $e->service);
        $this->assertSame('/trans-user', $e->endpoint);
    }

    public function testPathValidationCarriesServiceAndFullTemplateWithoutValue(): void
    {
        foreach (['exact' => 'invMastUid', 'fallback' => 'inv_mast_uid'] as $label => $key) {
            try {
                $this->client->get('https://items.test/inv-mast', '/{invMastUid}', [], [$key => 'secret-value']);
                $this->fail("Expected InvalidArgumentException ({$label})");
            } catch (InvalidArgumentException $e) {
                $this->assertSame('items', $e->service, $label);
                $this->assertSame('/inv-mast/{invMastUid}', $e->endpoint, $label);
                $this->assertStringNotContainsString('secret-value', $e->getMessage(), $label);
            }
        }
        $this->assertSame([], $this->mockClient->getRequests());
    }

    public function testNonArrayJsonBodyDecodesToEmptyArrayForTypedMethods(): void
    {
        $this->addRaw(200, '"pong"');

        $this->assertSame([], $this->client->get('https://items.test', '/ping'));
    }

    /**
     * @return array<string, array{mixed, array<string, string>}>
     */
    public static function edgeCacheProvider(): array
    {
        return [
            '30s' => ['30s', ['cacheSiteId30s' => 'TEST123']],
            '1m' => ['1m', ['cacheSiteId1m' => 'TEST123']],
            '5m' => ['5m', ['cacheSiteId5m' => 'TEST123']],
            'int 1' => [1, ['cacheSiteId1' => 'TEST123']],
            'int 8' => [8, ['cacheSiteId8' => 'TEST123']],
            'string 3' => ['3', ['cacheSiteId3' => 'TEST123']],
            'leading int' => ['4h', ['cacheSiteId4' => 'TEST123']],
            'float' => [2.5, ['cacheSiteId2' => 'TEST123']],
            'exponent parses like parseInt' => ['1e3', ['cacheSiteId1' => 'TEST123']],
            'unsupported hour' => [6, []],
            'not numeric' => ['soon', []],
            'bool' => [true, []],
            'array' => [[1], []],
        ];
    }

    /**
     * @param array<string, string> $expected
     */
    #[DataProvider('edgeCacheProvider')]
    public function testEdgeCacheTransform(mixed $value, array $expected): void
    {
        $this->addRaw(200, '{}');

        $this->client->get('https://items.test', '/inv-mast', ['edgeCache' => $value, 'q' => 'a']);

        parse_str($this->mockClient->getLastRequest()->getUri()->getQuery(), $query);
        $this->assertSame(['q' => 'a', ...$expected], $query);
    }

    public function testEdgeCacheTransformAppliesToEveryMethod(): void
    {
        foreach (['post', 'put'] as $method) {
            $this->addRaw(200, '{}');
            $this->client->{$method}('https://items.test', '/inv-mast', [], [], ['edgeCache' => '1m']);
            $this->assertSame('cacheSiteId1m=TEST123', $this->mockClient->getLastRequest()->getUri()->getQuery());
        }
        $this->addRaw(200, '{}');
        $this->client->delete('https://items.test', '/inv-mast', [], ['edgeCache' => 2]);
        $this->assertSame('cacheSiteId2=TEST123', $this->mockClient->getLastRequest()->getUri()->getQuery());
    }

    public function testNullEdgeCacheIsDropped(): void
    {
        $this->addRaw(200, '{}');

        $this->client->get('https://items.test', '/inv-mast', ['edgeCache' => null]);

        $this->assertSame('', $this->mockClient->getLastRequest()->getUri()->getQuery());
    }
}
