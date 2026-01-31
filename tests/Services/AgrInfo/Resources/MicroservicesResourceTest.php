<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInfo\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for MicroservicesResource.
 */
final class MicroservicesResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['microservicesUid' => 1, 'name' => 'Service A', 'status' => 'active'],
            ['microservicesUid' => 2, 'name' => 'Service B', 'status' => 'active'],
        ]);

        $response = $this->api->agrInfo->microservices->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Service A', $response->data[0]['name']);
        $this->assertRequestPath('/microservices');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['microservicesUid' => 1, 'name' => 'Service A'],
        ]);

        $response = $this->api->agrInfo->microservices->list(['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'microservicesUid' => 1,
            'name' => 'Service A',
            'status' => 'active',
            'endpoint' => 'https://service-a.augur-api.com',
        ]);

        $response = $this->api->agrInfo->microservices->get(1);

        $this->assertEquals(1, $response->data['microservicesUid']);
        $this->assertEquals('Service A', $response->data['name']);
        $this->assertRequestPath('/microservices/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'microservicesUid' => 3,
            'name' => 'New Service',
            'status' => 'pending',
        ]);

        $response = $this->api->agrInfo->microservices->create([
            'name' => 'New Service',
            'endpoint' => 'https://new-service.augur-api.com',
        ]);

        $this->assertEquals(3, $response->data['microservicesUid']);
        $this->assertEquals('New Service', $response->data['name']);
        $this->assertRequestPath('/microservices');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'microservicesUid' => 1,
            'name' => 'Updated Service',
            'status' => 'active',
        ]);

        $response = $this->api->agrInfo->microservices->update(1, ['name' => 'Updated Service']);

        $this->assertEquals('Updated Service', $response->data['name']);
        $this->assertRequestPath('/microservices/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->agrInfo->microservices->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/microservices/1');
        $this->assertRequestMethod('DELETE');
    }
}
