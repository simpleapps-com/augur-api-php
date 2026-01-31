<?php

declare(strict_types=1);

namespace AugurApi\Tests\Core;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\BaseServiceClient;
use AugurApi\Tests\AugurApiTestCase;

final class BaseServiceClientTest extends AugurApiTestCase
{
    public function testHealthCheckMethod(): void
    {
        $this->mockHealthCheckResponse();

        $result = $this->api->items->healthCheck();

        $this->assertInstanceOf(BaseResponse::class, $result);
        $this->assertEquals('abc123', $result->data['siteHash']);
        $this->assertEquals('TEST123', $result->data['siteId']);
        $this->assertRequestPath('/health-check');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testHealthCheckNoAuthHeader(): void
    {
        $this->mockHealthCheckResponse();

        $this->api->items->healthCheck();

        $request = $this->getLastRequest();
        $this->assertEquals('', $request->getHeaderLine('Authorization'));
    }

    public function testPingMethod(): void
    {
        $this->mockPingResponse();

        $result = $this->api->items->ping();

        $this->assertInstanceOf(BaseResponse::class, $result);
        $this->assertEquals('pong', $result->data);
        $this->assertRequestPath('/ping');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testPingNoAuthHeader(): void
    {
        $this->mockPingResponse();

        $this->api->items->ping();

        $request = $this->getLastRequest();
        $this->assertEquals('', $request->getHeaderLine('Authorization'));
    }

    public function testWhoamiMethod(): void
    {
        $this->mockWhoamiResponse();

        $result = $this->api->items->whoami();

        $this->assertInstanceOf(BaseResponse::class, $result);
        $this->assertEquals('TEST123', $result->data['siteId']);
        $this->assertEquals('Test Site', $result->data['siteName']);
        $this->assertRequestPath('/whoami');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
    }

    public function testWhoamiNoAuthHeader(): void
    {
        $this->mockWhoamiResponse();

        $this->api->items->whoami();

        $request = $this->getLastRequest();
        $this->assertEquals('', $request->getHeaderLine('Authorization'));
    }

    public function testServiceBaseUrlConfigured(): void
    {
        $this->mockHealthCheckResponse();

        $this->api->items->healthCheck();

        $request = $this->getLastRequest();
        $this->assertStringStartsWith('https://items.augur-api.com', (string) $request->getUri());
    }

    public function testGetServiceNameViaReflection(): void
    {
        $reflection = new \ReflectionClass($this->api->items);
        $method = $reflection->getMethod('getServiceName');

        $serviceName = $method->invoke($this->api->items);

        $this->assertEquals('items', $serviceName);
    }

    public function testDifferentServiceHasDifferentBaseUrl(): void
    {
        $this->mockHealthCheckResponse();

        $this->api->customers->healthCheck();

        $request = $this->getLastRequest();
        $this->assertStringStartsWith('https://customers.augur-api.com', (string) $request->getUri());
    }

    public function testMultipleServicesHaveCorrectNames(): void
    {
        $services = [
            'items' => 'items',
            'customers' => 'customers',
            'orders' => 'orders',
            'commerce' => 'commerce',
            'pricing' => 'pricing',
        ];

        foreach ($services as $property => $expectedName) {
            $serviceClient = $this->api->$property;
            $reflection = new \ReflectionClass($serviceClient);
            $method = $reflection->getMethod('getServiceName');

            $actualName = $method->invoke($serviceClient);

            $this->assertEquals($expectedName, $actualName);
        }
    }

    public function testHealthCheckResponse200(): void
    {
        $this->mockHealthCheckResponse();

        $result = $this->api->items->healthCheck();

        $this->assertEquals(200, $result->status);
    }

    public function testPingResponse200(): void
    {
        $this->mockPingResponse();

        $result = $this->api->items->ping();

        $this->assertEquals(200, $result->status);
    }

    public function testWhoamiResponse200(): void
    {
        $this->mockWhoamiResponse();

        $result = $this->api->items->whoami();

        $this->assertEquals(200, $result->status);
    }

    public function testBaseServiceClientIsAbstract(): void
    {
        $reflection = new \ReflectionClass(BaseServiceClient::class);
        $this->assertTrue($reflection->isAbstract());
    }

    public function testGetServiceNameIsAbstract(): void
    {
        $reflection = new \ReflectionClass(BaseServiceClient::class);
        $method = $reflection->getMethod('getServiceName');
        $this->assertTrue($method->isAbstract());
    }
}
