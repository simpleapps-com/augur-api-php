<?php

declare(strict_types=1);

namespace AugurApi\Tests;

use AugurApi\AugurApiClient;
use AugurApi\Core\EndpointEntry;
use AugurApi\Core\Envelope;
use AugurApi\Core\Exceptions\AugurApiException;
use AugurApi\Core\Exceptions\AuthenticationException;
use AugurApi\Core\Exceptions\InvalidArgumentException;
use AugurApi\Core\Exceptions\NotFoundException;
use AugurApi\Core\Exceptions\RateLimitException;
use AugurApi\Core\Exceptions\ValidationException;
use AugurApi\Core\PathValidator;
use AugurApi\Core\Registry;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\DataProvider;

final class CallTest extends AugurApiTestCase
{
    private const array ENVELOPE = [
        'count' => 1,
        'data' => [['id' => 1]],
        'message' => 'ok',
        'options' => [],
        'params' => [],
        'status' => 200,
        'total' => 1,
        'totalResults' => 1,
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->api = new AugurApiClient(
            siteId: 'TEST123',
            bearerToken: 'test-token',
            retries: 0,
            httpClient: $this->mockClient,
            requestFactory: $this->factory,
            streamFactory: $this->factory,
        );
    }

    private function addRaw(int $status, string $body, string $type = 'application/json'): void
    {
        $this->mockClient->addResponse(new Response($status, ['Content-Type' => $type], $body));
    }

    /**
     * Path values: 1 for numeric-named placeholders, 'x' otherwise.
     *
     * @return array<string, int|string>
     */
    private static function pathValues(EndpointEntry $entry): array
    {
        $values = [];
        foreach ($entry->pathParams as $name) {
            $values[$name] = PathValidator::isNumericPlaceholder($name) ? 1 : 'x';
        }

        return $values;
    }

    /**
     * @param array<array-key, mixed> $pathParams
     * @param array<array-key, mixed> $query
     * @param array<array-key, mixed>|null $body
     */
    private function invalid(string $id, array $pathParams = [], array $query = [], ?array $body = null): InvalidArgumentException
    {
        try {
            $this->api->call($id, $pathParams, $query, $body);
        } catch (InvalidArgumentException $e) {
            $this->assertSame([], $this->mockClient->getRequests(), 'no I/O before argument checks');
            $this->assertSame(400, $e->getCode());
            return $e;
        }
        $this->fail('Expected InvalidArgumentException');
    }

    public function testCallsEveryRegistryEntry(): void
    {
        foreach (AugurApiClient::endpoints() as $entry) {
            $this->addRaw(200, (string) json_encode(self::ENVELOPE));
            $body = $entry->hasBody ? ['a' => 1] : null;

            $result = $this->api->call($entry->id, self::pathValues($entry), [], $body);

            $request = $this->mockClient->getLastRequest();
            $expectedPath = (string) preg_replace_callback(
                '/\{([^}]+)\}/',
                static fn (array $m): string => PathValidator::isNumericPlaceholder($m[1]) ? '1' : 'x',
                $entry->path,
            );
            $service = explode('.', $entry->id)[0];
            $this->assertSame($entry->method, $request->getMethod(), $entry->id);
            $this->assertSame(
                $this->api->getConfig()->getBaseUrl($service) . $expectedPath,
                (string) $request->getUri(),
                $entry->id,
            );
            $this->assertSame("https://{$entry->service}.augur-api.com", $this->api->getConfig()->getBaseUrl($service));
            $this->assertSame($entry->hasBody ? '{"a":1}' : '', (string) $request->getBody(), $entry->id);
            $this->assertSame($entry->auth !== 'bearer' ? '' : 'Bearer test-token', $request->getHeaderLine('Authorization'), $entry->id);
            $this->assertSame('TEST123', $request->getHeaderLine('x-site-id'), $entry->id);
            $this->assertSame(200, $result->httpStatus);
            $this->assertInstanceOf(Envelope::class, $result->envelope);
        }
    }

    public function testEveryEntryThrowsWithServiceAndTemplate(): void
    {
        foreach (AugurApiClient::endpoints() as $entry) {
            $this->addRaw(404, '{"message":"missing"}');
            try {
                $this->api->call($entry->id, self::pathValues($entry));
                $this->fail("Expected NotFoundException for {$entry->id}");
            } catch (NotFoundException $e) {
                $this->assertSame($entry->service, $e->service, $entry->id);
                $this->assertSame($entry->path, $e->endpoint, $entry->id);
            }
        }
    }

    public function testAliasIdsResolveToCanonicalEntry(): void
    {
        $count = 0;
        foreach (AugurApiClient::endpoints() as $entry) {
            $chain = substr($entry->id, 0, (int) strrpos($entry->id, '.'));
            foreach ($entry->aliases as $alias) {
                $this->assertSame($entry, Registry::find("{$chain}.{$alias}"));
                $count++;
            }
        }
        $this->assertGreaterThan(0, $count);

        $this->addRaw(200, '[]');
        $result = $this->api->call('commerce.checkout.doc.get', ['checkoutUid' => 5]);
        $this->assertSame([], $result->body);
        $this->assertSame('/checkout/5/doc', $this->getLastRequest()->getUri()->getPath());
    }

    public function testBaseUrlOverrideIsHonoured(): void
    {
        $api = new AugurApiClient(
            siteId: 'TEST123',
            bearerToken: 'test-token',
            baseUrls: ['openSearch' => 'http://localhost:9000'],
            httpClient: $this->mockClient,
            requestFactory: $this->factory,
            streamFactory: $this->factory,
        );
        $this->addRaw(200, '{}');

        $api->call('openSearch.ping.get');

        $this->assertSame('http://localhost:9000/ping', (string) $this->getLastRequest()->getUri());
    }

    public function testQueryIsSentWithNullsSkippedAndEdgeCacheTransformed(): void
    {
        $this->addRaw(200, '{}');

        $this->api->call(
            'commerce.cartHdr.alsoBought.list',
            ['cartHdrUid' => '7'],
            ['limit' => 3, 'edgeCache' => '5m'],
        );
        $this->addRaw(200, '{}');
        $this->api->call('commerce.cartHdr.alsoBought.list', ['cartHdrUid' => 7], ['limit' => null]);

        $requests = $this->mockClient->getRequests();
        $this->assertSame('limit=3&cacheSiteId5m=TEST123', $requests[0]->getUri()->getQuery());
        $this->assertSame('', $requests[1]->getUri()->getQuery());
    }

    public function testHasBodyEntryWithoutBodySendsNone(): void
    {
        $entry = self::firstEntry(static fn (EndpointEntry $e): bool => $e->hasBody);
        $this->addRaw(201, '{"ok":true}');

        $result = $this->api->call($entry->id, self::pathValues($entry));

        $this->assertSame('', (string) $this->getLastRequest()->getBody());
        $this->assertFalse($this->getLastRequest()->hasHeader('Content-Type'));
        $this->assertSame(201, $result->httpStatus);
        $this->assertSame(['ok' => true], $result->body);
    }

    private static function firstEntry(callable $match): EndpointEntry
    {
        foreach (AugurApiClient::endpoints() as $entry) {
            if ($match($entry)) {
                return $entry;
            }
        }
        self::fail('No matching entry');
    }

    // ----- result shape -----

    public function testEnvelopeValuesArePassedThrough(): void
    {
        $body = [...self::ENVELOPE, 'total' => '0', 'options' => ['a' => 1], 'extra' => true];
        $this->addRaw(200, (string) json_encode($body));

        $result = $this->api->call('items.ping.get');

        $this->assertSame($body, $result->body);
        $envelope = $result->envelope;
        $this->assertNotNull($envelope);
        $this->assertSame(1, $envelope->count);
        $this->assertSame([['id' => 1]], $envelope->data);
        $this->assertSame('ok', $envelope->message);
        $this->assertSame(['a' => 1], $envelope->options);
        $this->assertSame([], $envelope->params);
        $this->assertSame(200, $envelope->status);
        $this->assertSame('0', $envelope->total);
        $this->assertSame(1, $envelope->totalResults);
    }

    public function testEnvelopeWithNullValuesStillCounts(): void
    {
        $this->addRaw(200, (string) json_encode([...self::ENVELOPE, 'data' => null, 'message' => null]));

        $envelope = $this->api->call('items.ping.get')->envelope;

        $this->assertNotNull($envelope);
        $this->assertNull($envelope->data);
    }

    /**
     * @return array<string, array{string, mixed}>
     */
    public static function nonEnvelopeProvider(): array
    {
        $missing = self::ENVELOPE;
        unset($missing['totalResults']);

        return [
            'list' => [(string) json_encode([self::ENVELOPE]), [self::ENVELOPE]],
            'object missing a key' => [(string) json_encode($missing), $missing],
            'empty object' => ['{}', []],
            'scalar' => ['"pong"', 'pong'],
            'null' => ['null', null],
            'non-JSON' => ['<html>ok</html>', '<html>ok</html>'],
            'empty body' => ['', ''],
        ];
    }

    #[DataProvider('nonEnvelopeProvider')]
    public function testNonEnvelopeBodies(string $text, mixed $expected): void
    {
        $this->addRaw(200, $text, 'text/plain');

        $result = $this->api->call('items.ping.get');

        $this->assertNull($result->envelope);
        $this->assertSame($expected, $result->body);
    }

    // ----- errors -----

    /**
     * @return array<int, array{int, class-string<AugurApiException>}>
     */
    public static function statusProvider(): array
    {
        return [
            '400' => [400, ValidationException::class],
            '401' => [401, AuthenticationException::class],
            '403' => [403, AugurApiException::class],
            '404' => [404, NotFoundException::class],
            '429' => [429, RateLimitException::class],
            '500' => [500, AugurApiException::class],
        ];
    }

    /**
     * @param class-string<AugurApiException> $class
     */
    #[DataProvider('statusProvider')]
    public function testMappedStatusesThrow(int $status, string $class): void
    {
        $this->addRaw($status, '{"message":"from server","errors":{"a":"b"}}');

        try {
            $this->api->call('items.invMast.get', ['invMastUid' => 424242], ['edgeCache' => 1]);
            $this->fail('Expected exception');
        } catch (AugurApiException $e) {
            $this->assertSame($class, $e::class);
            $this->assertSame($status, $e->getCode());
            $this->assertSame('from server', $e->getMessage());
            $this->assertSame('items', $e->service);
            $this->assertSame('/inv-mast/{invMastUid}', $e->endpoint);
            if ($e instanceof ValidationException) {
                $this->assertSame(['a' => 'b'], $e->errors);
            }
        }
    }

    public function testNonJsonErrorBodyNeverReachesTheMessage(): void
    {
        $this->addRaw(500, 'upstream exploded', 'text/plain');

        $this->expectException(AugurApiException::class);
        $this->expectExceptionMessage('Request failed with status 500');

        $this->api->call('items.ping.get');
    }

    // ----- argument checks -----

    public function testUnknownIdHasNoServiceOrEndpoint(): void
    {
        $e = $this->invalid('items.nope.get');

        $this->assertSame('', $e->service);
        $this->assertSame('', $e->endpoint);
        $this->assertSame('Unknown endpoint id: items.nope.get', $e->getMessage());
    }

    public function testMissingPathParam(): void
    {
        $e = $this->invalid('items.invMast.get');

        $this->assertSame('items', $e->service);
        $this->assertSame('/inv-mast/{invMastUid}', $e->endpoint);
        $this->assertSame('Missing path params for items.invMast.get: invMastUid', $e->getMessage());
    }

    public function testUnknownPathParamHasNoFuzzyMatching(): void
    {
        $e = $this->invalid('items.invMast.get', ['invMastUid' => 1, 'inv_mast_uid' => 2]);

        $this->assertSame('Unknown path params for items.invMast.get: inv_mast_uid', $e->getMessage());
    }

    public function testListPathParamsAreUnknownKeys(): void
    {
        $e = $this->invalid('items.ping.get', ['secret']);

        $this->assertSame('Unknown path params for items.ping.get: 0', $e->getMessage());
        $this->assertStringNotContainsString('secret', $e->getMessage());
    }

    /**
     * @return array<string, array{mixed}>
     */
    public static function badPathValueProvider(): array
    {
        return [
            'non-integer for numeric' => ['secret-abc'],
            'float' => [1.5],
            'null' => [null],
            'bool' => [true],
            'array' => [['secret']],
        ];
    }

    #[DataProvider('badPathValueProvider')]
    public function testBadPathValues(mixed $value): void
    {
        $e = $this->invalid('items.invMast.get', ['invMastUid' => $value]);

        $this->assertSame('/inv-mast/{invMastUid}', $e->endpoint);
        $this->assertStringStartsWith("Invalid path parameter 'invMastUid': expected ", $e->getMessage());
        $this->assertStringNotContainsString('secret', $e->getMessage());
    }

    public function testEmptyStringPathValue(): void
    {
        $entry = self::firstEntry(static fn (EndpointEntry $e): bool => count($e->pathParams) === 1
            && !PathValidator::isNumericPlaceholder($e->pathParams[0]));

        $e = $this->invalid($entry->id, [$entry->pathParams[0] => '']);

        $this->assertStringContainsString('non-empty string', $e->getMessage());
    }

    public function testUnknownQueryKey(): void
    {
        $e = $this->invalid('items.ping.get', [], ['q' => 'secret']);

        $this->assertSame('Unknown query params for items.ping.get: q', $e->getMessage());
        $this->assertStringNotContainsString('secret', $e->getMessage());
    }

    public function testEdgeCacheRejectedWhenEntryDoesNotCache(): void
    {
        $entry = self::firstEntry(static fn (EndpointEntry $e): bool => !$e->edgeCache && $e->pathParams === []);

        $e = $this->invalid($entry->id, [], ['edgeCache' => 1]);

        $this->assertStringContainsString('edgeCache', $e->getMessage());
    }

    public function testBodyRejectedWithoutHasBody(): void
    {
        $e = $this->invalid('items.ping.get', [], [], ['secret' => 1]);

        $this->assertSame('items.ping.get takes no body', $e->getMessage());
    }
}
