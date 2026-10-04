<?php

declare(strict_types=1);

namespace AugurApi\Tests;

use AugurApi\AugurApiClient;
use AugurApi\Core\Client;
use AugurApi\Core\Exceptions\AugurApiException;
use AugurApi\Core\Exceptions\InvalidArgumentException;
use AugurApi\Core\Exceptions\NotFoundException;
use Nyholm\Psr7\Response;

/**
 * Typed methods: exceptions carry the kebab service and full path template,
 * never param values; edgeCache is transformed.
 */
final class TypedErrorContextTest extends AugurApiTestCase
{
    public function testResourceErrorCarriesServiceAndTemplate(): void
    {
        $this->mockClient->addResponse(new Response(404, [], '{"message":"gone"}'));

        try {
            $this->api->items->invMast->get(987654, ['q' => 'secret-query']);
            $this->fail('Expected NotFoundException');
        } catch (NotFoundException $e) {
            $this->assertSame('items', $e->service);
            $this->assertSame('/inv-mast/{invMastUid}', $e->endpoint);
            $this->assertSame('gone', $e->getMessage());
        }
    }

    public function testBaseEndpointErrorCarriesKebabService(): void
    {
        $this->mockClient->addResponse(new Response(403, [], ''));

        try {
            $this->api->openSearch->whoami();
            $this->fail('Expected AugurApiException');
        } catch (AugurApiException $e) {
            $this->assertSame(AugurApiException::class, $e::class);
            $this->assertSame('open-search', $e->service);
            $this->assertSame('/whoami', $e->endpoint);
            $this->assertSame('Request failed with status 403', $e->getMessage());
        }
    }

    public function testEveryServiceClientReportsItsRegistryServiceName(): void
    {
        $services = [];
        foreach (AugurApiClient::endpoints() as $entry) {
            $services[explode('.', $entry->id)[0]] = $entry->service;
        }

        foreach ($services as $property => $kebab) {
            $this->mockClient->addResponse(new Response(404, [], ''));
            try {
                $this->api->{$property}->ping();
                $this->fail("Expected NotFoundException for {$property}");
            } catch (NotFoundException $e) {
                $this->assertSame($kebab, $e->service, $property);
                $this->assertSame('/ping', $e->endpoint, $property);
            }
        }
    }

    public function testPathValidationErrorOmitsValue(): void
    {
        // Typed int params cannot carry a bad value, so drive a service-bound Client directly.
        $client = (new Client(
            $this->api->getConfig(),
            $this->mockClient,
            $this->factory,
            $this->factory,
        ))->forService('orders');

        try {
            $client->get('https://orders.augur-api.com/oe-hdr', '/{oeHdrUid}', [], ['oeHdrUid' => 'secret-no']);
            $this->fail('Expected InvalidArgumentException');
        } catch (InvalidArgumentException $e) {
            $this->assertSame('orders', $e->service);
            $this->assertSame('/oe-hdr/{oeHdrUid}', $e->endpoint);
            $this->assertStringNotContainsString('secret-no', $e->getMessage());
        }
    }

    public function testTypedMethodTransformsEdgeCache(): void
    {
        $this->mockResponse([]);

        $this->api->items->invMast->get(1, ['edgeCache' => 3]);

        $this->assertSame('cacheSiteId3=TEST123', $this->getLastRequest()->getUri()->getQuery());
    }
}
