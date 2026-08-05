<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInt\Resources;

use AugurApi\Services\AgrInt\Resources\BundlesResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for BundlesResource.
 */
#[CoversClass(BundlesResource::class)]
final class BundlesResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['bundlesUid' => 1, 'bundleId' => 'admin', 'bundleName' => 'Admin Bundle'],
            ['bundlesUid' => 2, 'bundleId' => 'viewer', 'bundleName' => 'Viewer Bundle'],
        ]);

        $response = $this->api->agrInt->bundles->list();

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('admin', $data[0]['bundleId']);
        $this->assertRequestPath('/bundles');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['bundlesUid' => 1, 'bundleId' => 'admin'],
        ], 25);

        $response = $this->api->agrInt->bundles->list(['limit' => 10, 'systemFlag' => 'Y']);

        $this->assertCount(1, $response->data);
        $this->assertEquals(25, $response->total);
    }

    public function testCreate(): void
    {
        $this->mockResponse(['bundlesUid' => 3, 'bundleId' => 'new', 'bundleName' => 'New Bundle']);

        $response = $this->api->agrInt->bundles->create(['bundleId' => 'new']);

        $this->assertEquals('new', $response->data['bundleId']);
        $this->assertRequestPath('/bundles');
        $this->assertRequestMethod('POST');
    }

    public function testGet(): void
    {
        $this->mockResponse(['bundlesUid' => 1, 'bundleId' => 'admin', 'description' => 'All access']);

        $response = $this->api->agrInt->bundles->get(1);

        $this->assertEquals(1, $response->data['bundlesUid']);
        $this->assertEquals('All access', $response->data['description']);
        $this->assertRequestPath('/bundles/1');
        $this->assertRequestMethod('GET');
    }

    public function testUpdate(): void
    {
        $this->mockResponse(['bundlesUid' => 1, 'bundleName' => 'Renamed']);

        $response = $this->api->agrInt->bundles->update(1, ['bundleName' => 'Renamed']);

        $this->assertEquals('Renamed', $response->data['bundleName']);
        $this->assertRequestPath('/bundles/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['success' => true]);

        $this->api->agrInt->bundles->delete(1);

        $this->assertRequestPath('/bundles/1');
        $this->assertRequestMethod('DELETE');
    }

    public function testListResources(): void
    {
        $this->mockListResponse([
            ['bundlesXResourcesUid' => 7, 'bundlesUid' => 1, 'resourcesUid' => 4],
        ]);

        $response = $this->api->agrInt->bundles->listResources(1);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/bundles/1/resources');
        $this->assertRequestMethod('GET');
    }

    public function testCreateResources(): void
    {
        $this->mockResponse(['bundlesXResourcesUid' => 7, 'bundlesUid' => 1, 'resourcesUid' => 4]);

        $response = $this->api->agrInt->bundles->createResources(1, ['resourcesUid' => 4]);

        $this->assertEquals(4, $response->data['resourcesUid']);
        $this->assertRequestPath('/bundles/1/resources');
        $this->assertRequestMethod('POST');
    }

    public function testGetResources(): void
    {
        $this->mockResponse(['bundlesXResourcesUid' => 7, 'readCd' => 1, 'writeCd' => 0]);

        $response = $this->api->agrInt->bundles->getResources(1, 7);

        $this->assertEquals(7, $response->data['bundlesXResourcesUid']);
        $this->assertRequestPath('/bundles/1/resources/7');
        $this->assertRequestMethod('GET');
    }

    public function testUpdateResources(): void
    {
        $this->mockResponse(['bundlesXResourcesUid' => 7, 'writeCd' => 1]);

        $response = $this->api->agrInt->bundles->updateResources(1, 7, ['writeCd' => 1]);

        $this->assertEquals(1, $response->data['writeCd']);
        $this->assertRequestPath('/bundles/1/resources/7');
        $this->assertRequestMethod('PUT');
    }

    public function testDeleteResources(): void
    {
        $this->mockResponse(['success' => true]);

        $this->api->agrInt->bundles->deleteResources(1, 7);

        $this->assertRequestPath('/bundles/1/resources/7');
        $this->assertRequestMethod('DELETE');
    }
}
